<?php

namespace App\Modules\BackEnd\Composers;


use App\Modules\Core\Repositories\AccountRepository;
use App\Modules\Core\Constant;
use Illuminate\Support\Facades\URL;

class actionCreateEditAccComposer
{
    protected $accRepo;

    public function __construct(AccountRepository $accRepo){
        $this->accRepo = $accRepo;
    }
    public function compose($view){
        // get params value
        $viewdata= $view->getData();

        $isCreate = $viewdata['isCreate'];

        $account = null;

        if(!$isCreate){
            $accountId = $viewdata['accountId'];

            $account = $this->accRepo->find($accountId);

        }

        $accountType = ['Administrator','Editor'];

        $accountStatus = ['Active','Inactive'];


        $view->with([
            'account' => $account,
            'accountType' => $accountType,
            'accountStatus' => $accountStatus
        ]);
    }
}