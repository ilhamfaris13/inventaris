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

Route::get('/divisi', function () {
    return view('divisi.index');
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
Route::get('/kategori/{id}/print', [KategoriController::class, 'print'])->name('kategori.print');
Route::get('/kategori/{id}/pdf', [KategoriController::class, 'pdf'])->name('kategori.pdf');
Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');
/*
|--------------------------------------------------------------------------
| end-Kategori Routes
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\DivisiController;

// Resource route (sudah otomatis membuat index, create, store, show, edit, update, destroy)
Route::resource('divisi', DivisiController::class);

// Tambahan route khusus (print, pdf, import)
Route::get('/divisi/{id}/print', [DivisiController::class, 'print'])->name('divisi.print');
Route::get('/divisi/{id}/pdf', [DivisiController::class, 'pdf'])->name('divisi.pdf');
Route::post('/divisi/import', [DivisiController::class, 'import'])->name('divisi.import');




/*
|--------------------------------------------------------------------------
| end-Divisi Routes
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

use App\Http\Controllers\PeminjamanController;
Route::resource('peminjaman', PeminjamanController::class);
Route::get('/peminjaman/{id}/print', [PeminjamanController::class, 'print'])->name('peminjaman.print');
Route::get('/peminjaman/{id}/pdf', [PeminjamanController::class, 'pdf'])->name('peminjaman.pdf');
Route::post('/peminjaman/import', [PeminjamanController::class, 'import'])->name('peminjaman.import');

/*
|--------------------------------------------------------------------------
| end-Peminjaman Routes
|--------------------------------------------------------------------------
*/