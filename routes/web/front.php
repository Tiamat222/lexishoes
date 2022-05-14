<?php

use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::get('/', 'IndexController@index')->name('index');
    Route::group(['as' => 'login.'], function() {
        Route::get('/login', 'LoginController@showAuthForm')->name('show_form');
        Route::post('/customer-check', 'LoginController@login')->name('check');
        Route::get('/logout', 'LoginController@logout')->name('logout_customer');
    });
    Route::group(['as' => 'register.'], function() {
        Route::post('/register', 'RegisterController@registerNewCustomer')->name('new_customer');
        Route::get('/confirm', 'RegisterController@confirmCustomer')->name('confirm_customer');
        Route::get('/check-reg-token/{token}/{id}', 'RegisterController@confirmToken')->name('check_token');
        Route::get('/expired-token', 'RegisterController@expiredToken')->name('expired_token');
        Route::post('/resending', 'RegisterController@resending')->name('resending');
    });
    Route::group(['as' => 'customer.'], function() {
        Route::get('/profile', 'ProfileController@customerProfile')->name('profile');
        Route::post('/update-profile', 'ProfileController@updateProfile')->name('update_profile');
        Route::post('/update-password', 'ProfileController@updatePassword')->name('update_password');
    });
    Route::group(['as' => 'password.'], function(){
        Route::get('/forgot-password', 'ForgotPasswordController@forgotPassword')->name('forgot_form');
        Route::post('/send-email', 'ForgotPasswordController@sendEmail')->name('send_email');
        Route::get('/check-pwd-token/{token}/{id}', 'ForgotPasswordController@confirmToken')->name('check_token');
        Route::get('/new-password/{id}', 'ForgotPasswordController@newPassword')->name('new_password');
        Route::post('/change-password', 'ForgotPasswordController@changePassword')->name('change');
    });
}); 