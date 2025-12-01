@extends('layouts.pengelolaan')

@section('title', 'Riwayat Tukar Buku Saya')

@section('content')
<div class="bg-white rounded-2xl shadow-sm p-6">

    <h2 class="text-xl font-semibold mb-4">Riwayat Tukar Buku Saya</h2>

    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100 text-gray-700 text-left">
                <tr>
                    <th class="px-5 py-3 w-10">#</th>
                    <th class="px-5 py-3 w-48">Lawan Tukar Buku</th>
                    <th class="px-5 py-3 w-44">Buku Diminta</th>
                    <th class="px-5 py-3 w-44">Buku Ditukar</th>
                    <th class="px-5 py-3 w-32">Status</th>
                    <th class="px-5 py-3 w-40">Tanggal</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach($riwayat as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-3">{{ $loop->iteration }}</td>

                    {{-- Lawan Tukar Buku --}}
                    <td class="px-5 py-3">
                        <div class="font-semibold">
                            {{ auth()->id() === $item->requester_id 
                                ? ($item->owner->name ?? 'Unknown')
                                : ($item->requester->name ?? 'Unknown')
                            }}
                        </div>
                        <div class="text-gray-500 text-xs">
                            ID: {{ auth()->id() === $item->requester_id ? $item->owner_id : $item->requester_id }}
                        </div>
                    </td>

                    {{-- Buku Diminta --}}
                    <td class="px-5 py-3 font-medium">
                        {{ $item->requestedBook->title ?? '-' }}
                    </td>

                    {{-- Buku Ditukar --}}
                    <td class="px-5 py-3 font-medium">
                        {{ $item->offeredBook->title ?? '-' }}
                    </td>

                    {{-- Status --}}
                    <td class="px-5 py-3">
                        @if($item->status == 'accepted')
                            <span class="text-green-600 font-semibold">Accepted</span>
                        @elseif($item->status == 'pending')
                            <span class="text-yellow-600 font-semibold">Pending</span>
                        @elseif($item->status == 'rejected')
                            <span class="text-red-600 font-semibold">Rejected</span>
                        @else
                            <span class="text-gray-600">{{ ucfirst($item->status) }}</span>
                        @endif
                    </td>

                    {{-- Tanggal --}}
                    <td class="px-5 py-3">
                        {{ $item->created_at->format('d M Y, H:i') }}
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
@endsection
