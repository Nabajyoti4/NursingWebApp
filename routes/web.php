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

use App\User;

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



Route::resource('nursejoin','NurseJoinRequestController', ['names' =>[

    'index'=>'nursejoin.index',
    'create'=>'nursejoin.create',
    'store'=>'nursejoin.store',
    'edit'=>'nursejoin.edit',
    'show'=>'nursejoin.show'

]
]);


Route::post('nursejoin/{candidate}/approve', 'NurseJoinRequestController@approve')->name('nursejoin.approve');
Route::post('nursejoin/{id}/disapprove', 'NurseJoinRequestController@disapprove');


//for Admin Nurse
Route::resource('admin/nurse','AdminController\AdminNurseController', ['names' =>[
    'index'=>'admin.nurse.index',
    'create'=>'admin.nurse.create',
    'store'=>'admin.nurse.store',
    'edit'=>'admin.nurse.edit',
    'show'=>'admin.nurse.show'
]
]);


//admins
Route::get('/admin/admins',function (){
    $admins = User::where('role', 'admin')->get();
    return view('admin.admins.index',compact('admins'));
})->name('admin.admins.index');

