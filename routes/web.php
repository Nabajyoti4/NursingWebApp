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
    return view('index');
});

Auth::routes(['verify' => true]);



Route::get('/home', 'HomeController@index')->name('home');

// Admin Routes
Route::get('admin','AdminController@index')->name('admin.index');


// Admin User controller
Route::resource('admin/users','AdminController\AdminUsersController',['names'=> [
    'index'=>'admin.users.index',
    'edit'=>'admin.users.edit',
    'update'=>'admin.users.update'
]]);



// User controller
Route::resource('users','User\UserController',['names'=> [
    'index'=>'users.index',
    'edit'=>'users.edit',
    'update'=>'users.update'
]]);








