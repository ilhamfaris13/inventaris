{{-- resources/views/ruangan/create.blade.php --}}
@extends('layouts.app')
@section('title', 'Tambah Ruangan')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold mb-0">Tambah Ruangan</h4>
                <a href="{{ route('ruangan.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i>Kembali</a>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('ruangan.store') }}">
                        @csrf
                        @include('ruangan._form')
                        <button type="submit" class="btn btn-primary w-100 mt-2">
                            <i class="fas fa-save me-1"></i> Simpan Ruangan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
