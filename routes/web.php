<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect(route('admin.index'));
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace('Admin')->prefix('/admin')->group(function (): void {
    // Login
    Route::get('/login', 'LoginController@getLogin')->name('login');
    Route::post('/login', 'LoginController@postLogin')->name('postLogin');
    //reset pass
    Route::get('/resetpass', 'LoginController@getResetpass')->name('resetpass');
    Route::post('/resetpass', 'LoginController@postReset')->name('postReset');
    //register user
    Route::get('/register-user','LoginController@getRegisteruser')->name('registeruser');
    Route::post('/register-user','LoginController@postRegisteruser')->name('postRegisteruser');
    //Logout
    Route::post('/logout', 'LoginController@postLogout')->name('logout');
    Route::get('/','HomeController@index')->name('admin.index');

    //customer management
    Route::prefix('/customers')->group(function (): void {
        Route::get('/', 'CustomerController@index')->name('admin.customers.index');
        Route::post('/', 'CustomerController@searchRow')->name('admin.customers.search-row');
        Route::get('/{id}/show', 'CustomerController@show')->name('admin.customers.show');
        Route::get('/create', 'CustomerController@entry')->name('admin.customers.create');
        Route::get('/{id}/edit', 'CustomerController@entry')->name('admin.customers.edit');
        Route::post('/store', 'CustomerController@store')->name('admin.customers.store');
        Route::post('/destroy', 'CustomerController@destroy')->name('admin.customers.destroy');
        Route::post('/destroy-select', 'CustomerController@destroySelect')->name('admin.customers.destroy-select');
    });



    //Permission
    Route::prefix('/permissions')->group(function (): void {
        Route::get('/', 'PermissionController@index')->name('admin.permissions.index');
        Route::post('/', 'PermissionController@searchRow')->name('admin.permissions.search-row');
        Route::get('/create', 'PermissionController@createForm')->name('admin.permissions.create');
        Route::post('/store', 'PermissionController@store')->name('admin.permissions.store');
        Route::post('/destroy', 'PermissionController@destroy')->name('admin.permissions.destroy');
        Route::post('/destroy-select', 'PermissionController@destroySelect')->name('admin.permissions.destroy-select');
    });

    //Roles
    Route::prefix('/roles')->group(function (): void {
        Route::get('/', 'RoleController@index')->name('admin.roles.index');
        Route::post('/', 'RoleController@searchRow')->name('admin.roles.search-row');
        Route::get('/create', 'RoleController@createForm')->name('admin.roles.create');
        Route::post('/store', 'RoleController@store')->name('admin.roles.store');
        Route::post('/destroy', 'RoleController@destroy')->name('admin.roles.destroy');
        Route::post('/destroy-select', 'RoleController@destroySelect')->name('admin.roles.destroy-select');
    });

    //User
    Route::prefix('/users')->group(function (): void {
        Route::get('/', 'UserController@index')->name('admin.users.index');
        Route::post('/', 'UserController@searchRow')->name('admin.users.search-row');
        Route::get('/create', 'UserController@createForm')->name('admin.users.create');
        Route::post('/store', 'UserController@store')->name('admin.users.store');
        Route::post('/destroy', 'UserController@destroy')->name('admin.users.destroy');
        Route::post('/destroy-select', 'UserController@destroySelect')->name('admin.users.destroy-select');
    });

    //Position (staff)
    Route::prefix('/positions')->group(function(): void {
        Route::get('/', 'PositionController@index')->name('admin.positions.index');
        Route::post('/', 'PositionController@searchRow')->name('admin.positions.search-row');
        Route::get('/create', 'PositionController@createForm')->name('admin.positions.create');
        Route::post('/store', 'PositionController@store')->name('admin.positions.store');
        Route::post('/destroy', 'PositionController@destroy')->name('admin.positions.destroy');
        Route::post('/destroy-select', 'PositionController@destroySelect')->name('admin.positions.destroy-select');
    });

    //Departments
    Route::prefix('/departments')->group(function (): void {
        Route::get('/', 'DepartmentController@index')->name('admin.departments.index');
        Route::post('/', 'DepartmentController@searchRow')->name('admin.departments.search-row');
        Route::get('/create', 'DepartmentController@createForm')->name('admin.departments.create');
        Route::post('/store', 'DepartmentController@store')->name('admin.departments.store');
        Route::post('/destroy', 'DepartmentController@destroy')->name('admin.departments.destroy');
        Route::post('/destroy-select', 'DepartmentController@destroySelect')->name('admin.departments.destroy-select');
        Route::get('/trash', 'DepartmentController@trashIndex')->name('admin.departments.trash-index');
        Route::post('/trash', 'DepartmentController@trashSearchRow')->name('admin.departments.trash-search-row');
        Route::post('/trash/force', 'DepartmentController@forceDelete')->name('admin.departments.trash-force');
        Route::post('/trash/force-select', 'DepartmentController@forceDeleteSelect')->name('admin.departments.trash-force-select');
        Route::post('/trash/restore', 'DepartmentController@restore')->name('admin.departments.trash-restore');
    });


    //Staff
    Route::prefix('/staffs')->group(function(): void {
        Route::get('/', 'StaffController@index')->name('admin.staffs.index');
        Route::post('/', 'StaffController@searchRow')->name('admin.staffs.search-row');
        Route::get('/create', 'StaffController@createForm')->name('admin.staffs.create');
        Route::post('/store', 'StaffController@store')->name('admin.staffs.store');
        Route::post('/destroy', 'StaffController@destroy')->name('admin.staffs.destroy');
        Route::post('/destroy-select', 'StaffController@destroySelect')->name('admin.staffs.destroy-select');

    });





});
