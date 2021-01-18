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

});