@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Pengembalian</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pengembalian.create') }}" class="btn btn-primary mb-3">Tambah Pengembalian</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Kondisi Barang</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengembalian as $item)
            <tr>
                <td>{{ $item->peminjaman->id ?? '-' }}</td>
                <td>{{ $item->tanggal_pengembalian }}</td>
                <td>{{ ucfirst($item->kondisi_barang) }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>
                    <a href="{{ route('pengembalian.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('pengembalian.destroy', $item->id) }}" method="POST"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data pengembalian</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection