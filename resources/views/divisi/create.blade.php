@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Divisi</h2>

    <form action="{{ route('divisi.store') }}" method="POST">
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
            <label for="kode_divisi" class="form-label">Kode Divisi</label>
            <input type="text" name="kode_divisi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nama_divisi" class="form-label">Nama Divisi</label>
            <input type="text" name="nama_divisi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('divisi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection