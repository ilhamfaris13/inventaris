<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardOptimalController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\JadwalMaintenanceController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;


/*
|--------------------------------------------------------------------------
| AUTH ROUTES — Tidak butuh login
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Redirect root ke login atau dashboard
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard.optimal')
        : redirect()->route('login');
});
Route::middleware(['auth'])->group(function () {

    // ── Dashboard ───────────────────────────────────────────────────────
    Route::get('/dashboard-optimal', [DashboardOptimalController::class, 'index'])
        ->name('dashboard.optimal');

    // ── Ruangan ─────────────────────────────────────────────────────────
    Route::resource('ruangan', RuanganController::class);

    // ── Jadwal Maintenance ───────────────────────────────────────────────
    Route::resource('jadwal-maintenance', JadwalMaintenanceController::class);
    Route::patch('jadwal-maintenance/{jadwalMaintenance}/selesaikan',
        [JadwalMaintenanceController::class, 'selesaikan'])
        ->name('jadwal-maintenance.selesaikan');

    // ── Laporan ─────────────────────────────────────────────────────────
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('inventaris',    [LaporanController::class, 'inventaris'])   ->name('inventaris');
        Route::get('peminjaman',    [LaporanController::class, 'peminjaman'])   ->name('peminjaman');
        Route::get('maintenance',   [LaporanController::class, 'maintenance'])  ->name('maintenance');
        Route::get('stok',          [LaporanController::class, 'stok'])         ->name('stok');
        Route::get('log-aktivitas', [LaporanController::class, 'logAktivitas']) ->name('log-aktivitas');
    });
    Route::resource('kategori',  KategoriController::class);
    Route::resource('divisi',    DivisiController::class);
    Route::resource('karyawan',  KaryawanController::class);
    Route::resource('barang',    BarangController::class);
    Route::resource('peminjaman', PeminjamanController::class);
    Route::get('barang/scan',    [BarangController::class, 'scan'])->name('barang.scan');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    });
    
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|


Route::get('/', function () {
    return view('welcome');
});






Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // ↓ Tambahkan baris ini di bawah semua route lama ↓
    //require __DIR__.'/web_tambahan.php';
});
require __DIR__.'/auth.php';
*/
/*
|--------------------------------------------------------------------------
| Barang Routes
|--------------------------------------------------------------------------

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
*/
/*
|--------------------------------------------------------------------------
| end-Barang Routes
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| Kategori Routes
|--------------------------------------------------------------------------

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
*/
/*
|--------------------------------------------------------------------------
| end-Kategori Routes
|--------------------------------------------------------------------------


use App\Http\Controllers\DivisiController;

// Resource route (sudah otomatis membuat index, create, store, show, edit, update, destroy)
Route::resource('divisi', DivisiController::class);

// Tambahan route khusus (print, pdf, import)
Route::get('/divisi/{id}/print', [DivisiController::class, 'print'])->name('divisi.print');
Route::get('/divisi/{id}/pdf', [DivisiController::class, 'pdf'])->name('divisi.pdf');
Route::post('/divisi/import', [DivisiController::class, 'import'])->name('divisi.import');
*/



/*
|--------------------------------------------------------------------------
| end-Divisi Routes
|--------------------------------------------------------------------------
*/
/*
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

|--------------------------------------------------------------------------
| end-Karyawan Routes
|--------------------------------------------------------------------------
*/

/*
use App\Http\Controllers\PeminjamanController;
Route::resource('peminjaman', PeminjamanController::class);
Route::get('/peminjaman/{id}/print', [PeminjamanController::class, 'print'])->name('peminjaman.print');
Route::get('/peminjaman/{id}/pdf', [PeminjamanController::class, 'pdf'])->name('peminjaman.pdf');
Route::post('/peminjaman/import', [PeminjamanController::class, 'import'])->name('peminjaman.import');


|--------------------------------------------------------------------------
| end-Peminjaman Routes
|--------------------------------------------------------------------------


use App\Http\Controllers\PengembalianController;
Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
Route::get('/pengembalian/create/{id}', [PengembalianController::class, 'create'])->name('pengembalian.create');
Route::post('/pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');
Route::get('/pengembalian/{id}/edit', [PengembalianController::class, 'edit'])->name('pengembalian.edit');
Route::put('/pengembalian/{id}', [PengembalianController::class, 'update'])->name('pengembalian.update');
Route::delete('/pengembalian/{id}', [PengembalianController::class, 'destroy'])->name('pengembalian.destroy');
Route::get('/pengembalian/{id}/print', [PengembalianController::class, 'print'])->name('pengembalian.print');
Route::get('/pengembalian/{id}/pdf', [PengembalianController::class, 'pdf'])->name('pengembalian.pdf');
Route::get('/pengembalian/{id}', [PengembalianController::class, 'show'])->name('pengembalian.show');
//Route::resource('/pengembalian', PengembalianController::class)->except(['index', 'show', 'create', 'edit']);
// Route::post('/pengembalian/import', [\App\Http\Controllers\PengembalianController::class, 'import'])->name('pengembalian.import');
Route::post('/pengembalian/import', [PengembalianController::class, 'import'])->name('pengembalian.import');

Route::get('/scan-barang', [BarangController::class, 'scan'])->name('barang.scan');
Route::post('/scan-barang', [BarangController::class, 'scanResult'])->name('barang.scan.result');
*/

