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
                <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                @foreach ($barangAll as $brg)
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
                <option value="dipinjam">Pinjam</option>
                <option value="dikembalikan">Kembali</option>
            </select>
        </div>

       

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection