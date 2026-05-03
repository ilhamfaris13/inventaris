{{-- resources/views/laporan/maintenance.blade.php --}}
@extends('layouts.app')
@section('title', 'Laporan Maintenance')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Laporan Maintenance Barang</h4>
        <button onclick="window.print()" class="btn btn-outline-secondary btn-sm"><i class="fas fa-print me-1"></i>Cetak</button>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-2"><input type="date" name="dari" class="form-control" value="{{ request('dari') }}"></div>
                <div class="col-md-2"><input type="date" name="sampai" class="form-control" value="{{ request('sampai') }}"></div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="diperbaiki" @selected(request('status') === 'diperbaiki')>Diperbaiki</option>
                        <option value="selesai"    @selected(request('status') === 'selesai')>Selesai</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary"><i class="fas fa-filter me-1"></i>Filter</button>
                    <a href="{{ route('laporan.maintenance') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-4"><div class="card border-0 bg-primary text-white shadow-sm"><div class="card-body text-center"><div class="fs-4 fw-bold">{{ $ringkasan['total'] }}</div><div class="small">Total</div></div></div></div>
        <div class="col-4"><div class="card border-0 bg-warning text-dark shadow-sm"><div class="card-body text-center"><div class="fs-4 fw-bold">{{ $ringkasan['diperbaiki'] }}</div><div class="small">Sedang Diperbaiki</div></div></div></div>
        <div class="col-4"><div class="card border-0 bg-success text-white shadow-sm"><div class="card-body text-center"><div class="fs-4 fw-bold">{{ $ringkasan['selesai'] }}</div><div class="small">Selesai</div></div></div></div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 small">
                <thead class="table-dark">
                    <tr><th>#</th><th>Barang</th><th>Teknisi</th><th>Tgl Perbaikan</th><th>Deskripsi</th><th>Status</th></tr>
                </thead>
                <tbody>
                    @forelse($maintenances as $i => $m)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $m->barang?->nama_barang ?? '-' }}</td>
                        <td>{{ $m->teknisi?->nama ?? '-' }}</td>
                        <td>{{ $m->tanggal_perbaikan->format('d/m/Y') }}</td>
                        <td>{{ Str::limit($m->deskripsi, 60) ?? '-' }}</td>
                        <td><span class="badge bg-{{ $m->status_badge }}">{{ ucfirst($m->status) }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Tidak ada data maintenance</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
