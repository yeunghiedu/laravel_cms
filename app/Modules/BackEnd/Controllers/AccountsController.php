<?php

namespace App\Modules\BackEnd\Controllers;

use App\Modules\BackEnd\Requests\AccountCreateRequest;
use App\Modules\BackEnd\Requests\AccountUpdateRequest;
use App\Modules\BackEnd\Requests\AccountDeleteRequest;
use App\Modules\Core\Repositories\AccountRepository;
use App\Modules\Core\Validators\AccountValidator;
use App\Modules\Core\Constant;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;


class AccountsController extends Controller
{

    /**
     * @var AccountRepository
     */
    protected $accRepo;


    /**
     * @var AccountValidator
     */
    protected $validator;

    public function __construct(AccountRepository $accRepo, AccountValidator $validator )
    {
        $this->accRepo = $accRepo;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', Constant::PER_PAGE_DEFAULT);

        $accRepo = $this->accRepo;

        return view('BackEnd::account.index', compact('perPage','accRepo'));
    }

    public function info(Request $request){

        $accountId = $request->input('accountId', 0);

        if($accountId == 0){
            return redirect()->route('BackEndAccount.index');
        }

        $account = $this->accRepo->find($accountId);

        $perPage = $request->input('perPage', Constant::PER_PAGE_DEFAULT);


        $accRepo = $this->accRepo;

        return view('BackEnd::account.accountInfo', compact('account','perPage','accRepo'));
    }

    public function create(){
        return view('BackEnd::account.accountCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AccountCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AccountCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $account = $this->accRepo->create($request->all());

            $response = [
                'message' => 'Account created.',
                'data'    => $account->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('BackEndAccount.index');
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        } catch (QueryException $qe){
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $qe->getMessageBag()
                ]);
            }
            return redirect()->back()->withErrors($qe->getMessageBag())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AccountUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(AccountUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $account = $this->accRepo->update($request->all(), $id);
            $response = [
                'error' => false,
                'message' => 'Account updated.',
                'data'    => $account->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('response', $response);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountDeleteRequest $request)
    {
        if($request->ajax()){
            $ids = $request->input('id',0);
            if($ids == 0) return response()->json(array('success' => false, 'html' => 'No ID found!'));

            $this->accRepo->deleteWhere(['condition'=>['Id','In',$ids]]);

            return response()->json(array('success' => true, 'html' => 'Delete Completed.'));
        }
        return response()->json(array('success' => false, 'html' => 'Not ajax request'));
    }
}
