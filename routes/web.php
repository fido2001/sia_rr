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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin', 'HomeController@index')->name('index');
    Route::resource('/akun', 'AkunController');
    Route::get('jurnal', 'JurnalController@index')->name('jurnal.index');
    Route::get('jurnal/create', 'JurnalController@create')->name('jurnal.create');
    Route::post('jurnal/create', 'JurnalController@store')->name('jurnal.store');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
