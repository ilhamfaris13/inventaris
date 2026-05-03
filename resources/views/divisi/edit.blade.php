@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Divisi</h2>

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
    <form action="{{ route('divisi.update', $divisi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_divisi" class="form-label">ID Divisi</label>
            <input type="text" name="id_divisi" class="form-control" value="{{ $divisi->id_divisi }}" required>
        </div>

        <div class="mb-3">
            <label for="kode_divisi" class="form-label">Kode Divisi</label>
            <input type="text" name="kode_divisi" class="form-control" value="{{ $divisi->kode_divisi }}" required>
        </div>

        <div class="mb-3">
            <label for="nama_divisi" class="form-label">Nama Divisi</label>
            <input type="text" name="nama_divisi" class="form-control" value="{{ $divisi->nama_divisi }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $divisi->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label for="created_at" class="form-label">Created At</label>
            <input type="datetime-local" name="created_at" class="form-control" value="{{ $divisi->created_at->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label for="updated_at" class="form-label">Updated At</label>
            <input type="datetime-local" name="updated_at" class="form-control" value="{{ $divisi->updated_at->format('Y-m-d\TH:i') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('divisi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection