<?php
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::get('/', 'IndexController@index')->name('index');
}); 