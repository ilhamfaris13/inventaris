@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb-items')
  <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('page-actions')
  <div style="font-size:11.5px;color:var(--text-muted)">
    <i class="fas fa-clock mr-1"></i>{{ now()->isoFormat('dddd, D MMMM Y') }}
  </div>
@endsection

@section('content')

{{-- ── STAT CARDS ──────────────────────────────────────────────────── --}}
<div class="row">
  <div class="col-6 col-xl-3 mb-3">
    <div class="card stat-card blue">
      <div class="card-body">
        <div class="stat-label">Total Item Barang</div>
        <div class="stat-value">{{ number_format($totalBarang) }}</div>
        <div class="stat-sub">{{ number_format($totalUnit) }} unit tercatat</div>
        <i class="fas fa-boxes stat-icon"></i>
      </div>
    </div>
  </div>
  <div class="col-6 col-xl-3 mb-3">
    <div class="card stat-card success">
      <div class="card-body">
        <div class="stat-label">Kondisi Baik</div>
        <div class="stat-value">{{ number_format($barangBaik) }}</div>
        <div class="stat-sub">unit siap pakai</div>
        <i class="fas fa-check-circle stat-icon"></i>
      </div>
    </div>
  </div>
  <div class="col-6 col-xl-3 mb-3">
    <div class="card stat-card warning">
      <div class="card-body">
        <div class="stat-label">Sedang Dipinjam</div>
        <div class="stat-value">{{ number_format($totalDipinjam) }}</div>
        <div class="stat-sub">
          @if($peminjamanTerlambat > 0)
            <i class="fas fa-exclamation-triangle"></i> {{ $peminjamanTerlambat }} terlambat
          @else
            transaksi aktif
          @endif
        </div>
        <i class="fas fa-hand-holding stat-icon"></i>
      </div>
    </div>
  </div>
  <div class="col-6 col-xl-3 mb-3">
    <div class="card stat-card danger">
      <div class="card-body">
        <div class="stat-label">Dalam Perbaikan</div>
        <div class="stat-value">{{ number_format($barangDiperbaiki) }}</div>
        <div class="stat-sub">unit sedang diperbaiki</div>
        <i class="fas fa-tools stat-icon"></i>
      </div>
    </div>
  </div>
</div>

