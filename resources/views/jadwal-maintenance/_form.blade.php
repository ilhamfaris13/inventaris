{{-- resources/views/jadwal-maintenance/_form.blade.php --}}
<div class="mb-3">
    <label class="form-label fw-medium">Barang <span class="text-danger">*</span></label>
    <select name="barang_id" class="form-select @error('barang_id') is-invalid @enderror">
        <option value="">-- Pilih Barang --</option>
        @foreach($barangs as $b)
            <option value="{{ $b->id }}" @selected(old('barang_id', $jadwalMaintenance->barang_id ?? '') == $b->id)>
                [{{ $b->kode_barang }}] {{ $b->nama_barang }}
            </option>
        @endforeach
    </select>
    @error('barang_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label fw-medium">Teknisi</label>
    <select name="teknisi_id" class="form-select @error('teknisi_id') is-invalid @enderror">
        <option value="">-- Belum ditentukan --</option>
        @foreach($teknisis as $t)
            <option value="{{ $t->id }}" @selected(old('teknisi_id', $jadwalMaintenance->teknisi_id ?? '') == $t->id)>
                {{ $t->nama }}
            </option>
        @endforeach
    </select>
    @error('teknisi_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label fw-medium">Tanggal Jadwal <span class="text-danger">*</span></label>
        <input type="date" name="jadwal_tanggal" class="form-control @error('jadwal_tanggal') is-invalid @enderror"
            value="{{ old('jadwal_tanggal', isset($jadwalMaintenance) ? $jadwalMaintenance->jadwal_tanggal?->format('Y-m-d') : '') }}">
        @error('jadwal_tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label fw-medium">Frekuensi <span class="text-danger">*</span></label>
        <select name="frekuensi" class="form-select @error('frekuensi') is-invalid @enderror">
            @foreach(['sekali' => 'Sekali', 'mingguan' => 'Mingguan', 'bulanan' => 'Bulanan', 'tahunan' => 'Tahunan'] as $val => $label)
                <option value="{{ $val }}" @selected(old('frekuensi', $jadwalMaintenance->frekuensi ?? 'sekali') === $val)>{{ $label }}</option>
            @endforeach
        </select>
        @error('frekuensi')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<div class="mb-3">
    <label class="form-label fw-medium">Keterangan</label>
    <textarea name="keterangan" class="form-control" rows="3" placeholder="Deskripsi pekerjaan maintenance...">{{ old('keterangan', $jadwalMaintenance->keterangan ?? '') }}</textarea>
</div>

@isset($jadwalMaintenance->id)
<div class="mb-3">
    <label class="form-label fw-medium">Status</label>
    <select name="status" class="form-select">
        <option value="terjadwal"  @selected($jadwalMaintenance->status === 'terjadwal')>Terjadwal</option>
        <option value="selesai"    @selected($jadwalMaintenance->status === 'selesai')>Selesai</option>
        <option value="dibatalkan" @selected($jadwalMaintenance->status === 'dibatalkan')>Dibatalkan</option>
    </select>
</div>
@endisset
