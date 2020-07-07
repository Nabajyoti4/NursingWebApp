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
use Illuminate\Support\Facades\Auth;

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
    'update'=>'admin.users.update',
     'show'=>'admin.users.show'
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




Route::resource('user/service' , 'UserServiceController', ['names' =>[

    'index'=>'user.service.index',

]
]);




//for Admin Nurse
Route::resource('admin/nurse','AdminController\AdminNurseController', ['names' =>[
    'index'=>'admin.nurse.index',
    'create'=>'admin.nurse.create',
    'store'=>'admin.nurse.store',
    'edit'=>'admin.nurse.edit',
    'update'=>'admin.nurse.update',
    'show'=>'admin.nurse.show'
]
]);

Route::get('admin.nurse.join/{id}', 'AdminController\AdminNurseController@join')->name('admin.nurse.join');

Route::get('admin.patient.bookCreate/{id}', 'AdminController\AdminBookingController@bookCreate')->name('admin.book.bookCreate');


// Admin patient
Route::resource('admin/patient','AdminController\AdminPatientController', ['names' =>[
    'index'=>'admin.patient.index',
    'edit'=>'admin.patient.edit',
    'update'=>'admin.patient.update',
    'show'=>'admin.patient.show',
]
]);

Route::post('admin/patient/{patient}/approve','AdminController\AdminPatientController@approve')->name('patient.approve');
Route::get('admin/approvedpatient','AdminController\AdminPatientController@approved')->name('admin.patient.approved');
Route::post('admin/patient/{id}/disapprove', 'AdminController\AdminPatientController@disapprove');



// nurse routes
//for  Nurse
Route::resource('nurse','Nurse\NurseController', ['names' =>[
    'index'=>'nurse.index',
    'edit'=>'nurse.edit',
    'update'=>'nurse.update',
]
]);

// Route nurse  booking
Route::get('nurse/book/{id}/show','Nurse\NurseController@booking')->name('nurse.booking.show');

// patient for user
Route::resource('users/patient','Patient\PatientController', ['names' =>[
    'index'=>'users.patient.index',
    'create'=>'users.patient.create',
    'store'=>'users.patient.store',
    'edit'=>'users.patient.edit',
    'update'=>'users.patient.update',
    'show'=>'users.patient.show'
]
]);

// booking
Route::resource('admin/book','AdminController\AdminBookingController', ['names' =>[
    'index'=>'admin.book.index',
    'create'=>'admin.book.create',
    'store'=>'admin.book.store',
    'edit'=>'admin.book.edit',
    'update'=>'admin.book.update',
    'show'=>'admin.book.show'
]
]);

//attendance
Route::resource('/attendance','AttendanceController', ['names' =>[
    'index'=>'attendance.index',
    'create'=>'attendance.create',
    'store'=>'attendance.store',
    'edit'=>'attendance.edit',
    'update'=>'attendance.update',
    'show'=>'attendance.show'
]
]);

Route::get('admin/book/{id}/request','AdminController\AdminBookingController@request')->name('admin.book.request');
Route::post('admin/book/extend','AdminController\AdminBookingController@extend')->name('admin.book.extend');
Route::post('admin/book/takeover','AdminController\AdminBookingController@takeover')->name('admin.book.takeover');
// Route user extend booking
Route::get('user/book/{id}/show','User\UserController@booking')->name('user.booking.show');


//admins
Route::get('/admin/admins',function (){
    $admins = User::where('role', 'admin')->get();
    return view('admin.admins.index',compact('admins'));
})->name('admin.admins.index');




