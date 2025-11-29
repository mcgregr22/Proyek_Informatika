@extends('layouts.mycollection')

@section('title', 'Koleksi Buku Saya')

@section('content')

<div class="max-w-7xl mx-auto">

  <h1 class="text-2xl font-bold text-zinc-800 mb-6">Koleksi Buku Saya</h1>

  {{-- Jika kosong --}}
  @if($myBooks->isEmpty())
  <div class="p-10 text-center bg-white rounded-xl border border-zinc-200 shadow-sm">
    <p class="text-zinc-500 text-lg">Kamu belum menambahkan buku apa pun ke koleksi.</p>
  </div>
  @endif

  {{-- Grid buku --}}
  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">

    @foreach ($myBooks as $book)
    <div class="bg-white border border-zinc-200 rounded-xl shadow-sm hover:shadow-md transition overflow-hidden flex flex-col">

      {{-- Cover lebih panjang --}}
      <div class="w-full h-64 bg-zinc-100 overflow-hidden flex items-center justify-center">
        @if($book->cover_image)
          <img src="{{ asset('storage/'.$book->cover_image) }}"
               class="w-full h-full object-contain bg-white">
        @else
          <div class="flex items-center justify-center h-full text-4xl text-zinc-400">
            <i class="bi bi-book"></i>
          </div>
        @endif
      </div>

      {{-- Konten Buku --}}
      <div class="p-4 flex flex-col flex-grow">

        {{-- Judul --}}
        <h3 class="text-sm font-semibold text-zinc-800 leading-snug line-clamp-2">
          {{ $book->title }}
        </h3>

        {{-- Penulis --}}
        <p class="text-xs text-zinc-500 mt-1 mb-4">
          {{ $book->author ?? 'Tidak ada penulis' }}
        </p>

        {{-- Spacer agar tombol di bawah --}}
        <div class="flex-grow"></div>

        {{-- Tombol --}}
        <form action="/pengelolaan/swapbook" method="GET">
          <input type="hidden" name="requested" value="{{ $book->id_buku }}">
          <button
            class="w-full px-3 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-xs transition">
            Tukar Buku
          </button>
        </form>

      </div>
    </div>
    @endforeach

  </div>

</div>

@endsection
