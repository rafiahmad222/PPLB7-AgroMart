<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome to AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="images/icon-40x40.png">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&family=Signika:wght@300..700&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
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
            animation: fadeIn 0.4s ease-out forwards;
        }

        .animate-fadeOut {
            animation: fadeOut 0.3s ease-out forwards;
        }

        .hero-gradient {
            background: linear-gradient(to right, rgba(16, 185, 129, 0.8), rgba(5, 150, 105, 0.8));
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body class="text-gray-800 bg-gray-100">
    <!-- Header with Navigation -->
    <header class="sticky top-0 z-50 bg-white shadow-lg">
        <nav class="flex items-center justify-between max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center space-x-6">
                <a href="{{ route('welcome') }}" class="transition-transform hover:scale-105">
                    <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Logo AgroMart" class="h-12">
                </a>
                <div class="items-center hidden gap-6 text-base font-semibold md:flex text-emerald-700 font-[signika]">
                    <a href="#hero"
                        class="transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4">HOME</a>
                    <a href="#produk"
                        class="transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4">PRODUK</a>
                    <a href="#edukasi"
                        class="transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4">EDUKASI</a>
                    <a href="#galeri"
                        class="transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4">GALERI</a>
                    <a href="#layanan"
                        class="transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4">LAYANAN</a>
                    <a href="#tentang"
                        class="transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4">TENTANG
                        KAMI</a>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}"
                    class="px-5 py-2 font-medium text-white transition-all rounded-full shadow-md bg-primary-600 hover:bg-primary-700 hover:shadow-lg">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="px-5 py-2 font-medium transition-all border-2 rounded-full shadow-sm border-primary-600 text-primary-600 hover:bg-primary-50">
                    Daftar
                </a>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section id="hero" class="mx-2 my-2 relative h-[600px] bg-cover bg-center rounded-xl"
        style="background-image: url('{{ asset('images/Landing Page.png') }}');">
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40 rounded-xl"></div>
        <div class="relative flex flex-col items-start justify-center h-full px-6 mx-auto max-w-7xl lg:px-8">
            <div class="max-w-lg animate-fadeIn">
                <h1 class="text-4xl font-bold leading-tight text-white md:text-5xl lg:text-6xl">CV. Hidroponik
                    Jember</h1>
                <p class="mt-4 text-lg text-gray-200">We all need a little space to grow. Give yourself the space
                    you need to grow your inner you.</p>
                <div class="flex flex-wrap gap-4 mt-8">
                    <a href="#tentang"
                        class="px-8 py-3 text-base font-medium text-white transition-all rounded-full shadow-lg bg-primary-600 hover:bg-primary-700 hover:shadow-xl">Tentang
                        Kami</a>
                    <a href="#produk"
                        class="px-8 py-3 text-base font-medium text-white transition-all rounded-full bg-white/20 backdrop-blur-sm hover:bg-white/30">Produk
                        Kami</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-10">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="mb-12 text-center">
                <h2 class="mb-2 text-3xl font-bold text-gray-800">Kenapa Memilih Kami?</h2>
                <p class="max-w-lg mx-auto text-gray-600">Kami menyediakan produk hidroponik berkualitas tinggi
                    dengan pelayanan terbaik untuk kepuasan pelanggan.</p>
            </div>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                <!-- Feature Card -->
                <div class="p-6 bg-white shadow-md rounded-xl hover:shadow-xl card-hover">
                    <div
                        class="flex items-center justify-center w-16 h-16 mx-auto mb-6 rounded-full bg-primary-100 text-primary-600">
                        <i class="text-2xl fas fa-leaf"></i>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-center text-gray-800">Produk</h3>
                    <p class="text-sm text-center text-gray-600">Temukan berbagai produk hidroponik berkualitas
                        dari sayuran hingga peralatan.</p>
                    <div class="mt-6 text-center">
                        <a href="#produk" class="inline-block text-primary-600 hover:text-primary-700">Lihat
                            Produk <i class="ml-1 fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="p-6 bg-white shadow-md rounded-xl hover:shadow-xl card-hover">
                    <div
                        class="flex items-center justify-center w-16 h-16 mx-auto mb-6 rounded-full bg-primary-100 text-primary-600">
                        <i class="text-2xl fas fa-book-open"></i>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-center text-gray-800">Edukasi</h3>
                    <p class="text-sm text-center text-gray-600">Pelajari berbagai hal tentang hidroponik melalui
                        materi edukasi kami.</p>
                    <div class="mt-6 text-center">
                        <a href="#edukasi" class="inline-block text-primary-600 hover:text-primary-700">Pelajari
                            <i class="ml-1 fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="p-6 bg-white shadow-md rounded-xl hover:shadow-xl card-hover">
                    <div
                        class="flex items-center justify-center w-16 h-16 mx-auto mb-6 rounded-full bg-primary-100 text-primary-600">
                        <i class="text-2xl fas fa-images"></i>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-center text-gray-800">Galeri</h3>
                    <p class="text-sm text-center text-gray-600">Lihat koleksi foto dan video produk hidroponik
                        kami yang menarik.</p>
                    <div class="mt-6 text-center">
                        <a href="#galeri" class="inline-block text-primary-600 hover:text-primary-700">Lihat
                            Galeri <i class="ml-1 fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="p-6 bg-white shadow-md rounded-xl hover:shadow-xl card-hover">
                    <div
                        class="flex items-center justify-center w-16 h-16 mx-auto mb-6 rounded-full bg-primary-100 text-primary-600">
                        <i class="text-2xl fas fa-handshake"></i>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-center text-gray-800">Layanan</h3>
                    <p class="text-sm text-center text-gray-600">Dapatkan layanan konsultasi dan pengelolaan
                        hidroponik terbaik.</p>
                    <div class="mt-6 text-center">
                        <a href="#layanan" class="inline-block text-primary-600 hover:text-primary-700">Lihat
                            Layanan <i class="ml-1 fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Preview Section -->
    <section id="produk" class="py-10 bg-gray-50">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="text-center mb-7">
                <h2 class="mb-2 text-3xl font-bold text-gray-800">Produk Unggulan</h2>
                <p class="max-w-lg mx-auto text-gray-600">Temukan produk hidroponik terbaik dari kami.</p>
            </div>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($produks as $produk)
                    <div
                        class="p-6 transition bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl card-hover">
                        @if ($produk->gambar_produk)
                            <div class="mb-4 overflow-hidden rounded-lg">
                                <img src="{{ asset('storage/' . $produk->gambar_produk) }}"
                                    alt="{{ $produk->nama_produk }}"
                                    class="object-cover w-full h-48 transition-transform hover:scale-105">
                            </div>
                        @endif
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">{{ $produk->nama_produk }}</h3>
                                <p class="mt-1 text-sm text-gray-500">Stok: {{ $produk->jumlah_stok }}</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <p class="text-lg font-bold text-primary-600">Rp
                                {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
                            <a href="{{ route('login') }}"
                                class="px-3 py-2 text-sm font-medium text-center text-white rounded-full bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300">Login
                                untuk Melihat</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('login') }}"
                    class="px-6 py-3 text-white transition-all rounded-full shadow-md bg-primary-600 hover:bg-primary-700 hover:shadow-lg">
                    Login untuk Melihat Lebih Banyak
                </a>
            </div>
        </div>
    </section>

    <!-- Layanan Preview -->
    <section id="layanan" class="py-10">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="text-center mb-7">
                <h2 class="mb-2 text-3xl font-bold text-gray-800">Layanan Kami</h2>
                <p class="max-w-lg mx-auto text-gray-600">Temukan berbagai layanan hidroponik profesional dari kami.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($layanans as $layanan)
                    <div
                        class="p-6 transition bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl card-hover">
                        @if ($layanan->gambar_layanan)
                            <div class="mb-4 overflow-hidden rounded-lg">
                                <img src="{{ asset('storage/' . $layanan->gambar_layanan) }}"
                                    alt="{{ $layanan->nama_layanan }}"
                                    class="object-cover w-full h-48 transition-transform hover:scale-105">
                            </div>
                        @endif
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">{{ $layanan->nama_layanan }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ $layanan->jenis_layanan }}</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <p class="text-lg font-bold text-primary-600">Rp
                                {{ number_format($layanan->harga_layanan, 0, ',', '.') }}</p>
                            <a href="{{ route('login') }}"
                                class="px-3 py-2 text-sm font-medium text-center text-white rounded-full bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300">Login
                                untuk Melihat</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('login') }}"
                    class="px-6 py-3 text-white transition-all rounded-full shadow-md bg-primary-600 hover:bg-primary-700 hover:shadow-lg">
                    Login untuk Menggunakan Layanan
                </a>
            </div>
        </div>
    </section>

    <!-- Edukasi Preview -->
    <section id="edukasi" class="py-10 bg-gray-50">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="text-center mb-7">
                <h2 class="mb-2 text-3xl font-bold text-gray-800">Edukasi Hidroponik</h2>
                <p class="max-w-lg mx-auto text-gray-600">Pelajari teknik dan pengetahuan tentang hidroponik dari ahli
                    kami.</p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                <!-- Artikel Preview -->
                <div class="p-6 transition bg-white shadow-md rounded-xl hover:shadow-xl card-hover">
                    <h3 class="mb-4 text-2xl font-bold text-gray-800">Artikel Edukatif</h3>
                    <p class="mb-6 text-gray-600">Perluas wawasan hidroponik Anda dengan artikel informatif dari kami.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($artikels->take(2) as $artikel)
                            <div class="flex items-start gap-4 p-3 rounded-lg bg-gray-50">
                                @if ($artikel->gambar)
                                    <div class="w-1/2 h-16 overflow-hidden rounded">
                                        <img src="{{ asset('storage/' . $artikel->gambar) }}"
                                            alt="{{ $artikel->judul }}" class="object-cover w-full h-full">
                                    </div>
                                @endif
                                <div>
                                    <h4 class="font-medium text-gray-800 line-clamp-1">{{ $artikel->judul }}</h4>
                                    <p class="text-sm text-gray-500 line-clamp-2">{{ $artikel->ringkasan }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6 text-center">
                        <a href="{{ route('login') }}" class="inline-block text-primary-600 hover:text-primary-700">
                            Login untuk Membaca <i class="ml-1 fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Video Preview -->
                <div class="p-6 transition bg-white shadow-md rounded-xl hover:shadow-xl card-hover">
                    <h3 class="mb-4 text-2xl font-bold text-gray-800">Video Edukasi</h3>
                    <p class="mb-6 text-gray-600">Pelajari teknik hidroponik dengan video tutorial praktis dari ahli
                        kami.</p>

                    @if (count($videos) > 0)
                        <div class="overflow-hidden rounded-lg">
                            <img src="https://img.youtube.com/vi/{{ $videos[0]->youtube_id }}/mqdefault.jpg"
                                class="object-cover w-full h-48 transition-transform hover:scale-105"
                                alt="{{ $videos[0]->judul }}">
                        </div>
                        <h4 class="mt-3 font-medium text-gray-800">{{ $videos[0]->judul }}</h4>
                        <p class="mt-1 text-sm text-gray-500 line-clamp-2">{{ $videos[0]->deskripsi }}</p>
                    @endif

                    <div class="mt-6 text-center">
                        <a href="{{ route('login') }}" class="inline-block text-primary-600 hover:text-primary-700">
                            Login untuk Menonton <i class="ml-1 fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Preview -->
    <section id="galeri" class="py-10">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="text-center mb-7">
                <h2 class="mb-2 text-3xl font-bold text-gray-800">Galeri Hidroponik</h2>
                <p class="max-w-lg mx-auto text-gray-600">Lihat koleksi foto produk hidroponik terbaik dari kami.</p>
            </div>

            <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                @foreach ($galeris->take(4) as $galeri)
                    <div class="overflow-hidden rounded-lg shadow-md group">
                        @if ($galeri->gambar)
                            <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="{{ $galeri->judul }}"
                                class="object-cover w-full h-64 transition-transform group-hover:scale-105">
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('login') }}"
                    class="px-6 py-3 text-white transition-all rounded-full shadow-md bg-primary-600 hover:bg-primary-700 hover:shadow-lg">
                    Login untuk Melihat Galeri Lengkap
                </a>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="tentang" class="py-10 bg-gray-50">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="text-center mb-7">
                <h2 class="mb-2 text-3xl font-bold text-gray-800">Tentang Kami</h2>
                <p class="max-w-lg mx-auto text-gray-600">Mengenal lebih dekat CV. Hidroponik Jember</p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                <div class="overflow-hidden rounded-lg shadow-lg">
                    <img src="{{ asset('images/Landing Page.png') }}" alt="CV. Hidroponik Jember"
                        class="object-cover w-full h-full">
                </div>
                <div class="flex flex-col justify-center">
                    <h3 class="mb-4 text-2xl font-bold text-gray-800">CV. Hidroponik Jember</h3>
                    <p class="mb-4 text-gray-600">
                        CV. Hidroponik Jember adalah perusahaan yang bergerak di bidang pertanian hidroponik
                        yang berlokasi di Jember, Jawa Timur. Kami menyediakan berbagai produk hidroponik
                        berkualitas tinggi, mulai dari sayuran segar hingga peralatan hidroponik.
                    </p>
                    <p class="mb-4 text-gray-600">
                        Dengan pengalaman bertahun-tahun, kami berkomitmen untuk menyediakan produk dan layanan
                        terbaik untuk kepuasan pelanggan. Kami juga aktif dalam memberikan edukasi tentang
                        hidroponik kepada masyarakat.
                    </p>
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex items-center justify-center w-10 h-10 rounded-full bg-primary-100 text-primary-600">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <p class="text-gray-600">Jl. Mastrip, Jember, Jawa Timur</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="flex items-center justify-center w-10 h-10 rounded-full bg-primary-100 text-primary-600">
                                <i class="fas fa-phone"></i>
                            </div>
                            <p class="text-gray-600">+62 123-4567-8900</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="flex items-center justify-center w-10 h-10 rounded-full bg-primary-100 text-primary-600">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <p class="text-gray-600">info@cvhidroponikjember.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-primary-600">
        <div class="px-4 mx-auto text-center max-w-7xl">
            <h2 class="mb-4 text-3xl font-bold text-white">Bergabunglah Bersama Kami</h2>
            <p class="max-w-lg mx-auto mb-8 text-primary-50">Daftarkan akun Anda dan jelajahi dunia hidroponik bersama
                AgroMart. Akses produk, edukasi, dan layanan terbaik kami.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('login') }}"
                    class="px-8 py-3 text-base font-medium transition-all bg-white rounded-full shadow-lg text-primary-600 hover:bg-gray-100 hover:shadow-xl">
                    Login Sekarang
                </a>
                <a href="{{ route('register') }}"
                    class="px-8 py-3 text-base font-medium text-white transition-all border-2 rounded-full border-white/80 hover:bg-white/10">
                    Daftar Akun Baru
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <x-footer></x-footer>

    <script>
        // Simple scroll behavior for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80, // Offset for fixed header
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html>
