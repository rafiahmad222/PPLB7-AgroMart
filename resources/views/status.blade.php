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
                    <a href="{{ route('home') }}" class="transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4">HOME</a>
                    <div class="relative group">
                        <a href="{{ route('produk.index') }}" class="flex items-center gap-1 transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4">PRODUK</a>
                        <div class="absolute hidden bg-white border rounded-lg shadow-xl w-44 z-5 group-hover:block animate-fadeIn border-emerald-100">
                            @foreach($kategoris as $kategori)
                            <a href="{{ route('produk.index', $kategori->id_kategori) }}"
                               class="block px-4 py-2.5 text-sm rounded-md text-emerald-700 hover:bg-emerald-50">
                               {{ $kategori->nama_kategori }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{#edukasi}" class="transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4">EDUKASI</a>
                    <a href="#galeri" class="transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4">GALERI</a>
                    <a href="{{ route('layanan.index') }}" class="transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4">LAYANAN</a>
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('status.index') }}" class="relative px-4 py-1.5 text-white font-medium bg-emerald-600 rounded-full after:content-[''] after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-full">TRANSAKSI</a>
                    @else
                        <a href="{{ route('pesananku') }}" class="transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4">TRANSAKSI</a>
                    @endif
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <img src="{{ asset('images/notifIcon.png') }}" alt="Notifikasi" class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90">
                    <div class="absolute flex items-center justify-center w-5 h-5 text-xs font-bold text-white transform -translate-y-1/2 rounded-full -right-1 bg-emerald-500 top-1">3</div>
                </div>
                <div id="menuButton" class="relative">
                    <div class="flex items-center gap-3 p-1.5 rounded-full cursor-pointer hover:bg-gray-100 transition-all">
                        <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" class="object-cover w-10 h-10 border-2 rounded-full border-emerald-500">
                        <div class="hidden text-left md:block">
                            <span class="block font-bold text-gray-800">{{ Auth::user()->name }}</span>
                            <small class="text-gray-500">{{ Auth::user()->email }}</small>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-gray-500" viewBox="0 0 16 16">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </div>
                    <div id="dropdownUser" class="absolute right-0 z-30 flex-col hidden w-56 mt-2 overflow-hidden bg-white rounded-lg shadow-2xl">
                        <div class="p-4 bg-emerald-50">
                            <p class="font-semibold text-emerald-700">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="border-t">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-3 text-sm transition-colors hover:bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="text-gray-600" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                </svg>
                                Pengaturan Akun
                            </a>
                            @if (Auth::user()->role === 'admin')
                            <a href="{{ route('profile.adminshowuser') }}" class="flex items-center gap-2 px-4 py-3 text-sm transition-colors hover:bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="text-gray-600" viewBox="0 0 16 16">
                                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                                </svg>
                                Manajemen Pengguna
                            </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full gap-2 px-4 py-3 text-sm text-red-600 transition-colors hover:bg-red-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="text-red-500" viewBox="0 0 16 16">
                                        <path d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                                        <path d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
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
            <button id="tabPesanan"
                class="relative px-8 py-3 transition-all duration-200 rounded-full tab-active">
                <span class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                    </svg>
                    Manajemen Pesanan
                </span>
            </button>
            <button id="tabGrafik" class="relative px-8 py-3 transition-all duration-200 rounded-full tab-inactive">
                <span class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z"/>
                    </svg>
                    Grafik Penjualan
                </span>
            </button>
        </div>

        <!-- Content Pesanan -->
        <div id="contentPesanan">
            <div class="grid grid-cols-4 gap-4 mb-8">
                <div class="p-6 transition-all bg-white shadow-sm rounded-xl hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <div class="text-gray-600">Total Pesanan</div>
                        <div class="p-2 bg-indigo-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="text-indigo-600" viewBox="0 0 16 16">
                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 text-2xl font-bold text-gray-800">{{ $pesanans->count() }}</div>
                    <div class="mt-1 text-sm text-gray-500">Bulan ini</div>
                </div>

                <div class="p-6 transition-all bg-white shadow-sm rounded-xl hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <div class="text-gray-600">Diproses</div>
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="text-blue-600" viewBox="0 0 16 16">
                                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 text-2xl font-bold text-gray-800">
                        {{ $pesanans->where('status', 'Diproses')->count() }}
                    </div>
                    <div class="mt-1 text-sm text-gray-500">Menunggu pengiriman</div>
                </div>

                <div class="p-6 transition-all bg-white shadow-sm rounded-xl hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <div class="text-gray-600">Dikirim</div>
                        <div class="p-2 rounded-lg bg-amber-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="text-amber-600" viewBox="0 0 16 16">
                                <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 text-2xl font-bold text-gray-800">
                        {{ $pesanans->where('status', 'Dikirim')->count() }}
                    </div>
                    <div class="mt-1 text-sm text-gray-500">Dalam pengiriman</div>
                </div>

                <div class="p-6 transition-all bg-white shadow-sm rounded-xl hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <div class="text-gray-600">Selesai</div>
                        <div class="p-2 bg-green-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="text-green-600" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 text-2xl font-bold text-gray-800">
                        {{ $pesanans->where('status', 'Diterima')->count() }}
                    </div>
                    <div class="mt-1 text-sm text-gray-500">Pesanan selesai</div>
                </div>
            </div>

            <div class="flex justify-between mb-6">
                <div class="flex gap-2">
                    @php
                        $statuses = ['Diproses', 'Dikirim', 'Diterima'];
                        $currentStatus = request('status');
                    @endphp

                    <a href="{{ route('status.index') }}"
                        class="px-5 py-2 font-medium transition-all duration-200 bg-white border rounded-full {{ !$currentStatus ? 'border-emerald-500 text-emerald-600' : 'border-gray-200 text-gray-600 hover:border-emerald-500 hover:text-emerald-600' }}">
                        Semua
                    </a>

                    @foreach ($statuses as $status)
                        <a href="{{ route('status.index', ['status' => $status]) }}"
                            class="px-5 py-2 font-medium transition-all duration-200 bg-white border rounded-full {{ $currentStatus === $status ? 'border-emerald-500 text-emerald-600' : 'border-gray-200 text-gray-600 hover:border-emerald-500 hover:text-emerald-600' }}">
                            {{ $status }}
                        </a>
                    @endforeach
                </div>

                <div class="relative">
                    <input type="text" placeholder="Cari pesanan..." class="px-4 py-2 pl-10 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="absolute text-gray-400 transform -translate-y-1/2 left-3 top-1/2" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </div>
            </div>

            @foreach ($pesanans as $pesanan)
                <div class="p-6 mb-6 transition-shadow bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-md">
                    <div class="flex items-start justify-between pb-4 border-b">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset($pesanan->user->avatar_url ?? 'images/avatar.png') }}" alt="Avatar"
                                class="object-cover border rounded-full w-14 h-14 border-emerald-100">
                            <div>
                                <p class="text-lg font-semibold text-gray-800">{{ $pesanan->user->name }}</p>
                                <div class="flex items-center gap-1 text-sm text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z"/>
                                        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z"/>
                                    </svg>
                                    {{ $pesanan->alamat->detail_alamat }},
                                    {{ $pesanan->alamat->kecamatan->nama_kecamatan }},
                                    {{ $pesanan->alamat->kabupatenKota->nama_kabupaten_kota }},
                                    {{ $pesanan->alamat->kodePos->kode_pos }}
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col items-end">
                            <div class="mb-2 text-sm font-medium text-right text-gray-500">Status Pesanan:</div>
                            <form action="{{ route('dashboard.pesanan.updateStatus', $pesanan->id_pesanan) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()"
                                    class="px-4 py-2 text-sm font-medium rounded-full cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-1
                                        {{ $pesanan->status === 'Diterima' ? 'bg-green-100 text-green-700 focus:ring-green-500' :
                                           ($pesanan->status === 'Dikirim' ? 'bg-amber-100 text-amber-700 focus:ring-amber-500' :
                                           'bg-blue-100 text-blue-700 focus:ring-blue-500') }}">
                                    <option value="Diproses" @selected($pesanan->status === 'Diproses')>Diproses</option>
                                    <option value="Dikirim" @selected($pesanan->status === 'Dikirim')>Dikirim</option>
                                    <option value="Diterima" @selected($pesanan->status === 'Diterima')>Diterima</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <div class="flex items-start gap-6 mt-4">
                        <img src="{{ asset('storage/' . $pesanan->produk->gambar_produk ?? 'images/default-product.png') }}"
                            alt="{{ $pesanan->produk->nama_produk }}" class="object-cover w-24 h-24 border border-gray-100 rounded-lg">

                        <div class="grid flex-1 grid-cols-2 gap-y-2">
                            <div>
                                <p class="text-sm text-gray-500">Produk</p>
                                <p class="font-medium text-gray-800">{{ $pesanan->produk->nama_produk }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">ID Pesanan</p>
                                <p class="font-medium text-gray-800">{{ $pesanan->id_pesanan }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Jumlah</p>
                                <p class="font-medium text-gray-800">{{ $pesanan->jumlah }} pcs</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Pesan</p>
                                <p class="font-medium text-gray-800">{{ $pesanan->created_at->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Pengiriman</p>
                                <p class="font-medium text-gray-800">
                                    @if ($pesanan->pengiriman === 'wa_jek')
                                        WA Jek
                                    @elseif ($pesanan->pengiriman === 'ambil_ditempat')
                                        Ambil di Tempat
                                    @else
                                        {{ $pesanan->pengiriman ?? '-' }}
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Pembayaran</p>
                                <p class="font-medium text-gray-800">
                                    @if ($pesanan->pembayaran === 'transfer')
                                        Transfer
                                    @elseif ($pesanan->pembayaran === 'cod')
                                        Cash on Delivery (COD)
                                    @else
                                        {{ $pesanan->pembayaran ?? '-' }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col items-end">
                            <div class="text-sm text-gray-500">Total Pembayaran</div>
                            <div class="text-xl font-bold text-emerald-700">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</div>
                            <div class="flex gap-2 mt-3">
                                <button class="px-3 py-1.5 text-xs font-medium text-emerald-700 bg-emerald-50 hover:bg-emerald-100 rounded-full transition-colors">Cetak Invoice</button>
                                <button class="px-3 py-1.5 text-xs font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 rounded-full transition-colors">Detail</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            <div class="flex items-center justify-center mt-8">
                <nav class="inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    <a href="#" class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50">
                        <span class="sr-only">Previous</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                        </svg>
                    </a>
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium bg-white border border-gray-300 text-emerald-600 hover:bg-gray-50">1</a>
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-50">2</a>
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-50">3</a>
                    <a href="#" class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50">
                        <span class="sr-only">Next</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Content Grafik -->
        <div id="contentGrafik" class="hidden">
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
                <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-gray-700">Total Pendapatan</h3>
                        <span class="p-2 rounded-lg bg-emerald-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="text-emerald-600" viewBox="0 0 16 16">
                                <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                            </svg>
                        </span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">Rp 15.240.000</h2>
                    <div class="flex items-center mt-2">
                        <span class="flex items-center text-sm font-medium text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="mr-1">
                                <path fill-rule="evenodd" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z"/>
                            </svg>
                            8.2%
                        </span>
                        <span class="ml-2 text-sm text-gray-500">vs bulan lalu</span>
                    </div>
                </div>

                <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-gray-700">Total Pesanan</h3>
                        <span class="p-2 bg-blue-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="text-blue-600" viewBox="0 0 16 16">
                                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                            </svg>
                        </span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">254</h2>
                    <div class="flex items-center mt-2">
                        <span class="flex items-center text-sm font-medium text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="mr-1">
                                <path fill-rule="evenodd" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z"/>
                            </svg>
                            12.5%
                        </span>
                        <span class="ml-2 text-sm text-gray-500">vs bulan lalu</span>
                    </div>
                </div>

                <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-gray-700">Produk Terjual</h3>
                        <span class="p-2 rounded-lg bg-violet-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="text-violet-600" viewBox="0 0 16 16">
                                <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                        </span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">879</h2>
                    <div class="flex items-center mt-2">
                        <span class="flex items-center text-sm font-medium text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="mr-1">
                                <path fill-rule="evenodd" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z"/>
                            </svg>
                            5.3%
                        </span>
                        <span class="ml-2 text-sm text-gray-500">vs bulan lalu</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="p-6 bg-white border border-gray-100 shadow-sm md:col-span-2 rounded-xl">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">Tren Penjualan</h3>
                        <div class="flex gap-2">
                            <select id="filterBulan" class="px-3 py-2 text-sm border rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
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
                            <select id="filterTahun" class="px-3 py-2 text-sm border rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                <option value="">Semua Tahun</option>
                                @foreach ($listTahun as $tahun)
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <canvas id="chartPenjualan" class="w-full h-64"></canvas>
                </div>

                <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
                    <h3 class="mb-6 text-lg font-semibold text-gray-800">Produk Terlaris</h3>
                    <div class="space-y-4">
                        <div class="flex items-center p-2 transition-all rounded-lg hover:bg-gray-50">
                            <img src="{{ asset('images/default-product.png') }}" alt="Product 1" class="object-cover w-12 h-12 mr-3 rounded-lg">
                            <div class="flex-grow">
                                <h4 class="text-sm font-medium">Pupuk Organik Premium</h4>
                                <div class="flex items-center justify-between mt-1">
                                    <span class="text-sm text-gray-500">145 terjual</span>
                                    <span class="text-sm font-semibold text-emerald-600">Rp 85.000</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center p-2 transition-all rounded-lg hover:bg-gray-50">
                            <img src="{{ asset('images/default-product.png') }}" alt="Product 2" class="object-cover w-12 h-12 mr-3 rounded-lg">
                            <div class="flex-grow">
                                <h4 class="text-sm font-medium">Bibit Unggul Cabai</h4>
                                <div class="flex items-center justify-between mt-1">
                                    <span class="text-sm text-gray-500">98 terjual</span>
                                    <span class="text-sm font-semibold text-emerald-600">Rp 25.000</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center p-2 transition-all rounded-lg hover:bg-gray-50">
                            <img src="{{ asset('images/default-product.png') }}" alt="Product 3" class="object-cover w-12 h-12 mr-3 rounded-lg">
                            <div class="flex-grow">
                                <h4 class="text-sm font-medium">Alat Penyiram Otomatis</h4>
                                <div class="flex items-center justify-between mt-1">
                                    <span class="text-sm text-gray-500">67 terjual</span>
                                    <span class="text-sm font-semibold text-emerald-600">Rp 320.000</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center p-2 transition-all rounded-lg hover:bg-gray-50">
                            <img src="{{ asset('images/default-product.png') }}" alt="Product 4" class="object-cover w-12 h-12 mr-3 rounded-lg">
                            <div class="flex-grow">
                                <h4 class="text-sm font-medium">Media Tanam Hidroponik</h4>
                                <div class="flex items-center justify-between mt-1">
                                    <span class="text-sm text-gray-500">52 terjual</span>
                                    <span class="text-sm font-semibold text-emerald-600">Rp 45.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="w-full py-2 mt-4 text-sm font-medium text-center transition-colors border rounded-lg text-emerald-600 border-emerald-200 hover:bg-emerald-50">
                        Lihat Semua Produk
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
        });

        // Chart.js
        const ctx = document.getElementById('chartPenjualan').getContext('2d');
        let chartInstance;

        function fetchChartData(bulan = '', tahun = '') {
            fetch(`/api/chart-data?bulan=${bulan}&tahun=${tahun}`)
                .then(res => res.json())
                .then(data => {
                    if (chartInstance) chartInstance.destroy();

                    chartInstance = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels || ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            datasets: [{
                                label: 'Jumlah Terjual',
                                data: data.values || [65, 78, 52, 91, 43, 106, 120, 156, 132, 108, 145, 167],
                                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                borderColor: 'rgba(16, 185, 129, 0.8)',
                                borderWidth: 2,
                                tension: 0.4,
                                fill: true,
                                pointBackgroundColor: 'rgba(16, 185, 129, 1)',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                pointRadius: 4,
                                pointHoverRadius: 6
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        display: true,
                                        color: 'rgba(0, 0, 0, 0.05)'
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            interaction: {
                                intersect: false,
                                mode: 'index'
                            }
                        }
                    });
                });
        }

        // Inisialisasi awal
        fetchChartData();

        document.getElementById('filterBulan').addEventListener('change', function() {
            const bulan = this.value;
            const tahun = document.getElementById('filterTahun').value;
            fetchChartData(bulan, tahun);
        });

        document.getElementById('filterTahun').addEventListener('change', function() {
            const tahun = this.value;
            const bulan = document.getElementById('filterBulan').value;
            fetchChartData(bulan, tahun);
        });
    </script>
</body>

</html>
