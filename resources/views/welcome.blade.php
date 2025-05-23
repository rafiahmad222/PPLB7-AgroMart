<!-- filepath: d:\PPL-AgroMart\resources\views\welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Landing Page - AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="images/icon-40x40.png">
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&family=Signika:wght@300..700&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(-5px);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .animate-fadeOut {
            animation: fadeOut 0.3s ease-out forwards;
        }
    </style>
</head>

<body class="bg-gray-100">
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <nav class="flex items-center justify-between max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Logo AgroMart" class="h-12">
                </a>
                <div class="items-center hidden gap-4 text-base font-semibold md:flex text-emerald-700 font-[signika]">
                    <a href="{{ route('home') }}" class="hover:text-emerald-400">HOME</a>
                    <a href="#produk" class="hover:text-emerald-400">PRODUK</a>
                    <a href="#edukasi" class="hover:text-emerald-400">EDUKASI</a>
                    <a href="#galeri" class="hover:text-emerald-400">GALERI</a>
                    <a href="#layanan" class="hover:text-emerald-400">LAYANAN</a>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}"
                    class="px-4 py-2 text-sm font-medium text-white rounded-md bg-emerald-500 hover:bg-emerald-600">Login</a>
                <a href="{{ route('register') }}"
                    class="px-4 py-2 text-sm font-medium border rounded-md text-emerald-500 border-emerald-500 hover:bg-emerald-50">Registrasi</a>
            </div>
        </nav>
    </header>

    <div class="h-[400px] bg-cover bg-center mt-3 mx-4 rounded-3xl overflow-hidden relative"
        style="background-image: url('{{ asset('images/Landing Page.png') }}');">
        <div
            class="absolute inset-0 flex flex-col items-center justify-center p-6 text-center text-white bg-black bg-opacity-50">
            <h1 class="mb-2 text-4xl font-bold">CV. Hidroponik Jember</h1>
            <p class="mb-4 text-lg">We all need a little space to grow. Give yourself the space you need to grow your
                inner you.</p>
            <a href="#kontak" class="px-4 py-2 text-white rounded-md bg-emerald-500 hover:bg-emerald-600">Hubungi
                Kami</a>
        </div>
    </div>

    <section id="produk" class="py-12 bg-white">
        <div class="max-w-screen-xl px-4 mx-auto">
            <h2 class="mb-6 text-2xl font-bold text-center text-emerald-800">Produk Kami</h2>
            <p class="mb-8 text-center text-gray-600">Temukan berbagai produk hidroponik berkualitas.</p>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                @foreach ($produks as $produk)
                    <div class="p-4 bg-gray-100 rounded-lg shadow-md">
                        <h3 class="mb-2 text-lg font-semibold text-emerald-700">{{ $produk->nama_produk }}</h3>
                        <p class="text-sm text-gray-600">{{ $produk->deskripsi }}</p>
                        @if ($produk->gambar)
                            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}"
                                class="mt-4 rounded-lg">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="kontak" class="py-12 bg-gray-100">
        <div class="max-w-screen-xl px-4 mx-auto">
            <h2 class="mb-6 text-2xl font-bold text-center text-emerald-800">Hubungi Kami</h2>
            <p class="mb-8 text-center text-gray-600">Kami siap membantu Anda. Jangan ragu untuk menghubungi kami.</p>
            <div class="flex justify-center">
                <a href="mailto:info@agromart.com"
                    class="px-6 py-3 text-white rounded-md bg-emerald-500 hover:bg-emerald-600">Email Kami</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <x-footer></x-footer>
</body>

</html>
