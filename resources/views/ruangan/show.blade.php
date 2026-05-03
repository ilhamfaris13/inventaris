@extends('layouts.app')
@section('title', 'Detail Ruangan — ' . $ruangan->nama_ruangan)
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">{{ $ruangan->nama_ruangan }}</h4>
            <small class="text-muted"><code>{{ $ruangan->kode_ruangan }}</code> · {{ $ruangan->lantai_label }} · Kapasitas: {{ $ruangan->kapasitas ?? '-' }}</small>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('ruangan.edit', $ruangan) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit me-1"></i>Edit</a>
            <a href="{{ route('ruangan.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i>Kembali</a>
        </div>
    </div>

    @if($ruangan->keterangan)
    <div class="alert alert-light border mb-4">{{ $ruangan->keterangan }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent border-0 pt-3 pb-0">
            <h6 class="fw-bold mb-0">Daftar Barang di Ruangan Ini ({{ $ruangan->barangs->count() }} item)</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 small">
                <thead class="table-light">
                    <tr><th>Kode</th><th>Nama Barang</th><th>Kategori</th><th>Jumlah</th><th>Kondisi</th><th>Kepemilikan</th></tr>
                </thead>
                <tbody>
                    @forelse($ruangan->barangs as $barang)
                    <tr>
                        <td><code>{{ $barang->kode_barang }}</code></td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->kategori?->nama_kategori ?? '-' }}</td>
                        <td>{{ $barang->jumlah }}</td>
                        <td><span class="badge bg-{{ $barang->kondisi_badge }}">{{ ucfirst($barang->kondisi) }}</span></td>
                        <td>{{ $barang->kepemilikan?->nama_divisi ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Belum ada barang di ruangan ini</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
