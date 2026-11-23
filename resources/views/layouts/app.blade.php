<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('judul', 'Aplikasi Alat')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand navbar-dark bg-dark mb-4">
    <div class="container">
      <span class="navbar-brand">Sistem Peminjaman Alat</span>
      @auth
        <div class="navbar-nav me-auto">
          <a class="nav-link" href="{{ route('alat.index') }}">Alat</a>
          <a class="nav-link" href="{{ route('peminjaman.index') }}">Peminjaman</a>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="d-flex align-items-center gap-2">
          @csrf
          <span class="navbar-text">{{ auth()->user()->name }}</span>
          <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
        </form>
      @endauth
    </div>
  </nav>
  <div class="container">
    @yield('konten')
  </div>
</body>
</html>
