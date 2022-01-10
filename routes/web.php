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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin', 'as' => 'admin.'], function () {
    Route::get('/login', 'LoginController@showLoginForm')->middleware('autorized')->name('login');
    Route::post('/admin-check', 'LoginController@adminCheck')->name('check');
    Route::get('/logout', 'LoginController@adminLogout')->name('logout');

    Route::get('/forget-password', 'ForgotPasswordController@showForgetPasswordForm')->name('forget.get');
    Route::post('/forget-password', 'ForgotPasswordController@submitForgetPasswordForm')->name('forget.post'); 
    Route::get('/reset-password/{token}', 'ForgotPasswordController@showResetPasswordForm')->name('reset.get');
    Route::post('/reset-password', 'ForgotPasswordController@submitResetPasswordForm')->name('reset.post');
}); 

Route::group(['prefix' => 'admin', 'middleware' => 'notAutorized', 'as' => 'admin.', 'namespace' => 'App\Http\Controllers\Admin'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get('/information', 'InformationController@index')->middleware('permission:information')->name('information');
        Route::group(['middleware' => 'permission:log', 'as' => 'log.'], function(){
            Route::get('/logs', 'LogController@index')->name('index');
            Route::get('/clear-logs/{param}', 'LogController@clearLogFile')->name('clear');
        });
        Route::group(['middleware' => 'permission:general-settings'], function(){
            Route::get('/admin-settings', 'SettingsController@index')->name('generalSettings.index');
            Route::post('/admin-settings/store', 'SettingsController@store')->name('generalSettings.store');
        });
    });
    Route::group(['prefix' => 'catalog', 'as' => 'catalog.'], function () {
        Route::group(['middleware' => 'permission:suppliers'], function(){
            Route::get('/suppliers/restore/{id}', 'SupplierController@restore')->name('suppliers.restore');
            Route::get('/suppliers/trash', 'SupplierController@trash')->name('suppliers.trash');
            Route::delete('/suppliers/soft-delete/{id}', 'SupplierController@softDelete')->name('suppliers.delete');
            Route::post('/suppliers/restore-all', 'SupplierController@restoreAll')->name('suppliers.massRestore');
            Route::post('/suppliers/delete-all', 'SupplierController@forceDeleteAll')->name('suppliers.massDelete');
            Route::resource('/suppliers', 'SupplierController'); 
        });
    });
});
