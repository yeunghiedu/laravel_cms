<?php

namespace App\Modules\Core\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class AccountValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'Account' => 'bail|required|unique:account|unique:sysuser,Username|max:32',
            'Password' => 'bail|required|min:6|max:60',
        	'AccountStatus' => 'required|numeric',
        	'AccountType' => 'required|numeric',
        	'Email' => 'bail|required|email|unique:account|max:64',
            'Phone' => 'required|max:32',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'Password' => 'required|min:6|max:60',
        	'AccountStatus' => 'required|numeric',
        	'AccountType' => 'required|numeric',
            'Email' => 'bail|required|email|unique:account|max:64',
            'Phone' => 'required|max:32',
        ],
   ];
}
