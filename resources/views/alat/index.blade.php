@extends('layouts.app')
@section('judul', 'Daftar Alat')

@section('konten')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 m-0">Daftar Alat</h2>
    <a href="{{ route('alat.create') }}" class="btn btn-primary">+ Tambah Alat</a>
  </div>

  <form method="GET" action="{{ route('alat.index') }}" class="row g-2 mb-3">
    <div class="col-sm-6 col-md-4">
      <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Cari nama alat">
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-secondary">Cari</button>
      @if ($q)
        <a href="{{ route('alat.index') }}" class="btn btn-outline-secondary">Reset</a>
      @endif
    </div>
  </form>

  @if (session('sukses'))
    <div class="alert alert-success">{{ session('sukses') }}</div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger">
      @foreach ($errors->all() as $e) <div>{{ $e }}</div> @endforeach
    </div>
  @endif

  <table class="table table-bordered table-striped align-middle">
    <thead class="table-light">
      <tr>
        <th>Kode</th><th>Nama</th><th>Stok</th><th>Kondisi</th><th>Lokasi</th><th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($alat as $a)
        <tr>
          <td>{{ $a->kode }}</td>
          <td>{{ $a->nama }}</td>
          @if ($a->stok == 0)
            <td class="text-danger fw-bold">{{ $a->stok }}</td>
          @else
            <td>{{ $a->stok }}</td>
          @endif
          <td>{{ $a->kondisi }}</td>
          <td>{{ $a->lokasi }}</td>
          <td>
            <a href="{{ route('alat.show', $a) }}" class="btn btn-sm btn-info">Detail</a>
            <a href="{{ route('alat.edit', $a) }}" class="btn btn-sm btn-warning">Ubah</a>
            <form method="POST" action="{{ route('alat.destroy', $a) }}"
                  style="display:inline"
                  onsubmit="return confirm('Hapus alat ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6">
            @if ($q)
              Tidak ada alat dengan nama yang mengandung "{{ $q }}".
            @else
              Belum ada data alat.
            @endif
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>

  {{ $alat->links('pagination::bootstrap-5') }}
@endsection
