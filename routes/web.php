<?php

use Illuminate\Support\Facades\Auth;
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
    if (session()->has('userLogged')) {
        if (session()->get('userLogged') != null) {
            return redirect()->route('dashboard');
        }
        return redirect()->route('login');
    }
    return redirect()->route('login');
});
Route::get('/not-found',
    'HomeController@not_found')->name('notFound');
Auth::routes();
Route::group(['middleware' => 'isHaveToken'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::resource('users', 'UserController');
    Route::resource('guru', 'GuruController');
    Route::resource('kelas', 'KelasController');
    Route::resource('siswa', 'SiswaController');
    Route::resource('mapel', 'MapelController');
    Route::resource('jadwal', 'JadwalController');
    Route::resource('presensi', 'PresensiController');
    Route::get('/account', 'AccountController@account')->name('account.index');
    Route::post('/account',
        'AccountController@account_save')->name('account.store');
});
