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
    return redirect()->route('berat.index');
});

Route::group([
    'prefix' => '/berat',
    'as' => 'berat.',
], function () {
    Route::get('/', 'BeratController@index')->name('index');
    Route::get('/create', 'BeratController@create')->name('create');
    Route::get('/{berat}', 'BeratController@show')->name('show');
    Route::post('/', 'BeratController@store')->name('store');
    Route::get('/{berat}/edit', 'BeratController@edit')->name('edit');
    Route::put('/{berat}', 'BeratController@update')->name('update');
    Route::delete('/{berat}', 'BeratController@destroy')->name('delete');
});
