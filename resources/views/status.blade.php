<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin - AgroMart</title>
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
            animation: fadeIn 0.4s ease-out forwards;
        }

        .animate-fadeOut {
            animation: fadeOut 0.3s ease-out forwards;
        }

        .tab-active {
            @apply bg-emerald-600 text-white shadow-lg ring-2 ring-emerald-300 ring-offset-2;
        }

        .tab-inactive {
            @apply bg-white text-emerald-700 hover:bg-emerald-50 shadow;
        }

        .status-badge {
            @apply text-sm font-medium px-3 py-1.5 rounded-full;
        }
    </style>
</head>

<body class="bg-gray-50">
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
                <div class="relative">
                    <img src="{{ asset('images/notifIcon.png') }}" alt="Notifikasi"
                        class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90">
                    <div
                        class="absolute flex items-center justify-center w-5 h-5 text-xs font-bold text-white transform -translate-y-1/2 rounded-full -right-1 bg-emerald-500 top-1">
                        3</div>
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

    <div class="max-w-5xl px-4 py-10 mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-emerald-800">Dashboard Admin</h1>
            <p class="text-gray-600">Kelola pesanan dan pantau performa toko</p>
        </div>

        <div class="flex justify-center mb-8 space-x-4 text-lg font-semibold">
            <button id="tabPesanan" class="relative px-8 py-3 transition-all duration-200 rounded-full tab-active">
                <span class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path
                            d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                    </svg>
                    Manajemen Pesanan
                </span>
            </button>
            <button id="tabGrafik" class="relative px-8 py-3 transition-all duration-200 rounded-full tab-inactive">
                <span class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path
                            d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z" />
                    </svg>
                    Grafik Penjualan
                </span>
            </button>
        </div>

        <!-- Content Pesanan -->
        <div id="contentPesanan" class="space-y-8">
            <!-- Stats Cards - Dengan desain yang lebih modern dan responsif -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
                <div class="p-6 transition-all bg-white shadow-sm rounded-xl hover:shadow-md">
                    <div class="flex items-center justify-between mb-2">
                        <div class="font-medium text-gray-600">Total Pesanan</div>
                        <div class="p-2.5 bg-indigo-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="text-indigo-600" viewBox="0 0 16 16">
                                <path
                                    d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                <path
                                    d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 text-2xl font-bold text-gray-800">{{ $allPesanans->count() }}</div>
                    <div class="mt-1 text-sm text-gray-500">Bulan ini</div>
                </div>

                <div class="p-6 transition-all bg-white shadow-sm rounded-xl hover:shadow-md">
                    <div class="flex items-center justify-between mb-2">
                        <div class="font-medium text-gray-600">Diproses</div>
                        <div class="p-2.5 bg-blue-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="text-blue-600" viewBox="0 0 16 16">
                                <path
                                    d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                                <path
                                    d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 text-2xl font-bold text-gray-800">
                        {{ $allPesanans->where('status', 'Diproses')->count() }}
                    </div>
                    <div class="mt-1 text-sm text-gray-500">Menunggu pengiriman</div>
                </div>

                <div class="p-6 transition-all bg-white shadow-sm rounded-xl hover:shadow-md">
                    <div class="flex items-center justify-between mb-2">
                        <div class="font-medium text-gray-600">Dikirim</div>
                        <div class="p-2.5 rounded-lg bg-amber-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="text-amber-600" viewBox="0 0 16 16">
                                <path
                                    d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 text-2xl font-bold text-gray-800">
                        {{ $allPesanans->where('status', 'Dikirim')->count() }}
                    </div>
                    <div class="mt-1 text-sm text-gray-500">Dalam pengiriman</div>
                </div>

                <div class="p-6 transition-all bg-white shadow-sm rounded-xl hover:shadow-md">
                    <div class="flex items-center justify-between mb-2">
                        <div class="font-medium text-gray-600">Diterima</div>
                        <div class="p-2.5 bg-green-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="text-green-600" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 text-2xl font-bold text-gray-800">
                        {{ $allPesanans->where('status', 'Diterima')->count() }}
                    </div>
                    <div class="mt-1 text-sm text-gray-500">Pesanan diterima</div>
                </div>

                <div class="p-6 transition-all bg-white shadow-sm rounded-xl hover:shadow-md">
                    <div class="flex items-center justify-between mb-2">
                        <div class="font-medium text-gray-600">Selesai</div>
                        <div class="p-2.5 bg-purple-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="text-purple-600" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 text-2xl font-bold text-gray-800">
                        {{ $allPesanans->where('status', 'Selesai')->count() }}
                    </div>
                    <div class="mt-1 text-sm text-gray-500">Transaksi selesai</div>
                </div>
            </div>

            <!-- Filter dan Search -->
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <div class="flex flex-wrap items-center gap-3">
                    <div class="relative">
                        <select id="filterStatus"
                            class="pl-4 pr-10 py-2.5 text-sm bg-white border rounded-lg appearance-none border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="">Semua Status</option>
                            <option value="Diproses">Diproses</option>
                            <option value="Dikirim">Dikirim</option>
                            <option value="Diterima">Diterima</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="relative">
                        <select id="filterPengiriman"
                            class="pl-4 pr-10 py-2.5 text-sm bg-white border rounded-lg appearance-none border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="">Semua Pengiriman</option>
                            <option value="wa_jek">Paxel</option>
                            <option value="ambil_ditempat">Ambil di Tempat</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Cari pesanan atau pelanggan..."
                        class="w-full md:w-64 pl-10 pr-4 py-2.5 text-sm border rounded-lg border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <button id="clearSearch"
                        class="absolute inset-y-0 right-0 items-center hidden pr-3 text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Daftar Pesanan - Dengan desain yang lebih modern dan informatif -->
            <div class="space-y-6">
                @foreach ($pesanans as $pesanan)
                    <div
                        class="overflow-hidden transition-all bg-white border border-gray-100 shadow-sm rounded-xl hover:shadow-md">
                        <!-- Header Pesanan -->
                        <div
                            class="flex flex-col justify-between p-5 border-b border-gray-100 md:flex-row md:items-center">
                            <div class="flex items-center gap-4 mb-3 md:mb-0">
                                <img src="{{ asset($pesanan->user->avatar_url ?? 'images/avatar.png') }}"
                                    alt="Avatar"
                                    class="object-cover w-12 h-12 border-2 rounded-full border-emerald-100">
                                <div>
                                    <p class="text-lg font-semibold text-gray-800">{{ $pesanan->user->name }}</p>
                                    <div class="flex items-center gap-1.5 text-sm text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                                            <path
                                                d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                                        </svg>
                                        <span class="truncate">
                                            {{ $pesanan->alamat->detail_alamat }},
                                            {{ $pesanan->alamat->kecamatan->nama_kecamatan }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Pesanan -->
                            <div class="flex flex-col items-end">
                                <div class="mb-1.5 text-sm font-medium text-right text-gray-500">ID:
                                    #{{ substr($pesanan->id_pesanan, 0, 8) }}</div>

                                @if ($pesanan->status === 'Selesai')
                                    <span
                                        class="px-4 py-1.5 text-sm font-medium text-purple-700 bg-purple-100 rounded-full">
                                        <span class="flex items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                            </svg>
                                            Selesai
                                        </span>
                                    </span>
                                @elseif ($pesanan->status === 'Diterima')
                                    <div class="flex items-center space-x-2">
                                        <span
                                            class="px-4 py-1.5 text-sm font-medium text-green-700 bg-green-100 rounded-full">
                                            <span class="flex items-center gap-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path
                                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                                </svg>
                                                Diterima
                                            </span>
                                        </span>
                                        <form
                                            action="{{ route('dashboard.pesanan.updateStatus', $pesanan->id_pesanan) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="Selesai">
                                            <button type="submit"
                                                class="px-3 py-1.5 text-xs font-medium text-purple-700 transition-colors bg-purple-100 rounded-full hover:bg-purple-200 hover:text-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-1">
                                                Selesaikan
                                            </button>
                                        </form>
                                    </div>
                                @elseif ($pesanan->status === 'Dikirim')
                                    <form action="{{ route('dashboard.pesanan.updateStatus', $pesanan->id_pesanan) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()"
                                            class="px-4 py-1.5 text-sm font-medium bg-amber-100 text-amber-700 rounded-full cursor-pointer appearance-none pr-10 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-1">
                                            <option value="Dikirim" selected>Dikirim</option>
                                            <option value="Diterima">Diterima</option>
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </form>
                                @else
                                    <form action="{{ route('dashboard.pesanan.updateStatus', $pesanan->id_pesanan) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()"
                                            class="px-4 py-1.5 text-sm font-medium bg-blue-100 text-blue-700 rounded-full cursor-pointer appearance-none pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                                            <option value="Diproses" selected>Diproses</option>
                                            <option value="Dikirim">Dikirim</option>
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <!-- Detail Pesanan -->
                        <div class="p-5">
                            <div class="flex flex-col items-start gap-6 lg:flex-row">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('storage/' . $pesanan->produk->gambar_produk ?? 'images/default-product.png') }}"
                                        alt="{{ $pesanan->produk->nama_produk }}"
                                        class="object-cover w-24 h-24 border border-gray-100 rounded-lg">
                                </div>

                                <div class="grid flex-1 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-8 gap-y-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Produk</p>
                                        <p class="font-medium text-gray-800 line-clamp-1">
                                            {{ $pesanan->produk->nama_produk }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Jumlah</p>
                                        <p class="font-medium text-gray-800">{{ $pesanan->jumlah }} pcs</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Tanggal Pesan</p>
                                        <p class="font-medium text-gray-800">
                                            {{ $pesanan->created_at->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Pengiriman</p>
                                        <p class="font-medium text-gray-800">
                                            <span class="inline-flex items-center">
                                                @if ($pesanan->pengiriman === 'Paxel')
                                                    <span
                                                        class="inline-block w-2 h-2 mr-2 rounded-full bg-amber-400"></span>
                                                    Paxel
                                                @elseif ($pesanan->pengiriman === 'Ambil Ditempat')
                                                    <span
                                                        class="inline-block w-2 h-2 mr-2 bg-green-400 rounded-full"></span>
                                                    Ambil di Tempat
                                                @else
                                                    {{ $pesanan->pengiriman ?? '-' }}
                                                @endif
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Pembayaran</p>
                                        <p class="font-medium text-gray-800">
                                            <span class="inline-flex items-center">
                                                @if ($pesanan->pembayaran === 'Transfer')
                                                    <span
                                                        class="inline-block w-2 h-2 mr-2 bg-blue-400 rounded-full"></span>
                                                    Transfer
                                                @elseif ($pesanan->pembayaran === 'COD')
                                                    <span
                                                        class="inline-block w-2 h-2 mr-2 bg-indigo-400 rounded-full"></span>
                                                    Cash on Delivery
                                                @else
                                                    {{ $pesanan->pembayaran ?? '-' }}
                                                @endif
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Total Pembayaran</p>
                                        <p class="text-lg font-semibold text-emerald-700">
                                            Rp {{ number_format($pesanan->total, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex flex-col items-end self-stretch justify-between">
                                    <div class="flex items-center gap-1.5 text-xs text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                            fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                            <path
                                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                                        </svg>
                                        {{ $pesanan->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination yang lebih modern -->
            <div class="mt-8">
                <nav class="flex items-center justify-center" aria-label="Pagination">
                    <ul class="inline-flex space-x-1">
                        <li>
                            <a href="#"
                                class="flex items-center justify-center w-10 h-10 text-gray-500 transition-colors bg-white border rounded-lg hover:bg-gray-100">
                                <span class="sr-only">Previous</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center w-10 h-10 font-semibold transition-colors bg-white border rounded-lg text-emerald-600 hover:bg-emerald-50 border-emerald-200">1</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center w-10 h-10 text-gray-500 transition-colors bg-white border rounded-lg hover:bg-gray-100">2</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center w-10 h-10 text-gray-500 transition-colors bg-white border rounded-lg hover:bg-gray-100">3</a>
                        </li>
                        <li>
                            <span class="flex items-center justify-center w-10 h-10 text-gray-400 bg-white">...</span>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center w-10 h-10 text-gray-500 transition-colors bg-white border rounded-lg hover:bg-gray-100">8</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center w-10 h-10 text-gray-500 transition-colors bg-white border rounded-lg hover:bg-gray-100">
                                <span class="sr-only">Next</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Content Grafik -->
        <div id="contentGrafik" class="hidden">
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
                <div
                    class="p-6 transition-shadow duration-300 bg-white border border-gray-100 shadow-md hover:shadow-lg rounded-xl">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-gray-700">Total Pendapatan</h3>
                        <span class="p-2.5 rounded-lg bg-emerald-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                fill="currentColor" class="text-emerald-600" viewBox="0 0 16 16">
                                <path
                                    d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z" />
                            </svg>
                        </span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">Rp
                        {{ number_format((int) str_replace(['Rp', '.'], '', $totalPendapatan), 0, ',', '.') }}</h2>
                    <div class="flex items-center mt-2 text-sm">
                        <span class="flex items-center text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z" />
                            </svg>
                            <span class="ml-1">12% dari bulan lalu</span>
                        </span>
                    </div>
                </div>

                <div
                    class="p-6 transition-shadow duration-300 bg-white border border-gray-100 shadow-md hover:shadow-lg rounded-xl">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-gray-700">Total Pesanan</h3>
                        <span class="p-2.5 bg-blue-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                fill="currentColor" class="text-blue-600" viewBox="0 0 16 16">
                                <path
                                    d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                            </svg>
                        </span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">{{ $allPesanans->count() }}</h2>
                    <div class="flex items-center mt-2 text-sm">
                        <span class="flex items-center text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z" />
                            </svg>
                            <span class="ml-1">8% dari bulan lalu</span>
                        </span>
                    </div>
                </div>

                <div
                    class="p-6 transition-shadow duration-300 bg-white border border-gray-100 shadow-md hover:shadow-lg rounded-xl">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-gray-700">Produk Terjual</h3>
                        <span class="p-2.5 rounded-lg bg-violet-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                fill="currentColor" class="text-violet-600" viewBox="0 0 16 16">
                                <path
                                    d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z" />
                            </svg>
                        </span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">{{ $totalProduk }}</h2>
                    <div class="flex items-center mt-2 text-sm">
                        <span class="flex items-center text-violet-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z" />
                            </svg>
                            <span class="ml-1">15% dari bulan lalu</span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
                <div
                    class="p-6 transition-shadow duration-300 bg-white border border-gray-100 shadow-md hover:shadow-lg md:col-span-2 rounded-xl">
                    <div class="flex flex-col justify-between mb-6 sm:flex-row sm:items-center">
                        <h3 class="mb-3 text-lg font-semibold text-gray-800 sm:mb-0">Tren Penjualan</h3>
                        <div class="flex gap-2">
                            <select id="filterBulan"
                                class="px-3 py-2 text-sm border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                <option value="">Semua Bulan</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                            <select id="filterTahun"
                                class="px-3 py-2 text-sm border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                <option value="">Semua Tahun</option>
                                @foreach ($listTahun as $tahun)
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="p-4 rounded-lg bg-gray-50">
                        <canvas id="chartPenjualan" class="w-full h-64"></canvas>
                    </div>
                </div>

                <!-- Panel Produk Terlaris -->
                <div
                    class="p-6 transition-shadow duration-300 bg-white border border-gray-100 shadow-md hover:shadow-lg rounded-xl">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Produk Terlaris</h3>
                        <span class="p-2.5 bg-amber-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="text-amber-600" viewBox="0 0 16 16">
                                <path
                                    d="M2 2v2h2V2H2zm11 0v2h2V2h-2zM4 0a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm10 0a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2h-2zM2 9v2h2V9H2zm-2 2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v2zm13-2v2h2V9h-2zm-2 0a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2z" />
                            </svg>
                        </span>
                    </div>

                    <div class="mt-4 space-y-3">
                        @forelse ($produkTerlaris as $index => $produk)
                            <div
                                class="flex items-center p-3 transition-colors rounded-lg bg-gray-50 hover:bg-gray-100">
                                <div
                                    class="flex items-center justify-center w-8 h-8 mr-4 font-semibold text-white rounded-full
                        {{ $index === 0 ? 'bg-amber-500' : ($index === 1 ? 'bg-gray-400' : ($index === 2 ? 'bg-amber-700' : 'bg-gray-300')) }}">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-800 truncate">{{ $produk->nama_produk }}</p>
                                    <p class="text-sm text-gray-500">{{ $produk->total_terjual }} produk terjual</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-emerald-600">Rp
                                        {{ number_format($produk->total_pendapatan, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="p-4 text-center text-gray-500 rounded-lg bg-gray-50">
                                <p>Belum ada data penjualan</p>
                            </div>
                        @endforelse
                    </div>

                    <a href="{{ route('produk.index') }}"
                        class="flex items-center justify-center w-full px-4 py-2 mt-4 text-sm font-medium transition-colors bg-white border rounded-lg text-emerald-600 border-emerald-200 hover:bg-emerald-50">
                        Lihat semua produk
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="ml-1" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Tambahkan section untuk detail statistik produk -->
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                <div
                    class="overflow-hidden transition-shadow duration-300 bg-white border border-gray-100 shadow-md hover:shadow-lg rounded-xl">
                    <div class="p-5 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-800">Kategori Terlaris</h3>
                            <span class="p-2 bg-indigo-100 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    fill="currentColor" class="text-indigo-600" viewBox="0 0 16 16">
                                    <path
                                        d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z" />
                                    <path
                                        d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="space-y-4">
                            @forelse ($kategoriTerlaris as $kategori)
                                <div class="relative pt-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <div>
                                            <span
                                                class="text-sm font-medium text-gray-700">{{ $kategori->nama_kategori }}</span>
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            {{ $kategori->total_produk }} Pembelian
                                        </div>
                                    </div>
                                    <div class="flex h-2 overflow-hidden text-xs bg-gray-100 rounded">
                                        <div style="width: {{ ($kategori->total_produk / $totalProdukKategori) * 100 }}%"
                                            class="flex flex-col justify-center text-center text-white shadow-none whitespace-nowrap bg-gradient-to-r from-emerald-500 to-emerald-600">
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-4 text-center text-gray-500">
                                    <p>Belum ada data kategori</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div
                    class="overflow-hidden transition-shadow duration-300 bg-white border border-gray-100 shadow-md hover:shadow-lg rounded-xl">
                    <div class="p-5 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-800">Performa Bulanan</h3>
                            <span class="p-2 bg-purple-100 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    fill="currentColor" class="text-purple-600" viewBox="0 0 16 16">
                                    <path
                                        d="M7.5 1.018a7 7 0 0 0-4.79 11.566L7.5 7.793V1.018zm1 0v6.775l4.79 4.79A7 7 0 0 0 8.5 1.018zm4.084 12.273L8.5 9.207v5.775a6.97 6.97 0 0 0 4.084-1.691zM7.5 14.982V9.207l-4.084 4.084A6.97 6.97 0 0 0 7.5 14.982zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-4">
                            @foreach (['Bulan Ini', 'Bulan Lalu', 'Proyeksi'] as $index => $period)
                                <div class="p-3 text-center rounded-lg bg-gray-50">
                                    <p class="text-xs font-medium text-gray-500">{{ $period }}</p>
                                    @if ($index === 0)
                                        <p class="mt-1 text-xl font-bold text-emerald-600">{{ $pesananBulanIni }}</p>
                                    @elseif ($index === 1)
                                        <p class="mt-1 text-xl font-bold text-gray-700">{{ $pesananBulanLalu }}</p>
                                    @else
                                        <p class="mt-1 text-xl font-bold text-purple-600">
                                            @if ($pesananBulanLalu > 0)
                                                {{ round($pesananBulanIni * (1 + ($pesananBulanIni - $pesananBulanLalu) / $pesananBulanLalu)) }}
                                            @else
                                                {{ $pesananBulanIni }}
                                            @endif
                                        </p>
                                    @endif
                                    <p class="mt-1 text-xs text-gray-500">Pesanan</p>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            <p class="mb-2 text-sm font-medium text-gray-700">Performa</p>
                            <div class="overflow-hidden h-2.5 text-xs flex bg-gray-100 rounded-full">
                                @if ($pesananBulanLalu > 0)
                                    @php
                                        $growthPercentage =
                                            (($pesananBulanIni - $pesananBulanLalu) / $pesananBulanLalu) * 100;
                                        $barColor = $growthPercentage >= 0 ? 'bg-emerald-500' : 'bg-red-500';
                                        $barWidth = min(abs($growthPercentage), 100);
                                    @endphp
                                    <div style="width: {{ $barWidth }}%" class="{{ $barColor }}"></div>
                                @else
                                    <div style="width: 50%" class="bg-emerald-500"></div>
                                @endif
                            </div>
                            <p class="mt-2 text-xs font-medium text-gray-500">
                                @if ($pesananBulanLalu > 0)
                                    @php
                                        $growthPercentage =
                                            (($pesananBulanIni - $pesananBulanLalu) / $pesananBulanLalu) * 100;
                                    @endphp

                                    @if ($growthPercentage > 0)
                                        <span class="text-emerald-600">⬆
                                            {{ number_format(abs($growthPercentage), 1) }}% meningkat</span> dari bulan
                                        lalu
                                    @elseif ($growthPercentage < 0)
                                        <span class="text-red-600">⬇ {{ number_format(abs($growthPercentage), 1) }}%
                                            menurun</span> dari bulan lalu
                                    @else
                                        <span class="text-gray-600">⟷ Sama dengan bulan lalu</span>
                                    @endif
                                @else
                                    <span class="text-emerald-600">Data bulan lalu tidak tersedia untuk
                                        perbandingan</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
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
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // User dropdown menu
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

                // Tab Switching
                const tabPesanan = document.getElementById('tabPesanan');
                const tabGrafik = document.getElementById('tabGrafik');
                const contentPesanan = document.getElementById('contentPesanan');
                const contentGrafik = document.getElementById('contentGrafik');

                tabPesanan.addEventListener('click', () => {
                    tabPesanan.classList.add('tab-active');
                    tabPesanan.classList.remove('tab-inactive');
                    tabGrafik.classList.remove('tab-active');
                    tabGrafik.classList.add('tab-inactive');

                    contentPesanan.classList.remove('hidden');
                    contentGrafik.classList.add('hidden');
                });

                tabGrafik.addEventListener('click', () => {
                    tabGrafik.classList.add('tab-active');
                    tabGrafik.classList.remove('tab-inactive');
                    tabPesanan.classList.remove('tab-active');
                    tabPesanan.classList.add('tab-inactive');

                    contentGrafik.classList.remove('hidden');
                    contentPesanan.classList.add('hidden');

                    // Inisialisasi grafik ketika tab grafik dibuka
                    setTimeout(() => {
                        createPenjualanChart();
                    }, 100);
                });

                // Chart.js
                document.addEventListener('DOMContentLoaded', function() {
                    // Chart.js untuk Grafik Penjualan
                    const ctxPenjualan = document.getElementById('chartPenjualan')?.getContext('2d');
                    let chartPenjualanInstance;

                    // Fungsi untuk membuat grafik penjualan (batang)
                    function createPenjualanChart(bulan = '', tahun = '') {
                        if (!ctxPenjualan) return;

                        fetch(`/api/chart-data?bulan=${bulan}&tahun=${tahun}`)
                            .then(res => res.json())
                            .then(data => {
                                if (chartPenjualanInstance) chartPenjualanInstance.destroy();

                                chartPenjualanInstance = new Chart(ctxPenjualan, {
                                    type: 'bar',
                                    data: {
                                        labels: data.labels || ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul',
                                            'Aug',
                                            'Sep', 'Oct', 'Nov', 'Dec'
                                        ],
                                        datasets: [{
                                            label: 'Jumlah Terjual',
                                            data: data.values || [65, 78, 52, 91, 43, 106, 120, 156,
                                                132, 108, 145, 167
                                            ],
                                            backgroundColor: 'rgba(16, 185, 129, 0.7)',
                                            borderColor: 'rgba(16, 185, 129, 1)',
                                            borderWidth: 2,
                                            borderRadius: 4,
                                            barThickness: 'flex',
                                            maxBarThickness: 35
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        plugins: {
                                            legend: {
                                                display: false
                                            },
                                            tooltip: {
                                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                                titleColor: '#fff',
                                                bodyColor: '#fff',
                                                padding: 12,
                                                displayColors: false,
                                                callbacks: {
                                                    label: function(context) {
                                                        return `${context.parsed.y} produk terjual`;
                                                    }
                                                }
                                            }
                                        },
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                grid: {
                                                    display: true,
                                                    color: 'rgba(0, 0, 0, 0.05)'
                                                },
                                                ticks: {
                                                    font: {
                                                        size: 11
                                                    }
                                                }
                                            },
                                            x: {
                                                grid: {
                                                    display: false
                                                },
                                                ticks: {
                                                    font: {
                                                        size: 11
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });
                            })
                            .catch(error => {
                                console.error('Error fetching chart data:', error);
                            });
                    }

                    // Inisialisasi filter untuk grafik
                    const filterBulan = document.getElementById('filterBulan');
                    const filterTahun = document.getElementById('filterTahun');

                    if (filterBulan) {
                        filterBulan.addEventListener('change', function() {
                            const bulan = this.value;
                            const tahun = filterTahun ? filterTahun.value : '';
                            createPenjualanChart(bulan, tahun);
                        });
                    }

                    if (filterTahun) {
                        filterTahun.addEventListener('change', function() {
                            const tahun = this.value;
                            const bulan = filterBulan ? filterBulan.value : '';
                            createPenjualanChart(bulan, tahun);
                        });
                    }

                    // Filter dan Search functionality untuk pesanan
                    const filterStatus = document.getElementById('filterStatus');
                    const filterPengiriman = document.getElementById('filterPengiriman');
                    const searchInput = document.getElementById('searchInput');
                    const clearSearch = document.getElementById('clearSearch');
                    const pesananCards = document.querySelectorAll('.space-y-6 > div');

                    // Fungsi untuk menampilkan atau menyembunyikan pesanan berdasarkan filter
                    function applyFilters() {
                        if (!filterStatus || !filterPengiriman || !searchInput) return;

                        const statusValue = filterStatus.value.toLowerCase();
                        const pengirimanValue = filterPengiriman.value.toLowerCase();
                        const searchValue = searchInput.value.toLowerCase().trim();

                        let visibleCount = 0;

                        pesananCards.forEach(card => {
                            // Ambil atribut data yang diperlukan
                            const status = card.getAttribute('data-status') || '';
                            const pengiriman = card.getAttribute('data-pengiriman') || '';
                            const customerName = card.querySelector('.text-lg.font-semibold')?.textContent
                                .toLowerCase() || '';
                            const produkName = card.querySelector('.line-clamp-1')?.textContent.toLowerCase() || '';
                            const orderId = card.querySelector('.text-right.text-gray-500')?.textContent
                                .toLowerCase() || '';

                            // Cek apakah memenuhi filter status
                            const matchStatus = !statusValue || status.toLowerCase() === statusValue;

                            // Cek apakah memenuhi filter pengiriman
                            const matchPengiriman = !pengirimanValue || pengiriman.toLowerCase() ===
                                pengirimanValue;

                            // Cek apakah memenuhi filter pencarian
                            const matchSearch = !searchValue ||
                                customerName.includes(searchValue) ||
                                produkName.includes(searchValue) ||
                                orderId.includes(searchValue);

                            // Tampilkan kartu jika memenuhi semua filter
                            if (matchStatus && matchPengiriman && matchSearch) {
                                card.classList.remove('hidden');
                                visibleCount++;
                            } else {
                                card.classList.add('hidden');
                            }
                        });

                        // Tampilkan pesan tidak ada data jika tidak ada pesanan yang ditampilkan
                        const noDataMessage = document.getElementById('noDataMessage');
                        const parentContainer = document.querySelector('.space-y-6');

                        if (visibleCount === 0 && parentContainer) {
                            if (!noDataMessage) {
                                const message = document.createElement('div');
                                message.id = 'noDataMessage';
                                message.className = 'p-8 text-center bg-gray-50 rounded-lg';
                                message.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="mx-auto mb-4 text-gray-400" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                        <p class="text-lg font-medium text-gray-600">Tidak ada pesanan yang ditemukan</p>
                        <p class="mt-2 text-gray-500">Coba ubah filter atau kata kunci pencarian</p>
                        <button id="resetFilters" class="px-4 py-2 mt-4 text-sm font-medium text-white transition-colors rounded-lg bg-emerald-600 hover:bg-emerald-700">
                            Reset Filter
                        </button>
                    `;
                                parentContainer.appendChild(message);

                                // Event listener untuk tombol reset
                                document.getElementById('resetFilters').addEventListener('click', resetAllFilters);
                            }
                        } else if (noDataMessage) {
                            noDataMessage.remove();
                        }

                        // Update tampilan tombol clear search
                        if (clearSearch) {
                            if (searchValue.length > 0) {
                                clearSearch.style.display = 'flex';
                            } else {
                                clearSearch.style.display = 'none';
                            }
                        }
                    }

                    // Reset semua filter ke nilai default
                    function resetAllFilters() {
                        if (filterStatus) filterStatus.value = '';
                        if (filterPengiriman) filterPengiriman.value = '';
                        if (searchInput) searchInput.value = '';
                        if (clearSearch) clearSearch.style.display = 'none';
                        applyFilters();
                    }

                    // Tambahkan data atribut ke pesanan cards
                    pesananCards.forEach(card => {
                        // Ambil status dari tampilan badge
                        if (card.querySelector('.text-purple-700')) {
                            card.setAttribute('data-status', 'Selesai');
                        } else if (card.querySelector('.text-green-700')) {
                            card.setAttribute('data-status', 'Diterima');
                        } else if (card.querySelector('.text-amber-700')) {
                            card.setAttribute('data-status', 'Dikirim');
                        } else if (card.querySelector('.text-blue-700')) {
                            card.setAttribute('data-status', 'Diproses');
                        }

                        // Ambil pengiriman dari teks
                        const pengirimanTeks = card.querySelector('.inline-flex.items-center')?.textContent.trim();
                        if (pengirimanTeks?.includes('Paxel')) {
                            card.setAttribute('data-pengiriman', 'wa_jek');
                        } else if (pengirimanTeks?.includes('Ambil di Tempat')) {
                            card.setAttribute('data-pengiriman', 'ambil_ditempat');
                        }
                    });

                    // Trigger filter saat dropdown berubah
                    if (filterStatus) filterStatus.addEventListener('change', applyFilters);
                    if (filterPengiriman) filterPengiriman.addEventListener('change', applyFilters);

                    // Terapkan filter saat user mengetik (dengan debounce)
                    let debounceTimer;
                    if (searchInput) {
                        searchInput.addEventListener('input', function() {
                            clearTimeout(debounceTimer);
                            debounceTimer = setTimeout(applyFilters, 300);
                        });
                    }

                    // Clear search input
                    if (clearSearch) {
                        clearSearch.addEventListener('click', function() {
                            if (searchInput) searchInput.value = '';
                            clearSearch.style.display = 'none';
                            applyFilters();
                        });
                    }

                    // Tambahkan tombol shortcut di bagian atas untuk filter status umum
                    const filterButtons = `
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <button data-status="" class="px-3 py-1.5 text-sm rounded-full bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Semua
                </button>
                <button data-status="Diproses" class="px-3 py-1.5 text-sm rounded-full bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Diproses
                </button>
                <button data-status="Dikirim" class="px-3 py-1.5 text-sm rounded-full bg-amber-100 text-amber-800 hover:bg-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    Dikirim
                </button>
                <button data-status="Diterima" class="px-3 py-1.5 text-sm rounded-full bg-green-100 text-green-800 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Diterima
                </button>
                <button data-status="Selesai" class="px-3 py-1.5 text-sm rounded-full bg-purple-100 text-purple-800 hover:bg-purple-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    Selesai
                </button>
            </div>
        `;

                    // Sisipkan tombol filter di bawah statistik jika elemen ada
                    const statsContainer = document.querySelector(
                        '.grid.grid-cols-1.gap-4.sm\\:grid-cols-2.lg\\:grid-cols-5');
                    if (statsContainer) {
                        statsContainer.insertAdjacentHTML('afterend', filterButtons);

                        // Tambahkan event listener untuk tombol filter
                        document.querySelectorAll('button[data-status]').forEach(button => {
                            button.addEventListener('click', function() {
                                const status = this.getAttribute('data-status');
                                if (filterStatus) filterStatus.value = status;

                                // Hapus highlight dari semua tombol
                                document.querySelectorAll('button[data-status]').forEach(btn => {
                                    btn.classList.remove('ring-2');
                                });

                                // Tambahkan highlight untuk tombol yang aktif
                                if (status) {
                                    this.classList.add('ring-2');
                                }

                                applyFilters();
                            });
                        });
                    }

                    // Inisialisasi filter
                    applyFilters();

                    // Jika tab grafik aktif, inisialisasi grafik
                    if (contentGrafik && !contentGrafik.classList.contains('hidden')) {
                        createPenjualanChart();
                    }
                });
            </script>
</body>

</html>
