@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Scan Barang</h3>

    <form action="{{ route('barang.scan.result') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kode_barang" class="form-label">Scan Barcode atau Masukkan Kode Barang</label>
            <input type="text" name="kode_barang" id="kode_barang" class="form-control" autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Cari Barang</button>
    </form>

    <hr>

    @isset($barang)
        @if ($barang)
        <div class="card mt-4">
            <div class="card-header">
                Detail Barang
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                <p class="card-text"><strong>Kode:</strong> {{ $barang->kode_barang }}</p>
                <p class="card-text"><strong>Spesifikasi:</strong> {{ $barang->spesifikasi }}</p>
                <p class="card-text"><strong>Jumlah:</strong> {{ $barang->jumlah }}</p>
                <p class="card-text"><strong>Kondisi:</strong> {{ ucfirst($barang->kondisi) }}</p>
                <p class="card-text"><strong>Lokasi:</strong> {{ $barang->lokasi }}</p>
                @if($barang->foto)
                    <img src="{{ asset($barang->foto) }}" alt="Foto Barang" class="img-fluid" width="200">
                @endif

                <div class="mt-3">
                    <a href="{{ route('peminjaman.create', ['barang_id' => $barang->id]) }}" class="btn btn-success">Barang Pinjam</a>
                    <a href="{{ route('pengembalian.create', ['barang_id' => $barang->id]) }}" class="btn btn-warning">Barang Kembali</a>
                </div>
            </div>
        </div>
        @else
            <div class="alert alert-danger mt-4">Barang tidak ditemukan.</div>
        @endif
    @endisset
</div>
<script>
    document.getElementById('kode_barang').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            this.form.submit();
        }
    });
</script>
@endsection
