<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pesananku - AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="images/icon-40x40.png">
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&family=Signika:wght@300..700&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
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
                            950: '#052e16',
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        display: ['Signika', 'sans-serif'],
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
            animation: fadeIn 0.8s ease-out forwards;
        }

        .animate-fadeOut {
            animation: fadeOut 0.3s ease-out forwards;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Filter animation styles */
        .order-card {
            transition: all 0.4s ease-in-out;
            transform-origin: center;
            backface-visibility: hidden;
        }

        .order-card.hidden-card {
            opacity: 0;
            transform: scale(0.95);
            height: 0;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .order-card.showing-card {
            animation: cardAppear 0.5s ease-out forwards;
        }

        @keyframes cardAppear {
            from {
                opacity: 0;
                transform: translateY(10px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Active filter button animation */
        .filter-btn {
            transition: all 0.3s ease;
            position: relative;
        }

        .filter-btn::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background-color: #16a34a;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .filter-btn.active::after {
            width: 80%;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen font-sans bg-gray-50">
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
                                Pengaturan Akun
                            </a>
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('profile.adminshowuser') }}"
                                    class="flex items-center gap-2 px-4 py-3 text-sm transition-colors hover:bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        fill="currentColor" class="text-gray-600" viewBox="0 0 16 16">
                                        <path
                                            d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                                    </svg>
                                    Manajemen Pengguna
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
    <main class="flex-grow max-w-screen-xl px-4 py-8 mx-auto">
        <div class="flex flex-col mb-8 md:flex-row md:justify-between md:items-center">
            <div class="mt-4 md:mt-0">
                <div class="mt-4 md:mt-0">
                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <button type="button" data-filter="all"
                            class="filter-btn px-4 py-2 text-sm font-medium rounded-l-lg {{ !request()->has('status') ? 'active text-white bg-primary-600 hover:bg-primary-700' : 'text-gray-700 bg-white border-t border-b border-l border-gray-200 hover:bg-gray-100' }}">
                            Semua
                        </button>
                        <button type="button" data-filter="Diproses"
                            class="filter-btn px-4 py-2 text-sm font-medium border-t border-b border-r border-gray-200 {{ request()->get('status') === 'Diproses' ? 'active text-white bg-primary-600 hover:bg-primary-700' : 'text-gray-700 bg-white hover:bg-gray-100' }}">
                            Diproses
                        </button>
                        <button type="button" data-filter="Dikirim"
                            class="filter-btn px-4 py-2 text-sm font-medium border-t border-b border-r border-gray-200 {{ request()->get('status') === 'Dikirim' ? 'active text-white bg-primary-600 hover:bg-primary-700' : 'text-gray-700 bg-white hover:bg-gray-100' }}">
                            Dikirim
                        </button>
                        <button type="button" data-filter="Diterima"
                            class="filter-btn px-4 py-2 text-sm font-medium border-t border-b border-r border-gray-200 rounded-r-lg {{ request()->get('status') === 'Diterima' ? 'active text-white bg-primary-600 hover:bg-primary-700' : 'text-gray-700 bg-white hover:bg-gray-100' }}">
                            Diterima
                        </button>
                        <button type="button" data-filter="Selesai"
                            class="filter-btn px-4 py-2 text-sm font-medium border-t border-b border-r border-gray-200 rounded-r-lg {{ request()->get('status') === 'Diterima' ? 'active text-white bg-primary-600 hover:bg-primary-700' : 'text-gray-700 bg-white hover:bg-gray-100' }}">
                            Selesai
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="flex items-center p-4 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="flex items-center p-4 mb-6 text-red-800 bg-red-100 border border-red-200 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('error') }}
            </div>
        @endif

        @if ($pesanans->isEmpty())
            <div class="flex flex-col items-center justify-center p-10 text-center bg-white rounded-lg shadow-sm">
                <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mb-2 text-xl font-medium text-gray-800">Belum Ada Pesanan</h3>
                <p class="mb-6 text-gray-500">Anda belum memiliki pesanan apapun.</p>
                <a href="{{ route('produk.index') }}"
                    class="px-6 py-2 text-white transition-colors rounded-md bg-primary-600 hover:bg-primary-700">
                    Belanja Sekarang
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3" id="pesanan-container">
                @foreach ($pesanans as $pesanan)
                    <div class="overflow-hidden transition-shadow bg-white rounded-lg shadow-sm order-card hover:shadow-md"
                        data-order-status="{{ $pesanan->status }}">
                        <div class="p-4 border-b border-gray-100">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-500">No. Pesanan
                                    <span class="font-bold">{{ $pesanan->id_pesanan }}</span></span>
                                <span
                                    class="px-3 py-1 text-xs font-medium rounded-full
                                    @if ($pesanan->status === 'Menunggu Konfirmasi') bg-yellow-100 text-yellow-800
                                    @elseif($pesanan->status === 'Diproses') bg-blue-100 text-blue-800
                                    @elseif($pesanan->status === 'Dikirim') bg-indigo-100 text-indigo-800
                                    @elseif($pesanan->status === 'Diterima') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $pesanan->status }}
                                </span>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex">
                                <img src="{{ asset('storage/' . $pesanan->produk->gambar_produk ?? 'images/default-product.png') }}"
                                    alt="{{ $pesanan->produk->nama_produk }}"
                                    class="object-cover w-24 h-24 rounded-md">
                                <div class="flex-1 ml-4">
                                    <h3 class="text-lg font-medium text-gray-800">{{ $pesanan->produk->nama_produk }}
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">Jumlah: {{ $pesanan->jumlah }} item</p>
                                    <div class="mt-2">
                                        <span class="text-xl font-bold text-primary-600">
                                            Rp {{ number_format($pesanan->total, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 border-t border-gray-100 bg-gray-50">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">
                                    {{ $pesanan->created_at->format('d M Y, H:i') }}
                                </span>
                                <button onclick="showOrderDetail({{ $pesanan->id_pesanan }})"
                                    class="px-3 py-1 ml-1 text-xs font-medium transition-colors rounded-md text-primary-700 bg-primary-100 hover:bg-primary-200">
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Lihat Detail Pesanan
                                    </span>
                                </button>
                            </div>
                            @if ($pesanan->status === 'Diterima')
                                <form action="{{ route('pesananku.konfirmasi', $pesanan->id_pesanan) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full px-4 py-2 mt-2 text-sm font-medium text-white transition-colors rounded-md bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        Selesaikan Pesanan
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Empty state message when no orders match filter -->
            <div
                class="flex flex-col items-center justify-center hidden p-10 mt-8 text-center bg-white rounded-lg shadow-sm empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mb-4 text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mb-2 text-xl font-medium text-gray-800">Tidak Ada Pesanan</h3>
                <p class="mb-6 text-gray-500">Tidak ada pesanan dengan status yang dipilih.</p>
                <button type="button" data-filter="all"
                    class="px-6 py-2 text-white transition-colors rounded-md filter-btn bg-primary-600 hover:bg-primary-700">
                    Lihat Semua Pesanan
                </button>
            </div>

            <div class="mt-8 text-center" id="pagination-container">
                {{ $pesanans->links() }}
            </div>

            <!-- Modal Detail Pesanan -->
            <div id="orderDetailModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen p-4 text-center">
                    <!-- Overlay -->
                    <div id="orderModalOverlay" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75">
                    </div>

                    <!-- Modal Panel -->
                    <div
                        class="relative z-10 w-full max-w-lg px-4 py-5 overflow-hidden transition-all transform bg-white rounded-lg shadow-xl sm:p-6">
                        <!-- Modal Header -->
                        <div class="flex items-start justify-between pb-3 mb-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900" id="modal-title">
                                No. Pesanan <span id="orderDetailId" class="font-bold"></span>
                            </h3>
                            <button id="closeOrderModal" class="text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Tutup</span>
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Loading State -->
                        <div id="orderDetailLoading" class="py-8 text-center">
                            <svg class="inline w-8 h-8 mr-2 text-gray-200 animate-spin fill-primary-600"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                            <p class="mt-2 text-gray-500">Memuat detail pesanan...</p>
                        </div>

                        <!-- Content -->
                        <div id="orderDetailContent" class="hidden mt-4">
                            <div class="space-y-4">
                                <!-- Status -->
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-500">Status:</span>
                                    <span id="orderDetailStatus"
                                        class="px-3 py-1 text-xs font-medium rounded-full"></span>
                                </div>

                                <!-- Product Details -->
                                <div class="p-4 rounded-lg bg-gray-50">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <img id="orderDetailImage" src="" alt="Product Image"
                                                class="object-cover w-16 h-16 rounded-md">
                                        </div>
                                        <div class="flex-1 ml-4">
                                            <h4 id="orderDetailProduct" class="text-base font-medium text-gray-900">
                                            </h4>
                                            <p class="mt-1 text-sm text-gray-500">
                                                <span id="orderDetailQuantity"></span> item x
                                                <span id="orderDetailPrice"></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Info -->
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500">Tanggal Pemesanan:</span>
                                        <span id="orderDetailDate" class="text-sm text-gray-900"></span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500">Metode Pembayaran:</span>
                                        <span id="orderDetailPayment"
                                            class="text-sm font-medium text-gray-900"></span>
                                    </div>

                                    <div class="flex items-start justify-between">
                                        <span class="text-sm text-gray-500">Alamat Pengiriman:</span>
                                        <span id="orderDetailAddress" class="text-sm text-right text-gray-900"
                                            style="max-width: 65%;"></span>
                                    </div>
                                </div>

                                <!-- Payment Details -->
                                <div class="p-4 space-y-2 rounded-lg bg-gray-50">
                                    <h4 class="mb-2 text-sm font-medium text-gray-700">Rincian Pembayaran</h4>

                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500">Subtotal Produk:</span>
                                        <span id="orderDetailSubtotal" class="text-sm text-gray-900"></span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500">Ongkos Kirim:</span>
                                        <span id="orderDetailShipping" class="text-sm text-gray-900"></span>
                                    </div>

                                    <div class="flex justify-between pt-2 mt-2 border-t border-gray-200">
                                        <span class="text-sm font-medium text-gray-700">Total Pembayaran:</span>
                                        <span id="orderDetailTotal" class="font-bold text-md text-primary-600"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4">
                                <div class="flex justify-end">
                                    <button id="closeOrderModalBtn"
                                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        Tutup
                                    </button>
                                    <div id="orderDetailActionContainer" class="hidden ml-3">
                                        <form id="orderDetailForm" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="px-4 py-2 text-sm font-medium text-white rounded-md bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                                Selesaikan Pesanan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </main>
    <x-footer />
    <script>
        // Store the orders data from PHP to be accessible in JavaScript
        const pesananData = @json($pesanans);

        // Modal elements
        const modal = document.getElementById('orderDetailModal');
        const modalOverlay = document.getElementById('orderModalOverlay');
        const closeModalBtn = document.getElementById('closeOrderModal');
        const closeModalBtnFooter = document.getElementById('closeOrderModalBtn');
        const loadingContent = document.getElementById('orderDetailLoading');
        const detailContent = document.getElementById('orderDetailContent');

        // Detail elements
        const orderIdElement = document.getElementById('orderDetailId');
        const orderStatusElement = document.getElementById('orderDetailStatus');
        const orderImageElement = document.getElementById('orderDetailImage');
        const orderProductElement = document.getElementById('orderDetailProduct');
        const orderQuantityElement = document.getElementById('orderDetailQuantity');
        const orderPriceElement = document.getElementById('orderDetailPrice');
        const orderDateElement = document.getElementById('orderDetailDate');
        const orderPaymentElement = document.getElementById('orderDetailPayment');
        const orderAddressElement = document.getElementById('orderDetailAddress');
        const orderSubtotalElement = document.getElementById('orderDetailSubtotal');
        const orderShippingElement = document.getElementById('orderDetailShipping');
        const orderTotalElement = document.getElementById('orderDetailTotal');
        const orderActionContainer = document.getElementById('orderDetailActionContainer');
        const orderForm = document.getElementById('orderDetailForm');

        // Functions to show and hide the modal
        function showOrderDetail(orderId) {
            // Find the order in our data
            const order = pesananData.data.find(p => p.id_pesanan == orderId);

            if (!order) {
                console.error('Order not found:', orderId);
                return;
            }

            // Show loading first
            modal.classList.remove('hidden');
            loadingContent.classList.remove('hidden');
            detailContent.classList.add('hidden');

            // Simulate loading (you can remove this setTimeout if not needed)
            setTimeout(() => {
                // Hide loading and show content
                loadingContent.classList.add('hidden');
                detailContent.classList.remove('hidden');

                // Populate the modal with order details
                orderIdElement.textContent = order.id_pesanan;

                // Set status with appropriate color
                orderStatusElement.textContent = order.status;
                if (order.status === 'Menunggu Konfirmasi') {
                    orderStatusElement.className =
                        'px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800';
                } else if (order.status === 'Diproses') {
                    orderStatusElement.className =
                        'px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800';
                } else if (order.status === 'Dikirim') {
                    orderStatusElement.className =
                        'px-3 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-800';
                } else if (order.status === 'Diterima') {
                    orderStatusElement.className =
                        'px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800';
                } else {
                    orderStatusElement.className =
                        'px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800';
                }

                // Set product details
                const productImage = order.produk.gambar_produk ?
                    `/storage/${order.produk.gambar_produk}` :
                    '/images/default-product.png';
                orderImageElement.src = productImage;
                orderImageElement.alt = order.produk.nama_produk;

                orderProductElement.textContent = order.produk.nama_produk;
                orderQuantityElement.textContent = order.jumlah;
                orderPriceElement.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(order.produk
                    .harga_produk);

                // Set order info
                const orderDate = new Date(order.created_at);
                orderDateElement.textContent = orderDate.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });

                orderPaymentElement.textContent = order.pembayaran || 'Transfer Bank';
                if (order.alamat) {
                    try {
                        // Debug untuk membantu troubleshooting
                        console.log('Alamat data:', order.alamat);

                        let addressHTML = '';

                        // Menampilkan nama jalan dan detail alamat pada baris pertama
                        const mainAddress = [];
                        if (order.alamat.nama_jalan) {
                            mainAddress.push(order.alamat.nama_jalan);
                        }
                        if (order.alamat.detail_alamat) {
                            mainAddress.push(order.alamat.detail_alamat);
                        }

                        if (mainAddress.length > 0) {
                            addressHTML += mainAddress.join(', ');
                        }

                        // Menampilkan kecamatan dan kabupaten/kota pada baris kedua
                        const areaAddress = [];
                        if (order.alamat.kecamatan && order.alamat.kecamatan.nama_kecamatan) {
                            areaAddress.push(`Kec. ${order.alamat.kecamatan.nama_kecamatan}`);
                        }
                        if (order.alamat.kabupaten_kota && order.alamat.kabupaten_kota.nama_kabupaten_kota) {
                            areaAddress.push(order.alamat.kabupaten_kota.nama_kabupaten_kota);
                        }

                        // Jika ada data area, tambahkan ke HTML dengan line break
                        if (areaAddress.length > 0) {
                            if (addressHTML) addressHTML += '<br>';
                            addressHTML += areaAddress.join(', ');
                        }

                        // Tambahkan kode pos jika ada
                        if (order.alamat.kode_pos && order.alamat.kode_pos.kode) {
                            if (addressHTML) addressHTML += ' ';
                            addressHTML += order.alamat.kode_pos.kode;
                        } else if (order.alamat.kode_pos && order.alamat.kode_pos.kode_pos) {
                            if (addressHTML) addressHTML += ' ';
                            addressHTML += order.alamat.kode_pos.kode_pos;
                        }

                        // Set alamat lengkap ke element HTML
                        if (addressHTML) {
                            orderAddressElement.innerHTML = addressHTML;
                        } else {
                            orderAddressElement.textContent = 'Alamat tidak lengkap';
                        }
                    } catch (error) {
                        console.error('Error formatting address:', error);
                        orderAddressElement.textContent = 'Alamat tidak dapat ditampilkan dengan benar';
                    }
                } else {
                    orderAddressElement.textContent = 'Alamat tidak tersedia';
                }

                // Calculate subtotal (price * quantity)
                const subtotal = order.produk.harga_produk * order.jumlah;

                // Calculate shipping (assuming shipping fee is stored in order.ongkir or default to 10000)
                const shippingFee = order.ongkir || 10000;

                // Format and display payment details
                orderSubtotalElement.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal);
                orderShippingElement.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(shippingFee);
                orderTotalElement.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(order.total);

                // Show action button if status is "Diterima"
                if (order.status === 'Diterima') {
                    orderActionContainer.classList.remove('hidden');
                    orderForm.action = `/pesananku/konfirmasi/${order.id_pesanan}`;
                } else {
                    orderActionContainer.classList.add('hidden');
                }
            }, 500);
        }

        function closeModal() {
            modal.classList.add('hidden');
        }

        // Event listeners for closing the modal
        closeModalBtn.addEventListener('click', closeModal);
        closeModalBtnFooter.addEventListener('click', closeModal);
        modalOverlay.addEventListener('click', closeModal);

        // Close modal when Escape key is pressed
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });

        // Filter functionality with smooth animations
        document.addEventListener('DOMContentLoaded', function() {
            // Get all filter buttons
            const filterButtons = document.querySelectorAll('.filter-btn');

            // Add click event to each button
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const filterValue = this.getAttribute('data-filter');

                    // Update active state for buttons
                    filterButtons.forEach(btn => {
                        btn.classList.remove('active', 'text-white', 'bg-primary-600');
                        btn.classList.add('text-gray-700', 'bg-white');
                    });

                    this.classList.remove('text-gray-700', 'bg-white');
                    this.classList.add('active', 'text-white', 'bg-primary-600');

                    // Filter orders with animation
                    filterOrdersWithAnimation(filterValue);

                    // Update URL without page reload
                    updateUrlParameter('status', filterValue === 'all' ? null : filterValue);
                });
            });

            function filterOrdersWithAnimation(filterValue) {
                const orderCards = document.querySelectorAll('.order-card');
                let visibleCount = 0;

                orderCards.forEach(card => {
                    const status = card.getAttribute('data-order-status');

                    // Check if the card should be visible
                    const shouldBeVisible = filterValue === 'all' || status === filterValue;

                    if (shouldBeVisible) {
                        // If it was hidden before, animate it back in
                        if (card.classList.contains('hidden-card')) {
                            card.classList.remove('hidden-card');
                            card.classList.add('showing-card');

                            // Remove the animation class after it completes
                            setTimeout(() => {
                                card.classList.remove('showing-card');
                            }, 500);
                        }
                        visibleCount++;
                    } else {
                        // Animate it out
                        card.classList.add('hidden-card');
                    }
                });

                // Show/hide empty state message
                const emptyStateElement = document.querySelector('.empty-state');
                const paginationContainer = document.getElementById('pagination-container');

                if (visibleCount === 0) {
                    emptyStateElement.classList.remove('hidden');
                    emptyStateElement.classList.add('showing-card');
                    if (paginationContainer) paginationContainer.classList.add('hidden');
                } else {
                    emptyStateElement.classList.add('hidden');
                    if (paginationContainer) paginationContainer.classList.remove('hidden');
                }
            }

            function updateUrlParameter(param, value) {
                const url = new URL(window.location.href);

                if (value === null) {
                    url.searchParams.delete(param);
                } else {
                    url.searchParams.set(param, value);
                }

                // Update URL without refreshing page
                window.history.pushState({}, '', url);
            }

            // Handle empty state "Lihat Semua Pesanan" button click
            const emptyStateButton = document.querySelector('.empty-state .filter-btn');
            if (emptyStateButton) {
                emptyStateButton.addEventListener('click', function() {
                    // Find and click the "Semua" filter button
                    const allFilterButton = document.querySelector('.filter-btn[data-filter="all"]');
                    if (allFilterButton) {
                        allFilterButton.click();
                    }
                });
            }
        });
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
