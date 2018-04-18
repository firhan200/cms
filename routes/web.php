<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', 'Admin\LogController@login');
    Route::get('/logout', 'Admin\HomeController@logout');
    Route::get('/home', 'Admin\HomeController@dashboard');
    Route::get('/profile', 'Admin\ProfileController@profile');
    Route::get('/changePassword', 'Admin\ProfileController@changePassword');

    Route::post('/login', 'Admin\LogController@loginProcess');
    Route::post('/checkUnique', 'Admin\BaseController@__checkUnique');
    Route::post('/changePasswordProcess', 'Admin\ProfileController@changePasswordProcess');

    /*user*/
    Route::prefix('user')->group(function(){
        Route::get('/truncate', 'Admin\UserController@truncate');
        Route::get('/', 'Admin\UserController@list');
        Route::get('/add', 'Admin\UserController@add');
        Route::post('/addProcess', 'Admin\UserController@addProcess');
        Route::get('/{id}', 'Admin\UserController@detail');
        Route::get('/edit/{id}', 'Admin\UserController@edit');
        Route::post('/editProcess', 'Admin\UserController@editProcess');
        Route::get('/delete/{id}/{isDeleted}', 'Admin\UserController@deleteProcess');
        Route::get('/deletePermanent/{id}', 'Admin\UserController@deletePermanentProcess');
        Route::get('/resetPassword/{id}', 'Admin\UserController@resetPassword');
    });

    /*setting*/
    Route::prefix('setting')->group(function(){
	    Route::get('/truncate', 'Admin\SettingController@truncate');
        Route::get('/', 'Admin\SettingController@list');
        Route::get('/add', 'Admin\SettingController@add');
        Route::post('/addProcess', 'Admin\SettingController@addProcess');
        Route::get('/{id}', 'Admin\SettingController@detail');
        Route::get('/edit/{id}', 'Admin\SettingController@edit');
        Route::post('/editProcess', 'Admin\SettingController@editProcess');
        Route::get('/delete/{id}/{isDeleted}', 'Admin\SettingController@deleteProcess');
        Route::get('/deletePermanent/{id}', 'Admin\SettingController@deletePermanentProcess');
    });
});