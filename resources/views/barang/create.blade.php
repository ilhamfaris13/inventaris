@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Barang</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="kode_barang" class="form-label">Kode Barang</label>
            <input type="text" class="form-control" id="kode_barang" name="kode_barang" required>
        </div>

        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
        </div>

        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select class="form-control" id="kategori_id" name="kategori_id">
                <option value="">Pilih Kategori</option>
                @foreach ($kategori as $kat)
                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="spesifikasi" class="form-label">Spesifikasi</label>
            <textarea class="form-control" id="spesifikasi" name="spesifikasi"></textarea>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" value="1" min="1" required>
        </div>

        <div class="mb-3">
            <label for="kondisi" class="form-label">Kondisi</label>
            <select class="form-control" id="kondisi" name="kondisi" required>
                <option value="baik">Baik</option>
                <option value="rusak">Rusak</option>
                <option value="diperbaiki">Diperbaiki</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi">
        </div>

        <div class="mb-3">
            <label for="kepemilikan_id" class="form-label">Divisi Kepemilikan</label>
            <select class="form-control" id="kepemilikan_id" name="kepemilikan_id">
                <option value="">Pilih Divisi</option>
                @foreach ($divisi as $div)
                    <option value="{{ $div->id }}">{{ $div->nama_divisi }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto Barang</label>
            <input type="file" name="foto" class="form-control">
        </div>
        

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('kode_barang').focus();
    });
</script>
