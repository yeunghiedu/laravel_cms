<?php
/**
 * Created by PhpStorm.
 * User: huytt
 * Date: 6/27/2016
 * Time: 9:32 AM
 */

//example
//View::composer('BackEnd::partials.partialNameView', 'App\Modules\BackEnd\Composers\partialNameComposer');
View::composer([
//    'BackEnd::partials.partialTableTemplate',
    'BackEnd::partials.partialAccountManagement',
], 'App\Modules\BackEnd\Composers\partialTableTemplateComposer');

View::composer('BackEnd::account.action.create-edit-acc', 'App\Modules\BackEnd\Composers\actionCreateEditAccComposer');