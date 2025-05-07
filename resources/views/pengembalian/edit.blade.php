@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pengembalian</h2>

    @if ($errors->any())
        <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <form action="{{ route('pengembalian.update', $pengembalian->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Peminjaman</label>
            <input type="text" value="{{ $pengembalian->peminjaman->id ?? '-' }}" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label>Tanggal Pengembalian</label>
            <input type="date" name="tanggal_pengembalian" value="{{ $pengembalian->tanggal_pengembalian }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kondisi Barang</label>
            <select name="kondisi_barang" class="form-control" required>
                <option value="baik" {{ $pengembalian->kondisi_barang == 'baik' ? 'selected' : '' }}>Baik</option>
                <option value="rusak" {{ $pengembalian->kondisi_barang == 'rusak' ? 'selected' : '' }}>Rusak</option>
                <option value="hilang" {{ $pengembalian->kondisi_barang == 'hilang' ? 'selected' : '' }}>Hilang</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ $pengembalian->keterangan }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pengembalian.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
