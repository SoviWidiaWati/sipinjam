@extends('layouts.app')
@section('judul', 'Catat Peminjaman')

@section('konten')
  <h2 class="h4 mb-3">Catat Peminjaman</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('peminjaman.store') }}" style="max-width:480px">
    @csrf
    <div class="mb-3">
      <label class="form-label">Alat</label>
      <select name="alat_id" class="form-select">
        <option value="">-- Pilih alat --</option>
        @foreach ($alat as $a)
          <option value="{{ $a->id }}" {{ old('alat_id') == $a->id ? 'selected' : '' }}>
            {{ $a->kode }} - {{ $a->nama }}, stok {{ $a->stok }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Nama peminjam</label>
      <input name="nama_peminjam" class="form-control" value="{{ old('nama_peminjam') }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Jumlah</label>
      <input name="jumlah" type="number" class="form-control" value="{{ old('jumlah', 1) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Tanggal pinjam</label>
      <input name="tanggal_pinjam" type="date" class="form-control"
             value="{{ old('tanggal_pinjam', now()->toDateString()) }}">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary">Batal</a>
  </form>
@endsection
