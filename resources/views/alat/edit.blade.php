@extends('layouts.app')
@section('judul', 'Ubah Alat')

@section('konten')
  <h2 class="h4 mb-3">Ubah Alat</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('alat.update', $alat) }}" style="max-width:480px">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Kode</label>
      <input name="kode" class="form-control" value="{{ old('kode', $alat->kode) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input name="nama" class="form-control" value="{{ old('nama', $alat->nama) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Stok</label>
      <input name="stok" type="number" class="form-control" value="{{ old('stok', $alat->stok) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Kondisi</label>
      <select name="kondisi" class="form-select">
        <option value="baik" {{ old('kondisi', $alat->kondisi) == 'baik' ? 'selected' : '' }}>baik</option>
        <option value="rusak ringan" {{ old('kondisi', $alat->kondisi) == 'rusak ringan' ? 'selected' : '' }}>rusak ringan</option>
        <option value="rusak berat" {{ old('kondisi', $alat->kondisi) == 'rusak berat' ? 'selected' : '' }}>rusak berat</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Lokasi</label>
      <input name="lokasi" class="form-control" value="{{ old('lokasi', $alat->lokasi) }}">
    </div>
    <button type="submit" class="btn btn-primary">Perbarui</button>
    <a href="{{ route('alat.index') }}" class="btn btn-outline-secondary">Batal</a>
  </form>
@endsection
