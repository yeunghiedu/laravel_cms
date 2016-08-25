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
if (App::environment() == \App\Modules\Core\Constant::SUB_DOMAIN)
{
    $domain = \App\Modules\Core\Constant::SUB_DOMAIN.'.'.\App\Modules\Core\Constant::DOMAIN_NAME;
    Route::group(['domain' => $domain,'prefix' => 'admin','middleware' => ['web'],'namespace' => 'App\Modules\BackEnd\Controllers'], function () {
        Route::group(['middleware' => 'auth'],function(){
            Route::get('/',['as'=>'BackEndHome.index','uses' => 'HomeController@index']);

            //charge
            Route::get('/charge',['as'=>'BackEndCharge.index','uses' => 'ChargeController@index']);
            Route::get('/chargeCreate',['as'=>'BackEndCharge.create','uses' => 'ChargeController@create']);
            Route::post('/chargeStore',['as'=>'BackEndCharge.store','uses' => 'ChargeController@store']);
            Route::get('/loadChargelogTableByPerpage',['as'=>'BackEndAjax.loadChargelogTableByPerpage','uses' => 'AjaxController@loadChargelogTableByPerpage']);
        });

        Route::get('/login',['as'=>'BackEndAuth.getLogin','uses' => 'AuthController@getLogin']);
        Route::post('/login',['as'=>'BackEndAuth.postLogin','uses' => 'AuthController@postLogin']);
        Route::get('/logout',['as'=>'BackEndAuth.logout','uses' => 'AuthController@logout']);
    });
}


