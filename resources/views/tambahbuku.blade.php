@extends('layouts.pengelolaan')

@section('title', 'Tambah Buku | Library-Hub')

@section('content')
<div class="p-6 bg-white rounded-2xl shadow-sm">
  <h2 class="text-xl font-semibold mb-4">Form Tambah Buku</h2>

  {{-- Flash sukses --}}
  @if (session('success'))
    <div class="rounded-xl border border-green-200 bg-green-50 text-green-700 p-3 mb-4">
      {{ session('success') }}
    </div>
  @endif

  <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      {{-- ID Buku (opsional – hapus kalau PK auto-increment) --}}
      <div>
        <label class="block text-sm font-medium mb-1">ID Buku (opsional)</label>
        <input type="text" name="id_buku"
               class="w-full border rounded-lg px-3 py-2 @error('id_buku') border-red-400 @enderror"
               placeholder="Contoh: BK001" value="{{ old('id_buku') }}">
        @error('id_buku') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">ID Kategori</label>
        <input type="number" name="id_kategori"
               class="w-full border rounded-lg px-3 py-2 @error('id_kategori') border-red-400 @enderror"
               placeholder="Contoh: 1" value="{{ old('id_kategori') }}" required>
        @error('id_kategori') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Judul Buku</label>
        <input type="text" name="title"
               class="w-full border rounded-lg px-3 py-2 @error('title') border-red-400 @enderror"
               placeholder="Masukkan judul buku" value="{{ old('title') }}" required>
        @error('title') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Penulis</label>
        <input type="text" name="author"
               class="w-full border rounded-lg px-3 py-2 @error('author') border-red-400 @enderror"
               placeholder="Masukkan nama penulis" value="{{ old('author') }}" required>
        @error('author') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">ISBN</label>
        <input type="text" name="isbn"
               class="w-full border rounded-lg px-3 py-2 @error('isbn') border-red-400 @enderror"
               placeholder="Masukkan nomor ISBN" value="{{ old('isbn') }}" required>
        @error('isbn') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Harga</label>
        <input type="number" name="harga" min="0" step="1"
               class="w-full border rounded-lg px-3 py-2 @error('harga') border-red-400 @enderror"
               placeholder="Rp. 0" value="{{ old('harga') }}" required>
        @error('harga') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Deskripsi</label>
        <textarea name="deskripsi" rows="4"
                  class="w-full border rounded-lg px-3 py-2 @error('deskripsi') border-red-400 @enderror"
                  placeholder="Masukkan deskripsi buku" required>{{ old('deskripsi') }}</textarea>
        @error('deskripsi') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Cover Buku (opsional)</label>
        <input type="file" name="cover_image"
               class="block w-full border rounded-lg px-3 py-2 bg-white @error('cover_image') border-red-400 @enderror"
               accept="image/*">
        @error('cover_image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>
    </div>

    <div class="mt-6">
      <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
        Tambah Buku
      </button>
    </div>
  </form>
</div>
@endsection