@extends('layouts.manajemen_admin')

@section('title', 'Edit Akun | Library-Hub')

@section('content')
<h3 class="fw-bold mb-4">Edit Akun: {{ $user->name }}</h3>

<div class="card shadow-sm border-0 rounded-3">
  <div class="card-body">
    <form action="{{ route('manajemen_admin.update', $user->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
      </div>

      <div class="mb-3">
        <label class="form-label">Telepon</label>
        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
      </div>

      <div class="mb-3">
        <label class="form-label">Password Baru (Opsional)</label>
        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diganti">
      </div>

      <button class="btn btn-primary px-4" type="submit">Simpan Perubahan</button>
    </form>
  </div>
</div>
@endsection
