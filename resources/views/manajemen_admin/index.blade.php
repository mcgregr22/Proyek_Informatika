@extends('layouts.manajemen_admin')

@section('title', 'Manajemen Akun & Role | Library-Hub')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h3 class="fw-bold m-0">Manajemen Akun & Role</h3>
</div>

@if (session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="bg-light">
          <tr class="text-center fw-semibold">
            <th style="width:5%">ID</th>
            <th style="width:20%">Nama</th>
            <th style="width:25%">Email</th>
            <th style="width:15%">Telepon</th>
            <th style="width:10%">Role</th>
            <th style="width:25%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr class="align-middle">
            <td class="text-center">{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td class="text-center">{{ $user->phone ?? '-' }}</td>
            <td class="text-center">
              <span class="badge 
                @if($user->role === 'admin') bg-success 
                @elseif($user->role === 'pengguna') bg-primary 
                @else bg-secondary @endif
                px-3 py-2 rounded-pill text-capitalize shadow-sm">
                {{ $user->role }}
              </span>
            </td>
            <td class="text-center">
              <div class="btn-group" role="group" aria-label="Aksi">
                <a href="{{ route('manajemen_admin.edit', $user->id) }}" 
                   class="btn btn-success btn-sm px-3 d-flex align-items-center gap-1">
                  <i class="bi bi-pencil-square"></i> Edit
                </a>
                <a href="{{ route('manajemen_admin.role', $user->id) }}" 
                   class="btn btn-warning btn-sm px-3 text-white d-flex align-items-center gap-1">
                  <i class="bi bi-person-gear"></i> Role
                </a>
                <form action="{{ route('manajemen_admin.delete', $user->id) }}" 
                      method="POST" class="d-inline" 
                      onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" 
                          class="btn btn-danger btn-sm px-3 d-flex align-items-center gap-1">
                    <i class="bi bi-trash"></i> Hapus
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection

@push('styles')
<style>
  .table-hover tbody tr:hover {
    background-color: #f1f6ff;
    transition: background-color 0.2s ease-in-out;
  }
  .card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .card:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.08);
  }
  .btn-group .btn {
    border-radius: 20px;
    font-weight: 500;
  }
  .btn-group .btn + .btn {
    margin-left: 6px;
  }
</style>
@endpush
