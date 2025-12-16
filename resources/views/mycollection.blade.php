@extends('layouts.pengelolaan')

@section('content')
<div class="p-6">
  <h1 class="text-2xl font-bold text-gray-800 mb-2">Koleksi Buku Saya</h1>
  <p class="text-gray-500 mb-6">
    Pilih buku milik Anda untuk ditawarkan pada tukar buku.
  </p>

  {{-- Flash messages --}}
  @if(session('success'))
  <div class="p-3 mb-4 rounded bg-green-50 text-green-700">{{ session('success') }}</div>
  @endif
  @if(session('error'))
  <div class="p-3 mb-4 rounded bg-red-50 text-red-700">{{ session('error') }}</div>
  @endif

  {{-- Error validasi (jika ada) --}}
  @if ($errors->any())
  <div class="p-3 mb-4 rounded bg-red-50 text-red-700 text-sm">
    <ul class="list-disc pl-5">
      @foreach ($errors->all() as $e)
      <li>{{ $e }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  {{-- Peringatan jika belum ada target buku yang ingin ditukar --}}
  @if(empty($requestedId))
  <div class="p-3 mb-6 rounded bg-amber-50 text-amber-800 text-sm">
    Anda belum memilih buku target untuk ditukar. Silakan kembali ke halaman detail buku dan klik
    <span class="font-semibold">“Tukar Buku”</span> untuk memilih target.
  </div>
  @endif

  @if($myBooks->isEmpty())
  <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm p-10 text-center text-zinc-500">
    <h5 class="text-lg font-semibold mb-1">Koleksi Anda masih kosong</h5>
    <p class="text-sm">Tambahkan buku terlebih dahulu sebelum melakukan tukar buku.</p>
  </div>
  @else
  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach ($myBooks as $b)
    <div class="relative bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">

      {{-- Cover --}}
      @php
      $cover = $b->cover_image
      ? asset('storage/'.$b->cover_image)
      : 'https://picsum.photos/seed/'.$b->id_buku.'/400/600';
      @endphp

      <div class="w-full h-72 bg-gray-100 overflow-hidden">
        <img src="{{ $cover }}"
          alt="{{ $b->title }}"
          class="w-full h-full object-cover rounded-t-3xl transition-transform duration-300 hover:scale-105">
      </div>

      {{-- Info --}}
      <div class="p-4 text-center">
        <h2 class="text-lg font-bold text-gray-900 truncate" title="{{ $b->title }}">
          {{ $b->title }}
        </h2>
        <p class="text-gray-500 text-sm">{{ $b->author }}</p>
      </div>

      {{-- Button --}}
      <div class="p-4 pt-0">
        <div class="flex gap-2 mb-2">
          <a href="{{ route('buku.edit', $b->id_buku) }}"
            class="flex-1 px-3 py-2 rounded-xl text-white text-sm font-semibold bg-green-600 hover:bg-green-700 text-center">
            Edit Buku
          </a>
        </div>
        <form action="{{ route('swap.store') }}" method="POST">
          @csrf
          <input type="hidden" name="requested_book_id" value="{{ $requestedId }}">
          <input type="hidden" name="offered_book_id" value="{{ $b->id_buku }}">

          <button type="submit"
            class="w-full px-3 py-2 rounded-xl text-white text-sm font-semibold
              {{ empty($requestedId) ? 'bg-gray-300 cursor-not-allowed' : 'bg-indigo-600 hover:bg-indigo-700' }}"
            {{ empty($requestedId) ? 'disabled' : '' }}>
            Tukar dengan buku ini
          </button>
        </form>
      </div>

    </div>
    @endforeach
  </div>

  @endif
</div>
@endsection