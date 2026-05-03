{{-- resources/views/laporan/peminjaman.blade.php --}}
@extends('layouts.app')
@section('title', 'Laporan Peminjaman')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Laporan Peminjaman</h4>
        <button onclick="window.print()" class="btn btn-outline-secondary btn-sm"><i class="fas fa-print me-1"></i>Cetak</button>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-2"><input type="date" name="dari" class="form-control" value="{{ request('dari') }}" placeholder="Dari tanggal"></div>
                <div class="col-md-2"><input type="date" name="sampai" class="form-control" value="{{ request('sampai') }}" placeholder="Sampai tanggal"></div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="dipinjam"     @selected(request('status') === 'dipinjam')>Dipinjam</option>
                        <option value="dikembalikan" @selected(request('status') === 'dikembalikan')>Dikembalikan</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary"><i class="fas fa-filter me-1"></i>Filter</button>
                    <a href="{{ route('laporan.peminjaman') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3"><div class="card border-0 bg-primary text-white shadow-sm"><div class="card-body text-center"><div class="fs-4 fw-bold">{{ $ringkasan['total'] }}</div><div class="small">Total Transaksi</div></div></div></div>
        <div class="col-6 col-md-3"><div class="card border-0 bg-warning text-dark shadow-sm"><div class="card-body text-center"><div class="fs-4 fw-bold">{{ $ringkasan['dipinjam'] }}</div><div class="small">Sedang Dipinjam</div></div></div></div>
        <div class="col-6 col-md-3"><div class="card border-0 bg-success text-white shadow-sm"><div class="card-body text-center"><div class="fs-4 fw-bold">{{ $ringkasan['dikembalikan'] }}</div><div class="small">Dikembalikan</div></div></div></div>
        <div class="col-6 col-md-3"><div class="card border-0 bg-secondary text-white shadow-sm"><div class="card-body text-center"><div class="fs-4 fw-bold">{{ $ringkasan['total_unit'] }}</div><div class="small">Total Unit</div></div></div></div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 small">
                <thead class="table-dark">
                    <tr><th>#</th><th>Peminjam</th><th>Barang</th><th>Jumlah</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Status</th><th>Kondisi Kembali</th></tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $i => $p)
                    <tr class="{{ $p->is_terlambat ? 'table-danger' : '' }}">
                        <td>{{ $i+1 }}</td>
                        <td>{{ $p->karyawan?->nama ?? '-' }}</td>
                        <td>{{ $p->barang?->nama_barang ?? '-' }}</td>
                        <td>{{ $p->jumlah }}</td>
                        <td>{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                        <td>{{ $p->pengembalian?->tanggal_pengembalian?->format('d/m/Y') ?? ($p->tanggal_kembali?->format('d/m/Y') ?? '-') }}</td>
                        <td><span class="badge bg-{{ $p->status_badge }}">{{ ucfirst($p->status) }}</span></td>
                        <td>
                            @if($p->pengembalian)
                                <span class="badge bg-{{ $p->pengembalian->kondisi_badge }}">{{ ucfirst($p->pengembalian->kondisi_barang) }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">Tidak ada data peminjaman</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
