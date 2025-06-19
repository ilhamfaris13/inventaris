<?php

use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/karyawan', function () {
    return view('karyawan.index');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Barang Routes
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\BarangController;

Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{id}', [BarangController::class, 'show'])->name('barang.show');
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
Route::get('/barang/{id}/print', [BarangController::class, 'print'])->name('barang.print');
Route::get('/barang/{id}/pdf', [BarangController::class, 'pdf'])->name('barang.pdf');
/*
|--------------------------------------------------------------------------
| end-Barang Routes
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| Kategori Routes
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\KategoriController;

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
/*
|--------------------------------------------------------------------------
| end-Kategori Routes
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\KaryawanController;
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
Route::post('/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');
Route::get('/karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
Route::put('/karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
Route::delete('/karyawan/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
Route::get('/karyawan/{id}/print', [KaryawanController::class, 'print'])->name('karyawan.print');
Route::get('/karyawan/{id}/pdf', [KaryawanController::class, 'pdf'])->name('karyawan.pdf');
Route::get('/karyawan/{id}', [KaryawanController::class, 'show'])->name('karyawan.show');
/*
|--------------------------------------------------------------------------
| end-Karyawan Routes
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\PengembalianController;
Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
Route::get('/pengembalian/create', [PengembalianController::class, 'create'])->name('pengembalian.create');
Route::post('/pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');
Route::get('/pengembalian/{id}/edit', [PengembalianController::class, 'edit'])->name('pengembalian.edit');
Route::put('/pengembalian/{id}', [PengembalianController::class, 'update'])->name('pengembalian.update');
Route::delete('/pengembalian/{id}', [PengembalianController::class, 'destroy'])->name('pengembalian.destroy');
Route::get('/pengembalian/{id}/print', [PengembalianController::class, 'print'])->name('pengembalian.print');
Route::get('/pengembalian/{id}/pdf', [PengembalianController::class, 'pdf'])->name('pengembalian.pdf');
Route::get('/pengembalian/{id}', [PengembalianController::class, 'show'])->name('pengembalian.show');
Route::resource('/pengembalian', PengembalianController::class)->except(['index', 'show', 'create', 'edit']);
Route::post('/pengembalian/import', [\App\Http\Controllers\PengembalianController::class, 'import'])->name('pengembalian.import');
Route::post('/pengembalian/import', [PengembalianController::class, 'import'])->name('pengembalian.import');


