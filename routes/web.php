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
Route::post('/register-pasien', 'Auth\RegisterController@store_pasien')->name('store.pasien');
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
    Route::get('/antrian-besok/{id}', 'AntrianController@antrian_besok')->name('antrianBesok');
    Route::get('/laporan-pertanggal', 'AntrianController@laporan_pertanggal')->name('laporan-pertanggal');
    Route::get('/download-laporan', 'AntrianController@download_laporan')->name('download.laporan');
    Route::post('/download-laporan-pertanggal', 'AntrianController@download_laporan_pertanggal')->name('download.laporanPertanggal');
    Route::get('/antrian-pasien', 'AntrianController@antrian_pasien')->name('antrian-pasien.index');
    Route::get('/tambah-antrian-pasien/{id}', 'AntrianController@tambah_antrian_pasien')->name('tambahAntrian');
    Route::post('/save-antrian', 'AntrianController@tambah_antrian_pasien_save')->name('tambahAntrian.store');
    Route::get('/get-data-antrian', 'AntrianController@get_data_antrian')->name('get.dataAntrian');
    Route::get('/enable-antrian', 'AntrianController@enable_antrian')->name('enabledAntrian');
    Route::get('/disable-antrian', 'AntrianController@disable_antrian')->name('disabledAntrian');
    Route::get('/antrian-detail/{id}', 'AntrianController@antrian_detail')->name('antrianDetail');
    Route::post('/account-profile', 'AccountController@account_profile')->name('accountProfile.store');
});
Route::get('/pendaftaran', 'ClientPageController@pendaftaran')->name('pendaftaran');
Route::get('/pendaftaran/{id}', 'ClientPageController@pendaftaran_detail')->name('pendaftaran.detail');
Route::get('/profile', 'ClientPageController@profil')->name('profil');
Route::get('/motto', 'ClientPageController@motto')->name('motto');
Route::get('/visi-misi', 'ClientPageController@visi_misi')->name('visiMisi');
Route::get('/jadwal-layanan', 'ClientPageController@jadwal_layanan')->name('jadwalLayanan');
Route::get('/ambil-jadwal', 'ClientPageController@ambil_jadwal')->name('ambil.jadwal');
Route::get('/download-antrian/{id}', 'ClientPageController@download_antrian')->name('download.antrian');
