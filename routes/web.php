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


Route::get('/', 'HomeController@index');
Route::get('/contact-us', 'ContactUsController@index');
Route::get('/login', 'UserController@login');
Route::get('/sign-up', 'UserController@signUp');
Route::get('/logout', 'HomeController@logout');
Route::post('/loginProcess', 'UserController@loginProcess');
Route::post('/signUpProcess', 'UserController@signUpProcess');
Route::post('/contactUsProcess', 'ContactUsController@contactUsProcess');
Route::post('/checkUnique', 'BaseController@__checkUnique');

/*======== profile ============*/
Route::get('/profile', 'ProfileController@index');
Route::get('/profile/change-password', 'ProfileController@changePassword');
Route::post('/profile/changePasswordProcess', 'ProfileController@changePasswordProcess');
Route::get('/profile/edit', 'ProfileController@edit');
Route::post('/profile/editProcess', 'ProfileController@editProcess');

/*======== article ============*/
Route::get('/articles', 'ArticleController@index');
Route::get('/articles/{id}', 'ArticleController@detail');
Route::post('/getArticles', 'ArticleController@getArticles');



/*================= admin section start =================*/
Route::prefix('admin')->group(function () {
    Route::get('/', 'Admin\LogController@login');
    Route::get('/email', 'Admin\LogController@sendEmail');
    Route::get('/logout', 'Admin\HomeController@logout');
    Route::get('/home', 'Admin\HomeController@dashboard');
    Route::get('/profile', 'Admin\ProfileController@profile');
    Route::get('/changePassword', 'Admin\ProfileController@changePassword');
    Route::get('/forgotPassword', 'Admin\LogController@forgotPassword');
    Route::get('/resetPassword', 'Admin\LogController@resetPassword');
    Route::post('/forgotPasswordProcess', 'Admin\LogController@forgotPasswordProcess');
    Route::post('/resetPasswordProcess', 'Admin\LogController@resetPasswordProcess');

    Route::post('/login', 'Admin\LogController@loginProcess');
    Route::post('/checkUnique', 'Admin\BaseController@__checkUnique');
    Route::post('/checkNotifications', 'Admin\NotificationController@checkNotifications');
    Route::post('/getNotifications', 'Admin\NotificationController@getNotifications');
    Route::post('/truncateNotifications', 'Admin\NotificationController@truncate');
    Route::post('/changePasswordProcess', 'Admin\ProfileController@changePasswordProcess');

    //dashboard
    Route::post('/getTotal', 'Admin\HomeController@getTotal');
    Route::post('/getLatestFeedback', 'Admin\HomeController@getLatestFeedback');
    Route::post('/getLatestUsers', 'Admin\HomeController@getLatestUsers');
    Route::post('/getUsersStatistic', 'Admin\HomeController@getUsersStatistic');
    Route::post('/getFeedbackStatistic', 'Admin\HomeController@getFeedbackStatistic');

    /*articles*/
    Route::prefix('article')->group(function(){
        Route::get('/truncate', 'Admin\ArticleController@truncate');
        Route::get('/', 'Admin\ArticleController@list');
        Route::get('/add', 'Admin\ArticleController@add');
        Route::post('/addProcess', 'Admin\ArticleController@addProcess');
        Route::get('/{id}', 'Admin\ArticleController@detail');
        Route::get('/edit/{id}', 'Admin\ArticleController@edit');
        Route::post('/editProcess', 'Admin\ArticleController@editProcess');
        Route::get('/delete/{id}/{isDeleted}', 'Admin\ArticleController@deleteProcess');
        Route::get('/deletePermanent/{id}', 'Admin\ArticleController@deletePermanentProcess');
    });

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

    /*message*/
    Route::prefix('message')->group(function(){
	    Route::get('/truncate', 'Admin\MessageController@truncate');
        Route::get('/', 'Admin\MessageController@list');
        Route::get('/sent', 'Admin\MessageController@sent');
        Route::get('/add', 'Admin\MessageController@add');
        Route::post('/addProcess', 'Admin\MessageController@addProcess');
        Route::get('/{id}', 'Admin\MessageController@detail');
        Route::post('/reply/{message_id}', 'Admin\MessageController@reply');
        Route::get('/delete/{id}/{isDeleted}', 'Admin\MessageController@deleteProcess');
        Route::get('/deletePermanent/{id}', 'Admin\MessageController@deletePermanentProcess');
    });

    /*contact us*/
    Route::prefix('contact_us')->group(function(){
        Route::get('/truncate', 'Admin\ContactUsController@truncate');
        Route::get('/', 'Admin\ContactUsController@list');
        Route::get('/{id}', 'Admin\ContactUsController@detail');
        Route::get('/delete/{id}/{isDeleted}', 'Admin\ContactUsController@deleteProcess');
        Route::get('/deletePermanent/{id}', 'Admin\ContactUsController@deletePermanentProcess');
    });

    /*admin account*/
    Route::prefix('admin_account')->group(function(){
	    Route::get('/truncate', 'Admin\AdminAccountController@truncate');
        Route::get('/', 'Admin\AdminAccountController@list');
        Route::get('/add', 'Admin\AdminAccountController@add');
        Route::post('/addProcess', 'Admin\AdminAccountController@addProcess');
        Route::get('/{id}', 'Admin\AdminAccountController@detail');
        Route::get('/edit/{id}', 'Admin\AdminAccountController@edit');
        Route::post('/editProcess', 'Admin\AdminAccountController@editProcess');
        Route::get('/delete/{id}/{isDeleted}', 'Admin\AdminAccountController@deleteProcess');
        Route::get('/deletePermanent/{id}', 'Admin\AdminAccountController@deletePermanentProcess');
        Route::get('/resetPassword/{id}', 'Admin\AdminAccountController@resetPassword');
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