{{-- resources/views/ruangan/_form.blade.php --}}
<div class="mb-3">
    <label class="form-label fw-medium">Kode Ruangan <span class="text-danger">*</span></label>
    <input type="text" name="kode_ruangan" class="form-control @error('kode_ruangan') is-invalid @enderror"
        value="{{ old('kode_ruangan', $ruangan->kode_ruangan ?? '') }}" placeholder="Contoh: LAB-01, SRV-01">
    @error('kode_ruangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label fw-medium">Nama Ruangan <span class="text-danger">*</span></label>
    <input type="text" name="nama_ruangan" class="form-control @error('nama_ruangan') is-invalid @enderror"
        value="{{ old('nama_ruangan', $ruangan->nama_ruangan ?? '') }}" placeholder="Contoh: Laboratorium CBT 1">
    @error('nama_ruangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label fw-medium">Lantai</label>
        <input type="number" name="lantai" class="form-control @error('lantai') is-invalid @enderror"
            value="{{ old('lantai', $ruangan->lantai ?? '') }}" min="1" placeholder="1">
        @error('lantai')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label fw-medium">Kapasitas (unit komputer)</label>
        <input type="number" name="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror"
            value="{{ old('kapasitas', $ruangan->kapasitas ?? '') }}" min="1" placeholder="30">
        @error('kapasitas')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<div class="mb-3">
    <label class="form-label fw-medium">Keterangan</label>
    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3"
        placeholder="Deskripsi tambahan tentang ruangan ini...">{{ old('keterangan', $ruangan->keterangan ?? '') }}</textarea>
    @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
