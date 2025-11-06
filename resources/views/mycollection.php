@extends('layouts.pengelolaan')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Koleksi Buku Saya</h1>
    <p class="text-gray-500 mb-6">Kelola koleksi buku Anda di sini.</p>

    @php
        $books = [
            ['title' => 'Bumi', 'author' => 'Tere Liye', 'cover' => 'https://picsum.photos/id/1015/400/600'],
            ['title' => 'Filosofi Teras', 'author' => 'Henry Manampiring', 'cover' => 'https://picsum.photos/id/1016/400/600'],
            ['title' => 'Laut Bercerita', 'author' => 'Leila S. Chudori', 'cover' => 'https://picsum.photos/id/1018/400/600'],
            ['title' => 'Hujan', 'author' => 'Tere Liye', 'cover' => 'https://picsum.photos/id/1024/400/600'],
            ['title' => 'Atomic Habits', 'author' => 'James Clear', 'cover' => 'https://picsum.photos/id/1027/400/600'],
            ['title' => 'The Alchemist', 'author' => 'Paulo Coelho', 'cover' => 'https://picsum.photos/id/1035/400/600'],
            ['title' => 'A Promised Land', 'author' => 'Barack Obama', 'cover' => 'https://picsum.photos/id/1049/400/600'],
            ['title' => 'Big Magic', 'author' => 'Elizabeth Gilbert', 'cover' => 'https://picsum.photos/id/1041/400/600'],
        ];
    @endphp

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($books as $book)
            <div class="relative bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
                <img src="{{ $book['cover'] }}" alt="{{ $book['title'] }}" class="w-full h-60 object-cover">
                <div class="p-4 text-center">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $book['title'] }}</h2>
                    <p class="text-gray-500 text-sm">{{ $book['author'] }}</p>
                </div>
                <button class="absolute top-3 right-3 bg-red-500 text-white rounded-full p-2 hover:bg-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endforeach
    </div>
</div>
@endsection
