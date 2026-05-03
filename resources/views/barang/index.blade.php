@extends('layouts.app')

@section('content')
<div class="container">
<a href="{{ route('barang.create') }}" class="btn btn-success mb-3">Tambah Barang</a>

    <h2 class="mb-4">Daftar Barang</h2>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Spesifikasi</th>
                <th>Jumlah</th>
                <th>Kondisi</th>
                <th>Lokasi</th>
                <th>Kepemilikan</th>
                <th>Tanggal Masuk</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->kategori->nama_kategori ?? 'Tidak Ada' }}</td>
                <td>{{ $item->spesifikasi }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ ucfirst($item->kondisi) }}</td>
                <td>{{ $item->lokasi }}</td>
                <td>{{ $item->divisi->nama_divisi ?? 'Tidak Ada' }}</td>
                <td>{{ $item->tanggal_masuk }}</td>
                <td>
                    @if($item->foto)
                        <img src="{{ asset($item->foto) }}" alt="Foto" width="80">
                    @else
                        <small>Tidak ada foto</small>
                    @endif
                </td>
                <td>
                    <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('barang.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
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
