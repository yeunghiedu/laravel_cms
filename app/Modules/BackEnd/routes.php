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

            //account
            Route::get('/account',['as'=>'BackEndAccount.index','uses' => 'AccountsController@index']);
            Route::get('/accountCreate',['as'=>'BackEndAccount.create','uses' => 'AccountsController@create']);
            Route::post('/accountStore',['as'=>'BackEndAccount.store','uses' => 'AccountsController@store']);
            Route::get('/accountInfo',['as'=>'BackEndAccount.info','uses' => 'AccountsController@info']);
            Route::post('/accountUpdate/{id}',['as'=>'BackEndAccount.update','uses' => 'AccountsController@update']);
            Route::post('/accountDelete',['as'=>'BackEndAccount.destroy','uses' => 'AccountsController@destroy']);
            Route::get('/loadAccountTableByPerpage',['as'=>'BackEndAjax.loadAccountTableByPerpage','uses' => 'AjaxController@loadAccountTableByPerpage']);
        });

        Route::get('/login',['as'=>'BackEndAuth.getLogin','uses' => 'AuthController@getLogin']);
        Route::post('/login',['as'=>'BackEndAuth.postLogin','uses' => 'AuthController@postLogin']);
        Route::get('/logout',['as'=>'BackEndAuth.logout','uses' => 'AuthController@logout']);
    });
}


