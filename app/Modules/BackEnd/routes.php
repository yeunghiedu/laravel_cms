<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

if (App::environment() == \App\Modules\Core\Constant::SUB_DOMAIN_BILLING_SYSTEM)
{
    $domain = \App\Modules\Core\Constant::SUB_DOMAIN_BILLING_SYSTEM.'.'.\App\Modules\Core\Constant::DOMAIN_NAME;
    Route::group(['domain' => $domain, 'middleware' => ['web'],'namespace' => 'App\Modules\BillingSystem\Controllers'], function () {
        Route::group(['middleware' => 'auth'],function(){

            Route::get('/',['as'=>'BillingSystemHome.index','uses' => 'HomeController@index']);

            //charge
            Route::get('/charge',['as'=>'BillingSystemCharge.index','uses' => 'ChargeController@index']);
            Route::get('/chargeCreate',['as'=>'BillingSystemCharge.create','uses' => 'ChargeController@create']);
            Route::post('/chargeStore',['as'=>'BillingSystemCharge.store','uses' => 'ChargeController@store']);
            Route::get('/loadChargelogTableByPerpage',['as'=>'BillingSystemAjax.loadChargelogTableByPerpage','uses' => 'AjaxController@loadChargelogTableByPerpage']);
        });

        Route::get('/login',['as'=>'BillingSystemAuth.getLogin','uses' => 'AuthController@getLogin']);
        Route::post('/login',['as'=>'BillingSystemAuth.postLogin','uses' => 'AuthController@postLogin']);
        Route::get('/logout',['as'=>'BillingSystemAuth.logout','uses' => 'AuthController@logout']);
    });
} else {
    Route::get('/', function () {
        return view('welcome');
    });
}


