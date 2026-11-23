@extends('layouts.app')
@section('judul', 'Detail Alat')

@section('konten')
  <h2 class="h4 mb-3">Detail Alat</h2>

  <table class="table table-bordered w-auto">
    <tr><th>Kode</th><td>{{ $alat->kode }}</td></tr>
    <tr><th>Nama</th><td>{{ $alat->nama }}</td></tr>
    <tr><th>Stok</th><td>{{ $alat->stok }}</td></tr>
    <tr><th>Kondisi</th><td>{{ $alat->kondisi }}</td></tr>
    <tr><th>Lokasi</th><td>{{ $alat->lokasi ?? '-' }}</td></tr>
  </table>

  <h3 class="h5 mt-4">Riwayat Peminjaman</h3>
  <table class="table table-sm table-bordered w-auto">
    <tr><th>Peminjam</th><th>Jumlah</th><th>Tanggal Pinjam</th><th>Status</th></tr>
    @forelse ($alat->peminjaman as $p)
      <tr>
        <td>{{ $p->nama_peminjam }}</td>
        <td>{{ $p->jumlah }}</td>
        <td>{{ $p->tanggal_pinjam->format('d-m-Y') }}</td>
        <td>{{ $p->tanggal_kembali ? 'Sudah kembali' : 'Sedang dipinjam' }}</td>
      </tr>
    @empty
      <tr><td colspan="4">Belum pernah dipinjam.</td></tr>
    @endforelse
  </table>

  <div class="mt-3">
    <a href="{{ route('alat.edit', $alat) }}" class="btn btn-warning">Ubah</a>
    <a href="{{ route('alat.index') }}" class="btn btn-outline-secondary">Kembali ke daftar</a>
  </div>
@endsection
