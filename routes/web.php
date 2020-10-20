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
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $ratings = \App\Rating::all();
    $services = \App\Service::all();
    $members = \App\Team::all();
    $patients_count = \App\Patient::all()->count();
    $nurses_count = \App\Nurse::all()->count();
    $nurses_active_count = \App\Nurse::all()->where('is_active',1)->count();
    return view('index', compact('ratings','services','members','nurses_count','nurses_active_count','patients_count'));
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');


// Admin Routes
Route::group(['middleware' => ['admin', 'auth']], function () {

    Route::get('admin','AdminController@index')->name('admin.index');

    // Admin User controller
    Route::resource('admin/users','AdminController\AdminUsersController',['names'=> [
        'index'=>'admin.users.index',
        'edit'=>'admin.users.edit',
        'update'=>'admin.users.update',
        'show'=>'admin.users.show'
    ]]);


    Route::get('admin/users/admin/{id}', 'AdminController\AdminUsersController@make_admin')->name('admin.users.admin');


    //for Admin Nurse
    Route::resource('admin/nurse','AdminController\AdminNurseController', ['names' =>[
        'index'=>'admin.nurse.index',
        'create'=>'admin.nurse.create',
        'store'=>'admin.nurse.store',
        'edit'=>'admin.nurse.edit',
        'update'=>'admin.nurse.update',
        'show'=>'admin.nurse.show'
    ]]);


    Route::get('admin/nurse/makePermanent/{id}','AdminController\AdminNurseController@makePermanent')->name('admin.nurse.makePermanent');

    Route::resource('admin/services' , 'AdminController\ServiceController' ,  ['names' =>[
        'index'=>'admin.services.index',
        'create'=>'admin.services.create',
        'store'=>'admin.services.store',
        'edit'=>'admin.services.edit',
        'update'=>'admin.services.update',
        'delete' => 'services.destroy'
    ]]);


    Route::get('admin.nurse.join/{id}', 'AdminController\AdminNurseController@join')->name('admin.nurse.join');


    Route::get('admin.patient.bookCreate/{id}', 'AdminController\AdminBookingController@bookCreate')->name('admin.book.bookCreate');



// Admin patient
    Route::resource('admin/patient','AdminController\AdminPatientController', ['names' =>[
        'index'=>'admin.patient.index',
        'edit'=>'admin.patient.edit',
        'update'=>'admin.patient.update',
        'show'=>'admin.patient.show',
    ]]);


    Route::post('admin/patient/{patient}/approve','AdminController\AdminPatientController@approve')->name('patient.approve');
    Route::get('admin/approved/patient','AdminController\AdminPatientController@approved')->name('admin.patient.approved');
    Route::post('admin/patient/{id}/disapprove', 'AdminController\AdminPatientController@disapprove');


// Admin salary
    Route::resource('admin/salary','AdminController\AdminSalaryController', ['names' =>[
        'index'=>'admin.salary.index',
        'store'=>'admin.salary.store',
        'show'=>'admin.salary.show',
    ]]);

// temporary and permanent nurse salary edit
    Route::get('admin/salary/tedit/{id}', 'AdminController\AdminSalaryController@tedit')->name('admin.salary.tedit');
    Route::get('admin/salary/pedit/{id}', 'AdminController\AdminSalaryController@pedit')->name('admin.salary.pedit');


// temporary and permanent nurse salary create
    Route::get('admin/salary/create/{permanent}', 'AdminController\AdminSalaryController@create')->name('admin.salary.create');
    Route::get('admin/salary/temporary/salary/{id}', 'AdminController\AdminSalaryController@salaries')->name('admin.salary.salaries');

// temporary and permanent nurse salary index
    Route::get('admin/salary/temporary/nurse', 'AdminController\AdminSalaryController@temporarynurses')->name('admin.salary.temporary');
    Route::get('admin/salary/permanent/nurse', 'AdminController\AdminSalaryController@permanentnurses')->name('admin.salary.permanent');

// temporary and permanent nurse salary update
    Route::patch('admin/salary/permanentUpdate/{id}', 'AdminController\AdminSalaryController@permanentUpdate')->name('admin.salary.permanentUpdate');
    Route::patch('admin/salary/temporaryUpdate/{id}', 'AdminController\AdminSalaryController@temporaryUpdate')->name('admin.salary.temporaryUpdate');

    // booking
    Route::resource('admin/book','AdminController\AdminBookingController', ['names' =>[
        'index'=>'admin.book.index',
        'create'=>'admin.book.create',
        'store'=>'admin.book.store',
        'edit'=>'admin.book.edit',
        'update'=>'admin.book.update',
        'show'=>'admin.book.show'
    ]]);




    Route::get('admin/book/{id}/request','AdminController\AdminBookingController@request')->name('admin.book.request');
    Route::post('admin/book/extend','AdminController\AdminBookingController@extend')->name('admin.book.extend');
    Route::post('admin/book/takeover','AdminController\AdminBookingController@takeover')->name('admin.book.takeover');




   //admins
    Route::get('/admin/admins',function (){
        $admins = User::where('role', 'admin')->get();
        return view('admin.admins.index',compact('admins'));
    })->name('admin.admins.index');


   // dashboard routes
    Route::get('admin/dashboard/mark' , 'AdminController\AdminDashboardController@today_attendance')->name('admin.dashboard.mark');
    Route::get('admin/mark/{id}/present' , 'AdminController\AdminDashboardController@mark_present')->name('admin.mark.present');
    Route::get('admin/mark/{id}/absent' , 'AdminController\AdminDashboardController@mark_absent')->name('admin.mark.absent');
    Route::get('admin/dashboard/attendance' , 'AdminController\AdminDashboardController@monthly_attendance')->name('admin.dashboard.attendance');
    Route::get('admin/dashboard/preport/{id}', 'AdminController\AdminDashboardController@permanent_report')->name('admin.dashboard.preport');
    Route::get('admin/dashboard/treport/{id}', 'AdminController\AdminDashboardController@temporary_report')->name('admin.dashboard.treport');

    // Team
    Route::resource('admin/teams','AdminController\AdminTeamController', ['names' =>[
        'index'=>'admin.teams.index',
        'create'=>'admin.teams.create',
        'store'=>'admin.teams.store',
        'edit'=>'admin.teams.edit',
        'update'=>'admin.teams.update',
        'show'=>'admin.teams.show',
        'destroy'=>'teams.destroy'
    ]]);

    // Add featured nurse

    Route::resource('admin/rating','AdminController\AdminRatingController', ['names' =>[
        'index'=>'admin.rating.index',
        'create'=>'admin.rating.create',
        'store'=>'admin.rating.store',
        'edit'=>'admin.rating.edit',
        'update'=>'admin.rating.update',
        'show'=>'admin.rating.show',
        'delete' => 'rating.destroy'
    ]]);

    Route::resource('admin/price','AdminController\AdminPriceController', ['names' =>[
        'index'=>'admin.price.index',
        'create'=>'admin.price.create',
        'store'=>'admin.price.store',
        'edit'=>'admin.price.edit',
        'update'=>'admin.price.update',
        'show'=>'admin.price.show',
        'delete' => 'price.destroy'
    ]]);


    Route::get('admin/query', 'QueryController@index')->name('admin.query.index');
    Route::get('admin/query/{id}', 'QueryController@update')->name('admin.query.update');

    //Role
    Route::get('admin/role', 'AdminController\RoleController@index')->name('admin.role.index');
    Route::get('admin/role/create', 'AdminController\RoleController@create')->name('admin.role.create');
    Route::post('admin/role/store', 'AdminController\RoleController@store')->name('admin.role.store');
    Route::get('admin/role/edit/{id}', 'AdminController\RoleController@edit')->name('admin.role.edit');
    Route::patch('admin/role/update/{id}', 'AdminController\RoleController@update')->name('admin.role.update');
    Route::delete('admin/role/delete/{id}', 'AdminController\RoleController@delete')->name('admin.role.delete');

    //state
    Route::get('admin/city', 'AdminController\AdminCityController@index')->name('admin.city.index');
    Route::get('admin/city/create', 'AdminController\AdminCityController@create')->name('admin.city.create');
    Route::post('admin/city/store', 'AdminController\AdminCityController@store')->name('admin.city.store');
    Route::get('admin/city/edit/{id}', 'AdminController\AdminCityController@edit')->name('admin.city.edit');
    Route::patch('admin/city/update/{id}', 'AdminController\AdminCityController@update')->name('admin.city.update');
    Route::delete('admin/city/delete/{id}', 'AdminController\AdminCityController@delete')->name('admin.city.delete');

    //employees
    Route::resource('admin/employee','AdminController\AdminEmployeeController', ['names' =>[
        'index'=>'admin.employee.index',
        'create'=>'admin.employee.create',
        'store'=>'admin.employee.store',
        'edit'=>'admin.employee.edit',
        'update'=>'admin.employee.update',
        'show'=>'admin.employee.show',
        'delete' => 'employee.destroy'
    ]]);

    Route::post('admin/employee/filter', 'AdminController\AdminEmployeeController@filter')->name('admin.employee.filter');

});

