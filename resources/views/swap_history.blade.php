@extends('layouts.homepage_admin')
{{-- Jika tidak pakai layout, beritahu saya — nanti saya buatkan versi tanpa layout --}}

@section('title', 'Riwayat Tukar Buku')

@section('content')
<div class="container mt-4">

    <h2 class="fw-bold mb-4">Riwayat Tukar Buku</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <table class="table table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Requester</th>
                        <th>Owner</th>
                        <th>Buku Diminta</th>
                        <th>Buku Ditukar</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($riwayat as $item)
                    <tr>
                        <td>{{ $item->id }}</td>

                        <td>
                            <strong>{{ $item->requester->name ?? 'Unknown' }}</strong><br>
                            <small class="text-muted">ID: {{ $item->requester_id }}</small>
                        </td>

                        <td>
                            <strong>{{ $item->owner->name ?? 'Unknown' }}</strong><br>
                            <small class="text-muted">ID: {{ $item->owner_id }}</small>
                        </td>

                        <td>
                            <strong>{{ $item->requestedBook->title ?? '-' }}</strong>
                        </td>

                        <td>
                            <strong>{{ $item->offeredBook->title ?? '-' }}</strong>
                        </td>

                        <td>
                            @if($item->status === 'accepted')
                                <span class="badge bg-success">Accepted</span>
                            @elseif($item->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($item->status === 'rejected')
                                <span class="badge bg-danger">Rejected</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                            @endif
                        </td>

                        <td>
                            {{ $item->created_at->format('d M Y, H:i') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection
