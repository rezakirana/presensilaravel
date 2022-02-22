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
    Route::resource('guru', 'AccountController');
    Route::resource('kelas', 'KelasController');
    Route::resource('siswa', 'SiswaController');
    Route::resource('mapel', 'MapelController');
    Route::resource('tahun-ajaran', 'TahunAjaranController');
    Route::resource('jadwal', 'JadwalController');
    Route::resource('presensi', 'PresensiController');
    Route::get('/account', 'AccountController@account')->name('account.index');
    Route::post('/account', 'AccountController@account_save')->name('account.store');
    Route::get('/semester', 'SemesterController@index')->name('semester.index');
    Route::get('/semester/{id}', 'SemesterController@change')->name('semester.change');
    Route::get('/rekap-presensi', 'PresensiController@rekap_list')->name('rekap-presensi.index');
    Route::get('/tambah-presensi/{id}', 'PresensiController@add_presensi')->name('tambah.presensi');
    Route::get('/lengkapi-presensi/{id}', 'PresensiController@lengkapi_presensi')->name('lengkapi.presensi');
});
