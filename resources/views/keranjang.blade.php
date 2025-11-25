@extends('layouts.pengelolaan')

@php
use Illuminate\Support\Facades\Storage;

// Helper kecil untuk rupiah
$rp = fn($n) => 'Rp ' . number_format((int) $n, 0, ',', '.');

// Pastikan pengecekan empty valid
$isEmpty = empty($items) || (is_countable($items) && count($items) === 0);
@endphp

@section('content')
<h2 class="text-2xl font-semibold mb-2">Keranjang</h2>
<p class="text-sm text-zinc-500 mb-6">Buku-buku yang kamu tambahkan ke keranjang</p>

{{-- FLASH MESSAGES --}}
@if (session('success'))
<div class="rounded-xl border border-green-200 bg-green-50 text-green-700 p-3 mb-4">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="rounded-xl border border-red-200 bg-red-50 text-red-700 p-3 mb-4">
    {{ session('error') }}
</div>
@endif

{{-- ========================================================= --}}
{{-- ======================= EMPTY STATE ======================= --}}
{{-- ========================================================= --}}
@if ($isEmpty)

<div class="rounded-2xl border border-zinc-200 bg-white shadow-sm p-8 text-center">
    <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png"
        alt="Empty"
        class="mx-auto w-40 opacity-90 mb-4">

    <h5 class="text-lg font-semibold text-zinc-700">Keranjang Belanja Kosong</h5>
    <p class="text-sm text-zinc-500">
        Yuk, temukan buku favoritmu dan tambahkan ke keranjang!
    </p>

    <a href="{{ route('homepage') }}"
        class="inline-flex items-center gap-2 mt-4 px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
            viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 19l-7-7 7-7" />
        </svg>
        Beranda
    </a>
</div>

{{-- RINGKASAN (EMPTY) --}}
<div class="rounded-2xl border border-zinc-200 bg-white shadow-sm p-6 mt-6 w-full">
    <h6 class="font-semibold mb-3">Ringkasan Pesanan</h6>

    <div class="flex justify-between text-sm">
        <span>Subtotal (item):</span><strong>{{ $rp(0) }}</strong>
    </div>
    <div class="flex justify-between text-sm">
        <span>Pajak (10%):</span><strong>{{ $rp(0) }}</strong>
    </div>
    <div class="flex justify-between text-sm mb-2">
        <span>Pengiriman:</span><strong>{{ $rp(0) }}</strong>
    </div>

    <hr class="my-3">

    <div class="flex justify-between items-center">
        <span class="font-semibold">Total:</span>
        <span class="text-indigo-600 font-bold">{{ $rp(0) }}</span>
    </div>

    <button class="w-full mt-4 px-4 py-2 rounded-lg bg-zinc-200 text-zinc-500 cursor-not-allowed">
        Checkout
    </button>
</div>

{{-- ========================================================= --}}
{{-- ================= LIST ITEM (NOT EMPTY) ================== --}}
{{-- ========================================================= --}}
@else

{{-- LIST ITEM --}}
<div class="rounded-2xl border border-zinc-200 bg-white shadow-sm p-4">
    <h5 class="font-semibold mb-3">Keranjang Kamu</h5>

    @foreach ($items as $it)
    @php
    // Ambil cover
    $cover = $it['cover'] ?? null;

    // Normalisasi path
    if ($cover) $cover = str_replace('\\', '/', $cover);

    // Jika relatif → Storage::url()
    $coverUrl = $cover && !preg_match('#^https?://#', $cover)
    ? Storage::url($cover)
    : ($cover ?: asset('images/placeholder-cover.png'));
    @endphp

    <div class="flex items-center gap-4 py-4 border-b border-zinc-100 last:border-0 flex-wrap">

        {{-- COVER --}}
        <img src="{{ $coverUrl }}"
            alt="{{ $it['title'] ?? 'Buku' }}"
            class="w-[72px] h-[104px] object-cover rounded-lg">

        {{-- ISI --}}
        <div class="flex-1 min-w-[220px]">
            <div class="font-medium">{{ $it['title'] ?? '-' }}</div>
            <div class="text-sm text-zinc-500">{{ $it['author'] ?? '-' }}</div>

            @if (!empty($it['isbn']))
            <div class="text-xs text-zinc-400">ISBN: {{ $it['isbn'] }}</div>
            @endif

            <div class="mt-1 text-sm">
                {{ $rp($it['price'] ?? 0) }}
                <span class="text-zinc-400">/ buku</span>

                {{-- QUANTITY CONTROL --}}
                <div class="flex items-center gap-2 mt-2">

                    {{-- MINUS --}}
                    <form action="{{ route('cart.decrease', $it['id_buku']) }}" method="POST">
                        @csrf
                        <button class="w-7 h-7 flex items-center justify-center rounded-lg border border-zinc-300 hover:bg-zinc-100">−</button>
                    </form>

                    {{-- QTY --}}
                    <span class="px-2">{{ $it['qty'] }}</span>

                    {{-- PLUS --}}
                    <form action="{{ route('cart.increase', $it['id_buku']) }}" method="POST">
                        @csrf
                        <button class="w-7 h-7 flex items-center justify-center rounded-lg border border-zinc-300 hover:bg-zinc-100">+</button>
                    </form>

                </div>
            </div>
        </div>

        {{-- SUBTOTAL + HAPUS --}}
        <div class="text-right min-w-[120px]">
            <div class="font-semibold">
                {{ $rp($it['subtotal'] ?? 0) }}
            </div>

            <form action="{{ route('cart.remove', $it['id_buku']) }}" method="POST" class="mt-2">
                @csrf
                @method('DELETE')
                <button class="px-3 py-1.5 text-sm rounded-lg border border-zinc-200 hover:bg-zinc-50">
                    Hapus
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>

{{-- RINGKASAN (NOT EMPTY) --}}
<div class="rounded-2xl border border-zinc-200 bg-white shadow-sm p-6 mt-6 w-full">
    <h6 class="font-semibold mb-6">Ringkasan Pesanan</h6>

    <div class="flex justify-between text-sm">
        <span>Subtotal (item):</span>
        <strong>{{ $rp($subtotal ?? 0) }}</strong>
    </div>

    <div class="flex justify-between text-sm">
        <span>Pajak (10%):</span>
        <strong>{{ $rp($tax ?? 0) }}</strong>
    </div>

    <div class="flex justify-between text-sm mb-2">
        <span>Pengiriman:</span>
        <strong>{{ $rp($shipping ?? 0) }}</strong>
    </div>

    <hr class="my-3">

    <div class="flex justify-between items-center">
        <span class="font-semibold">Total:</span>
        <span class="text-indigo-600 font-bold">{{ $rp($total ?? 0) }}</span>
    </div>

    <form action="{{ route('midtrans.checkout') }}" method="POST">
        @csrf
        <button class="w-full mt-4 px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white">
            Bayar Sekarang
        </button>
    </form>

</div>
@endif

{{-- ACTIVE SIDEBAR MARKER --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const active = ['bg-indigo-50', 'text-indigo-700', 'ring-1', 'ring-indigo-200'];

        document.querySelectorAll('aside nav a').forEach(a =>
            a.classList.remove(...active)
        );

        const link = document.querySelector(
    `a[href="/pengelolaan/keranjang"],
     a[href="pengelolaan/keranjang"],
     a[href="{{ url('/pengelolaan/keranjang') }}"]`
);


        if (link) {
            link.classList.add(...active);
            link.querySelector('span.w-6')?.classList.add('text-indigo-600');
        }
    });
</script>
@endsection