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

Route::get('/', 'DaftarController@index');

Auth::routes();

Route::get('redirect', 'RedirectController@index');

Route::post('daftar', 'DaftarController@daftar');
Route::post('daftar/cekmahasiswa', 'DaftarController@cekMahasiswa');

//paj
Route::get('paj/jadwalsidang','Paj\JadwalSidangController@index');

Route::get('paj/mastermahasiswa', 'Paj\MasterMahasiswaController@index');
Route::post('paj/mastermahasiswa', 'Paj\MasterMahasiswaController@carimahasiswa');

Route::get('paj/masterdosen', 'Paj\MasterDosenController@index');
Route::get('paj/masterdosen/{id}', 'Paj\MasterDosenController@get');
Route::post('paj/masterdosen', 'Paj\MasterDosenController@simpan');
Route::put('paj/masterdosen/{id}', 'Paj\MasterDosenController@update');
Route::delete('paj/masterdosen/{id}', 'Paj\MasterDosenController@hapus');

Route::get('paj/masterperiode', 'Paj\MasterPeriodeController@index');
Route::post('paj/masterperiode', 'Paj\MasterPeriodeController@simpan');
Route::get('paj/masterperiode/{id}', 'Paj\MasterPeriodeController@get');
Route::put('paj/masterperiode/{id}', 'Paj\MasterPeriodeController@setting');


Route::get('paj/mastertempat', 'Paj\MasterTempatController@index');
Route::get('paj/mastertempat/{id}', 'Paj\MasterTempatController@get');
Route::post('paj/mastertempat', 'Paj\MasterTempatController@simpan');
Route::put('paj/mastertempat/{id}', 'Paj\MasterTempatController@update');
Route::delete('paj/mastertempat/{id}', 'Paj\MasterTempatController@hapus');
