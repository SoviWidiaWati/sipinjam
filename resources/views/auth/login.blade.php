@extends('layouts.app')
@section('judul', 'Login')

@section('konten')
  <div class="card mx-auto" style="max-width:420px">
    <div class="card-body">
      <h2 class="h4 mb-3">Login</h2>

      @if ($errors->any())
        <div class="alert alert-danger">
          @foreach ($errors->all() as $e) <div>{{ $e }}</div> @endforeach
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="text" name="email" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control">
        </div>
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" name="ingat" id="ingat">
          <label class="form-check-label" for="ingat">Ingat saya</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">Masuk</button>
      </form>
    </div>
  </div>
@endsection
