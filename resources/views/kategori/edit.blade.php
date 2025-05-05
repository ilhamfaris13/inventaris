@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Divisi</h2>

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

    <form action="{{ route('divisi.update', $divisi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="text" name="id" class="form-control" value="{{ $divisi->id }}" required readonly>
        </div>

        <div class="mb-3">
            <label for="kode_divisi" class="form-label">Kode Divisi</label>
            <input type="text" name="kode_divisi" class="form-control" value="{{ $divisi->kode_divisi }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('divisi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
