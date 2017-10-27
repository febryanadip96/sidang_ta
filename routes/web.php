<?php

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
    return view('daftar');
})->middleware('guest');

Auth::routes();

Route::get('redirect', 'RedirectController@index');

Route::post('daftar', 'DaftarController@daftar');

//paj
Route::get('paj/jadwalsidang','Paj\JadwalSidangController@index');
