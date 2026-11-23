@extends('layouts.app')
@section('judul', 'Riwayat Peminjaman')

@section('konten')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 m-0">Riwayat Peminjaman</h2>
    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">+ Catat Peminjaman</a>
  </div>

  @if (session('sukses'))
    <div class="alert alert-success">{{ session('sukses') }}</div>
  @endif

  <table class="table table-bordered table-striped align-middle">
    <thead class="table-light">
      <tr>
        <th>Alat</th><th>Peminjam</th><th>Jumlah</th>
        <th>Tanggal Pinjam</th><th>Tanggal Kembali</th><th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($peminjaman as $p)
        <tr>
          <td>{{ $p->alat->kode }} - {{ $p->alat->nama }}</td>
          <td>{{ $p->nama_peminjam }}</td>
          <td>{{ $p->jumlah }}</td>
          <td>{{ $p->tanggal_pinjam->format('d-m-Y') }}</td>
          <td>{{ $p->tanggal_kembali ? $p->tanggal_kembali->format('d-m-Y') : 'Belum kembali' }}</td>
          <td>
            @if ($p->tanggal_kembali === null)
              <form method="POST" action="{{ route('peminjaman.kembali', $p) }}"
                    style="display:inline"
                    onsubmit="return confirm('Tandai alat sudah dikembalikan?')">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-sm btn-success">Kembalikan</button>
              </form>
            @else
              <span class="badge text-bg-secondary">Selesai</span>
            @endif
          </td>
        </tr>
      @empty
        <tr><td colspan="6">Belum ada catatan peminjaman.</td></tr>
      @endforelse
    </tbody>
  </table>

  {{ $peminjaman->links('pagination::bootstrap-5') }}
@endsection
