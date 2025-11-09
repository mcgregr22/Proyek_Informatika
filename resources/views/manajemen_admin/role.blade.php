@extends('layouts.manajemen_admin')

@section('title', 'Ubah Role | Library-Hub')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h3 class="fw-bold mb-0">
    <i class="bi bi-person-gear me-2 text-primary"></i> Ubah Role Pengguna
  </h3>
</div>

{{-- ✅ Alert Section --}}
@if (session('warning'))
  <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
    <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
    <div>{{ session('warning') }}</div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if (session('success'))
  <div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
    <div>{{ session('success') }}</div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="card border-0 shadow-sm rounded-4">
  <div class="card-body">
    <h5 class="fw-semibold mb-3 text-secondary">
      <i class="bi bi-person-circle me-2 text-primary"></i> {{ $user->name }}
    </h5>

    <form id="roleForm" action="{{ route('manajemen_admin.role.update', $user->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-4">
        <label class="form-label fw-semibold">Pilih Role</label>
        <select name="role" id="roleSelect" class="form-select shadow-sm">
          <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
          <option value="pengguna" {{ $user->role == 'pengguna' ? 'selected' : '' }}>User</option>
        </select>
      </div>

      <div class="d-flex justify-content-between">
        <a href="{{ route('manajemen_admin') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
          <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>

        <button id="saveBtn" class="btn btn-primary px-4 d-flex align-items-center gap-2" type="submit">
          <i class="bi bi-save2"></i> Simpan Perubahan
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("roleForm");
  const roleSelect = document.getElementById("roleSelect");
  const currentUserId = "{{ auth()->id() }}";
  const targetUserId = "{{ $user->id }}";

  if (!form) return;

  form.addEventListener("submit", function (e) {
    const selectedRole = roleSelect.value;

    // ✅ Hanya tampilkan konfirmasi jika admin ubah dirinya sendiri ke "pengguna"
    if (selectedRole === "pengguna" && currentUserId === targetUserId) {
      e.preventDefault(); // hentikan submit

      Swal.fire({
        title: "Konfirmasi Perubahan Role",
        html: "Anda akan mengubah <b>akun admin Anda sendiri</b> menjadi pengguna.<br><br>Jika dilanjutkan, Anda akan <b>otomatis logout</b>.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, ubah & logout",
        cancelButtonText: "Batal",
        confirmButtonColor: "#d33",
        cancelButtonColor: "#6c757d",
        reverseButtons: true,
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit(); // baru submit ke controller jika disetujui
        }
      });
    }
  });
});
</script>
@endpush
