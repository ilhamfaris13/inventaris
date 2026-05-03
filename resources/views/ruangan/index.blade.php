@extends('layouts.app')
@section('title', 'Manajemen Ruangan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Manajemen Ruangan</h4>
        <a href="{{ route('ruangan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Ruangan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body pb-0">
            <form method="GET" class="row g-2 mb-3">
                <div class="col-md-4">
                    <input type="text" name="q" class="form-control" placeholder="Cari nama / kode ruangan..." value="{{ request('q') }}">
                </div>
                <div class="col-auto">
                    <button class="btn btn-outline-secondary"><i class="fas fa-search"></i> Cari</button>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Nama Ruangan</th>
                        <th>Lantai</th>
                        <th>Kapasitas</th>
                        <th>Jumlah Barang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ruangans as $ruangan)
                    <tr>
                        <td>{{ $ruangans->firstItem() + $loop->index }}</td>
                        <td><code>{{ $ruangan->kode_ruangan }}</code></td>
                        <td>{{ $ruangan->nama_ruangan }}</td>
                        <td>{{ $ruangan->lantai_label }}</td>
                        <td>{{ $ruangan->kapasitas ? $ruangan->kapasitas . ' komputer' : '-' }}</td>
                        <td><span class="badge bg-primary rounded-pill">{{ $ruangan->barangs_count }}</span></td>
                        <td>
                            <a href="{{ route('ruangan.show', $ruangan) }}" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('ruangan.edit', $ruangan) }}" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{ route('ruangan.destroy', $ruangan) }}" class="d-inline" onsubmit="return confirm('Hapus ruangan ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Tidak ada data ruangan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer border-0 bg-transparent">
            {{ $ruangans->links() }}
        </div>
    </div>
</div>
@endsection
