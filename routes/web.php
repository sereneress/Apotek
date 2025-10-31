<?php

use App\Http\Controllers\AuthC;
use App\Http\Controllers\DashC;
use App\Http\Controllers\Apoteker\ApotekerC;
use App\Http\Controllers\Gudang\GudangC;
use App\Http\Controllers\Inventory\InventoryC;
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
    Route::get('/', [GudangC::class, 'index'])->name('tabel');      // Menampilkan tabel gudang
    Route::get('/create', [GudangC::class, 'create'])->name('form'); // (Jika nanti ada form input baru)
    Route::post('/store', [GudangC::class, 'store'])->name('store'); // Simpan data baru
    Route::get('/edit/{id}', [GudangC::class, 'edit'])->name('edit'); // (Jika nanti ada halaman edit)
    Route::put('/update/{id}', [GudangC::class, 'update'])->name('update'); // Update data
    Route::delete('/destroy/{id}', [GudangC::class, 'destroy'])->name('destroy'); // Hapus data
});

Route::prefix('inventory')->name('inventory.')->group(function () {
    Route::get('/', [InventoryC::class, 'index'])->name('tabel');      // Menampilkan tabel gudang
    Route::get('/create', [InventoryC::class, 'create'])->name('form'); // (Jika nanti ada form input baru)
    Route::post('/store', [InventoryC::class, 'store'])->name('store'); // Simpan data baru
    Route::get('/edit/{id}', [InventoryC::class, 'edit'])->name('edit'); // (Jika nanti ada halaman edit)
    Route::put('/update/{id}', [InventoryC::class, 'update'])->name('update'); // Update data
    Route::delete('/destroy/{id}', [InventoryC::class, 'destroy'])->name('destroy'); // Hapus data
});
