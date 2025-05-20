@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Data Karyawan</h1>
    <div class="mb-3">
        <a href="{{ route('karyawan.create') }}" class="btn btn-primary">Tambah Karyawan</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>Posisi</th>
                <th>Gaji</th>
                <th>Tanggal Masuk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($karyawans as $karyawan)
                <tr>
                    <td>{{ $karyawan->nama }}</td>
                    <td>{{ $karyawan->alamat }}</td>
                    <td>{{ $karyawan->tanggal_lahir }}</td>
                    <td>{{ $karyawan->posisi }}</td>
                    <td>{{ number_format($karyawan->gaji, 0, ',', '.') }}</td>
                    <td>{{ $karyawan->tanggal_masuk }}</td>
                    <td>
                        <a href="{{ route('karyawan.edit', $karyawan->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection