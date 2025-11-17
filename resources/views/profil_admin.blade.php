@extends('layouts.profil_admin')

@section('title', 'Profil Admin - ' . $admin->name)

@push('styles')
{{-- Bisa tambah style khusus di sini kalau perlu --}}
@endpush

@section('content')

<div class="max-w-3xl mx-auto mt-10">

  {{-- Kartu Profil --}}
  <div class="bg-white rounded-2xl shadow-md p-10 border border-zinc-200">

    {{-- Header --}}
    <div class="text-center mb-8">
      <img 
        src="https://cdn-icons-png.flaticon.com/512/149/149071.png" 
        class="w-28 h-28 mx-auto rounded-full border-4 border-indigo-600"
      >
      <h2 class="mt-4 text-2xl font-semibold text-indigo-700">{{ $admin->name }}</h2>
    </div>

    {{-- Form Profil --}}
    <h3 class="text-lg font-semibold mb-3 text-zinc-700">Profil</h3>

    <form action="{{ route('profil_admin.update') }}" method="POST">
      @csrf
      @method('PUT')

      <div class="space-y-5">

        <div>
          <label class="block font-medium text-zinc-700 mb-1">Nama Lengkap</label>
          <input
            type="text"
            name="name"
            value="{{ $admin->name }}"
            class="w-full border border-zinc-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:outline-none"
          >
        </div>

        <div>
          <label class="block font-medium text-zinc-700 mb-1">Email</label>
          <input
            type="email"
            name="email"
            value="{{ $admin->email }}"
            class="w-full border border-zinc-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:outline-none"
          >
        </div>

        <div>
          <label class="block font-medium text-zinc-700 mb-1">Nomor Telepon</label>
          <input
            type="text"
            name="phone"
            value="{{ $admin->phone ?? '' }}"
            class="w-full border border-zinc-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:outline-none"
          >
        </div>

        <div>
          <label class="block font-medium text-zinc-700 mb-1">Role</label>
          <input
            type="text"
            name="role"
            value="{{ $admin->role }}"
            class="w-full border border-zinc-300 rounded-lg px-4 py-2 bg-zinc-100"
            readonly
          >
        </div>

      </div>

      <hr class="my-6 border-zinc-300">

      {{-- Bagian Akun --}}
      <h3 class="text-lg font-semibold mb-3 text-zinc-700">Akun</h3>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div>
          <label class="block font-medium text-zinc-700 mb-1">Email</label>
          <input
            type="email"
            name="email_confirm"
            value="{{ $admin->email }}"
            class="w-full border border-zinc-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:outline-none"
          >
        </div>

        <div>
          <label class="block font-medium text-zinc-700 mb-1">Password</label>

          <div class="relative">
            <input
              id="passwordInput"
              type="password"
              name="password"
              placeholder="Kosongkan jika tidak ingin mengubah"
              class="w-full border border-zinc-300 rounded-lg px-4 py-2 pr-12 focus:ring-indigo-500 focus:outline-none"
            >

            <button 
              type="button" 
              id="togglePassword"
              class="absolute top-1/2 right-3 -translate-y-1/2 text-zinc-500"
            >
              <i id="toggleIcon" class="bi bi-eye text-lg"></i>
            </button>
          </div>
        </div>

      </div>

      {{-- Tombol Simpan --}}
      <div class="text-center mt-8">
        <button 
          type="submit" 
          class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold shadow-sm"
        >
          Simpan
        </button>
      </div>

    </form>

  </div>
</div>

@endsection

@push('scripts')
<script>
  document.getElementById("togglePassword").addEventListener("click", function() {
    const passwordInput = document.getElementById("passwordInput");
    const toggleIcon = document.getElementById("toggleIcon");

    passwordInput.type = passwordInput.type === "password" ? "text" : "password";

    toggleIcon.classList.toggle("bi-eye");
    toggleIcon.classList.toggle("bi-eye-slash");
  });
</script>
@endpush
