<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Redirect halaman utama ke login
ns: Route::get('/', function () {
    return redirect('/login');
});

// Autentikasi (Login & Logout)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
// Halaman Registrasi Publik
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout']);

// Dashboard Utama
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

// CRUD Outlet (Khusus Admin)
Route::resource('outlet', OutletController::class);

// CRUD Paket Cucian (Khusus Admin)
Route::resource('paket', PaketController::class);

// CRUD Pengguna / User (Khusus Admin)
Route::resource('user', UserController::class);

// CRUD Member / Pelanggan (Admin & Kasir)
Route::resource('member', MemberController::class);

// Transaksi (Admin & Kasir)
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
Route::put('/transaksi/{id}/status', [TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');
Route::put('/transaksi/{id}/bayar', [TransaksiController::class, 'bayar'])->name('transaksi.bayar');

// Laporan (Admin, Kasir, Owner)
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');