// Admin Routes End



// User controller
Route::resource('users','User\UserController',['names'=> [
    'index'=>'users.index',
    'edit'=>'users.edit',
    'update'=>'users.update'
]])->middleware('auth');



Route::resource('nursejoin','NurseJoinRequestController', ['names' =>[
    'index'=>'nursejoin.index',
    'create'=>'nursejoin.create',
    'store'=>'nursejoin.store',
    'edit'=>'nursejoin.edit',
    'show'=>'nursejoin.show'
]])->middleware('auth');


Route::post('nursejoin/{candidate}/approve', 'NurseJoinRequestController@approve')->name('nursejoin.approve')->middleware('auth', 'admin');
Route::post('nursejoin/{id}/disapprove', 'NurseJoinRequestController@disapprove')->middleware('auth', 'admin');
Route::resource('user/service' , 'UserServiceController', ['names' =>[
    'index'=>'user.service.index',
]]);




// nurse routes
//for  Nurse
Route::resource('nurse','Nurse\NurseController', ['names' =>[
    'index'=>'nurse.index',
    'edit'=>'nurse.edit',
    'update'=>'nurse.update',
]])->middleware('auth');


// Route nurse  booking
Route::get('nurse/book/{id}/show','Nurse\NurseController@booking')->name('nurse.booking.show')->middleware('auth');

// patient for user
Route::resource('users/patient','Patient\PatientController', ['names' =>[
    'index'=>'users.patient.index',
    'create'=>'users.patient.create',
    'store'=>'users.patient.store',
    'edit'=>'users.patient.edit',
    'update'=>'users.patient.update',
    'show'=>'users.patient.show'
]])->middleware('auth');


// user query
Route::post('user/query', 'QueryController@store')->name('user.query.store');

//attendance
Route::resource('/attendance','AttendanceController', ['names' =>[
    'index'=>'attendance.index',
    'create'=>'attendance.create',
    'store'=>'attendance.store',
    'edit'=>'attendance.edit',
    'update'=>'attendance.update',
    'show'=>'attendance.show'
]])->middleware('auth');


// Route user extend booking
Route::get('user/book/{id}/show','User\UserController@booking')->name('user.booking.show')->middleware('auth');

//about us
Route::get('about_us',function (){
    $members = \App\Team::all();
    return view('about_us.index',compact('members'));
})->name('about_us');

//about us
Route::get('contact_us',function (){
    $members = \App\Team::all();
    return view('contact_us.index',compact('members'));
})->name('contact_us');
