@extends('layouts.pengelolaan')

@section('title', 'Edit Buku | Library-Hub')

@section('content')

<div class="max-w-5xl mx-auto p-8 bg-white rounded-2xl shadow-sm border border-gray-200">

    {{-- TITLE --}}
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Edit Buku</h2>
        <p class="text-gray-500 text-sm">Ubah data buku dengan benar.</p>
    </div>

    {{-- Flash messages --}}
    @if (session('success'))
    <div class="rounded-xl border border-green-200 bg-green-50 text-green-700 p-3 mb-5">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('buku.update', $book->id_buku) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ====================== --}}
        {{-- SECTION 1 : INFORMASI UTAMA --}}
        {{-- ====================== --}}
        <h3 class="text-lg font-semibold text-gray-700 mb-3">Informasi Utama</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Kategori --}}
            <div>
                <label class="block text-sm font-medium mb-1">Kategori Buku</label>
                <div class="flex gap-3">
                    <select name="kategori"
                        class="w-full border rounded-lg px-3 h-[42px] @error('id_kategori') border-red-400 @enderror"
                        required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $k)
                        <option value="{{ $k->nama_kategori }}" {{ $book->kategori == $k->nama_kategori ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>

                    <button type="button"
                        onclick="document.getElementById('modalKategori').classList.remove('hidden')"
                        class="px-4 h-[42px] bg-blue-600 text-white rounded-lg text-sm">
                        Tambah Kategori
                    </button>
                </div>
                @error('id_kategori') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Judul --}}
            <div>
                <label class="block text-sm font-medium mb-1">Judul Buku</label>
                <input type="text" name="title"
                    class="w-full border rounded-lg px-3 h-[42px] @error('title') border-red-400 @enderror"
                    placeholder="Masukkan judul buku" value="{{ $book->title }}" required>
                @error('title') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Penulis --}}
            <div>
                <label class="block text-sm font-medium mb-1">Penulis</label>
                <input type="text" name="author"
                    class="w-full border rounded-lg px-3 h-[42px] @error('author') border-red-400 @enderror"
                    placeholder="Masukkan nama penulis" value="{{ $book->author }}" required>
                @error('author') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- ISBN --}}
            <div>
                <label class="block text-sm font-medium mb-1">ISBN</label>
                <input type="text" name="isbn"
                    class="w-full border rounded-lg px-3 h-[42px] @error('isbn') border-red-400 @enderror"
                    placeholder="Masukkan nomor ISBN" value="{{ $book->isbn }}" required>
                @error('isbn') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Tanggal rilis --}}
            <div>
                <label class="block text-sm font-medium mb-1">Tanggal Rilis</label>
                <input type="date" name="tanggal_rilis"
                    class="w-full border rounded-lg px-3 h-[42px]" value="{{ $book->tanggal_rilis }}" required>
            </div>

            {{-- Bahasa --}}
            <div>
                <label class="block text-sm font-medium mb-1">Bahasa</label>
                <input type="text" name="bahasa"
                    class="w-full border rounded-lg px-3 h-[42px]"
                    placeholder="Indonesia / Inggris / dll" value="{{ $book->bahasa }}">
            </div>

            {{-- Penerbit --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Penerbit</label>
                <input type="text" name="penerbit"
                    class="w-full border rounded-lg px-3 h-[42px]"
                    placeholder="Nama penerbit" value="{{ $book->penerbit }}">
            </div>
        </div>


        {{-- ====================== --}}
        {{-- SECTION 2 : LISTING --}}
        {{-- ====================== --}}
        <h3 class="text-lg font-semibold text-gray-700 mt-8 mb-3">Penawaran Buku</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Listing Type --}}
            <div class="md:col-span-2">
                <!-- <label class="block text-sm font-medium mb-1">Penawaran</label> -->

                <div class="flex gap-4">
                    <label class="flex items-center gap-2 border rounded-lg px-4 h-[42px] cursor-pointer">
                        <input type="checkbox" name="listing_type[]" value="exchange" {{ in_array('exchange', explode(',', $book->listing_type)) ? 'checked' : '' }}>
                        <span class="text-sm">Tukar</span>
                    </label>

                    <label class="flex items-center gap-2 border rounded-lg px-4 h-[42px] cursor-pointer">
                        <input type="checkbox" name="listing_type[]" value="sell" {{ in_array('sell', explode(',', $book->listing_type)) ? 'checked' : '' }}>
                        <span class="text-sm">Jual</span>
                    </label>
                </div>
            </div>

            {{-- Harga --}}
            <div class="md:col-span-2" id="hargaContainer">
                <label class="block text-sm font-medium mb-1">Harga</label>
                <input type="number" min="0" name="harga" id="hargaInput"
                    class="w-full border rounded-lg px-3 h-[42px]"
                    placeholder="Masukkan harga (Rp)" value="{{ $book->harga }}">
                <!-- <p class="text-xs text-gray-500 mt-1">Isi harga meskipun Exchange agar tetap dapat dijual.</p> -->
            </div>

            {{-- Kondisi --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Kondisi Buku</label>
                <select name="kondisi"
                    class="w-full border rounded-lg px-3 h-[42px]" required>
                    <option value="Baru" {{ $book->kondisi == 'Baru' ? 'selected' : '' }}>Baru</option>
                    <option value="Bekas" {{ $book->kondisi == 'Bekas' ? 'selected' : '' }}>Bekas</option>
                </select>
            </div>
        </div>


        {{-- ====================== --}}
        {{-- SECTION 3 : DESKRIPSI --}}
        {{-- ====================== --}}
        <h3 class="text-lg font-semibold text-gray-700 mt-8 mb-3">Deskripsi Buku</h3>

        <textarea name="deskripsi" rows="4"
            class="w-full border rounded-lg px-3 py-2"
            placeholder="Tuliskan deskripsi buku secara lengkap..." required>{{ $book->deskripsi }}</textarea>


        {{-- ====================== --}}
        {{-- SECTION 4 : COVER --}}
        {{-- ====================== --}}
        <h3 class="text-lg font-semibold text-gray-700 mt-8 mb-3">Cover Buku</h3>

        @if($book->cover_image)
        <div class="mb-3">
            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Current Cover" class="w-32 h-32 object-cover rounded-lg border">
        </div>
        @endif

        <input type="file" name="cover_image"
            class="block w-full border rounded-lg px-3 h-[42px] bg-white"
            accept="image/*">


        {{-- SUBMIT BUTTON --}}
        <div class="mt-8 flex justify-between items-center">
            <button type="button" onclick="deleteBook()"
                class="px-6 h-[45px] bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium">
                Hapus Buku
            </button>
            <div class="flex gap-3">
                <a href="{{ route('mycollection.index') }}" class="px-6 h-[45px] bg-gray-500 hover:bg-gray-600 text-white rounded-lg text-sm font-medium flex items-center">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 h-[45px] bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium">
                    Update Buku
                </button>
            </div>
        </div>

    </form>

    {{-- DELETE FORM OUTSIDE UPDATE FORM --}}
    <form id="deleteForm" action="{{ route('buku.destroy', $book->id_buku) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
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

@push('scripts')
<script>
    // Fungsi untuk toggle harga berdasarkan listing type
    function toggleHarga() {
        const exchangeChecked = document.querySelector('input[name="listing_type[]"][value="exchange"]').checked;
        const sellChecked = document.querySelector('input[name="listing_type[]"][value="sell"]').checked;
        const hargaContainer = document.getElementById('hargaContainer');
        const hargaInput = document.getElementById('hargaInput');

        if (sellChecked) {
            hargaContainer.style.display = 'block';
            hargaInput.required = true;
        } else {
            hargaContainer.style.display = 'none';
            hargaInput.required = false;
        }
    }

    // Fungsi untuk menghapus buku
    function deleteBook() {
        if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
            document.getElementById('deleteForm').submit();
        }
    }

    // Event listener untuk checkbox
    document.querySelectorAll('input[name="listing_type[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', toggleHarga);
    });

    // Inisialisasi saat load
    toggleHarga();
</script>
@endpush