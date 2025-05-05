@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Karyawan</h1>

    <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $karyawan->nama) }}" required>
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="Laki-laki" {{ old('jenis_kelamin', $karyawan->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $karyawan->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required>{{ old('alamat', $karyawan->alamat) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $karyawan->tanggal_lahir) }}" required>
        </div>

        <div class="mb-3">
            <label>Posisi</label>
            <input type="number" name="posisi" class="form-control" value="{{ old('posisi', $karyawan->posisi) }}" required>
        </div>

        <div class="mb-3">
            <label>Gaji</label>
            <input type="number" step="0.01" name="gaji" class="form-control" value="{{ old('gaji', $karyawan->gaji) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
