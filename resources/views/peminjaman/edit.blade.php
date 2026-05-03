@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Data Peminjaman</h2>

    <!-- Menampilkan pesan sukses -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Menampilkan pesan error -->
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Menampilkan validasi error -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form untuk edit data -->
    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="text" name="id" class="form-control" value="{{ $peminjaman->id }}" readonly>
        </div>

        <div class="mb-3">
            <label for="karyawan_id" class="form-label">Karyawan ID</label>
            <input type="text" name="karyawan_id" class="form-control" value="{{ $peminjaman->karyawan_id }}" required>
        <select name="karyawan_id" class="form-control" required>
                <option value="">Pilih Karyawan</option>
                @foreach ($karyawan as $kar)
                    <option value="{{ $kar->id }}" {{ $peminjaman->karyawan_id == $kar->id ? 'selected' : '' }}>{{ $kar->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="barang_id" class="form-label">Barang ID</label>
            <input type="text" name="barang_id" class="form-control" value="{{ $peminjaman->barang_id }}" required>
        <select name="barang_id" class="form-control" required>
                <option value="">Pilih Barang</option>
                @foreach ($barang as $brg)
                    <option value="{{ $brg->id }}" {{ $peminjaman->barang_id == $brg->id ? 'selected' : '' }}>{{ $brg->nama_barang }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="{{ $peminjaman->jumlah }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="datetime-local" name="tanggal_pinjam" class="form-control" value="{{ $peminjaman->tanggal_pinjam->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
            <input type="datetime-local" name="tanggal_kembali" class="form-control" value="{{ $peminjaman->tanggal_kembali->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="pinjam" {{ $peminjaman->status == 'pinjam' ? 'selected' : '' }}>Pinjam</option>
                <option value="kembali" {{ $peminjaman->status == 'kembali' ? 'selected' : '' }}>Kembali</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="created_at" class="form-label">Created At</label>
            <input type="datetime-local" name="created_at" class="form-control" value="{{ $peminjaman->created_at->format('Y-m-d\TH:i') }}" readonly>
        </div>

        <div class="mb-3">
            <label for="updated_at" class="form-label">Updated At</label>
            <input type="datetime-local" name="updated_at" class="form-control" value="{{ $peminjaman->updated_at->format('Y-m-d\TH:i') }}" readonly>
        </div>


        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('divisi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection