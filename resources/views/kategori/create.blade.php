@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Kategori</h2>

    <form action="{{ route('kategori.store') }}" method="POST">
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
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input name="nama_kategori" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

       

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
