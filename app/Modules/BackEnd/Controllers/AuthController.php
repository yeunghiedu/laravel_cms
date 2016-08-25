<?php

namespace App\Modules\BackEnd\Controllers;

use App\Http\Requests;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Modules\Core\Repositories\SysuserRepository;
use App\Modules\Core\Validators\SysuserValidator;


class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';
    protected $redirectAfterLogout = '/admin/login';

    /**
     * @var SysuserRepository
     */
    protected $repository;

    /**
     * @var SysuserValidator
     */
    protected $validator;

    protected $messageErrors;

    //[HTBS-750] huytt: define tables will be used to login
    protected $guards = ['sysusers'];

    protected $guard = null;

    public function __construct(SysuserRepository $repository, SysuserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        
        $this->guard = \Session::get('guard');
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    public function getLogin(){
        return view('BackEnd::auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail('login');

            // If the class is using the ThrottlesLogins trait, we can automatically throttle
            // the login attempts for this application. We'll key this by the username and
            // the IP address of the client making these requests into this application.
            $throttles = $this->isUsingThrottlesLoginsTrait();

            if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }

            foreach($this->guards as $guard) {
                $this->guard = $guard;
                $credentials = $this->getCredentials($request);

                if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
                    \Session::put('guard', $guard);
                    return $this->handleUserWasAuthenticated($request, $throttles);
                }
            }

            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            if ($throttles && !$lockedOut) {
                $this->incrementLoginAttempts($request);
            }

            return $this->sendFailedLoginResponse('Username or Password incorrect');
        } catch (ValidatorException $e){
            return $this->sendFailedLoginResponse($e->getMessageBag());
        }
    }

    // [HTBS-750] huytt: use guard from session to logout and create Credentials with name of table
    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard($this->getGuard())->logout();

        \Session::remove('guard');
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        $formInput = $request->only('UserName', 'password');
        $results = [];

        Arr::set($results, $this->loginUsername(), $formInput['UserName'] );
        Arr::set($results, 'password', $formInput['password'] );

        return $results;

//        return $request->only($this->loginUsername(), 'password');
    }

    public function loginUsername()
    {
        switch($this->getGuard()){
            case 'accounts':
                return property_exists($this, 'Account') ? $this->Account : 'Account';
            case 'sysusers':
            default:
                return property_exists($this, 'UserName') ? $this->UserName : 'UserName';
        }
    }

    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse($messages)
    {
        return redirect()->back()->withErrors($messages)->withInput();
    }
}
