{{-- resources/views/laporan/log-aktivitas.blade.php --}}
@extends('layouts.app')
@section('title', 'Log Aktivitas')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Log Aktivitas Sistem</h4>
        <button onclick="window.print()" class="btn btn-outline-secondary btn-sm"><i class="fas fa-print me-1"></i>Cetak</button>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-2"><input type="date" name="dari" class="form-control" value="{{ request('dari') }}" placeholder="Dari tanggal"></div>
                <div class="col-md-2"><input type="date" name="sampai" class="form-control" value="{{ request('sampai') }}" placeholder="Sampai tanggal"></div>
                <div class="col-auto">
                    <button class="btn btn-primary"><i class="fas fa-filter me-1"></i>Filter</button>
                    <a href="{{ route('laporan.log-aktivitas') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 small">
                <thead class="table-dark">
                    <tr><th>#</th><th>Pengguna</th><th>Aktivitas</th><th>Waktu</th></tr>
                </thead>
                <tbody>
                    @forelse($logs as $i => $log)
                    <tr>
                        <td>{{ $logs->firstItem() + $loop->index }}</td>
                        <td>{{ $log->karyawan?->nama ?? 'System' }}</td>
                        <td>{{ $log->aktivitas }}</td>
                        <td>
                            <span title="{{ $log->timestamp->format('d/m/Y H:i:s') }}">
                                {{ $log->timestamp->isoFormat('D MMM Y, HH:mm') }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted py-4">Tidak ada log aktivitas</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer border-0 bg-transparent">{{ $logs->links() }}</div>
    </div>
</div>
@endsection
