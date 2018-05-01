# cms

<img src="https://image.ibb.co/drFTeS/cms.png"></img>

Run laravel:
1. php artisan serve

Admin page:
http://localhost:8000/admin

Add CRUD on cms (example):
1. php artisan make:Migration create_testing_table
2. php artisan make:Controller Models/Testing
3. connect Models/Testing to testing table
   protected $table = 'testing';
1. php artisan make:Controller Admin/TestingController
2. copy Admin/CRUDController to Admin/TestingController
3. On Admin/TestingController:
   match $this->model to Models/Testing
   match $this->data['title'] with your 'Testing'
   match $this->data['objectName'] 'testing' -> refer(views/admin/testing) folder
4. create routes on routes/web
	Route::prefix('testing')->group(function(){
	    Route::get('/truncate', 'Admin\TestingController@truncate');
        Route::get('/', 'Admin\TestingController@list');
        Route::get('/add', 'Admin\TestingController@add');
        Route::post('/addProcess', 'Admin\TestingController@addProcess');
        Route::get('/{id}', 'Admin\TestingController@detail');
        Route::get('/edit/{id}', 'Admin\TestingController@edit');
        Route::post('/editProcess', 'Admin\TestingController@editProcess');
        Route::get('/delete/{id}/{isDeleted}', 'Admin\TestingController@deleteProcess');
        Route::get('/deletePermanent/{id}', 'Admin\TestingController@deletePermanentProcess');
    });
5. CRUD ready to use!