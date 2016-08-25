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
    
    Route::group(['domain' => $domain, 'middleware' => ['web'],'namespace' => 'App\Modules\FrontEnd\Controllers'], function () {

        Route::get('/',['as'=>'FrontEndHome.index','uses' => 'HomeController@index']);

    });
}


