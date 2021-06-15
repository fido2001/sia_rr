<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin', 'HomeController@index')->name('index');
    Route::resource('/akun', 'AkunController');
    Route::resource('/user', 'UserController');
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
    Route::get('bukubesar', 'BukubesarController@index')->name('bukubesar.index');
    Route::get('neraca', 'NeracaController@index')->name('neraca.index');
    Route::get('labarugi', 'LabarugiController@index')->name('labarugi.index');
});

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
