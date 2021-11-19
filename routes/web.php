<?php

use Illuminate\Support\Facades\Route;
use Modules\Apotek\Http\Controllers\ApotekController;
use Modules\Dokter\Http\Controllers\DokterController;
use Modules\Obat\Http\Controllers\ObatController;
use Modules\Obat\Http\Controllers\ResepObatController;
use Modules\Pasien\Http\Controllers\PasienController;
use Modules\Pasien\Http\Controllers\PasienUserController;
use Modules\Poliklinik\Http\Controllers\PoliklinikController;
use Modules\RawatJalan\Http\Controllers\RawatJalanController;
use Modules\RawatJalan\Http\Controllers\RawatJalanPasienController;
use Modules\Role\Http\Controllers\RoleController;
use Modules\Transaksi\Http\Controllers\TransaksiController;
use Modules\User\Http\Controllers\DependentDropdownController;
use Modules\User\Http\Controllers\UserController;


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

Route::get('dependent-dropdown', [DependentDropdownController::class, 'index'])
    ->name('dependent-dropdown.index');
Route::post('dependent-dropdown', [DependentDropdownController::class, 'store'])
    ->name('dependent-dropdown.store');
Route::post('kecamatan', [DependentDropdownController::class, 'kecamatan'])
    ->name('dependent-dropdown.kecamatan');
Route::post('desa', [DependentDropdownController::class, 'desa'])
    ->name('dependent-dropdown.desa');

Auth::routes();

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/profil', [UserController::class, 'profile'])->name('profil')->middleware('auth');
Route::patch('/profil',  [UserController::class, 'profile_update'])->name('profil.update')->middleware('auth');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
    Route::resource('pasien', PasienController::class);
    Route::resource('dokter', DokterController::class);
    Route::resource('poliklinik', PoliklinikController::class);
    Route::resource('obat', ObatController::class);
    Route::resource('resep-obat', ResepObatController::class);
    Route::resource('rawat-jalan', RawatJalanController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('apotek', ApotekController::class);
});

Route::resource('pasien', PasienUserController::class)->only(['store','create']);
Route::prefix('pasien')->name('pasien.')->middleware('auth')->group(function () {
    Route::resource('rawat-jalan', RawatJalanPasienController::class);
});
