<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>

    <!-- Midtrans Snap -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-md text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Pembayaran Pesanan</h2>

        <p class="text-gray-600 text-sm mb-6">
            Klik tombol di bawah untuk melanjutkan pembayaran Anda
        </p>

        <!-- Loading Message -->
        <div id="loading-box" class="hidden mb-4 animate-pulse">
            <div class="flex justify-center">
                <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 108 8h-4l3 3 3-3h-4a8 8 0 01-8-8z">
                    </path>
                </svg>
            </div>
            <p class="text-blue-600 font-semibold mt-3">Membuka halaman pembayaran...</p>
        </div>

        <!-- Tombol Bayar -->
        <button id="pay"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg text-lg font-semibold transition">
            Bayar Sekarang
        </button>

        <!-- Tombol Batalkan -->
        <a href="/pengelolaan/keranjang"
           class="block w-full mt-3 bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg text-lg font-semibold transition">
            Batalkan Pembayaran
        </a>

        <p class="text-xs text-gray-500 mt-4">Transaksi Anda aman & terenkripsi.</p>
    </div>

    <script>
        const payBtn = document.getElementById('pay');
        const loadingBox = document.getElementById('loading-box');

        payBtn.onclick = function () {
            loadingBox.classList.remove("hidden");
            payBtn.classList.add("hidden");

            snap.pay('{{ $snapToken }}', {
                onSuccess: function () {
                    window.location.href = "/pengelolaan/keranjang";
                },
                onPending: function () {
                    window.location.href = "/pengelolaan/keranjang";
                },
                onError: function () {
                    alert('Terjadi kesalahan saat memproses pembayaran.');
                    window.location.href = "/pengelolaan/keranjang";
                },
                onClose: function () {
                    loadingBox.classList.add("hidden");
                    payBtn.classList.remove("hidden");
                }
            });
        };
    </script>

</body>

</html>
