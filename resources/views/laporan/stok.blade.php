{{-- resources/views/laporan/stok.blade.php --}}
@extends('layouts.app')
@section('title', 'Laporan Transaksi Stok')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Laporan Transaksi Stok</h4>
        <button onclick="window.print()" class="btn btn-outline-secondary btn-sm"><i class="fas fa-print me-1"></i>Cetak</button>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-2"><input type="date" name="dari" class="form-control" value="{{ $dari }}"></div>
                <div class="col-md-2"><input type="date" name="sampai" class="form-control" value="{{ $sampai }}"></div>
                <div class="col-md-2">
                    <select name="tipe" class="form-select">
                        <option value="">Semua Tipe</option>
                        <option value="masuk"       @selected(request('tipe') === 'masuk')>Masuk</option>
                        <option value="keluar"      @selected(request('tipe') === 'keluar')>Keluar</option>
                        <option value="penyesuaian" @selected(request('tipe') === 'penyesuaian')>Penyesuaian</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary"><i class="fas fa-filter me-1"></i>Filter</button>
                    <a href="{{ route('laporan.stok') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-4"><div class="card border-0 bg-success text-white shadow-sm"><div class="card-body text-center"><div class="fs-4 fw-bold">{{ $ringkasan['masuk'] }}</div><div class="small">Unit Masuk</div></div></div></div>
        <div class="col-4"><div class="card border-0 bg-danger text-white shadow-sm"><div class="card-body text-center"><div class="fs-4 fw-bold">{{ $ringkasan['keluar'] }}</div><div class="small">Unit Keluar</div></div></div></div>
        <div class="col-4"><div class="card border-0 bg-info text-white shadow-sm"><div class="card-body text-center"><div class="fs-4 fw-bold">{{ $ringkasan['penyesuaian'] }}</div><div class="small">Penyesuaian</div></div></div></div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 small">
                <thead class="table-dark">
                    <tr><th>#</th><th>Barang</th><th>Tipe</th><th>Jumlah</th><th>Tanggal</th><th>Keterangan</th></tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $i => $t)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $t->barang?->nama_barang ?? '-' }}</td>
                        <td><span class="badge bg-{{ $t->tipe_badge }}">{{ ucfirst($t->tipe) }}</span></td>
                        <td>{{ $t->jumlah }}</td>
                        <td>{{ $t->tanggal->format('d/m/Y') }}</td>
                        <td>{{ $t->keterangan ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Tidak ada transaksi stok pada periode ini</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
