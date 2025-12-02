@extends('layouts.homepage_admin')
{{-- Ganti sesuai nama file layout pertama yang kamu kirim --}}

@section('title', 'Dashboard Admin')

{{-- Search bar khusus di header --}}
@section('search_form')
<form action="" class="hidden md:flex items-center gap-2">
    <input
        type="text"
        class="border border-zinc-300 rounded-xl px-4 py-2 w-72 focus:outline-none focus:ring-2 focus:ring-indigo-500"
        placeholder="Cari Buku..."
    >
</form>
@endsection

@section('content')

<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-semibold text-zinc-800">Daftar Buku</h1>
</div>

{{-- Grid Buku --}}
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4"> 
    @forelse($books as $book)
    <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden p-3">

        {{-- Cover buku agar terlihat seluruhnya --}}
        <div class="w-full h-36 bg-zinc-100 flex items-center justify-center rounded-lg overflow-hidden">
            <img src="{{ asset('storage/' . $book->cover_image) }}" 
                 class="w-full h-full object-contain">
        </div>

        <div class="pt-3 text-center">
            <p class="font-semibold text-zinc-800 text-sm line-clamp-2">{{ $book->title }}</p>
            <p class="text-xs text-zinc-500">{{ $book->author }}</p>
            <p class="text-sm font-bold text-zinc-800 mt-1">{{ $book->harga_rupiah }}</p>

            <form action="{{ route('homepage_admin.destroy', $book->id_buku) }}" method="POST" class="mt-2">
                @csrf
                @method('DELETE')
                <button 
                    onclick="return confirm('Yakin ingin menghapus buku ini?')"
                    class="w-full py-1.5 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </form>
        </div>

    </div>
    @empty
    <p class="text-zinc-500 col-span-full text-center">Belum ada buku dalam koleksi.</p>
    @endforelse
</div>


@endsection
