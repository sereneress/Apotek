<?php

use App\Http\Controllers\AuthC;
use App\Http\Controllers\DashC;
use App\Http\Controllers\Apoteker\ApotekerC;
use App\Http\Controllers\Gudang\GudangC;
use App\Http\Controllers\Inventory\InventoryC;
use App\Http\Controllers\Inventory\KategoriC;
use App\Http\Controllers\Inventory\LaporanC;
use App\Http\Controllers\Kasir\KasirC;
use App\Http\Controllers\Inventory\ObatC;
use App\Http\Controllers\Inventory\TransaksiC;
use App\Http\Controllers\Inventory\TransaksiPenjualanC;
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
Route::post('/logout', [AuthC::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashC::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:apoteker'])->group(function () {
    Route::get('/apoteker/dashboard', [DashC::class, 'apoteker'])->name('apoteker.dashboard');
});

Route::middleware(['auth', 'role:gudang'])->group(function () {
    Route::get('/gudang/dashboard', [DashC::class, 'gudang'])->name('gudang.dashboard');
});


Route::prefix('apoteker')->name('apoteker.')->group(function () {
    Route::get('/', [ApotekerC::class, 'index'])->name('tabel');
    Route::post('/store', [ApotekerC::class, 'store'])->name('store');
    Route::get('/view/{id}', [ApotekerC::class, 'view'])->name('view');
    Route::put('/update/{id}', [ApotekerC::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ApotekerC::class, 'destroy'])->name('destroy');
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

Route::prefix('obat')->name('obat.')->group(function () {
    Route::get('/', [InventoryC::class, 'index'])->name('tabel');      // Menampilkan tabel gudang
    Route::get('/create', [ObatC::class, 'create'])->name('form'); // (Jika nanti ada form input baru)
    Route::post('/store', [ObatC::class, 'store'])->name('store'); // Simpan data baru
    Route::get('/edit/{id}', [ObatC::class, 'edit'])->name('edit'); // (Jika nanti ada halaman edit)
    Route::put('/update/{id}', [ObatC::class, 'update'])->name('update'); // Update data
    Route::delete('/destroy/{id}', [ObatC::class, 'destroy'])->name('destroy'); // Hapus data
});

Route::prefix('kategori')->name('kategori.')->group(function () {
    Route::get('/', [InventoryC::class, 'index'])->name('tabel'); // (Jika nanti ada form input baru)
    Route::post('/store', [KategoriC::class, 'store'])->name('store'); // Simpan data baru
    Route::get('/edit/{id}', [KategoriC::class, 'edit'])->name('edit'); // (Jika nanti ada halaman edit)
    Route::put('/update/{id}', [KategoriC::class, 'update'])->name('update'); // Update data
    Route::delete('/destroy/{id}', [KategoriC::class, 'destroy'])->name('destroy'); // Hapus data
});

Route::prefix('transaksi')->name('transaksi.')->group(function () {
    Route::get('/', [InventoryC::class, 'index'])->name('tabel'); // (Jika nanti ada form input baru)
    Route::post('/store', [TransaksiC::class, 'store'])->name('store'); // Simpan data baru
    Route::get('/edit/{id}', [TransaksiC::class, 'edit'])->name('edit'); // (Jika nanti ada halaman edit)
    Route::put('/update/{id}', [TransaksiC::class, 'update'])->name('update'); // Update data
    Route::delete('/destroy/{id}', [TransaksiC::class, 'destroy'])->name('destroy'); // Hapus data
});

Route::prefix('transaksi')->name('transaksi.')->group(function () {
    Route::get('/penjualan', [TransaksiPenjualanC::class, 'index'])->name('penjualan.index'); // halaman penjualan
    Route::post('/penjualan/store', [TransaksiPenjualanC::class, 'store'])->name('penjualan.store'); // simpan transaksi
});

Route::prefix('laporan')->group(function () {
    Route::get('/penjualan-harian', [LaporanC::class, 'harian'])->name('laporan.harian');
    Route::get('/penjualan-bulanan', [LaporanC::class, 'bulanan'])->name('laporan.bulanan');
});
