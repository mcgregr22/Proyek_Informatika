@extends('layouts.pengelolaan')

@section('content')
  <h2 class="text-2xl font-semibold mb-2">Permintaan Tukar Buku</h2>
  <p class="text-sm text-zinc-500 mb-6">Kelola permintaan tukar buku Anda dari dan kepada pengguna lain.</p>

  <div class="flex gap-3 mb-6">
    <button id="incomingBtn" class="tab-button px-5 py-2 border-b-2 border-indigo-600 text-indigo-700 font-semibold">
      Masuk
    </button>
    <button id="outgoingBtn" class="tab-button px-5 py-2 text-gray-500 hover:text-black">
      Keluar
    </button>
  </div>

  {{-- ========== TAB MASUK ========== --}}
  <div id="incoming" class="rounded-2xl border border-zinc-200 bg-white shadow-sm p-6">
    @if($incomingRequests->isEmpty())
      <div class="text-center text-zinc-500">
        <h5 class="text-lg font-semibold">Belum ada permintaan swap masuk</h5>
        <p class="text-sm">Jika ada pengguna yang ingin tukar buku Anda, akan muncul di sini.</p>
      </div>
    @else
      @foreach($incomingRequests as $req)
        <div id="req-{{ $req->id }}" class="flex items-center justify-between border-b py-4 transition-all">
          <div class="flex items-start gap-4">
            <img src="{{ $req->book->cover ?? '/images/default-book.png' }}" class="w-16 h-20 object-cover rounded-lg border" alt="Buku">
            <div class="text-left">
              <p class="text-base font-semibold text-zinc-700">
                {{ $req->book->title ?? 'Judul Tidak Diketahui' }}
              </p>
              <p class="text-sm text-zinc-500 mt-1">
                Diminta oleh: <span class="font-medium text-indigo-600">{{ $req->requester->name ?? 'User Tidak Diketahui' }}</span>
              </p>
              <p class="text-xs text-zinc-400 mt-1">Dikirim pada {{ $req->created_at->format('d M Y, H:i') }}</p>
            </div>
          </div>
          <div class="flex gap-2">
            <button class="accept-btn px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600" data-id="{{ $req->id }}">Terima</button>
            <button class="reject-btn px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600" data-id="{{ $req->id }}">Tolak</button>
          </div>
        </div>
      @endforeach
    @endif
  </div>

  {{-- ========== TAB KELUAR ========== --}}
  <div id="outgoing" class="rounded-2xl border border-zinc-200 bg-white shadow-sm p-6 hidden">
    @if($outgoingRequests->isEmpty())
      <div class="text-center text-zinc-500">
        <h5 class="text-lg font-semibold">Belum ada permintaan swap keluar</h5>
        <p class="text-sm">Anda belum meminta tukar buku ke pengguna lain.</p>
      </div>
    @else
      @foreach($outgoingRequests as $req)
        <div class="flex items-center justify-between border-b py-4">
          <div class="flex items-start gap-4">
            <img src="{{ $req->book->cover ?? '/images/default-book.png' }}" class="w-16 h-20 object-cover rounded-lg border" alt="Buku">
            <div class="text-left">
              <p class="text-base font-semibold text-zinc-700">
                {{ $req->book->title ?? 'Judul Tidak Diketahui' }}
              </p>
              <p class="text-sm text-zinc-500 mt-1">
                Pemilik buku: <span class="font-medium text-indigo-600">{{ $req->owner->name ?? 'User Tidak Diketahui' }}</span>
              </p>
              <p class="text-xs text-zinc-400 mt-1">Status:
                <span class="@if($req->status == 'pending') text-amber-500 
                             @elseif($req->status == 'accepted') text-green-600 
                             @else text-red-600 @endif font-medium">
                  {{ ucfirst($req->status) }}
                </span>
              </p>
            </div>
          </div>
        </div>
      @endforeach
    @endif
  </div>

  {{-- ====== SCRIPT: SWITCH TAB ====== --}}
  <script>
    const incomingBtn = document.getElementById('incomingBtn');
    const outgoingBtn = document.getElementById('outgoingBtn');
    const incoming = document.getElementById('incoming');
    const outgoing = document.getElementById('outgoing');

    incomingBtn.addEventListener('click', () => {
      incoming.classList.remove('hidden');
      outgoing.classList.add('hidden');
      incomingBtn.classList.add('border-indigo-600','text-indigo-700','font-semibold');
      outgoingBtn.classList.remove('border-indigo-600','text-indigo-700','font-semibold');
    });

    outgoingBtn.addEventListener('click', () => {
      outgoing.classList.remove('hidden');
      incoming.classList.add('hidden');
      outgoingBtn.classList.add('border-indigo-600','text-indigo-700','font-semibold');
      incomingBtn.classList.remove('border-indigo-600','text-indigo-700','font-semibold');
    });
  </script>

  {{-- ====== SCRIPT: SWEETALERT + AJAX ====== --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const acceptButtons = document.querySelectorAll('.accept-btn');
      const rejectButtons = document.querySelectorAll('.reject-btn');

      acceptButtons.forEach(btn => {
        btn.addEventListener('click', async () => {
          const id = btn.dataset.id;
          const result = await Swal.fire({
            title: 'Terima permintaan ini?',
            text: "Kamu yakin ingin menerima tukar buku ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Terima',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#16a34a',
          });
          if (result.isConfirmed) {
            fetch(/swap/${id}/accept, { method: 'PUT', headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'} })
              .then(() => {
                document.getElementById(req-${id}).remove();
                Swal.fire({ icon: 'success', title: 'Permintaan diterima ✅', timer: 1800, toast: true, position: 'top-end', showConfirmButton: false });
              });
          }
        });
      });

      rejectButtons.forEach(btn => {
        btn.addEventListener('click', async () => {
          const id = btn.dataset.id;
          const result = await Swal.fire({
            title: 'Tolak permintaan ini?',
            text: "Kamu yakin ingin menolak tukar buku ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Tolak',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#dc2626',
          });
          if (result.isConfirmed) {
            fetch(/swap/${id}/reject, { method: 'PUT', headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'} })
              .then(() => {
                document.getElementById(req-${id}).remove();
                Swal.fire({ icon: 'error', title: 'Permintaan ditolak ❌', timer: 1800, toast: true, position: 'top-end', showConfirmButton: false });
              });
          }
        });
      });
    });
  </script>
@endsection
