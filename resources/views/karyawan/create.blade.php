@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>
<script>
    $(document).ready(function() {
        $('#gaji').inputmask('decimal', {
            alias: 'numeric',
            groupSeparator: '.',
            autoGroup: true,
            digits: 0,
            digitsOptional: false,
            placeholder: '0',
            removeMaskOnSubmit: true
        });
    });
</script>
<div class="container">
    <h1 class="text-center">Tambah Karyawan</h1>
    <form action="{{ route('karyawan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="address" name="alamat" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
        </div>
        <div class="mb-3">
            <label for="posisi" class="form-label">Posisi</label>
            <select class="form-control" id="posisi" name="posisi" required>
        <option value="">Pilih Posisi</option>
        @foreach ($divisi as $item)
            <option value="{{ $item->id }}">{{ $item->nama_divisi }}</option>
        @endforeach
    </select>
        </div>
        <div class="mb-3">
            <label for="gaji" class="form-label">Gaji</label>
            <input type="text" class="form-control" id="gaji" name="gaji" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
    <a href="{{ route('karyawan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection