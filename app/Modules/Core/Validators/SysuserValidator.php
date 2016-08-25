<?php

namespace App\Modules\Core\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class SysuserValidator extends LaravelValidator
{

    protected $rules = [
        'login' => [
            'UserName' => 'required|max:50',
            'password' => 'required|min:6',
        ],
        ValidatorInterface::RULE_CREATE => [
        	'UserName' => 'bail|required|regex:/^[A-Za-z0-9]+(?:[._-][A-Za-z0-9]+)*$/u|unique:sysuser|max:32',
        	'Password' => 'bail|required|min:6|max:60',
        	'Role' => 'required|numeric',
        	'Status' => 'required|numeric',
        	],
        ValidatorInterface::RULE_UPDATE => [
        	'Password' => 'bail|required|min:6|max:60',
        	'Role' => 'required|numeric',
        	'Status' => 'required|numeric',],
   ];
}
