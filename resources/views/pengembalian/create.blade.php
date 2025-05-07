@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Pengembalian</h2>

    @if ($errors->any())
        <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <form action="{{ route('pengembalian.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Peminjaman</label>
            <select name="peminjaman_id" class="form-control" required>
                <option value="">-- Pilih Peminjaman --</option>
                @foreach ($peminjamans as $peminjaman)
                    <option value="{{ $peminjaman->id }}">{{ $peminjaman->karyawan_id}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Pengembalian</label>
            <input type="date" name="tanggal_pengembalian" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kondisi Barang</label>
            <select name="kondisi_barang" class="form-control" required>
                <option value="baik">Baik</option>
                <option value="rusak">Rusak</option>
                <option value="hilang">Hilang</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('pengembalian.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
