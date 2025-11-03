@extends('layouts.pengelolaan')


@section('title', 'Tambah Buku | Library-Hub')

@section('content')
<div class="p-6 bg-white rounded-2xl shadow-sm">
  <h2 class="text-xl font-semibold mb-4">Form Tambah Buku</h2>

  {{-- Form Tambah Buku --}}
  <form action="{{ route('homepage_admin.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-2 gap-4">

      <div>
        <label class="block text-sm font-medium mb-1">ID Buku</label>
        <input type="text" name="id_buku" class="w-full border rounded-lg px-3 py-2" placeholder="Contoh: BK001" required>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">ID Kategori</label>
        <input type="text" name="id_kategori" class="w-full border rounded-lg px-3 py-2" placeholder="Contoh: KT01" required>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Judul Buku</label>
        <input type="text" name="title" class="w-full border rounded-lg px-3 py-2" placeholder="Masukkan judul buku" required>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Penulis</label>
        <input type="text" name="author" class="w-full border rounded-lg px-3 py-2" placeholder="Masukkan nama penulis" required>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">ISBN</label>
        <input type="text" name="isbn" class="w-full border rounded-lg px-3 py-2" placeholder="Masukkan nomor ISBN" required>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Harga</label>
        <input type="number" name="harga" class="w-full border rounded-lg px-3 py-2" placeholder="Rp. 0" required>
      </div>

      <div class="col-span-2">
        <label class="block text-sm font-medium mb-1">Deskripsi</label>
        <textarea name="deskripsi" rows="3" class="w-full border rounded-lg px-3 py-2" placeholder="Masukkan deskripsi buku" required></textarea>
      </div>

      <div class="col-span-2">
        <label class="block text-sm font-medium mb-1">Cover Buku</label>
        <input type="file" name="cover_image" class="w-full border rounded-lg px-3 py-2" accept="image/*" required>
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
