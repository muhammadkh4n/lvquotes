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



/*
 | Web middleware
 | includes session state, CSRF protection, and more
 */

Route::group(['middlewareGroups' => ['web']], function () {
    Route::get('/{author?}', [
        'uses' => 'QuoteController@getIndex',
        'as' => 'index'
    ]);

    Route::post('/new', [
        'uses' => 'QuoteController@postQuote',
        'as' => 'create'
    ]);

    Route::get('/delete/{id}', [
        'uses' => 'QuoteController@deleteQuote',
        'as' => 'delete'
    ]);

    Route::get('/gotemail/{author_name}', [
        'uses' => 'QuoteController@getMailCallback',
        'as' => 'mail_callback'
    ]);

    Route::get('/admin/login', [
        'uses' => 'AdminController@getLogin',
        'as' => 'login'
    ]);

    Route::post('/admin/login', [
        'uses' => 'AdminController@postLogin',
        'as' => 'login'
    ]);

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/admin/dashboard', [
            'uses' => 'AdminController@getDashboard',
            'as' => 'dashboard'
        ]);

        Route::get('/admin/quotes', function () {
            return view('admin.quotes');
        });
    });

    Route::get('/admin/logout', [
        'uses' => 'AdminController@getLogout',
        'as' => 'logout'
    ]);
});