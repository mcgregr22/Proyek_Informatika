@extends('layouts.pengelolaan')

@section('content')
  <h2 class="text-2xl font-semibold mb-2">Tukar Buku</h2>
  <p class="text-sm text-zinc-500 mb-6">Kelola permintaan tukar buku Anda</p>

  {{-- Flash messages --}}
  @if(session('success'))
    <div class="p-3 mb-4 rounded bg-green-50 text-green-700">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="p-3 mb-4 rounded bg-red-50 text-red-700">{{ session('error') }}</div>
  @endif

  <div class="flex gap-3 mb-6">
    <button id="incomingBtn" class="tab-button px-5 py-2 border-b-2 border-black font-semibold">Masuk</button>
    <button id="outgoingBtn" class="tab-button px-5 py-2 text-gray-500 hover:text-black">Keluar</button>
  </div>

  {{-- ===================== PERMINTAAN MASUK ===================== --}}
  <div id="incoming" class="rounded-2xl border border-zinc-200 bg-white shadow-sm p-6">
    @if ($incoming->isEmpty())
      <div class="text-center text-zinc-500">
        <h5 class="text-lg font-semibold">Belum ada permintaan swap masuk</h5>
        <p class="text-sm">Saat ada pengguna yang meminta tukar dengan buku Anda, akan muncul di sini.</p>
        <a href="/homepage" class="btn btn-dark mt-3 inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Jelajahi Buku</a>
      </div>
    @else
      <table class="table-auto w-full text-left border-collapse">
        <thead class="border-b text-sm text-gray-600">
          <tr>
            <th class="py-2">Peminta</th>
            <th>Buku Diminta</th>
            <th>Buku Ditukar</th>
            <th>Status</th>
            <th>Tanggal / Aksi</th>
          </tr>
        </thead>
        <tbody class="text-sm">
          @foreach ($incoming as $req)
            <tr class="border-b align-top">
              <td class="py-2">{{ $req->requester->name ?? 'User Dihapus' }}</td>
              <td>{{ $req->requestedBook->title ?? '-' }}</td>
              <td>{{ $req->offeredBook->title ?? '-' }}</td>
              <td>
                <span class="px-2 py-1 rounded text-white text-xs
                  @if($req->status === 'pending') bg-yellow-500
                  @elseif($req->status === 'accepted') bg-green-600
                  @else bg-red-600 @endif">
                  {{ ucfirst($req->status) }}
                </span>
              </td>
              <td class="py-2 whitespace-nowrap">
                {{ optional($req->created_at)->format('Y-m-d') }}

                {{-- Tombol aksi muncul hanya saat pending --}}
                @if($req->status === 'pending')
                  <div class="mt-2 flex gap-2">
                    <form action="{{ route('swap.accept', $req->id) }}" method="POST" onsubmit="return confirm('Terima permintaan ini?')">
                      @csrf
                      @method('PATCH')
                      <button type="submit"
                              class="px-3 py-1 rounded bg-green-600 text-white text-xs hover:bg-green-700">
                        Terima
                      </button>
                    </form>

                    <form action="{{ route('swap.reject', $req->id) }}" method="POST" onsubmit="return confirm('Tolak permintaan ini?')">
                      @csrf
                      @method('PATCH')
                      <button type="submit"
                              class="px-3 py-1 rounded bg-red-600 text-white text-xs hover:bg-red-700">
                        Tolak
                      </button>
                    </form>
                  </div>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>

  {{-- ===================== PERMINTAAN KELUAR ===================== --}}
  <div id="outgoing" class="rounded-2xl border border-zinc-200 bg-white shadow-sm p-6 hidden">
    @if ($outgoing->isEmpty())
      <div class="text-center text-zinc-500">
        <h5 class="text-lg font-semibold">Belum ada permintaan swap keluar</h5>
        <p class="text-sm">Anda belum meminta tukar buku. Jelajahi dan ajukan permintaan tukar.</p>
        <a href="/homepage" class="btn btn-dark mt-3 inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Jelajahi Buku</a>
      </div>
    @else
      <table class="table-auto w-full text-left border-collapse">
        <thead class="border-b text-sm text-gray-600">
          <tr>
            <th class="py-2">Penerima</th>
            <th>Buku Diminta</th>
            <th>Buku Ditukar</th>
            <th>Status</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody class="text-sm">
          @foreach ($outgoing as $req)
            <tr class="border-b">
              <td class="py-2">{{ $req->owner->name ?? 'User Dihapus' }}</td>
              <td>{{ $req->requestedBook->title ?? '-' }}</td>
              <td>{{ $req->offeredBook->title ?? '-' }}</td>
              <td>
                <span class="px-2 py-1 rounded text-white text-xs
                  @if($req->status === 'pending') bg-yellow-500
                  @elseif($req->status === 'accepted') bg-green-600
                  @else bg-red-600 @endif">
                  {{ ucfirst($req->status) }}
                </span>
              </td>
              <td class="py-2">{{ optional($req->created_at)->format('Y-m-d') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>

  {{-- ===================== JS TAB SWITCH ===================== --}}
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

  {{-- Highlight sidebar --}}
  <script>
  document.addEventListener('DOMContentLoaded', () => {
    const activeClasses = ['bg-indigo-50','text-indigo-700','ring-1','ring-indigo-200'];
    document.querySelectorAll('aside nav a').forEach(a => a.classList.remove(...activeClasses));
    const swapLink = document.getElementById('bookSwapsLink');
    if (swapLink) {
      swapLink.classList.add(...activeClasses);
      const icon = swapLink.querySelector('span.w-6');
      if (icon) icon.classList.add('text-indigo-600');
    }
  });
  </script>
@endsection