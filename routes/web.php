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
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
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
    Route::match(array('GET','POST'),'/data-presensi', 'PresensiController@data_presensi')->name('presensi.data');
    Route::get('/account', 'AccountController@account')->name('account.index');
    Route::post('/account', 'AccountController@account_save')->name('account.store');
    Route::get('/semester', 'SemesterController@index')->name('semester.index');
    Route::get('/semester/{id}', 'SemesterController@change')->name('semester.change');
    Route::get('/rekap-presensi', 'PresensiController@rekap_list')->name('rekap-presensi.index');
    Route::get('/rekap-data-presensi/{id}', 'PresensiController@rekap_data_presensi')->name('rekap.semua');
    Route::get('/list-presensi/{id}', 'PresensiController@list_presensi')->name('list.presensi');
    Route::get('/detail-presensi/{id}', 'PresensiController@detail_presensi')->name('presensi.detail');
    Route::get('/tambah-presensi/{id}', 'PresensiController@add_presensi')->name('tambah.presensi');
    Route::get('/lengkapi-presensi/{id}', 'PresensiController@lengkapi_presensi')->name('lengkapi.presensi');
    Route::get('/kirim-email', 'PresensiController@kirim_email')->name('kirim.email');
    Route::get('/cetak-semua/{id}', 'PresensiController@cetak_semua')->name('cetak.semua');
    Route::get('/export-semua/{id}', 'PresensiController@export_semua')->name('export.semua');
    Route::get('/cetak-satuan/{id}', 'PresensiController@cetak_satuan')->name('cetak.satuan');
    Route::get('/export-satuan/{id}', 'PresensiController@export_satuan')->name('export.satuan');
});
