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

//Route::get('/', function () {
//    return view('auth.login');
//});

Route::get('/', ['middleware' => 'auth', function() {
    return view('homestreward');
}]);

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


/*
 |--------------------------------------------------------------------------
 | 测试路由
 |--------------------------------------------------------------------------
 */
Route::get('test', function(){

});

Route::group(['middleware' => 'auth'], function(){

    /*
     |--------------------------------------------------------------------------
     | 记帐总路由
     |--------------------------------------------------------------------------
     */
    Route::group(['prefix' => 'bill', 'namespace' => 'Bill'], function(){

        Route::get('/', 'BillController@index');
        Route::get('/search', 'BillController@search');
        Route::get('/{year}/{month}/{day}', 'BillController@searchByDate')->where(['year', 'month', 'day'], '[0-9]+');
        Route::post('/new', 'BillController@store');
        Route::get('/total', 'BillController@total');

        // 消费配置相关
        Route::group(['prefix' => 'setting'], function(){
            Route::get('/', function(){
                return view('bill.settings');
            });
            Route::get('/cc', 'BillSettingController@index');
            Route::post("/new", 'BillSettingController@store');
        });
    });

    /*
     |--------------------------------------------------------------------------
     | 用户总路由
     |--------------------------------------------------------------------------
     */
    Route::group(['prefix' => 'user', 'namespace' => 'User'], function(){
//        Route::resource("/", "UserController", ['only' => ['update']]);
        Route::put("/edit", "UserController@update");
    });
});

/*
 |--------------------------------------------------------------------------
 | 微店总路由
 |--------------------------------------------------------------------------
 */
Route::group(['prefix' => 'wd', 'namespace' => 'WD'], function(){
    Route::get("/{category}", "WDController@index")->where('category', '[0-9]+');
    Route::get("/latest/{category}", "WDController@latestIndex")->where('category', '[0-9]+');
    Route::get("/detail/{id}", "WDController@index")->where('id', '[0-9]+');
});
