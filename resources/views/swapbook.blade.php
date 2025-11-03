{{-- resources/views/swapbook.blade.php --}}
@extends('layouts.pengelolaan')

@section('content')
  <h2 class="text-2xl font-semibold mb-2">Tukar Buku</h2>
  <p class="text-sm text-zinc-500 mb-6">Kelola permintaan tukar buku Anda</p>

  <div class="flex gap-3 mb-6">
    <button id="incomingBtn" class="tab-button px-5 py-2 border-b-2 border-black font-semibold">Masuk</button>
    <button id="outgoingBtn" class="tab-button px-5 py-2 text-gray-500 hover:text-black">Keluar</button>
  </div>

  <div id="incoming" class="rounded-2xl border border-zinc-200 bg-white shadow-sm p-10 text-center text-zinc-500">
    <h5 class="text-lg font-semibold">Belum ada permintaan swap masuk</h5>
    <p class="text-sm">Saat ada pengguna yang meminta tukar dengan buku Anda, akan muncul di sini.</p>
    <a href="/homepage" class="btn btn-dark mt-3 inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Jelajahi Buku</a>
  </div>

  <div id="outgoing" class="rounded-2xl border border-zinc-200 bg-white shadow-sm p-10 text-center text-zinc-500 hidden">
    <h5 class="text-lg font-semibold">Belum ada permintaan swap keluar</h5>
    <p class="text-sm">Anda belum meminta tukar buku. Jelajahi dan ajukan permintaan tukar.</p>
    <a href="/homepage" class="btn btn-dark mt-3 inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Jelajahi Buku</a>
  </div>

  <script>
    const incomingBtn = document.getElementById('incomingBtn');
    const outgoingBtn = document.getElementById('outgoingBtn');
    const incoming = document.getElementById('incoming');
    const outgoing = document.getElementById('outgoing');

    incomingBtn.onclick = () => {
      incoming.classList.remove('hidden');
      outgoing.classList.add('hidden');
      incomingBtn.classList.add('border-black','font-semibold');
      outgoingBtn.classList.remove('border-black');
      outgoingBtn.classList.add('text-gray-500');
    };

    outgoingBtn.onclick = () => {
      outgoing.classList.remove('hidden');
      incoming.classList.add('hidden');
      outgoingBtn.classList.add('border-black','font-semibold');
      incomingBtn.classList.remove('border-black');
      incomingBtn.classList.add('text-gray-500');
    };
  </script>
  <script>
  document.addEventListener('DOMContentLoaded', () => {
    // kelas yang dipakai untuk tampilan item aktif (sesuaikan dengan gaya kamu)
    const activeClasses = ['bg-indigo-50','text-indigo-700','ring-1','ring-indigo-200'];

    // reset kelas aktif di semua link sidebar
    document.querySelectorAll('aside nav a').forEach(a => {
      a.classList.remove(...activeClasses);
    });

    // set aktif khusus untuk "Tukar Buku"
    const swapLink = document.getElementById('bookSwapsLink');
    if (swapLink) {
      swapLink.classList.add(...activeClasses);

      // opsional: warnai ikon saat aktif
      const icon = swapLink.querySelector('span.w-6');
      if (icon) icon.classList.add('text-indigo-600');
    }
  });
</script>

@endsection