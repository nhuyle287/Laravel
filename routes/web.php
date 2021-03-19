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


    //Medicine
    Route::prefix('/medicines')->group(function(): void {
        Route::get('/', 'MedicineController@index')->name('admin.medicines.index');
        Route::post('/', 'MedicineController@searchRow')->name('admin.medicines.search-row');
        Route::get('/create', 'MedicineController@entry')->name('admin.medicines.create');
        Route::post('/store', 'MedicineController@store')->name('admin.medicines.store');
        Route::post('/destroy', 'MedicineController@destroy')->name('admin.medicines.destroy');
        Route::post('/destroy-select', 'MedicineController@destroySelect')->name('admin.medicines.destroy-select');

    });

//    Register-medicine
    Route::prefix('/register-medicines')->group(function(): void {
        Route::get('/', 'Register_medicineController@index')->name('admin.register-medicines.index');
        Route::post('/', 'Register_medicineController@searchRow')->name('admin.register-medicines.search-row');
        Route::post('/update', 'Register_medicineController@update')->name('admin.register-medicines.update');
//        Route::get('/create', 'MedicineController@entry')->name('admin.medicines.create');
//        Route::post('/store', 'MedicineController@store')->name('admin.medicines.store');
//        Route::post('/destroy', 'MedicineController@destroy')->name('admin.medicines.destroy');
//        Route::post('/destroy-select', 'MedicineController@destroySelect')->name('admin.medicines.destroy-select');

    });

//    medical examination
    Route::prefix('/medical-examinations')->group(function(): void {
        Route::get('/', 'Register_medicineController@indexlist')->name('admin.medical-examinations.index');
        Route::post('/', 'Register_medicineController@searchRowlist')->name('admin.medical-examinations.search-row');
//        Route::post('/update', 'Register_medicineController@update')->name('admin.register-medicines.update');
        Route::get('/create', 'Register_medicineController@entry')->name('admin.medical-examinations.create');
        Route::post('/store', 'Register_medicineController@store')->name('admin.medical-examinations.store');
//        Route::post('/destroy', 'MedicineController@destroy')->name('admin.medicines.destroy');
        Route::post('/destroy-select', 'Register_medicineController@destroySelect')->name('admin.medical-examinations.destroy-select');

    });
//    history examination
    //    medical examination
    Route::prefix('/history-examinations')->group(function(): void {
        Route::get('/', 'MedicalExaminationController@index')->name('admin.history-examinations.index');
        Route::post('/', 'MedicalExaminationController@searchRow')->name('admin.history-examinations.search-row');
        Route::get('/{id}/show', 'MedicalExaminationController@show')->name('admin.history-examinations.show');
        Route::post('/update', 'MedicalExaminationController@update')->name('admin.history-examinations.update');
        Route::post('/destroy-select', 'MedicalExaminationController@destroySelect')->name('admin.history-examinations.destroy-select');

    });

//    expenditure
    Route::prefix('/expenditure')->group(function(): void{
        Route::get('/', 'ExpenditureController@index')->name('admin.expenditure.index');
        Route::post('/', 'ExpenditureController@searchRow')->name('admin.expenditure.search-row');
        Route::post('/print','ExpenditureController@print')->name('admin.expenditure.print');
        Route::get('/create', 'ExpenditureController@entry')->name('admin.expenditure.create');
        Route::get('/{id}/edit', 'ExpenditureController@entry')->name('admin.expenditure.edit');
        Route::post('/store','ExpenditureController@store')->name('admin.expenditure.store');
        Route::post('/destroy', 'ExpenditureController@destroy')->name('admin.expenditure.destroy');
        Route::post('/destroy-select', 'ExpenditureController@destroySelect')->name('admin.expenditure.destroy-select');
    });

});

Route::namespace('Register')->prefix('/register')->group(function ():void{
    Route::get('/','Register_MedicalController@get_register')->name('register.medicine.get_register');

    Route::post('/registerhavecode','Register_MedicalController@register')->name('register.medicine.register');
    Route::prefix('/havecode')->group(function(): void {
        Route::get('/havecode','Register_MedicalController@get_register_code')->name('register.havecode.get_register_code');
        Route::post('/register','Register_MedicalController@register_code')->name('register.havecode.register_code');

    });


});
