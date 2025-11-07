@extends('layouts.pengelolaan')

@section('content')

    <div class="max-w-6xl mx-auto py-10 px-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">📚 Riwayat Transaksi Pembelian</h1>

        <div class="bg-white rounded-xl shadow p-6">
            <table class="min-w-full text-left text-gray-700">
                <thead class="border-b-2 border-gray-200 text-sm uppercase">
                    <tr>
                        <th class="py-2 px-3">ID Transaksi</th>
                        <th class="py-2 px-3">Nama Pengguna</th>
                        <th class="py-2 px-3">Tanggal</th>
                        <th class="py-2 px-3">Total</th>
                        <th class="py-2 px-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-3">{{ $transaction->id }}</td>
                        <td class="py-2 px-3">{{ $transaction->user_name }}</td>
                        <td class="py-2 px-3">{{ $transaction->date }}</td>
                        <td class="py-2 px-3 font-semibold">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                        <td class="py-2 px-3">
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($transaction->status == 'Completed') bg-green-100 text-green-700
                                @elseif($transaction->status == 'Pending') bg-yellow-100 text-yellow-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ $transaction->status }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
@endsection
