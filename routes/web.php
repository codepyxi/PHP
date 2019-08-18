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

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@validation');
Route::get('/logout', 'LoginController@logout');
		

//authentication
	Route::group(['middleware' => 'authverify'], function(){
	
		Route::get('/register', 'RegisterController@index');
		Route::post('/register', 'RegisterController@save');
		Route::get('/employee-list', 'RegisterController@list');
		Route::get('/employee-edit-{id?}', 'RegisterController@edit');
		Route::post('/employee-delete', 'RegisterController@delete');
		Route::get('/send-email', 'emailController@index');
		Route::get('/employee-pdf', 'RegisterController@pdf');
		
	});
	

