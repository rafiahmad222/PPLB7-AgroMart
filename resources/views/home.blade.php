<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home - AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="images/icon-40x40.png">
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&display=swap"
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

        /* Styles for notification dropdown */
        .notification-item {
            animation: fadeIn 0.3s ease-out forwards;
        }

        /* Custom scrollbar for notifications list */
        #notificationsList::-webkit-scrollbar {
            width: 6px;
        }

        #notificationsList::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #notificationsList::-webkit-scrollbar-thumb {
            background: #cbcbcb;
            border-radius: 10px;
        }

        #notificationsList::-webkit-scrollbar-thumb:hover {
            background: #a0a0a0;
        }

        /* Notification badge animation when new notification arrives */
        @keyframes pulse-badge {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        .pulse-animation {
            animation: pulse-badge 0.6s ease-in-out;
        }
    </style>
</head>

<body class="text-gray-800 bg-gray-100">
    <header class="sticky top-0 z-50 bg-white shadow-lg">
        <nav class="flex items-center justify-between max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}" class="transition-transform hover:scale-105">
                    <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Logo AgroMart" class="h-12">
                </a>
                <div class="items-center hidden gap-6 text-base font-semibold md:flex text-emerald-700 font-[signika]">
                    <a href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'px-4 py-1.5 text-white font-medium bg-emerald-600 rounded-full' : 'transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4' }}">HOME</a>
                    <div class="relative group">
                        <a href="{{ route('produk.index') }}"
                            class="{{ request()->routeIs('produk.*') ? 'px-4 py-1.5 text-white font-medium bg-emerald-600 rounded-full flex items-center' : 'flex items-center gap-1 transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4' }}">PRODUK</a>
                        <div
                            class="absolute hidden bg-white border rounded-lg shadow-xl w-44 z-5 group-hover:block animate-fadeIn border-emerald-100">
                            @foreach ($kategoris as $kategori)
                                <a href="{{ route('produk.index', $kategori->id_kategori) }}"
                                    class="block px-4 py-2.5 text-sm rounded-md text-emerald-700 hover:bg-emerald-50">
                                    {{ $kategori->nama_kategori }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('edukasi.index') }}"
                        class="{{ request()->routeIs('edukasi.*') ? 'px-4 py-1.5 text-white font-medium bg-emerald-600 rounded-full' : 'transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4' }}">EDUKASI</a>
                    <a href="{{ route('galeri.index') }}"
                        class="{{ request()->routeIs('galeri.*') ? 'px-4 py-1.5 text-white font-medium bg-emerald-600 rounded-full' : 'transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4' }}">GALERI</a>
                    <a href="{{ route('layanan.index') }}"
                        class="{{ request()->routeIs('layanan.*') ? 'px-4 py-1.5 text-white font-medium bg-emerald-600 rounded-full' : 'transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4' }}">LAYANAN</a>
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('status.index') }}"
                            class="{{ request()->routeIs('status.*') ? 'px-4 py-1.5 text-white font-medium bg-emerald-600 rounded-full' : 'transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4' }}">TRANSAKSI</a>
                    @else
                        <a href="{{ route('pesananku') }}"
                            class="{{ request()->routeIs('pesananku') ? 'px-4 py-1.5 text-white font-medium bg-emerald-600 rounded-full' : 'transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4' }}">TRANSAKSI</a>
                    @endif
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative" id="notificationContainer">
                    <img src="{{ asset('images/notifIcon.png') }}" alt="Notifikasi"
                        class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90"
                        id="notificationButton">
                    <div class="absolute flex items-center justify-center w-5 h-5 text-xs font-bold text-white transform -translate-y-1/2 rounded-full -right-1 bg-emerald-500 top-1"
                        id="unreadCount">
                        0</div>

                    <!-- Notification Dropdown -->
                    <div id="notificationDropdown"
                        class="absolute right-0 z-50 hidden mt-2 overflow-hidden bg-white rounded-lg shadow-xl w-80 animate-fadeIn">
                        <div class="flex items-center justify-between p-4 border-b">
                            <h3 class="font-semibold text-gray-800">Notifikasi</h3>
                            <button id="markAllAsRead" class="text-sm text-emerald-600 hover:text-emerald-800">Tandai
                                semua dibaca</button>
                        </div>
                        <div id="notificationsList" class="overflow-y-auto max-h-80">
                            <!-- Notifications will be loaded here -->
                            <div id="emptyNotification" class="p-6 text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                    </path>
                                </svg>
                                <p>Tidak ada notifikasi baru</p>
                            </div>
                        </div>
                        <div class="p-3 text-center border-t">
                            <a href="#" class="text-sm text-emerald-600 hover:text-emerald-800">Lihat semua
                                notifikasi</a>
                        </div>
                    </div>
                </div>
                <div id="menuButton" class="relative">
                    <div
                        class="flex items-center gap-3 p-1.5 rounded-full cursor-pointer hover:bg-gray-100 transition-all">
                        <img src="{{ Auth::user()->avatar_url }}" alt="Avatar"
                            class="object-cover w-10 h-10 border-2 rounded-full border-emerald-500">
                        <div class="hidden text-left md:block">
                            <span class="block font-bold text-gray-800">{{ Auth::user()->name }}</span>
                            <small class="text-gray-500">{{ Auth::user()->email }}</small>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="text-gray-500" viewBox="0 0 16 16">
                            <path
                                d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                        </svg>
                    </div>
                    <div id="dropdownUser"
                        class="absolute right-0 z-30 flex-col hidden w-56 mt-2 overflow-hidden bg-white rounded-lg shadow-2xl">
                        <div class="p-4 bg-emerald-50">
                            <p class="font-semibold text-emerald-700">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="border-t">
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-2 px-4 py-3 text-sm transition-colors hover:bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    fill="currentColor" class="text-gray-600" viewBox="0 0 16 16">
                                    <path
                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                </svg>
                                Akun
                            </a>
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('profile.adminshowuser') }}"
                                    class="flex items-center gap-2 px-4 py-3 text-sm transition-colors hover:bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        fill="currentColor" class="text-gray-600" viewBox="0 0 16 16">
                                        <path
                                            d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                                    </svg>
                                    Akun Customer
                                </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                                @csrf
                                <button type="button" id="logoutButton"
                                    class="flex items-center w-full gap-2 px-4 py-3 text-sm text-red-600 transition-colors hover:bg-red-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        fill="currentColor" class="text-red-500" viewBox="0 0 16 16">
                                        <path
                                            d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                                        <path
                                            d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- Modern Hero Section -->
    <section class="mx-2 my-2 relative h-[600px] bg-cover bg-center rounded-xl"
        style="background-image: url('{{ asset('images/Landing Page.png') }}');">
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40 rounded-xl"></div>
        <div class="relative flex flex-col items-start justify-center h-full px-6 mx-auto max-w-7xl lg:px-8">
            <div class="max-w-lg animate-fadeIn">
                <h1 class="text-4xl font-bold leading-tight text-white md:text-5xl lg:text-6xl">CV. Hidroponik
                    Jember</h1>
                <p class="mt-4 text-lg text-gray-200">We all need a little space to grow. Give yourself the space
                    you need to grow your inner you.</p>
                <div class="flex flex-wrap gap-4 mt-8">
                    <a href="#kontak"
                        class="px-8 py-3 text-base font-medium text-white transition-all rounded-full shadow-lg bg-primary-600 hover:bg-primary-700 hover:shadow-xl">Hubungi
                        Kami</a>
                    <a href="#produk"
                        class="px-8 py-3 text-base font-medium text-white transition-all rounded-full bg-white/20 backdrop-blur-sm hover:bg-white/30">Lihat
                        Produk</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Elegant Features Section -->
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
                        <a href="{{ route('produk.index') }}"
                            class="inline-block text-primary-600 hover:text-primary-700">Lihat
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
                        <a href="{{ route('edukasi.index') }}"
                            class="inline-block text-primary-600 hover:text-primary-700">Pelajari
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
                        <a href="{{ route('galeri.index') }}"
                            class="inline-block text-primary-600 hover:text-primary-700">Lihat
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
                        <a href="{{ route('layanan.index') }}"
                            class="inline-block text-primary-600 hover:text-primary-700">Lihat
                            Layanan <i class="ml-1 fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modern Produk Carousel with Hover-visible Navigation -->
    <section class="py-5">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="text-center mb-7">
                <h2 class="mb-2 text-3xl font-bold text-gray-800">Produk Terbaru</h2>
                <p class="max-w-lg mx-auto text-gray-600">Temukan produk hidroponik terbaru dan terbaik dari kami.</p>
            </div>

            <div id="carouselContainer" class="relative overflow-hidden group">
                <div class="absolute inset-0 z-10 pointer-events-none" style="width: 100%;"></div>

                <div id="produkCarousel" class="flex transition-transform duration-500 ease-in-out">
                    @foreach ($produks as $produk)
                        <div class="flex-none w-full p-4 sm:w-1/2 md:w-1/3">
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
                                <div class="flex items-center justify-between mt-1">
                                    <p class="text-lg font-bold text-primary-600">Rp
                                        {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
                                    <a href="{{ route('produk.show', $produk->id_produk) }}"
                                        class="px-3 py-2 text-sm font-medium text-center text-white rounded-full bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Buttons with Opacity Transition -->
                <div
                    class="absolute inset-y-0 left-0 z-20 flex items-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                    <button id="prevCarousel"
                        class="flex items-center justify-center w-10 h-10 ml-2 text-white transition-transform -translate-y-1/2 rounded-full bg-primary-600/80 hover:bg-primary-700 hover:shadow-lg hover:scale-110">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                </div>
                <div
                    class="absolute inset-y-0 right-0 z-20 flex items-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                    <button id="nextCarousel"
                        class="flex items-center justify-center w-10 h-10 mr-2 text-white transition-transform -translate-y-1/2 rounded-full bg-primary-600/80 hover:bg-primary-700 hover:shadow-lg hover:scale-110">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <!-- Dots Navigation -->
                <div class="flex justify-center mt-2 space-x-2" id="carouselDots">
                    <!-- Dots will be added dynamically by JS -->
                </div>
            </div>
        </div>
    </section>

    <!-- Modern Layanan Carousel with Hover-visible Navigation -->
    <section class="py-5">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="text-center mb-7">
                <h2 class="mb-2 text-3xl font-bold text-gray-800">Layanan Terbaik</h2>
                <p class="max-w-lg mx-auto text-gray-600">Temukan berbagai layanan hidroponik profesional dari kami.
                </p>
            </div>

            <div id="layananCarouselContainer" class="relative overflow-hidden group">
                <div class="absolute inset-0 z-10 pointer-events-none" style="width: 100%;"></div>

                <div id="layananCarousel" class="flex transition-transform duration-500 ease-in-out">
                    @foreach ($layanans as $layanan)
                        <div class="flex-none w-full p-4 sm:w-1/2 md:w-1/3">
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
                                <div class="flex items-center justify-between mt-1">
                                    <p class="text-lg font-bold text-primary-600">Rp
                                        {{ number_format($layanan->harga_layanan, 0, ',', '.') }}</p>
                                    <a href="{{ route('layanan.show', $layanan->id_layanan) }}"
                                        class="px-3 py-2 text-sm font-medium text-center text-white rounded-full bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Buttons with Opacity Transition -->
                <div
                    class="absolute inset-y-0 left-0 z-20 flex items-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                    <button id="prevLayananCarousel"
                        class="flex items-center justify-center w-10 h-10 ml-2 text-white transition-transform -translate-y-1/2 rounded-full bg-primary-600/80 hover:bg-primary-700 hover:shadow-lg hover:scale-110">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                </div>
                <div
                    class="absolute inset-y-0 right-0 z-20 flex items-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                    <button id="nextLayananCarousel"
                        class="flex items-center justify-center w-10 h-10 mr-2 text-white transition-transform -translate-y-1/2 rounded-full bg-primary-600/80 hover:bg-primary-700 hover:shadow-lg hover:scale-110">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <!-- Dots Navigation -->
                <div class="flex justify-center mt-2 space-x-2" id="layananCarouselDots">
                    <!-- Dots will be added dynamically by JS -->
                </div>
            </div>
        </div>
    </section>
    <!-- Modern Artikel Carousel with Hover-visible Navigation -->
    <section class="py-5">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="text-center mb-7">
                <h2 class="mb-2 text-3xl font-bold text-gray-800">Artikel Terbaru</h2>
                <p class="max-w-lg mx-auto text-gray-600">Perluas wawasan hidroponik Anda dengan artikel informatif
                    dari kami.</p>
            </div>

            <div id="artikelCarouselContainer" class="relative overflow-hidden group">
                <div class="absolute inset-0 z-10 pointer-events-none" style="width: 100%;"></div>

                <div id="artikelCarousel" class="flex transition-transform duration-500 ease-in-out">
                    @foreach ($artikels as $artikel)
                        <div class="flex-none w-full p-4 sm:w-1/2 md:w-1/3">
                            <div
                                class="p-6 transition bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl card-hover">
                                @if ($artikel->gambar)
                                    <div class="mb-4 overflow-hidden rounded-lg">
                                        <img src="{{ asset('storage/' . $artikel->gambar) }}"
                                            alt="{{ $artikel->judul }}"
                                            class="object-cover w-full h-48 transition-transform hover:scale-105">
                                    </div>
                                @endif
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800">{{ $artikel->judul }}</h3>
                                        <p class="mt-1 text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($artikel->created_at)->format('d M Y') }} •
                                            {{ $artikel->user->name }}
                                        </p>
                                    </div>
                                </div>
                                <p class="mt-2 text-gray-600 line-clamp-2">{{ $artikel->ringkasan }}</p>
                                <div class="flex items-center justify-end mt-4">
                                    <a href="{{ route('edukasi.show', $artikel->id_artikel) }}"
                                        class="px-3 py-2 text-sm font-medium text-center text-white rounded-full bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300">Baca
                                        Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Buttons with Opacity Transition -->
                <div
                    class="absolute inset-y-0 left-0 z-20 flex items-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                    <button id="prevArtikelCarousel"
                        class="flex items-center justify-center w-10 h-10 ml-2 text-white transition-transform -translate-y-1/2 rounded-full bg-primary-600/80 hover:bg-primary-700 hover:shadow-lg hover:scale-110">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                </div>
                <div
                    class="absolute inset-y-0 right-0 z-20 flex items-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                    <button id="nextArtikelCarousel"
                        class="flex items-center justify-center w-10 h-10 mr-2 text-white transition-transform -translate-y-1/2 rounded-full bg-primary-600/80 hover:bg-primary-700 hover:shadow-lg hover:scale-110">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <!-- Dots Navigation -->
                <div class="flex justify-center mt-2 space-x-2" id="artikelCarouselDots">
                    <!-- Dots will be added dynamically by JS -->
                </div>
            </div>
        </div>
    </section>
    <!-- Modern Video Edukasi Carousel with Hover-visible Navigation -->
    <section class="py-5">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="text-center mb-7">
                <h2 class="mb-2 text-3xl font-bold text-gray-800">Video Edukasi</h2>
                <p class="max-w-lg mx-auto text-gray-600">Pelajari teknik hidroponik dengan video tutorial praktis dari
                    ahli kami.</p>
            </div>

            <div id="videoCarouselContainer" class="relative overflow-hidden group">
                <div class="absolute inset-0 z-10 pointer-events-none" style="width: 100%;"></div>

                <div id="videoCarousel" class="flex transition-transform duration-500 ease-in-out">
                    @foreach ($videos as $video)
                        <div class="flex-none w-full p-4 sm:w-1/2 md:w-1/3">
                            <div
                                class="p-6 transition bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl card-hover">
                                <div class="mb-4 video-thumbnail"
                                    onclick="window.location.href='{{ route('edukasi.index', ['tab' => 'video']) }}#video-{{ $video->id_video }}'">
                                    <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/mqdefault.jpg"
                                        class="object-cover w-full h-48 rounded-lg" alt="{{ $video->judul }}">
                                </div>
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800">{{ $video->judul }}</h3>
                                        <p class="mt-1 text-sm text-gray-500">
                                            {{ $video->created_at->format('d M Y') }} • {{ $video->user->name }}</p>
                                    </div>
                                </div>
                                <p class="mt-2 text-gray-600 line-clamp-2">{{ $video->deskripsi }}</p>
                                <div class="flex items-center justify-end mt-4">
                                    <a href="{{ route('edukasi.index', ['tab' => 'video']) }}#video-{{ $video->id_video }}"
                                        class="px-3 py-2 text-sm font-medium text-center text-white rounded-full bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300">Tonton
                                        Video</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Buttons with Opacity Transition -->
                <div
                    class="absolute inset-y-0 left-0 z-20 flex items-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                    <button id="prevVideoCarousel"
                        class="flex items-center justify-center w-10 h-10 ml-2 text-white transition-transform -translate-y-1/2 rounded-full bg-primary-600/80 hover:bg-primary-700 hover:shadow-lg hover:scale-110">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                </div>
                <div
                    class="absolute inset-y-0 right-0 z-20 flex items-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                    <button id="nextVideoCarousel"
                        class="flex items-center justify-center w-10 h-10 mr-2 text-white transition-transform -translate-y-1/2 rounded-full bg-primary-600/80 hover:bg-primary-700 hover:shadow-lg hover:scale-110">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <!-- Dots Navigation -->
                <div class="flex justify-center mt-2 space-x-2" id="videoCarouselDots">
                    <!-- Dots will be added dynamically by JS -->
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <x-footer></x-footer>
    <!-- Logout Confirmation Modal -->
    <div id="logoutModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div id="logoutModalBackdrop" class="absolute inset-0 bg-black/60"></div>
        <div class="relative w-full max-w-md p-6 mx-4 bg-white rounded-lg shadow-xl">
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor"
                    class="mx-auto mb-4 text-red-500" viewBox="0 0 16 16">
                    <path
                        d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                    <path
                        d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                </svg>
                <h3 class="mb-5 text-lg font-semibold text-gray-800">Konfirmasi Logout</h3>
                <p class="mb-6 text-gray-600">Apakah Anda yakin ingin keluar dari akun ini?</p>
                <div class="flex justify-center space-x-3">
                    <button id="cancelLogout"
                        class="px-4 py-2 font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
                        Batal
                    </button>
                    <button id="confirmLogout"
                        class="px-4 py-2 font-medium text-white bg-red-500 rounded-lg hover:bg-red-600">
                        Ya, Keluar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const menuButton = document.getElementById('menuButton');
        const dropdownUser = document.getElementById('dropdownUser');
        let isDropdownVisible = false;

        menuButton.addEventListener('click', function(e) {
            e.stopPropagation();
            if (!isDropdownVisible) {
                dropdownUser.classList.remove('hidden');
                dropdownUser.classList.remove('animate-fadeOut');
                dropdownUser.classList.add('animate-fadeIn');
                isDropdownVisible = true;
            } else {
                dropdownUser.classList.remove('animate-fadeIn');
                dropdownUser.classList.add('animate-fadeOut');
                setTimeout(() => {
                    dropdownUser.classList.add('hidden');
                    isDropdownVisible = false;
                }, 300);
            }
        });

        document.addEventListener('click', function() {
            if (isDropdownVisible) {
                dropdownUser.classList.remove('animate-fadeIn');
                dropdownUser.classList.add('animate-fadeOut');
                setTimeout(() => {
                    dropdownUser.classList.add('hidden');
                    isDropdownVisible = false;
                }, 300);
            }
        });

        dropdownUser.addEventListener('click', function(e) {
            e.stopPropagation();
        });
        // Carousel Logic
        const carousel = document.getElementById('produkCarousel');
        const prevButton = document.getElementById('prevCarousel');
        const nextButton = document.getElementById('nextCarousel');
        const dotsContainer = document.getElementById('carouselDots');

        let currentIndex = 0;
        const itemsPerPage = 3;
        const totalItems = @json($produks).length;
        const maxIndex = Math.ceil(totalItems / itemsPerPage) - 1;

        // Create dots
        for (let i = 0; i <= maxIndex; i++) {
            const dot = document.createElement('button');
            dot.className = 'w-3 h-3 rounded-full bg-gray-300 hover:bg-primary-500 transition-colors';
            dot.setAttribute('data-index', i);
            dot.addEventListener('click', () => {
                currentIndex = i;
                updateCarousel();
                updateDots();
            });
            dotsContainer.appendChild(dot);
        }

        function updateCarousel() {
            const offset = currentIndex * -100;
            carousel.style.transform = `translateX(${offset}%)`;
        }

        function updateDots() {
            const dots = dotsContainer.querySelectorAll('button');
            dots.forEach((dot, index) => {
                if (index === currentIndex) {
                    dot.classList.remove('bg-gray-300');
                    dot.classList.add('bg-primary-600');
                } else {
                    dot.classList.remove('bg-primary-600');
                    dot.classList.add('bg-gray-300');
                }
            });
        }

        prevButton.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
                updateDots();
            }
        });

        nextButton.addEventListener('click', () => {
            if (currentIndex < maxIndex) {
                currentIndex++;
                updateCarousel();
                updateDots();
            }
        });
        // Logout Confirmation Modal Logic
        const logoutButton = document.getElementById('logoutButton');
        const logoutModal = document.getElementById('logoutModal');
        const logoutModalBackdrop = document.getElementById('logoutModalBackdrop');
        const confirmLogout = document.getElementById('confirmLogout');
        const cancelLogout = document.getElementById('cancelLogout');
        const logoutForm = document.getElementById('logoutForm');

        logoutButton.addEventListener('click', function(e) {
            e.preventDefault();
            logoutModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden'); // Prevent scrolling when modal is open
        });

        function closeLogoutModal() {
            logoutModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        confirmLogout.addEventListener('click', function() {
            logoutForm.submit(); // Submit the logout form
        });

        cancelLogout.addEventListener('click', closeLogoutModal);
        logoutModalBackdrop.addEventListener('click', closeLogoutModal);

        // Initialize
        updateCarousel();
        updateDots();
        // Layanan Carousel Logic
        const layananCarousel = document.getElementById('layananCarousel');
        const prevLayananButton = document.getElementById('prevLayananCarousel');
        const nextLayananButton = document.getElementById('nextLayananCarousel');
        const layananDotsContainer = document.getElementById('layananCarouselDots');

        let currentLayananIndex = 0;
        const layananItemsPerPage = 3;
        const totalLayananItems = @json($layanans).length;
        const maxLayananIndex = Math.ceil(totalLayananItems / layananItemsPerPage) - 1;

        // Create dots for layanan carousel
        for (let i = 0; i <= maxLayananIndex; i++) {
            const dot = document.createElement('button');
            dot.className = 'w-3 h-3 rounded-full bg-gray-300 hover:bg-primary-500 transition-colors';
            dot.setAttribute('data-index', i);
            dot.addEventListener('click', () => {
                currentLayananIndex = i;
                updateLayananCarousel();
                updateLayananDots();
            });
            layananDotsContainer.appendChild(dot);
        }

        function updateLayananCarousel() {
            const offset = currentLayananIndex * -100;
            layananCarousel.style.transform = `translateX(${offset}%)`;
        }

        function updateLayananDots() {
            const dots = layananDotsContainer.querySelectorAll('button');
            dots.forEach((dot, index) => {
                if (index === currentLayananIndex) {
                    dot.classList.remove('bg-gray-300');
                    dot.classList.add('bg-primary-600');
                } else {
                    dot.classList.remove('bg-primary-600');
                    dot.classList.add('bg-gray-300');
                }
            });
        }

        prevLayananButton.addEventListener('click', () => {
            if (currentLayananIndex > 0) {
                currentLayananIndex--;
                updateLayananCarousel();
                updateLayananDots();
            }
        });

        nextLayananButton.addEventListener('click', () => {
            if (currentLayananIndex < maxLayananIndex) {
                currentLayananIndex++;
                updateLayananCarousel();
                updateLayananDots();
            }
        });

        // Initialize layanan carousel
        updateLayananCarousel();
        updateLayananDots();
        // Artikel Carousel Logic
        const artikelCarousel = document.getElementById('artikelCarousel');
        const prevArtikelButton = document.getElementById('prevArtikelCarousel');
        const nextArtikelButton = document.getElementById('nextArtikelCarousel');
        const artikelDotsContainer = document.getElementById('artikelCarouselDots');

        let currentArtikelIndex = 0;
        const artikelItemsPerPage = 3;
        const totalArtikelItems = @json($artikels).length;
        const maxArtikelIndex = Math.ceil(totalArtikelItems / artikelItemsPerPage) - 1;

        // Create dots for artikel carousel
        for (let i = 0; i <= maxArtikelIndex; i++) {
            const dot = document.createElement('button');
            dot.className = 'w-3 h-3 rounded-full bg-gray-300 hover:bg-primary-500 transition-colors';
            dot.setAttribute('data-index', i);
            dot.addEventListener('click', () => {
                currentArtikelIndex = i;
                updateArtikelCarousel();
                updateArtikelDots();
            });
            artikelDotsContainer.appendChild(dot);
        }

        function updateArtikelCarousel() {
            const offset = currentArtikelIndex * -100;
            artikelCarousel.style.transform = `translateX(${offset}%)`;
        }

        function updateArtikelDots() {
            const dots = artikelDotsContainer.querySelectorAll('button');
            dots.forEach((dot, index) => {
                if (index === currentArtikelIndex) {
                    dot.classList.remove('bg-gray-300');
                    dot.classList.add('bg-primary-600');
                } else {
                    dot.classList.remove('bg-primary-600');
                    dot.classList.add('bg-gray-300');
                }
            });
        }

        prevArtikelButton.addEventListener('click', () => {
            if (currentArtikelIndex > 0) {
                currentArtikelIndex--;
                updateArtikelCarousel();
                updateArtikelDots();
            }
        });

        nextArtikelButton.addEventListener('click', () => {
            if (currentArtikelIndex < maxArtikelIndex) {
                currentArtikelIndex++;
                updateArtikelCarousel();
                updateArtikelDots();
            }
        });

        // Initialize artikel carousel
        updateArtikelCarousel();
        updateArtikelDots();

        // Video Carousel Logic
        const videoCarousel = document.getElementById('videoCarousel');
        const prevVideoButton = document.getElementById('prevVideoCarousel');
        const nextVideoButton = document.getElementById('nextVideoCarousel');
        const videoDotsContainer = document.getElementById('videoCarouselDots');

        let currentVideoIndex = 0;
        const videoItemsPerPage = 3;
        const totalVideoItems = @json($videos).length;
        const maxVideoIndex = Math.ceil(totalVideoItems / videoItemsPerPage) - 1;

        // Create dots for video carousel
        for (let i = 0; i <= maxVideoIndex; i++) {
            const dot = document.createElement('button');
            dot.className = 'w-3 h-3 rounded-full bg-gray-300 hover:bg-primary-500 transition-colors';
            dot.setAttribute('data-index', i);
            dot.addEventListener('click', () => {
                currentVideoIndex = i;
                updateVideoCarousel();
                updateVideoDots();
            });
            videoDotsContainer.appendChild(dot);
        }

        function updateVideoCarousel() {
            const offset = currentVideoIndex * -100;
            videoCarousel.style.transform = `translateX(${offset}%)`;
        }

        function updateVideoDots() {
            const dots = videoDotsContainer.querySelectorAll('button');
            dots.forEach((dot, index) => {
                if (index === currentVideoIndex) {
                    dot.classList.remove('bg-gray-300');
                    dot.classList.add('bg-primary-600');
                } else {
                    dot.classList.remove('bg-primary-600');
                    dot.classList.add('bg-gray-300');
                }
            });
        }

        prevVideoButton.addEventListener('click', () => {
            if (currentVideoIndex > 0) {
                currentVideoIndex--;
                updateVideoCarousel();
                updateVideoDots();
            }
        });

        nextVideoButton.addEventListener('click', () => {
            if (currentVideoIndex < maxVideoIndex) {
                currentVideoIndex++;
                updateVideoCarousel();
                updateVideoDots();
            }
        });

        // Initialize video carousel
        updateVideoCarousel();
        updateVideoDots();
        // Notification Logic
        document.addEventListener('DOMContentLoaded', function() {
            const notificationButton = document.getElementById('notificationButton');
            const notificationDropdown = document.getElementById('notificationDropdown');
            const notificationsList = document.getElementById('notificationsList');
            const unreadCount = document.getElementById('unreadCount');
            const markAllAsRead = document.getElementById('markAllAsRead');
            const emptyNotification = document.getElementById('emptyNotification');

            let isNotificationOpen = false;

            // Tampilkan atau sembunyikan dropdown notifikasi
            notificationButton.addEventListener('click', function(e) {
                e.stopPropagation();

                if (!isNotificationOpen) {
                    notificationDropdown.classList.remove('hidden');
                    isNotificationOpen = true;
                    // Load notifications when dropdown is opened
                    loadNotifications();
                } else {
                    notificationDropdown.classList.add('hidden');
                    isNotificationOpen = false;
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function() {
                if (isNotificationOpen) {
                    notificationDropdown.classList.add('hidden');
                    isNotificationOpen = false;
                }
            });

            notificationDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });

            // Function to load notifications from backend
            function loadNotifications() {
                fetch('/notifications')
                    .then(response => response.json())
                    .then(data => {
                        displayNotifications(data.data);
                        getUnreadCount();
                    })
                    .catch(error => {
                        console.error('Error fetching notifications:', error);
                    });
            }

            // Function to get unread notification count
            function getUnreadCount() {
                fetch('/notifications/unread-count')
                    .then(response => response.json())
                    .then(data => {
                        const count = data.count;
                        unreadCount.textContent = count;

                        // Hide unread badge if count is 0
                        if (count === 0) {
                            unreadCount.classList.add('hidden');
                        } else {
                            unreadCount.classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching unread count:', error);
                    });
            }

            // Function to display notifications
            function displayNotifications(notifications) {
                // Clear previous notifications except the empty state
                const notificationItems = notificationsList.querySelectorAll('.notification-item');
                notificationItems.forEach(item => item.remove());

                // Show empty state if no notifications
                if (notifications.length === 0) {
                    emptyNotification.classList.remove('hidden');
                    return;
                }

                // Hide empty state if there are notifications
                emptyNotification.classList.add('hidden');

                // Add notifications to the list
                notifications.forEach(notification => {
                    const notificationItem = createNotificationItem(notification);
                    notificationsList.insertBefore(notificationItem, notificationsList.firstChild);
                });
            }

            // Create notification item element
            function createNotificationItem(notification) {
                const item = document.createElement('div');
                item.className = 'notification-item p-4 border-b hover:bg-gray-50 transition cursor-pointer';
                if (!notification.is_read) {
                    item.classList.add('bg-emerald-50');
                }

                const time = new Date(notification.created_at);
                const formattedTime = time.toLocaleDateString() + ' ' + time.toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });

                // Pilih ikon berdasarkan tipe notifikasi
                let iconMarkup = '<i class="fas fa-info-circle text-emerald-500"></i>'; // default icon

                if (notification.type === 'new_order') {
                    iconMarkup = '<i class="fas fa-shopping-bag text-emerald-500"></i>';
                } else if (notification.type === 'status_update') {
                    iconMarkup = '<i class="fas fa-sync-alt text-emerald-500"></i>';
                }

                item.innerHTML = `
    <div class="flex items-start">
        <div class="flex-shrink-0 mr-3">
            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100">
                ${iconMarkup}
            </div>
        </div>
        <div class="flex-grow">
            <p class="text-sm text-gray-800">${notification.message}</p>
            <p class="mt-1 text-xs text-gray-500">${formattedTime}</p>
        </div>
        ${!notification.is_read ? '<div class="w-2 h-2 mt-2 ml-2 rounded-full bg-emerald-500"></div>' : ''}
    </div>
    `;

                // Mark as read when clicked
                item.addEventListener('click', function() {
                    if (!notification.is_read) {
                        markAsRead(notification.id, item);
                    }

                    // Arahkan pengguna ke halaman yang berbeda berdasarkan tipe notifikasi
                    if (notification.pesanan_id) {
                        // Untuk pelanggan, arahkan berdasarkan tipe notifikasi
                        if (notification.type === 'new_order') {
                            window.location.href = `/status`;
                        } else if (notification.type === 'status_update') {
                            window.location.href = `/pesananku`;
                        }
                    }
                });

                return item;
            }

            // Function to mark a notification as read
            function markAsRead(notificationId, itemElement) {
                fetch(`/notifications/${notificationId}/read`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    })
                    .then(response => response.json())
                    .then(() => {
                        // Update UI
                        itemElement.classList.remove('bg-emerald-50');
                        const dot = itemElement.querySelector('.bg-emerald-500');
                        if (dot) {
                            dot.remove();
                        }
                        getUnreadCount();
                    })
                    .catch(error => {
                        console.error('Error marking notification as read:', error);
                    });
            }

            // Mark all notifications as read
            markAllAsRead.addEventListener('click', function(e) {
                e.preventDefault();

                fetch('/notifications/mark-all-read', {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(() => {
                        // Reload notifications
                        loadNotifications();
                    })
                    .catch(error => {
                        console.error('Error marking all notifications as read:', error);
                    });
            });

            // Load unread count on page load
            getUnreadCount();

            // Set up polling for notifications (every 30 seconds)
            setInterval(getUnreadCount, 30000);
        });
    </script>
</body>

</html>