{{-- ── PEMINJAMAN AKTIF + LOG AKTIVITAS ───────────────────────────── --}}
<div class="row">
  <div class="col-12 col-lg-7 mb-3">
    <div class="card h-100">
      <div class="card-header d-flex justify-content-between align-items-center">
        <span>
          <i class="fas fa-hand-holding mr-2" style="color:var(--warning)"></i>
          Peminjaman Aktif
          @if($peminjamanTerlambat > 0)
            <span class="badge badge-danger ml-1">{{ $peminjamanTerlambat }} terlambat</span>
          @endif
        </span>
        <a href="{{ route('laporan.peminjaman', ['status'=>'dipinjam']) }}"
           class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
      </div>
      <div class="card-body p-0">
        @if($peminjamanAktif->isEmpty())
          <div class="text-center py-5" style="color:var(--text-muted)">
            <i class="fas fa-inbox fa-2x d-block mb-2" style="opacity:.25"></i>
            <span style="font-size:13px">Tidak ada peminjaman aktif</span>
          </div>
        @else
          <div class="table-responsive">
            <table class="table mb-0">
              <thead>
                <tr><th>Barang</th><th>Peminjam</th><th>Tgl Pinjam</th><th>Jml</th><th>Status</th></tr>
              </thead>
              <tbody>
                @foreach($peminjamanAktif as $p)
                <tr>
                  <td>
                    <div style="font-weight:600">{{ Str::limit($p->barang?->nama_barang ?? '-', 28) }}</div>
                    <div style="font-size:11px;color:var(--text-muted)">{{ $p->barang?->kode_barang }}</div>
                  </td>
                  <td>{{ $p->karyawan?->nama ?? '-' }}</td>
                  <td style="font-size:12px">{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                  <td><span class="badge badge-primary">{{ $p->jumlah }}</span></td>
                  <td>
                    @if($p->is_terlambat)
                      <span class="badge badge-danger">Terlambat</span>
                    @else
                      <span class="badge badge-warning">Dipinjam</span>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>
  </div>

  <div class="col-12 col-lg-5 mb-3">
    <div class="card h-100">
      <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-history mr-2" style="color:var(--blue-mid)"></i>Aktivitas Terbaru</span>
        <a href="{{ route('laporan.log-aktivitas') }}" class="btn btn-sm btn-outline-secondary">Semua Log</a>
      </div>
      <div class="card-body p-0" style="max-height:300px;overflow-y:auto">
        @forelse($logTerbaru as $log)
          <div style="padding:9px 14px;border-bottom:1px solid var(--border-soft);display:flex;gap:9px;align-items:flex-start">
            <div style="width:28px;height:28px;border-radius:50%;background:var(--blue-pale);display:flex;align-items:center;justify-content:center;flex-shrink:0">
              <i class="fas fa-user" style="font-size:10px;color:var(--blue-main)"></i>
            </div>
            <div style="flex:1;min-width:0">
              <div style="font-size:12.5px;line-height:1.4">{{ $log->aktivitas }}</div>
              <div style="font-size:11px;color:var(--text-muted);margin-top:1px">
                {{ $log->karyawan?->nama ?? 'System' }} · {{ $log->timestamp->diffForHumans() }}
              </div>
            </div>
          </div>
        @empty
          <div class="text-center py-5" style="color:var(--text-muted);font-size:13px">Belum ada aktivitas</div>
        @endforelse
      </div>
    </div>
  </div>
</div>

{{-- ── JADWAL MAINTENANCE + TOP BARANG ────────────────────────────── --}}
<div class="row">
  <div class="col-12 col-md-7 mb-3">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <span>
          <i class="fas fa-calendar-check mr-2" style="color:var(--blue-main)"></i>
          Jadwal Maintenance (7 Hari)
          @if($jadwalTerlambat > 0)
            <span class="badge badge-danger ml-1">{{ $jadwalTerlambat }} terlambat</span>
          @endif
        </span>
        <a href="{{ route('jadwal-maintenance.index') }}" class="btn btn-sm btn-outline-secondary">Kelola</a>
      </div>
      <div class="card-body p-0">
        @if($jadwalAkanDatang->isEmpty())
          <div class="text-center py-4" style="color:var(--text-muted)">
            <i class="fas fa-check-circle fa-2x d-block mb-2" style="color:var(--success);opacity:.5"></i>
            <span style="font-size:13px">Tidak ada jadwal dalam 7 hari ke depan</span>
          </div>
        @else
          <div class="table-responsive">
            <table class="table mb-0">
              <thead><tr><th>Barang</th><th>Teknisi</th><th>Jadwal</th><th>Aksi</th></tr></thead>
              <tbody>
                @foreach($jadwalAkanDatang as $j)
                <tr>
                  <td style="font-weight:600;font-size:13px">{{ Str::limit($j->barang?->nama_barang ?? '-', 26) }}</td>
                  <td style="font-size:12px">{{ $j->teknisi?->nama ?? '-' }}</td>
                  <td>
                    <span style="font-size:12px">{{ $j->jadwal_tanggal->format('d/m/Y') }}</span>
                    @if($j->is_terlambat)
                      <span class="badge badge-danger ml-1">Telat</span>
                    @elseif($j->hari_menuju_jadwal <= 2)
                      <span class="badge badge-warning ml-1">{{ $j->hari_menuju_jadwal }}h lagi</span>
                    @endif
                  </td>
                  <td>
                    <form method="POST" action="{{ route('jadwal-maintenance.selesaikan', $j) }}" class="d-inline">
                      @csrf @method('PATCH')
                      <button class="btn btn-sm btn-success" style="padding:2px 8px;font-size:11px"
                              onclick="return confirm('Tandai selesai?')">
                        <i class="fas fa-check"></i>
                      </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>
  </div>

  <div class="col-12 col-md-5 mb-3">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-trophy mr-2" style="color:var(--gold)"></i>Top 5 Barang Paling Sering Dipinjam
      </div>
      <div class="card-body">
        @forelse($topBarangDipinjam as $i => $item)
          @php $maxFreq = $topBarangDipinjam->first()->frekuensi ?: 1; @endphp
          <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
              <span style="font-size:12.5px;font-weight:600">
                <span style="color:var(--text-muted);margin-right:3px">{{ $i+1 }}.</span>
                {{ Str::limit($item->barang?->nama_barang ?? 'N/A', 30) }}
              </span>
              <span style="font-size:12px;font-weight:700;color:var(--blue-main)">{{ $item->frekuensi }}×</span>
            </div>
            <div class="progress" style="height:5px;border-radius:10px;background:var(--border)">
              <div class="progress-bar" style="width:{{ ($item->frekuensi/$maxFreq)*100 }}%;background:linear-gradient(90deg,var(--blue-dark),var(--blue-mid));border-radius:10px"></div>
            </div>
          </div>
        @empty
          <div class="text-center py-3" style="color:var(--text-muted);font-size:13px">Belum ada data</div>
        @endforelse
      </div>
    </div>
  </div>
</div>

{{-- ── RINGKASAN KONDISI BARANG ────────────────────────────────────── --}}
<div class="row">
  <div class="col-12 mb-3">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-chart-pie mr-2" style="color:var(--blue-main)"></i>Ringkasan Kondisi Barang</span>
        <a href="{{ route('laporan.inventaris') }}" class="btn btn-sm btn-outline-secondary">Lihat Laporan Lengkap</a>
      </div>
      <div class="card-body">
        @php
          $t2  = max($totalUnit, 1);
          $pB  = round(($barangBaik / $t2) * 100);
          $pR  = round(($barangRusak / $t2) * 100);
          $pD  = round(($barangDiperbaiki / $t2) * 100);
        @endphp
        <div class="row align-items-center">
          <div class="col-12 col-md-8">
            <div class="mb-1" style="font-size:11px;color:var(--text-muted);font-weight:600">
              Distribusi Kondisi ({{ number_format($totalUnit) }} unit total)
            </div>
            <div style="height:20px;border-radius:10px;overflow:hidden;display:flex;background:var(--border)">
              @if($pB > 0)
                <div style="width:{{ $pB }}%;background:#2E7D32;display:flex;align-items:center;justify-content:center;font-size:10px;color:#fff;font-weight:700">{{ $pB > 8 ? $pB.'%' : '' }}</div>
              @endif
              @if($pD > 0)
                <div style="width:{{ $pD }}%;background:#B45309;display:flex;align-items:center;justify-content:center;font-size:10px;color:#fff;font-weight:700">{{ $pD > 8 ? $pD.'%' : '' }}</div>
              @endif
              @if($pR > 0)
                <div style="width:{{ $pR }}%;background:#991B1B;display:flex;align-items:center;justify-content:center;font-size:10px;color:#fff;font-weight:700">{{ $pR > 8 ? $pR.'%' : '' }}</div>
              @endif
            </div>
            <div class="d-flex mt-2" style="gap:18px;flex-wrap:wrap">
              <span style="font-size:12px;color:var(--text-muted)"><span style="display:inline-block;width:10px;height:10px;border-radius:2px;background:#2E7D32;margin-right:4px"></span>Baik ({{ number_format($barangBaik) }})</span>
              <span style="font-size:12px;color:var(--text-muted)"><span style="display:inline-block;width:10px;height:10px;border-radius:2px;background:#B45309;margin-right:4px"></span>Diperbaiki ({{ number_format($barangDiperbaiki) }})</span>
              <span style="font-size:12px;color:var(--text-muted)"><span style="display:inline-block;width:10px;height:10px;border-radius:2px;background:#991B1B;margin-right:4px"></span>Rusak ({{ number_format($barangRusak) }})</span>
            </div>
          </div>
          <div class="col-12 col-md-4 mt-3 mt-md-0">
            <div class="row text-center">
              <div class="col-4">
                <div style="font-size:1.6rem;font-weight:800;color:#2E7D32">{{ number_format($barangBaik) }}</div>
                <div style="font-size:11px;color:var(--text-muted)">Baik</div>
              </div>
              <div class="col-4">
                <div style="font-size:1.6rem;font-weight:800;color:#B45309">{{ number_format($barangDiperbaiki) }}</div>
                <div style="font-size:11px;color:var(--text-muted)">Diperbaiki</div>
              </div>
              <div class="col-4">
                <div style="font-size:1.6rem;font-weight:800;color:#991B1B">{{ number_format($barangRusak) }}</div>
                <div style="font-size:11px;color:var(--text-muted)">Rusak</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
