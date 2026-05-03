@extends('layouts.app')
@section('title', 'Laporan Inventaris Barang')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Laporan Inventaris Barang</h4>
        <button onclick="window.print()" class="btn btn-outline-secondary btn-sm"><i class="fas fa-print me-1"></i>Cetak</button>
    </div>

    {{-- Filter --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-3">
                    <input type="text" name="q" class="form-control" placeholder="Cari nama/kode barang..." value="{{ request('q') }}">
                </div>
                <div class="col-md-2">
                    <select name="kondisi" class="form-select">
                        <option value="">Semua Kondisi</option>
                        <option value="baik"       @selected(request('kondisi') === 'baik')>Baik</option>
                        <option value="rusak"      @selected(request('kondisi') === 'rusak')>Rusak</option>
                        <option value="diperbaiki" @selected(request('kondisi') === 'diperbaiki')>Diperbaiki</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary"><i class="fas fa-filter me-1"></i>Filter</button>
                    <a href="{{ route('laporan.inventaris') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Ringkasan --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3"><div class="card border-0 bg-primary text-white shadow-sm"><div class="card-body text-center"><div class="fs-4 fw-bold">{{ $ringkasan['total_item'] }}</div><div class="small">Total Item</div></div></div></div>
        <div class="col-6 col-md-3"><div class="card border-0 bg-secondary text-white shadow-sm"><div class="card-body text-center"><div class="fs-4 fw-bold">{{ $ringkasan['total_unit'] }}</div><div class="small">Total Unit</div></div></div></div>
        <div class="col-6 col-md-3"><div class="card border-0 bg-success text-white shadow-sm"><div class="card-body text-center"><div class="fs-4 fw-bold">{{ $ringkasan['baik'] }}</div><div class="small">Unit Baik</div></div></div></div>
        <div class="col-6 col-md-3"><div class="card border-0 bg-danger text-white shadow-sm"><div class="card-body text-center"><div class="fs-4 fw-bold">{{ $ringkasan['rusak'] }}</div><div class="small">Unit Rusak</div></div></div></div>
    </div>

    {{-- Tabel --}}
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 small">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Ruangan</th>
                        <th>Divisi</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
                        <th>Tgl Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangs as $i => $b)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td><code>{{ $b->kode_barang }}</code></td>
                        <td>{{ $b->nama_barang }}</td>
                        <td>{{ $b->kategori?->nama_kategori ?? '-' }}</td>
                        <td>{{ $b->ruangan?->nama_ruangan ?? $b->lokasi ?? '-' }}</td>
                        <td>{{ $b->kepemilikan?->nama_divisi ?? '-' }}</td>
                        <td>{{ $b->jumlah }}</td>
                        <td><span class="badge bg-{{ $b->kondisi_badge }}">{{ ucfirst($b->kondisi) }}</span></td>
                        <td>{{ $b->tanggal_masuk?->format('d/m/Y') ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center text-muted py-4">Tidak ada data barang</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
