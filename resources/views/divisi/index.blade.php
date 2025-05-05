@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Divisi</h2>

    <a href="{{ route('divisi.create') }}" class="btn btn-primary mb-3">Tambah Divisi</a>

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
    

    <table class="table table-bordered">
    <thead>
        <tr>
            <th style="background-color: rgb(205, 212, 219);">No</th>
            <th style="background-color: rgb(205, 212, 219);">Kode Divisi</th>
            <th style="background-color: rgb(205, 212, 219);">Nama Divisi</th>
            <th style="background-color: rgb(205, 212, 219);">Deskripsi</th>
            <th style="background-color: rgb(205, 212, 219);">Created At</th>
            <th style="background-color: rgb(205, 212, 219);">Updated At</th>
            <th style="background-color: rgb(205, 212, 219);">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($divisi as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->kode_divisi }}</td>
                <td>{{ $item->nama_divisi }}</td>
                <td>{{ $item->deskripsi ?? '-' }}</td>
                <td>{{ $item->created_at ? $item->created_at->format('Y-m-d H:i:s') : '-' }}</td>
                <td>{{ $item->updated_at ? $item->updated_at->format('Y-m-d H:i:s') : '-' }}</td>
                <td>
                    <a href="{{ route('divisi.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('divisi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus divisi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection