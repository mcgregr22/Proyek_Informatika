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

  <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

      {{-- ====================== --}}
      {{-- KATEGORI BUKU --}}
      {{-- ====================== --}}
      <div>
        <label class="block text-sm font-medium mb-1">Kategori Buku</label>

        <div class="flex gap-3">
          <select name="kategori"
            class="w-full border rounded-lg px-3 h-[42px] @error('id_kategori') border-red-400 @enderror"
            required>

            <option value="">-- Pilih Kategori --</option>

            @foreach ($kategori as $k)
            <option value="{{ $k->nama_kategori }}">
              {{ $k->nama_kategori }}
            </option>
            @endforeach

          </select>

          <!-- Tombol Tambah Kategori -->
          <button type="button"
            onclick="document.getElementById('modalKategori').classList.remove('hidden')"
            class="px-4 h-[42px] bg-blue-600 text-white rounded-lg flex items-center justify-center text-sm">
            +Kategori
          </button>
        </div>

        @error('id_kategori')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Judul --}}
      <div>
        <label class="block text-sm font-medium mb-1">Judul Buku</label>
        <input type="text" name="title"
          class="w-full border rounded-lg px-3 h-[42px] @error('title') border-red-400 @enderror"
          placeholder="Masukkan judul buku" value="{{ old('title') }}" required>
        @error('title') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Penulis --}}
      <div>
        <label class="block text-sm font-medium mb-1">Penulis</label>
        <input type="text" name="author"
          class="w-full border rounded-lg px-3 h-[42px] @error('author') border-red-400 @enderror"
          placeholder="Masukkan nama penulis" value="{{ old('author') }}" required>
        @error('author') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- ISBN --}}
      <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">ISBN</label>
        <input type="text" name="isbn"
          class="w-full border rounded-lg px-3 h-[42px] @error('isbn') border-red-400 @enderror"
          placeholder="Masukkan nomor ISBN" value="{{ old('isbn') }}" required>
        @error('isbn') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Tanggal Rilis --}}
      <div>
        <label class="block text-sm font-medium mb-1">Tanggal Rilis</label>
        <input type="date" name="tanggal_rilis"
          class="w-full border rounded-lg px-3 h-[42px] @error('tanggal_rilis') border-red-400 @enderror"
          value="{{ old('tanggal_rilis') }}" required>
        @error('tanggal_rilis') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Bahasa --}}
      <div>
        <label class="block text-sm font-medium mb-1">Bahasa</label>
        <input type="text" name="bahasa"
          class="w-full border rounded-lg px-3 h-[42px] @error('bahasa') border-red-400 @enderror"
          placeholder="Masukkan Bahasa" value="{{ old('bahasa') }}">
        @error('bahasa') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Penerbit --}}
      <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Penerbit</label>
        <input type="text" name="penerbit"
          class="w-full border rounded-lg px-3 h-[42px] @error('penerbit') border-red-400 @enderror"
          placeholder="Masukkan nama penerbit" value="{{ old('penerbit') }}" required>
        @error('penerbit') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Listing Type --}}
      <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Listing Type</label>

        <div class="flex gap-4 mt-1">

          <label class="flex items-center gap-2 border rounded-lg px-4 h-[42px] cursor-pointer hover:bg-zinc-50">
            <input type="checkbox" name="listing_type[]" value="exchange"
              {{ (is_array(old('listing_type')) && in_array('exchange', old('listing_type'))) ? 'checked' : '' }}>
            <span class="text-sm">Exchange</span>
          </label>

          <label class="flex items-center gap-2 border rounded-lg px-4 h-[42px] cursor-pointer hover:bg-zinc-50">
            <input type="checkbox" name="listing_type[]" value="sell"
              {{ (is_array(old('listing_type')) && in_array('sell', old('listing_type'))) ? 'checked' : '' }}>
            <span class="text-sm">Sell</span>
          </label>

        </div>
        @error('listing_type') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Harga --}}
      <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Harga</label>
        <input type="number" min="0" step="1" name="harga"
          class="w-full border rounded-lg px-3 h-[42px] @error('harga') border-red-400 @enderror"
          placeholder="Masukkan harga buku (Rp)" value="{{ old('harga') }}">
        <p class="text-gray-500 text-xs mt-1">Isi harga meskipun Exchange agar tetap bisa dijual.</p>
        @error('harga') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Kondisi --}}
      <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Kondisi</label>
        <select name="kondisi"
          class="w-full border rounded-lg px-3 h-[42px] @error('kondisi') border-red-400 @enderror"
          required>
          <option value="Baru" {{ old('kondisi') == 'Baru' ? 'selected' : '' }}>Baru</option>
          <!-- <option value="Bekas Layak" {{ old('kondisi') == 'Bekas Layak' ? 'selected' : '' }}>Bekas Layak</option> -->
          <option value="Bekas" {{ old('kondisi') == 'Bekas' ? 'selected' : '' }}>Bekas</option>
        </select>
        @error('kondisi') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Deskripsi --}}
      <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Deskripsi</label>
        <textarea name="deskripsi" rows="4"
          class="w-full border rounded-lg px-3 py-2 @error('deskripsi') border-red-400 @enderror"
          placeholder="Masukkan deskripsi buku" required>{{ old('deskripsi') }}</textarea>
        @error('deskripsi') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Cover Buku --}}
      <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Cover Buku (opsional)</label>
        <input type="file" name="cover_image"
          class="block w-full border rounded-lg px-3 h-[42px] bg-white @error('cover_image') border-red-400 @enderror"
          accept="image/*">
        @error('cover_image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

    </div>

    {{-- Tombol Submit --}}
    <div class="mt-6">
      <button type="submit"
        class="px-5 h-[42px] bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
        Tambah Buku
      </button>
    </div>

  </form>
</div>

{{-- ============================== --}}
{{-- MODAL TAMBAH KATEGORI --}}
{{-- ============================== --}}
<div id="modalKategori"
  class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

  <div class="bg-white p-6 rounded-xl w-80 shadow-lg">
    <h3 class="text-lg font-semibold mb-3">Tambah Kategori Baru</h3>

    <form action="{{ route('kategori.store') }}" method="POST">
      @csrf

      <input type="text" name="nama_kategori"
        class="w-full border rounded-lg px-3 h-[42px] mb-3"
        placeholder="Nama kategori..." required>

      <div class="flex justify-end gap-2">
        <button type="button"
          onclick="document.getElementById('modalKategori').classList.add('hidden')"
          class="px-4 h-[42px] bg-gray-400 text-white rounded-lg">
          Batal
        </button>

        <button type="submit"
          class="px-4 h-[42px] bg-blue-600 text-white rounded-lg">
          Simpan
        </button>
      </div>
    </form>
  </div>

</div>
@endsection