@extends('layouts.app')
@section('judul', 'Tambah Alat')

@section('konten')
  <h2 class="h4 mb-3">Tambah Alat</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('alat.store') }}" style="max-width:480px">
    @csrf
    <div class="mb-3">
      <label class="form-label">Kode</label>
      <input name="kode" class="form-control" value="{{ old('kode') }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input name="nama" class="form-control" value="{{ old('nama') }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Stok</label>
      <input name="stok" type="number" class="form-control" value="{{ old('stok') }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Kondisi</label>
      <select name="kondisi" class="form-select">
        <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>baik</option>
        <option value="rusak ringan" {{ old('kondisi') == 'rusak ringan' ? 'selected' : '' }}>rusak ringan</option>
        <option value="rusak berat" {{ old('kondisi') == 'rusak berat' ? 'selected' : '' }}>rusak berat</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Lokasi</label>
      <input name="lokasi" class="form-control" value="{{ old('lokasi') }}">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('alat.index') }}" class="btn btn-outline-secondary">Batal</a>
  </form>
@endsection
