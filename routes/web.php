<?php

use Illuminate\Support\Facades\Route;
use Modules\Pasien\Http\Controllers\PasienController;
use Modules\Role\Http\Controllers\RoleController;
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
});
