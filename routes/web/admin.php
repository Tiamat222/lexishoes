<?php
use Illuminate\Support\Facades\Route;



Route::group([], function () {
    Route::get('/login', 'LoginController@showLoginForm')->middleware('autorized')->name('login');
    Route::post('/admin-check', 'LoginController@adminCheck')->name('check');
    Route::get('/logout', 'LoginController@adminLogout')->name('logout');

    Route::get('/forget-password', 'ForgotPasswordController@showForgetPasswordForm')->name('forget.get');
    Route::post('/forget-password', 'ForgotPasswordController@submitForgetPasswordForm')->name('forget.post'); 
    Route::get('/reset-password/{token}', 'ForgotPasswordController@showResetPasswordForm')->name('reset.get');
    Route::post('/reset-password', 'ForgotPasswordController@submitResetPasswordForm')->name('reset.post');
}); 

Route::group(['middleware' => 'notAutorized'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::group(['prefix' => 'catalog', 'as' => 'catalog.'], function () {
        Route::group(['middleware' => 'permission:suppliers'], function(){
            Route::get('/suppliers/restore/{id}', 'SupplierController@restore')->name('suppliers.restore');
            Route::get('/suppliers/trash', 'SupplierController@trash')->name('suppliers.trash');
            Route::delete('/suppliers/soft-delete/{id}', 'SupplierController@softDelete')->name('suppliers.delete');
            Route::post('/suppliers/restore-all', 'SupplierController@restoreAll')->name('suppliers.massRestore');
            Route::post('/suppliers/delete-all', 'SupplierController@forceDeleteAll')->name('suppliers.massDelete');
            Route::resource('/suppliers', 'SupplierController'); 
        });
        Route::group(['middleware' => 'permission:categories'], function(){
            Route::get('/categories/restore/{id}', 'CategoryController@restore')->name('categories.restore');
            Route::get('/categories/disabled', 'CategoryController@disabled')->name('categories.disabled');
            Route::delete('/categories/soft-delete/{id}', 'CategoryController@softDelete')->name('categories.delete');
            Route::get('/categories/trash', 'CategoryController@trash')->name('categories.trash');
            Route::post('/categories/create-slug', 'CategoryController@createSlug');
            Route::resource('/categories', 'CategoryController');
        });
        Route::group(['middleware' => 'permission:attributes'], function(){
            Route::get('/attributes/values-list/{id}', 'AttributeValueController@valuesList')->name('attribute-values.valuesList');
            Route::get('/attributes/list', 'AttributeController@getAllAttributes');
            Route::post('/attributes/values', 'AttributeValueController@getAttributeValues');
            Route::resource('/attributes', 'AttributeController');
            Route::resource('/attribute-values', 'AttributeValueController');
        });
        Route::group(['middleware' => 'permission:products'], function(){
            Route::post('/products/create-slug', 'ProductController@createSlug');
            Route::post('/products/download-images', 'ProductController@downloadImages');
            Route::get('/products/trash', 'ProductController@trash')->name('products.trash');
            Route::get('/products/disabled', 'ProductController@disabled')->name('products.disabled');
            Route::resource('/products', 'ProductController');
        });
        Route::group(['middleware' => 'permission:pages'], function(){
            Route::resource('/pages', 'PageController');
        });
    });
    Route::group([], function () {
        Route::group(['middleware' => 'permission:customers'], function(){
            Route::get('/categories/restore/{id}', 'CustomerController@restore')->name('customers.restore');
            Route::get('/customers/trash', 'CustomerController@trash')->name('customers.trash');
            Route::get('/customers/email/{id}', 'CustomerController@email')->name('customers.email');
            Route::delete('/customers/soft-delete/{id}', 'CustomerController@softDelete')->name('customers.delete');
            Route::resource('/customers', 'CustomerController');
        });
    });
    Route::group([], function () {
        Route::group(['middleware' => 'permission:orders'], function(){
            Route::post('/orders/update-status', 'OrderController@updateStatus')->name('orders.update_status');
            Route::post('/orders/save-comment/{id}', 'OrderController@saveComment')->name('orders.save_comment');
            Route::resource('/orders', 'OrderController');
        });
    });
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get('/information', 'InformationController@index')->middleware('permission:information')->name('information');
        Route::group(['middleware' => 'permission:log', 'as' => 'log.'], function(){
            Route::get('/logs', 'LogController@index')->name('index');
            Route::get('/clear-logs/{param}', 'LogController@clearLogFile')->name('clear');
        });
        Route::group(['middleware' => 'permission:settings'], function(){
            Route::get('/admin-settings', 'SettingsController@index')->name('index');
            Route::post('/admin-settings/store', 'SettingsController@store')->name('store');
        });
        Route::group(['middleware' => 'permission:export'], function(){
            Route::get('/export', 'ExportController@index')->name('export.index');
            Route::post('/export/unload', 'ExportController@unload')->name('export.unload');
        });
        Route::group(['middleware' => 'permission:import'], function(){
            Route::get('/import', 'ImportController@index')->name('import.index');
            Route::post('/import/load', 'ImportController@load')->name('import.load');
        });
        Route::group(['middleware' => 'permission:admin-profile'], function(){
            Route::get('/profile', 'AdminProfileController@edit')->name('profile.edit');
            Route::put('/profile/update/{id}', 'AdminProfileController@update')->name('profile.update');
            Route::put('/profile/change-pwd', 'AdminProfileController@changePwd')->name('profile.pwd');
        });
        Route::group(['middleware' => 'permission:admins'], function(){
            Route::delete('/admins/soft-delete/{id}', 'AdminsSettingsController@softDelete')->name('admins.delete');
            Route::get('/admins/restore/{id}', 'AdminsSettingsController@restore')->name('admins.restore');
            Route::get('/admins/trash', 'AdminsSettingsController@trash')->name('admins.trash');
            Route::get('/admins/activity/{id?}', 'AdminsSettingsController@activity')->name('admins.activity');
            Route::post('/admins/get-feeds', 'AdminsSettingsController@getFeeds')->name('admins.feeds');
            Route::resource('/admins', 'AdminsSettingsController');
        }); 
    });
});