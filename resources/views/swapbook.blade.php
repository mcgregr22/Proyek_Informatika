@extends('layouts.pengelolaan')

@section('content')
  <h2 class="text-2xl font-semibold mb-2">Book Swaps</h2>
  <p class="text-sm text-zinc-500 mb-6">Manage your book swap requests</p>

  <div class="flex gap-3 mb-6">
    <button id="incomingBtn" class="tab-button px-5 py-2 border-b-2 border-black font-semibold">Incoming</button>
    <button id="outgoingBtn" class="tab-button px-5 py-2 text-gray-500 hover:text-black">Outgoing</button>
  </div>

  <div id="incoming" class="rounded-2xl border border-zinc-200 bg-white shadow-sm p-10 text-center text-zinc-500">
    <h5 class="text-lg font-semibold">No incoming swap requests</h5>
    <p class="text-sm">When someone requests to swap with one of your books, it will appear here.</p>
    <a href="/homepage" class="btn btn-dark mt-3 inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Browse Books</a>
  </div>

  <div id="outgoing" class="rounded-2xl border border-zinc-200 bg-white shadow-sm p-10 text-center text-zinc-500 hidden">
    <h5 class="text-lg font-semibold">No outgoing swap requests</h5>
    <p class="text-sm">You haven’t requested any swaps yet. Browse and request a book swap.</p>
    <a href="/homepage" class="btn btn-dark mt-3 inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Browse Books</a>
  </div>

  <script>
    const incomingBtn = document.getElementById('incomingBtn');
    const outgoingBtn = document.getElementById('outgoingBtn');
    const incoming = document.getElementById('incoming');
    const outgoing = document.getElementById('outgoing');

    incomingBtn.onclick = () => {
      incoming.classList.remove('hidden');
      outgoing.classList.add('hidden');
      incomingBtn.classList.add('border-black');
      outgoingBtn.classList.remove('border-black');
    };

    outgoingBtn.onclick = () => {
      outgoing.classList.remove('hidden');
      incoming.classList.add('hidden');
      outgoingBtn.classList.add('border-black');
      incomingBtn.classList.remove('border-black');
    };
  </script>
@endsection
