<?php

namespace App\Modules\BackEnd\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class AccountCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard(\Session::get('guard'))->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
