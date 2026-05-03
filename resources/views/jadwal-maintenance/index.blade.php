@extends('layouts.app')
@section('title', 'Jadwal Maintenance')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Jadwal Maintenance</h4>
            @if($terlambatCount > 0)
                <span class="badge bg-danger">{{ $terlambatCount }} jadwal terlambat!</span>
            @endif
            @if($akanDatangCount > 0)
                <span class="badge bg-warning text-dark ms-1">{{ $akanDatangCount }} dalam 7 hari</span>
            @endif
        </div>
        <a href="{{ route('jadwal-maintenance.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Buat Jadwal
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body pb-0">
            <form method="GET" class="row g-2 mb-3">
                <div class="col-md-4">
                    <input type="text" name="q" class="form-control" placeholder="Cari nama barang..." value="{{ request('q') }}">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="terjadwal"  @selected(request('status') === 'terjadwal')>Terjadwal</option>
                        <option value="selesai"    @selected(request('status') === 'selesai')>Selesai</option>
                        <option value="dibatalkan" @selected(request('status') === 'dibatalkan')>Dibatalkan</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn btn-outline-secondary"><i class="fas fa-search"></i> Filter</button>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 small">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Barang</th>
                        <th>Teknisi</th>
                        <th>Jadwal</th>
                        <th>Frekuensi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwals as $j)
                    <tr class="{{ $j->is_terlambat ? 'table-danger' : '' }}">
                        <td>{{ $jadwals->firstItem() + $loop->index }}</td>
                        <td>
                            <div class="fw-medium">{{ $j->barang?->nama_barang ?? '-' }}</div>
                            <div class="text-muted" style="font-size:0.75rem">{{ $j->barang?->kode_barang }}</div>
                        </td>
                        <td>{{ $j->teknisi?->nama ?? '<em class="text-muted">Belum ditentukan</em>' }}</td>
                        <td>
                            {{ $j->jadwal_tanggal->format('d/m/Y') }}
                            @if($j->is_terlambat)
                                <span class="badge bg-danger ms-1">Terlambat</span>
                            @elseif($j->hari_menuju_jadwal <= 3 && $j->hari_menuju_jadwal >= 0)
                                <span class="badge bg-warning text-dark ms-1">{{ $j->hari_menuju_jadwal }} hari lagi</span>
                            @endif
                        </td>
                        <td><span class="badge bg-secondary">{{ ucfirst($j->frekuensi) }}</span></td>
                        <td><span class="badge bg-{{ $j->status_badge }}">{{ ucfirst($j->status) }}</span></td>
                        <td>
                            @if($j->status === 'terjadwal')
                                <form method="POST" action="{{ route('jadwal-maintenance.selesaikan', $j) }}" class="d-inline">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-sm btn-success py-0 px-1" onclick="return confirm('Tandai selesai?')" title="Tandai Selesai">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                <a href="{{ route('jadwal-maintenance.edit', $j) }}" class="btn btn-sm btn-warning py-0 px-1"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('jadwal-maintenance.destroy', $j) }}" class="d-inline" onsubmit="return confirm('Batalkan jadwal ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger py-0 px-1"><i class="fas fa-times"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Tidak ada jadwal maintenance</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer border-0 bg-transparent">{{ $jadwals->links() }}</div>
    </div>
</div>
@endsection
