<?php

use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\PerlombaanController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\WasitController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerlombaanUserController;
use App\Http\Controllers\ProfileUserController;
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
    return view('welcome');
});

Route::prefix('pages/admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('0.dashboard');

        // Berita
        Route::resource('berita', BeritaController::class);

        // Perlombaan
        // Route::get('/perlombaan', [PerlombaanController::class, 'index'])->name('0.perlombaan');
        // Route::post('/tambah/perlombaan', [PerlombaanController::class, 'store'])->name('0.perlombaan.store');
        Route::post('/show/perlombaan', [PerlombaanController::class, 'show'])->name('0.show.perlombaan');
        Route::post('/update/perlombaan', [PerlombaanController::class, 'update'])->name('0.update.perlombaan');
        Route::post('/hapus/perlombaan', [PerlombaanController::class, 'destroy'])->name('0.delete.perlombaan');

        Route::resource('perlombaan-admin', PerlombaanController::class);
        // Wasit
        Route::get('/wasit', [WasitController::class, 'index'])->name('0.wasit');
        Route::post('/tambah/wasit', [WasitController::class, 'store'])->name('0.wasit.store');
        Route::post('/show/wasit', [WasitController::class, 'show'])->name('0.show.wasit');
        Route::post('/update/wasit', [WasitController::class, 'update'])->name('0.update.wasit');
        Route::post('/hapus/wasit', [WasitController::class, 'destroy'])->name('0.delete.wasit');
        
        // Verifikasi
        Route::get('/verifikasi', [DashboardAdminController::class, 'getVerifikasi'])->name('0.get.verifikasi');
        Route::get('/verifikasi/detail/{id}', [DashboardAdminController::class, 'detailVerifikasi'])->name('0.detail.verifikasi');
        Route::post('/verifikasi', [DashboardAdminController::class, 'verifikasi'])->name('0.verifikasi');
        Route::post('/verifikasi/tolak', [DashboardAdminController::class, 'tolakVerifikasi'])->name('0.tolak.verifikasi');

        Route::get('/pengguna', [PenggunaController::class, 'index'])->name('0.pengguna');
        Route::post('/pengguna/blokir', [PenggunaController::class, 'blokir'])->name('0.blokir.pengguna');
        
        Route::resource('akun-admin', ProfileController::class);
    });

Route::prefix('pages/user')
    ->middleware(['auth', 'user'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('1.dashboard');

        Route::get('/perlombaan/{id}/daftar', [PerlombaanUserController::class, 'daftar'])->name('1.daftar');
        Route::resource('perlombaan', PerlombaanUserController::class);
        Route::resource('akun', ProfileUserController::class);
    });


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
