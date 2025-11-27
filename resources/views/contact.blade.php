<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - Library Hub</title>

    <!-- TAILWIND CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <!-- NAVBAR -->
    <nav class="w-full bg-white shadow-sm py-5 px-8 flex justify-between items-center sticky top-0 z-50">
        <a href="/beranda" class="flex items-center gap-1 text-2xl font-bold">
            <span class="text-gray-900">Library-</span>
            <span class="text-blue-600">Hub</span>
        </a>

        <ul class="hidden md:flex gap-8 text-gray-700 font-medium">
            <li><a href="/beranda" class="hover:text-blue-600">Beranda</a></li>
            <li><a href="/kontak" class="hover:text-blue-600">Kontak</a></li>
            <li><a href="/login" class="hover:text-blue-600">Masuk</a></li>
            <li><a href="/register" class="hover:text-blue-600">Daftar</a></li>
        </ul>
    </nav>


    <!-- HEADER -->
    <div class="text-center pt-16 pb-8 px-4">
        <h1 class="text-4xl font-extrabold text-gray-900">Hubungi Kami</h1>
        <p class="mt-2 text-gray-600">Kami siap membantu jika Anda memiliki pertanyaan atau membutuhkan bantuan.</p>
    </div>

    <!-- CARD KONTAK -->
    <div class="max-w-xl mx-auto px-6">
        <div class="bg-white shadow-lg rounded-2xl p-8 space-y-6">

            <h3 class="text-xl font-bold text-gray-800">Informasi Kontak</h3>

            <!-- Email -->
            <div>
                <p class="text-sm font-semibold text-gray-700">Email:</p>
                <p class="text-gray-600">locil@gmail.com</p>
            </div>
            <hr class="border-gray-200">

            <!-- WA -->
            <div>
                <p class="text-sm font-semibold text-gray-700">WhatsApp:</p>
                <p class="text-gray-600">+62 812-3456-7890</p>
            </div>
            <hr class="border-gray-200">

            <!-- Operasional -->
            <div>
                <p class="text-sm font-semibold text-gray-700">Jam Operasional:</p>
                <p class="text-gray-600">
                    Senin – Jumat <br>
                    09.00 – 17.00 WIB
                </p>
            </div>
            <hr class="border-gray-200">

            <!-- Alamat -->
            <div>
                <p class="text-sm font-semibold text-gray-700">Alamat:</p>
                <p class="text-gray-600">
                    PainganCity, Maguwoharjo, Depok, Sleman, Yogyakarta 55281
                </p>
            </div>
            <hr class="border-gray-200">

            <!-- Sosmed -->
            <div>
                <p class="text-sm font-semibold text-gray-700">Ikuti Kami:</p>
                <div class="flex items-center gap-4 text-blue-600 font-medium">
                    <a href="#" class="hover:underline">Instagram</a>
                    <a href="#" class="hover:underline">Facebook</a>
                    <a href="#" class="hover:underline">TikTok</a>
                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <footer class="mt-16 py-6 text-center text-sm text-gray-500">
        © {{ date('Y') }} Library-Hub. All rights reserved.
    </footer>

</body>

</html>
