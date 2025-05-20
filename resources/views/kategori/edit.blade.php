@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Kategori</h2>

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

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="text" name="id" class="form-control" value="{{ $kategori->id }}" readonly>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kategori</label>
            <select name="nama" class="form-control" required>
    <option value="">Pilih Kategori</option>
    <option value="Makanan" {{ $kategori->nama == 'Makanan' ? 'selected' : '' }}>Makanan</option>
    <option value="Minuman" {{ $kategori->nama == 'Minuman' ? 'selected' : '' }}>Minuman</option>
    <option value="Barang" {{ $kategori->nama == 'Barang' ? 'selected' : '' }}>Barang</option>
</select>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required>{{ $kategori->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label for="created_at" class="form-label">created_at</label>
            <input type="text" name="created_at" class="form-control" value="{{ $kategori->created_at }}" readonly>
        </div>

        <div class="mb-3">
            <label for="updated_at" class="form-label">updated_at</label>
            <input type="text" name="updated_at" class="form-control" value="{{ $kategori->updated_at }}" readonly>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('divisi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
