<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AgroMart - Pengaturan Profil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="45x45" href="images/icon-40x40.png">
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&family=Signika:wght@300..700&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'agromart': {
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
                        },
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                        'manrope': ['Manrope', 'sans-serif'],
                        'signika': ['Signika', 'sans-serif'],
                        'volkhov': ['Volkhov', 'serif'],
                    },
                    boxShadow: {
                        'card': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
                        'input': '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
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

        .form-input {
            @apply w-full px-4 py-3 transition duration-200 bg-white border rounded-lg shadow-input focus:border-agromart-500 focus:ring focus:ring-agromart-200 focus:ring-opacity-50 focus:outline-none;
        }

        .btn-primary {
            @apply px-6 py-3 font-semibold text-white transition duration-200 rounded-lg shadow-md bg-agromart-600 hover:bg-agromart-700 focus:outline-none focus:ring-2 focus:ring-agromart-500 focus:ring-opacity-50;
        }

        .btn-secondary {
            @apply px-6 py-3 font-semibold text-white transition duration-200 rounded-lg shadow-md bg-gray-500 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50;
        }

        .card {
            @apply p-6 transition duration-300 bg-white rounded-xl shadow-card hover:shadow-lg;
        }
    </style>
</head>

<body class="min-h-screen text-gray-800 bg-gray-50 font-poppins">
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <nav class="flex items-center justify-between max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Logo AgroMart" class="h-12">
                </a>
                <div class="items-center hidden gap-4 text-base font-semibold md:flex text-emerald-700 font-[signika]">
                    <a href="{{ route('home') }}" class=x`">HOME</a>
                    <div class="relative group">
                        <a href="{{ route('produk.index') }}" class="flex items-center gap-1">PRODUK</a>
                        <div
                            class="absolute hidden w-40 bg-white rounded-md shadow-lg z-5 group-hover:block animate-fadeIn text-emerald-600">
                            @foreach ($kategoris as $kategori)
                                <a href="{{ route('produk.index', $kategori->id_kategori) }}"
                                    class="block px-4 py-2 text-sm rounded-md text-emerald-700 hover:bg-gray-100 hover:text-emerald-400">{{ $kategori->nama_kategori }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="#edukasi" class="hover:text-emerald-400">EDUKASI</a>
                    <a href="#galeri" class="hover:text-emerald-400">GALERI</a>
                    <a href="#layanan" class="hover:text-emerald-400">LAYANAN</a>
                    <a href="#contact" class="hover:text-emerald-400">CONTACT US</a>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/keranjangIcon.png') }}" alt="Keranjang"
                    class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90">
                <img src="{{ asset('images/notifIcon.png') }}" alt="Notifikasi"
                    class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90">
                <div id="menuButton" class="relative">
                    <div class="flex items-center gap-2 cursor-pointer">
                        <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" class="w-12 h-12 rounded-full">
                        <div class="hidden text-left md:block">
                            <span class="block font-bold">{{ Auth::user()->name }}</span>
                            <small class="text-gray-500">{{ Auth::user()->email }}</small>
                        </div>
                    </div>
                    <div id="dropdownUser"
                        class="absolute right-0 z-30 flex-col hidden w-48 mt-4 bg-white rounded-md shadow-2xl">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Akun</a>
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('status.index') }}"
                                class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Transaksi</a>
                            <a href="{{ route('profile.adminshowuser') }}"
                                class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Akun Customer</a>
                        @else
                            <a href="{{ route('pesananku') }}"
                                class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Transaksi</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full px-4 py-2 text-sm text-left rounded-md hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- Main Content -->
    <div class="container px-4 pt-5 pb-20 mx-auto max-w-7xl">
        <!-- Page Title -->
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-agromart-800 font-volkhov">Pengaturan Akun</h1>
            <p class="mt-2 text-gray-600">Kelola informasi profil dan preferensi akun Anda</p>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            <!-- FORM EDIT PROFIL -->
            <section class="overflow-hidden transition-all bg-white rounded-2xl shadow-card hover:shadow-lg">
                <div class="p-6 border-b bg-gradient-to-r from-agromart-50 to-agromart-100">
                    <h2 class="text-2xl font-bold text-agromart-800">Profil Saya</h2>
                    <p class="text-sm text-gray-600">Informasi dasar akun Anda</p>
                </div>

                <form method="POST" action="{{ route('profile.update') }}" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col items-center mb-6">
                        <div class="relative group">
                            <div
                                class="overflow-hidden transition-all duration-300 border-4 rounded-full shadow-lg w-36 h-36 border-agromart-200 group-hover:border-agromart-300">
                                <img id="avatar-preview"
                                    src="{{ Auth::user()->avatar_url ?? asset('images/avatar.png') }}"
                                    class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105">
                            </div>
                            <div
                                class="absolute inset-0 flex items-center justify-center transition duration-300 opacity-0 group-hover:opacity-100">
                                <div class="p-3 text-white rounded-full bg-agromart-600 bg-opacity-80">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <input type="file" id="avatar-input" accept="image/*"
                                    class="absolute inset-0 opacity-0 cursor-pointer">
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Klik untuk mengganti foto profil</p>
                    </div>

                    <input type="hidden" name="cropped_avatar" id="cropped-avatar-input">

                    <div class="space-y-5">
                        <div class="relative">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Nama</label>
                            <div class="relative group">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                                    class="w-full py-2 pl-10 border rounded-lg border-emerald-400 focus:outline-none focus:border-emerald-600">
                            </div>
                        </div>

                        <div class="relative">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                            <div class="relative group">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                </div>
                                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                    class="w-full py-2 pl-10 border rounded-lg border-emerald-400 focus:outline-none focus:border-emerald-600">
                            </div>
                        </div>

                        <div class="relative">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Telepon</label>
                            <div class="relative group">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                </div>
                                <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}"
                                    class="w-full py-2 pl-10 border rounded-lg border-emerald-400 focus:outline-none focus:border-emerald-600">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full py-2 bg-green-400 hover:bg-green-600 focus:ring-green-500 rounded-xl btn-primary">
                            <div class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                Simpan Profil
                            </div>
                        </button>
                    </div>
                </form>
            </section>

            <!-- UBAH PASSWORD -->
            <section class="overflow-hidden transition-all bg-white rounded-2xl shadow-card hover:shadow-lg">
                <div class="p-6 border-b bg-gradient-to-r from-amber-50 to-amber-100">
                    <h2 class="text-2xl font-bold text-amber-800">Keamanan</h2>
                    <p class="text-sm text-gray-600">Update password akun Anda</p>
                </div>

                <form method="POST" action="{{ route('password.update') }}" class="px-6 py-2">
                    @csrf
                    @method('PUT')

                    <div class="space-y-2">
                        <div>
                            <label class="block mb-1 font-medium text-gray-700">Password Saat Ini</label>
                            <input type="password" name="current_password"
                                class="w-full py-2 pl-10 border rounded-lg border-amber-400 focus:outline-none focus:border-amber-600"
                                required>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium text-gray-700">Password Baru</label>
                            <input type="password" name="password"
                                class="w-full py-2 pl-10 border rounded-lg border-amber-400 focus:outline-none focus:border-amber-600"
                                required>
                            <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter dengan kombinasi huruf dan angka
                            </p>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium text-gray-700">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation"
                                class="w-full py-2 pl-10 border rounded-lg border-amber-400 focus:outline-none focus:border-amber-600"
                                required>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full py-2 rounded-xl btn-primary bg-amber-600 hover:bg-amber-700 focus:ring-amber-500">
                            <div class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                Simpan Password
                            </div>
                        </button>
                    </div>
                </form>
            </section>

            <!-- ALAMAT CUSTOMER -->
            <section class="overflow-hidden transition-all bg-white rounded-2xl shadow-card hover:shadow-lg">
                <div class="p-6 border-b bg-gradient-to-r from-blue-50 to-blue-100">
                    <h2 class="text-2xl font-bold text-blue-800">Alamat Saya</h2>
                    <p class="text-sm text-gray-600">Kelola lokasi pengiriman Anda</p>
                </div>

                <div class="p-6">
                    <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2">
                        @if ($alamat->isEmpty())
                            <div class="flex flex-col items-center justify-center p-8 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mb-4 text-gray-300"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p class="text-gray-500">Tidak ada alamat yang ditambahkan.</p>
                                <p class="text-sm text-gray-400">Tambahkan alamat untuk pengiriman pesanan Anda</p>
                            </div>
                        @else
                            @foreach ($alamat as $alamats)
                                <div class="p-4 transition-all bg-white border rounded-lg shadow-sm hover:shadow-md">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-center">
                                            <div class="p-2 mr-3 text-white bg-blue-600 rounded-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="font-medium">{{ $alamats->label_alamat }}</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pl-10 mt-1 text-sm text-gray-600">
                                        <p><span class="font-semibold">{{ $alamats->nama_jalan }}</span>,
                                            {{ $alamats->detail_alamat }}</p>
                                        <p class="mt-1">{{ $alamats->kecamatan->nama_kecamatan }},
                                            {{ $alamats->kabupatenKota->nama_kabupaten_kota }}</p>
                                        <p>{{ $alamats->kodePos->kode_pos }}</p>
                                    </div>

                                    <div class="flex justify-end gap-2 mt-3">
                                        <button id="openEditModal"
                                            class="px-3 py-1 text-sm text-white transition rounded-md bg-amber-500 hover:bg-amber-600">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </div>
                                        </button>
                                        <button
                                            class="px-3 py-1 text-sm text-white transition bg-red-500 rounded-md hover:bg-red-600">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <button id="add-address"
                        class="flex items-center justify-center w-full px-4 py-3 mt-5 text-black transition rounded-lg btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Alamat Baru
                    </button>
                </div>
            </section>
        </div>
    </div>

    <!-- ADD ALAMAT MODAL -->
    <div id="add-address-modal"
        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-60">
        <div class="w-full max-w-5xl max-h-[90vh] overflow-hidden bg-white rounded-xl shadow-2xl">
            <!-- Header -->
            <div class="relative p-5 border-b bg-gradient-to-r from-agromart-50 to-agromart-100">
                <button type="button" id="close-add-address"
                    class="absolute p-1 text-gray-500 transition-colors rounded-full top-4 right-4 hover:bg-gray-100 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <h2 class="text-2xl font-bold text-agromart-800">Tambah Alamat Baru</h2>
                <p class="text-sm text-gray-600">Masukkan detail alamat pengiriman dan pilih lokasinya di peta</p>
            </div>

            <form method="POST" action="{{ route('alamat.store') }}" class="overflow-auto max-h-[calc(90vh-70px)]">
                @csrf
                <div class="flex flex-col p-5 lg:flex-row lg:gap-6">
                    <!-- Form Fields -->
                    <div class="w-full space-y-5 lg:w-1/2">
                        <div class="relative">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Label Alamat</label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </div>
                                <input type="text" name="label_alamat"
                                    class="w-full py-3 pl-10 pr-4 border border-gray-300 rounded-lg focus:border-agromart-500 focus:ring focus:ring-agromart-200 focus:ring-opacity-50 focus:outline-none"
                                    placeholder="Rumah, Kantor, Kost, dll" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                            <div class="relative">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        </svg>
                                    </div>
                                    <select id="kabupaten-kota" name="id_kabupaten_kota"
                                        class="w-full py-3 pl-10 pr-8 border border-gray-300 rounded-lg appearance-none focus:border-agromart-500 focus:ring focus:ring-agromart-200 focus:ring-opacity-50 focus:outline-none"
                                        required>
                                        <option value="">Pilih Kabupaten/Kota</option>
                                        @foreach ($kabupatenKota as $kabupaten)
                                            <option value="{{ $kabupaten->id_kabupaten_kota }}">
                                                {{ $kabupaten->nama_kabupaten_kota }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="relative">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Kecamatan</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        </svg>
                                    </div>
                                    <select id="kecamatan" name="id_kecamatan"
                                        class="w-full py-3 pl-10 pr-8 border border-gray-300 rounded-lg appearance-none focus:border-agromart-500 focus:ring focus:ring-agromart-200 focus:ring-opacity-50 focus:outline-none"
                                        required>
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                            <div class="relative">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Kode Pos</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </div>
                                    <select id="kode-pos" name="id_kode_pos"
                                        class="w-full py-3 pl-10 pr-8 border border-gray-300 rounded-lg appearance-none focus:border-agromart-500 focus:ring focus:ring-agromart-200 focus:ring-opacity-50 focus:outline-none"
                                        required>
                                        <option value="">Pilih Kode Pos</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="relative">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Nama Jalan</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                        </svg>
                                    </div>
                                    <input type="text" name="nama_jalan"
                                        class="w-full py-3 pl-10 pr-4 border border-gray-300 rounded-lg focus:border-agromart-500 focus:ring focus:ring-agromart-200 focus:ring-opacity-50 focus:outline-none"
                                        placeholder="Nama jalan lengkap" required>
                                </div>
                            </div>
                        </div>

                        <div class="relative">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Detail Alamat</label>
                            <div class="relative">
                                <div class="absolute text-gray-500 pointer-events-none top-3 left-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                    </svg>
                                </div>
                                <textarea name="detail_alamat"
                                    class="w-full py-3 pl-10 pr-4 border border-gray-300 rounded-lg focus:border-agromart-500 focus:ring focus:ring-agromart-200 focus:ring-opacity-50 focus:outline-none"
                                    placeholder="No. Rumah, RT/RW, Blok, dll" required rows="3"></textarea>
                            </div>
                        </div>

                        <div class="relative p-4 rounded-lg shadow-inner bg-blue-50">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="font-medium text-blue-800">Koordinat Lokasi</h4>
                                <span id="coordinates-display"
                                    class="px-2 py-1 text-xs text-blue-800 bg-white rounded shadow">-</span>
                            </div>
                            <p class="mb-1 text-xs text-blue-700">Koordinat akan otomatis terisi ketika Anda:</p>
                            <ul class="ml-4 space-y-1 text-xs text-blue-600 list-disc">
                                <li>Klik pada peta</li>
                                <li>Geser pin pada peta</li>
                                <li>Memilih kabupaten/kota</li>
                            </ul>
                            <input type="hidden" id="latitude" name="latitude" required>
                            <input type="hidden" id="longitude" name="longitude" required>
                        </div>
                    </div>

                    <!-- Map -->
                    <div
                        class="w-full h-[350px] lg:h-auto lg:w-1/2 mt-5 lg:mt-0 rounded-lg overflow-hidden shadow-md border border-gray-300">
                        <div id="map" class="w-full h-full"></div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex justify-end gap-4 p-5 mt-2 border-t bg-gray-50">
                    <button type="button" id="cancel-add-address"
                        class="px-6 py-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2.5 bg-agromart-600 hover:bg-agromart-700 focus:ring-agromart-500 rounded-lg text-white font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Alamat
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL CROP -->
    <div id="crop-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-70">
        <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-2xl">
            <h2 class="mb-6 text-xl font-bold text-center text-gray-800">Sesuaikan Foto Profil</h2>
            <div class="flex justify-center">
                <div class="overflow-hidden border rounded-md shadow-lg">
                    <img id="crop-image" class="max-w-full max-h-96" />
                </div>
            </div>
            <div class="flex justify-end mt-6 space-x-4">
                <button id="crop-cancel" class="btn-secondary">Batal</button>
                <button id="crop-save" class="btn-primary">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Terapkan
                    </div>
                </button>
            </div>
        </div>
    </div>
    <!-- Success Notification Component -->
    <div id="success-notification"
        class="fixed z-50 flex items-center p-4 mb-4 transition-all duration-300 transform translate-y-20 bg-green-100 rounded-lg shadow-lg opacity-0 bottom-5 right-5">
        <div
            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-600 bg-green-200 rounded-lg">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
        </div>
        <div id="notification-message" class="ml-3 text-sm font-medium text-green-800">Perubahan berhasil disimpan!
        </div>
        <button type="button"
            class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg p-1.5 hover:bg-green-200 inline-flex h-8 w-8 items-center justify-center">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
    <!-- Error Notification Component -->
    <div id="error-notification"
        class="fixed z-50 flex items-center p-4 mb-4 transition-all duration-300 transform translate-y-20 bg-red-100 rounded-lg shadow-lg opacity-0 bottom-5 right-5">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-600 bg-red-200 rounded-lg">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11V7a1 1 0 10-2 0v2a1 1 0 002 0zm0 4a1 1 0 10-2 0 1 1 0 002 0z" />
            </svg>
        </div>
        <div id="error-message" class="ml-3 text-sm font-medium text-red-800">Terjadi kesalahan!</div>
        <button type="button"
            class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg p-1.5 hover:bg-red-200 inline-flex h-8 w-8 items-center justify-center">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @foreach ($errors->all() as $error)
                    showErrorNotification(@json($error));
                @endforeach
            });
        </script>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Map initialization
            let map;
            let marker;
            const defaultLat = -6.200000; // Default latitude (Indonesia)
            const defaultLng = 106.816666; // Default longitude (Jakarta)

            function initMap() {
                // Initialize map when modal is opened
                map = L.map('map').setView([defaultLat, defaultLng], 13);

                // Base layers - add multiple options
                const streets = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    maxZoom: 19,
                    name: 'streets'
                });

                // Google Hybrid layer (satellite with labels)
                const googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: '&copy; Google Maps',
                    name: 'hybrid'
                });

                // Google Satellite layer (without labels)
                const googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: '&copy; Google Maps',
                    name: 'satellite'
                });

                // Set hybrid as default base layer
                googleHybrid.addTo(map);

                // Add layer control to switch between views
                const baseLayers = {
                    "Peta Jalan": streets,
                    "Hybrid": googleHybrid,
                    "Satelit": googleSat
                };

                L.control.layers(baseLayers, null, {
                    position: 'topright'
                }).addTo(map);

                // Add click event to map
                map.on('click', function(e) {
                    setMarkerPosition(e.latlng.lat, e.latlng.lng);
                });

                // Initialize marker with custom icon for better visibility on satellite imagery
                const markerIcon = L.icon({
                    iconUrl: 'https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-512.png',
                    iconSize: [32, 32],
                    iconAnchor: [16, 32],
                    popupAnchor: [0, -32]
                });

                marker = L.marker([defaultLat, defaultLng], {
                    draggable: true,
                    icon: markerIcon
                }).addTo(map);

                // Update coordinates when marker is dragged
                marker.on('dragend', function(e) {
                    const position = marker.getLatLng();
                    setMarkerPosition(position.lat, position.lng);
                });
            }

            function setMarkerPosition(lat, lng) {
                // Update marker position
                if (marker) {
                    marker.setLatLng([lat, lng]);
                }

                // Format coordinates for display
                const formattedLat = lat.toFixed(6);
                const formattedLng = lng.toFixed(6);

                // Update hidden inputs
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                // Update display if element exists
                const coordDisplay = document.getElementById('coordinates-display');
                if (coordDisplay) {
                    coordDisplay.textContent = `${formattedLat}, ${formattedLng}`;
                }
            }

            // Initialize map when add address modal is opened
            const addAddressButton = document.getElementById('add-address');
            const addAddressModal = document.getElementById('add-address-modal');
            const cancelAddAddressButton = document.getElementById('cancel-add-address');
            const closeAddAddressButton = document.getElementById('close-add-address');

            // Open modal when "Tambah Alamat" button is clicked
            addAddressButton.addEventListener('click', () => {
                addAddressModal.classList.remove('hidden');
                // Initialize map after modal is visible
                setTimeout(() => {
                    initMap();
                    map.invalidateSize(); // Fix map display issues
                }, 100);
            });

            // Close modal when "Batal" button is clicked
            [cancelAddAddressButton, closeAddAddressButton].forEach(button => {
                if (button) {
                    button.addEventListener('click', () => {
                        addAddressModal.classList.add('hidden');
                    });
                }
            });

            // Update map view when kabupaten/kota is selected
            const kabupatenKotaSelect = document.getElementById('kabupaten-kota');
            const kecamatanSelect = document.getElementById('kecamatan');

            // Fungsi untuk memperbarui peta berdasarkan nama lokasi
            function updateMapByLocation(locationName, zoomLevel = 12) {
                if (map) {
                    // Tampilkan indikator loading
                    const coordDisplay = document.getElementById('coordinates-display');
                    if (coordDisplay) {
                        coordDisplay.textContent = 'Mencari lokasi...';
                    }

                    // Geocode lokasi yang dipilih untuk mendapatkan koordinat
                    fetch(
                            `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(locationName)},Indonesia&format=json&limit=1`
                        )
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.length > 0) {
                                const lat = parseFloat(data[0].lat);
                                const lon = parseFloat(data[0].lon);
                                map.setView([lat, lon], zoomLevel);
                                setMarkerPosition(lat, lon);
                            } else {
                                console.log('Lokasi tidak ditemukan');
                            }
                        })
                        .catch(error => {
                            console.error('Error geocoding location:', error);
                        });
                }
            }

            // Update peta ketika kabupaten/kota dipilih
            if (kabupatenKotaSelect) {
                kabupatenKotaSelect.addEventListener('change', function() {
                    const selectedKabupaten = this.options[this.selectedIndex].text;
                    if (selectedKabupaten && selectedKabupaten !== 'Pilih Kabupaten/Kota') {
                        updateMapByLocation(selectedKabupaten, 11); // Zoom level lebih jauh untuk kabupaten
                    }
                });
            }

            // Update peta ketika kecamatan dipilih
            if (kecamatanSelect) {
                kecamatanSelect.addEventListener('change', function() {
                    const selectedKecamatan = this.options[this.selectedIndex].text;
                    const selectedKabupaten = kabupatenKotaSelect.options[kabupatenKotaSelect.selectedIndex]
                        .text;

                    if (selectedKecamatan && selectedKecamatan !== 'Pilih Kecamatan') {
                        // Tambahkan nama kabupaten untuk meningkatkan akurasi pencarian
                        const searchQuery = `${selectedKecamatan}, ${selectedKabupaten}`;
                        updateMapByLocation(searchQuery, 13); // Zoom level lebih dekat untuk kecamatan
                    }
                });
            }
        });
        // ALAMAT
        document.addEventListener('DOMContentLoaded', function() {
            const kabupatenKotaSelect = document.getElementById('kabupaten-kota');
            const kecamatanSelect = document.getElementById('kecamatan');
            const kodePosSelect = document.getElementById('kode-pos');

            // Ketika kabupaten/kota dipilih
            kabupatenKotaSelect.addEventListener('change', function() {
                const kabupatenKotaId = this.value;

                // Kosongkan dropdown kecamatan dan kode pos
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                kodePosSelect.innerHTML = '<option value="">Pilih Kode Pos</option>';

                if (kabupatenKotaId) {
                    fetch(`/get-kecamatan/${kabupatenKotaId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(kecamatan => {
                                const option = document.createElement('option');
                                option.value = kecamatan.id_kecamatan;
                                option.textContent = kecamatan.nama_kecamatan;
                                kecamatanSelect.appendChild(option);
                            });
                        });
                }
            });

            // Ketika kecamatan dipilih
            kecamatanSelect.addEventListener('change', function() {
                const kecamatanId = this.value;

                // Kosongkan dropdown kode pos
                kodePosSelect.innerHTML = '<option value="">Pilih Kode Pos</option>';

                if (kecamatanId) {
                    fetch(`/get-kode-pos/${kecamatanId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(kodePos => {
                                const option = document.createElement('option');
                                option.value = kodePos.id_kode_pos;
                                option.textContent = kodePos.kode_pos;
                                kodePosSelect.appendChild(option);
                            });
                        });
                }
            });
        });
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
        const avatarInput = document.getElementById('avatar-input');
        const avatarPreview = document.getElementById('avatar-preview');
        const cropModal = document.getElementById('crop-modal');
        const cropImage = document.getElementById('crop-image');
        const cropSave = document.getElementById('crop-save');
        const cropCancel = document.getElementById('crop-cancel');
        const croppedAvatarInput = document.getElementById('cropped-avatar-input');
        let cropper;

        avatarInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    cropImage.src = reader.result;
                    cropModal.classList.remove('hidden');
                    cropper = new Cropper(cropImage, {
                        aspectRatio: 1,
                        viewMode: 1,
                        responsive: true,
                        autoCropArea: 1,
                    });
                };
                reader.readAsDataURL(file);
            }
        });

        cropSave.addEventListener('click', () => {
            const canvas = cropper.getCroppedCanvas({
                width: 300,
                height: 300
            });
            canvas.toBlob(blob => {
                const reader = new FileReader();
                reader.onloadend = () => {
                    croppedAvatarInput.value = reader.result;
                    avatarPreview.src = reader.result;
                    cropModal.classList.add('hidden');
                    cropper.destroy();
                };
                reader.readAsDataURL(blob);
            });
        });

        cropCancel.addEventListener('click', () => {
            cropModal.classList.add('hidden');
            avatarInput.value = '';
            if (cropper) cropper.destroy();
        });
        // Notification handling
        function showNotification(message) {
            const notification = document.getElementById('success-notification');
            const notificationMessage = document.getElementById('notification-message');

            // Set message
            notificationMessage.textContent = message;

            // Show notification
            notification.classList.remove('translate-y-20', 'opacity-0');
            notification.classList.add('translate-y-0', 'opacity-100');

            // Hide notification after 5 seconds
            setTimeout(() => {
                notification.classList.remove('translate-y-0', 'opacity-100');
                notification.classList.add('translate-y-20', 'opacity-0');
            }, 5000);

            // Close button functionality
            notification.querySelector('button').addEventListener('click', () => {
                notification.classList.remove('translate-y-0', 'opacity-100');
                notification.classList.add('translate-y-20', 'opacity-0');
            });
        }

        function showErrorNotification(message) {
            const notification = document.getElementById('error-notification');
            const notificationMessage = document.getElementById('error-message');

            // Set message
            notificationMessage.textContent = message;

            // Show notification
            notification.classList.remove('translate-y-20', 'opacity-0');
            notification.classList.add('translate-y-0', 'opacity-100');

            // Hide notification after 5 seconds
            setTimeout(() => {
                notification.classList.remove('translate-y-0', 'opacity-100');
                notification.classList.add('translate-y-20', 'opacity-0');
            }, 5000);

            // Close button functionality
            notification.querySelector('button').addEventListener('click', () => {
                notification.classList.remove('translate-y-0', 'opacity-100');
                notification.classList.add('translate-y-20', 'opacity-0');
            });
        }

        // Check for success messages from server and show notifications
        document.addEventListener('DOMContentLoaded', function() {
            // Check URL parameters for success messages
            const urlParams = new URLSearchParams(window.location.search);

            if (urlParams.get('profile_updated') === 'true') {
                showNotification('Profil berhasil diperbarui!');
            }

            if (urlParams.get('password_updated') === 'true') {
                showNotification('Password berhasil diperbarui!');
            }

            if (urlParams.get('address_created') === 'true') {
                showNotification('Alamat baru berhasil ditambahkan!');
            }

            // Handle form submissions
            const profileForm = document.querySelector('form[action="{{ route('profile.update') }}"]');
            const passwordForm = document.querySelector('form[action="{{ route('password.update') }}"]');
            const addressForm = document.querySelector('form[action="{{ route('alamat.store') }}"]');

            // Profile form submission
            if (profileForm) {
                profileForm.addEventListener('submit', function(e) {
                    localStorage.setItem('show_profile_success', 'true');
                });
            }

            // Password form submission
            if (passwordForm) {
                passwordForm.addEventListener('submit', function(e) {
                    localStorage.setItem('show_password_success', 'true');
                });
            }

            // Address form submission
            if (addressForm) {
                addressForm.addEventListener('submit', function(e) {
                    localStorage.setItem('show_address_success', 'true');
                });
            }

            // CEK ERROR DARI SERVER
            const hasServerError = {{ $errors->any() ? 'true' : 'false' }};

            // Check localStorage for pending notifications
            if (!hasServerError) {
                if (localStorage.getItem('show_profile_success') === 'true') {
                    showNotification('Profil berhasil diperbarui!');
                    localStorage.removeItem('show_profile_success');
                }

                if (localStorage.getItem('show_password_success') === 'true') {
                    showNotification('Password berhasil diperbarui!');
                    localStorage.removeItem('show_password_success');
                }

                if (localStorage.getItem('show_address_success') === 'true') {
                    showNotification('Alamat baru berhasil ditambahkan!');
                    localStorage.removeItem('show_address_success');
                }
            } else {
                // Jika ada error, hapus notifikasi sukses agar tidak muncul di reload berikutnya
                localStorage.removeItem('show_profile_success');
                localStorage.removeItem('show_password_success');
                localStorage.removeItem('show_address_success');
            }
        });
    </script>

</body>

</html>
