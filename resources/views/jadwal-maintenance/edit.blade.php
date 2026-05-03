@extends('layouts.app')
@section('title', 'Edit Jadwal Maintenance')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold mb-0">Edit Jadwal Maintenance</h4>
                <a href="{{ route('jadwal-maintenance.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i>Kembali</a>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('jadwal-maintenance.update', $jadwalMaintenance) }}">
                        @csrf @method('PUT')
                        @include('jadwal-maintenance._form')
                        <button type="submit" class="btn btn-warning w-100 mt-2"><i class="fas fa-save me-1"></i>Perbarui Jadwal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
