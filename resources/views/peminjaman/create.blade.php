@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Data Peminjaman</h2>

    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="text" name="id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="karyawan_id" class="form-label">Karyawan ID</label>
            <select name="karyawan_id" class="form-control" required>
                <option value="">Pilih Karyawan</option>
                @foreach ($karyawan as $kar)
                    <option value="{{ $kar->id }}">{{ $kar->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="barang_id" class="form-label">Barang ID</label>
            <select name="barang_id" class="form-control" required>
                <option value="">Pilih Barang</option>
                @foreach ($barang as $brg)
                    <option value="{{ $brg->id }}">{{ $brg->nama_barang }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="datetime-local" name="tanggal_pinjam" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
            <input type="datetime-local" name="tanggal_kembali" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="pinjam">Pinjam</option>
                <option value="kembali">Kembali</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="created_at" class="form-label">Created At</label>
            <input type="datetime-local" name="created_at" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="updated_at" class="form-label">Updated At</label>
            <input type="datetime-local" name="updated_at" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection