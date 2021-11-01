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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/not-found', 'HomeController@not_found')->name('notFound');
Route::group(['middleware' => 'auth'], function()
{
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::resource('users', 'UserController');
    Route::resource('account', 'AccountController');
    Route::resource('poli', 'PoliController');
    Route::resource('dokter', 'DokterController');
    Route::resource('pasien', 'PasienController');
    Route::resource('jadwal', 'JadwalController');
    Route::resource('antrian', 'AntrianController');
    Route::get('/laporan', 'AntrianController@laporan')->name('laporan');
    Route::post('/account-profile', 'AccountController@account_profile')->name('accountProfile.store');
});
