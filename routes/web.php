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
    Route::resource('/products', 'ProductController');
    Route::get('jurnal', 'JurnalController@index')->name('jurnal.index');
    Route::get('jurnal/create', 'JurnalController@create')->name('jurnal.create');
    Route::post('jurnal/create', 'JurnalController@store')->name('jurnal.store');
    Route::get('jurnal/{bulan}/{tahun}', 'JurnalController@getJurnal')->name('jurnal.getJurnal');
    Route::get('/transaction', 'TransactionController@index');
    Route::post('/transaction/addproduct/{id}', 'TransactionController@addProductCart');
    Route::post('/transaction/removeproduct/{id}', 'TransactionController@removeProductCart');
    Route::post('/transaction/clear', 'TransactionController@clear');
    Route::post('/transaction/increasecart/{id}', 'TransactionController@increasecart');
    Route::post('/transaction/decreasecart/{id}', 'TransactionController@decreasecart');
    Route::post('/transaction/bayar', 'TransactionController@bayar');
    Route::get('/transaction/history', 'TransactionController@history');
    Route::get('/transaction/laporan/{id}', 'TransactionController@laporan');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
