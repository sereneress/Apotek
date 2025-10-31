<?php

use App\Http\Controllers\AuthC;
use App\Http\Controllers\DashC;
use App\Http\Controllers\Apoteker\ApotekerC;
use App\Http\Controllers\Gudang\GudangC;
use App\Http\Controllers\Kasir\KasirC;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [AuthC::class, 'login'])->name('login');       // Tampil form
Route::post('/login', [AuthC::class, 'loginStore'])->name('login.store'); // Proses login
Route::get('/logout', [AuthC::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashC::class, 'index'])->middleware('auth')->name('dashboard');

Route::prefix('apoteker')->name('apoteker.')->group(function () {
    Route::get('/', [ApotekerC::class, 'index'])->name('tabel');
    Route::post('/store', [ApotekerC::class, 'store'])->name('store');
    Route::get('/view/{id}', [ApotekerC::class, 'view'])->name('view');
    Route::put('/update/{id}', [ApotekerC::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ApotekerC::class, 'destroy'])->name('destroy');
});

Route::prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/', [KasirC::class, 'index'])->name('tabel');          // menampilkan tabel kasir
    Route::get('/create', [KasirC::class, 'create'])->name('form');     // form tambah kasir
    Route::post('/store', [KasirC::class, 'store'])->name('store');     // simpan kasir baru
    Route::get('/view/{id}', [KasirC::class, 'view'])->name('view');    // view detail kasir
    Route::put('/update/{id}', [KasirC::class, 'update'])->name('update');  // update kasir
    Route::delete('/delete/{id}', [KasirC::class, 'destroy'])->name('destroy'); // hapus kasir
});


Route::prefix('gudang')->name('gudang.')->group(function () {
    Route::get('/', [GudangC::class, 'index'])->name('tabel');
    Route::get('/create', [GudangC::class, 'create'])->name('form');
    Route::post('/store', [GudangC::class, 'store'])->name('store');
    Route::get('/view/{id}', [GudangC::class, 'view'])->name('view');
    Route::put('/update/{id}', [GudangC::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [GudangC::class, 'delete'])->name('delete'); // <- hapus 'dokter/'
});
