<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Layanan - AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="images/icon-40x40.png">
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&family=Signika:wght@300..700&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahkan link CSS untuk Cropper.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
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

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-fade-in {
            animation: fadeIn 0.3s ease-out;
        }

        .modal-slide-in {
            animation: slideIn 0.4s ease-out;
        }

        .pulse-button {
            transition: all 0.3s ease;
        }

        .pulse-button:hover {
            transform: scale(1.05);
        }

        .pulse-button:active {
            transform: scale(0.95);
        }
    </style>
</head>

<body class="font-sans bg-gray-100">
    <!-- Header -->
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

    <main class="container px-4 py-12 mx-auto">
        <!-- Header Section with Animated Gradient Background -->
        <div
            class="relative mb-12 overflow-hidden shadow-xl bg-gradient-to-r from-emerald-500 to-emerald-700 rounded-2xl">
            <div class="absolute inset-0 opacity-10">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                    <defs>
                        <pattern id="plant-pattern" patternUnits="userSpaceOnUse" width="80" height="80"
                            patternTransform="rotate(25)">
                            <path d="M20,60 Q40,40 60,60" stroke="currentColor" fill="none" stroke-width="2" />
                            <circle cx="20" cy="60" r="4" fill="currentColor" />
                            <circle cx="60" cy="60" r="4" fill="currentColor" />
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#plant-pattern)" />
                </svg>
            </div>
            <div class="relative z-10 flex flex-col items-center justify-between p-8 md:flex-row">
                <div class="mb-6 md:mb-0">
                    <h1 class="text-3xl font-bold leading-tight text-white md:text-4xl">Layanan AgroMart</h1>
                    <p class="mt-2 text-emerald-100">Temukan berbagai layanan profesional untuk kebutuhan pertanian
                        hidroponik Anda</p>
                </div>
                @if (Auth::user()->hasRole('admin'))
                    <button id="openModalButton"
                        class="px-6 py-3 font-semibold transition-all transform bg-white rounded-lg shadow-md group text-emerald-700 hover:bg-emerald-50 hover:-translate-y-1 hover:shadow-lg">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 mr-2 transition-transform group-hover:rotate-90" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Layanan
                        </span>
                    </button>
                @endif
            </div>
        </div>

        <!-- Services Grid with Hover Effects -->
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($layanans as $layanan)
                <a href="{{ route('layanan.show', $layanan->id_layanan) }}" class="group">
                    <div
                        class="flex flex-col h-full overflow-hidden transition-all duration-300 transform bg-white shadow-md rounded-xl hover:shadow-xl hover:-translate-y-2">
                        <div class="relative overflow-hidden">
                            <div
                                class="absolute inset-0 z-10 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/60 to-transparent group-hover:opacity-100">
                            </div>
                            <img src="{{ asset('storage/' . $layanan->gambar_layanan) }}"
                                alt="{{ $layanan->nama_layanan }}"
                                class="object-cover w-full h-56 transition-transform duration-500 group-hover:scale-105">
                            <div
                                class="absolute bottom-0 left-0 right-0 z-20 p-4 text-white transition-transform duration-300 transform translate-y-full group-hover:translate-y-0">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-emerald-600">Layanan
                                    Agromart</span>
                            </div>
                        </div>
                        <div class="flex flex-col flex-grow p-5">
                            <h2
                                class="mb-2 text-xl font-bold text-gray-800 transition-colors group-hover:text-emerald-600">
                                {{ $layanan->nama_layanan }}</h2>
                            <p class="mb-4 text-sm text-gray-500 line-clamp-2">
                                {{ Str::limit($layanan->deskripsi_layanan ?? 'Layanan profesional untuk kebutuhan hidroponik Anda', 100) }}
                            </p>
                            <div class="mt-auto">
                                <div class="flex items-center justify-between mt-1">
                                    <div class="flex items-center">
                                        <p class="text-xl font-bold text-emerald-600">Rp
                                            {{ number_format($layanan->harga_layanan, 0, ',', '.') }}</p>
                                    </div>
                                    <span
                                        class="inline-block px-4 py-1 text-sm font-medium transition-colors rounded-full bg-emerald-100 text-emerald-700 group-hover:bg-emerald-600 group-hover:text-white">Lihat
                                        Detail</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="py-32 text-center col-span-full">
                    <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                        </path>
                    </svg>
                    <h3 class="mt-4 text-xl font-semibold text-gray-700">Belum Ada Layanan</h3>
                    <p class="mt-2 text-gray-500">Belum ada layanan yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </main>


    <div id="modalTambahLayanan"
        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50 rounded-sm">
        <div class="w-full max-w-5xl p-0 overflow-hidden bg-white shadow-2xl rounded-xl">
            <div class="flex flex-col md:flex-row">
                <!-- Left Column - Image Upload & Crop -->
                <div class="flex flex-col w-full p-6 md:w-2/5 bg-gradient-to-br from-emerald-500 to-emerald-700">
                    <h3 class="mb-4 text-xl font-bold text-white">Gambar Layanan</h3>
                    <div class="flex flex-col items-center justify-center flex-grow space-y-4">
                        <!-- Image Preview Container -->
                        <div class="relative w-full overflow-hidden bg-white rounded-lg shadow-inner aspect-square">
                            <img id="previewGambar" src="{{ asset('images/UploadFoto.png') }}" alt="Preview Gambar"
                                class="object-contain w-full h-full">
                        </div>

                        <!-- Image Controls -->
                        <div class="flex flex-col w-full space-y-3">
                            <label class="w-full">
                                <div
                                    class="flex items-center justify-center px-4 py-2 font-medium text-center transition duration-200 bg-white rounded-lg shadow cursor-pointer text-emerald-700 hover:bg-emerald-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Pilih Gambar
                                </div>
                                <input type="file" name="gambar_layanan" id="gambar_layanan" class="hidden"
                                    accept="image/*">
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Form Inputs -->
                <div class="w-full p-6 md:w-3/5">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Tambah Layanan</h2>
                        <button type="button" id="closeModalButton" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form action="{{ route('layanan.store') }}" method="POST" enctype="multipart/form-data"
                        id="layananForm">
                        @csrf
                        <!-- Hidden field for cropped image data -->
                        <input type="hidden" name="cropped_image" id="croppedImageData">

                        <div class="space-y-5">
                            <div class="form-group">
                                <label for="nama_layanan" class="block mb-1 text-sm font-medium text-gray-700">Nama
                                    Layanan</label>
                                <input type="text" name="nama_layanan" id="nama_layanan" required
                                    class="w-full px-4 py-3 transition-colors border-2 rounded-lg border-emerald-600 focus:border-emerald-400 focus:ring focus:ring-emerald-200">
                            </div>

                            <div class="form-group">
                                <label for="harga_layanan" class="block mb-1 text-sm font-medium text-gray-700">Harga
                                    Layanan</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <span class="font-medium text-gray-500">Rp</span>
                                    </div>
                                    <input type="text" name="harga_layanan" id="harga_layanan" required
                                        class="w-full px-4 py-3 pl-10 transition-colors border-2 rounded-lg border-emerald-600 focus:border-emerald-400 focus:ring focus:ring-emerald-200"
                                        placeholder="0">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi_layanan"
                                    class="block mb-1 text-sm font-medium text-gray-700">Deskripsi Layanan</label>
                                <textarea name="deskripsi_layanan" id="deskripsi_layanan" rows="6" required
                                    class="w-full px-4 py-3 transition-colors border-2 rounded-lg border-emerald-600 focus:border-emerald-400 focus:ring focus:ring-emerald-200"></textarea>
                            </div>

                            <div class="flex justify-end pt-4 space-x-3">
                                <button type="button" id="cancelModalButton"
                                    class="px-6 py-3 text-gray-800 transition-colors bg-gray-200 rounded-lg hover:bg-gray-300">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white rounded-lg shadow-md transition-all transform hover:-translate-y-0.5">
                                    Simpan Layanan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="successModal"
        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black modal-fade-in bg-opacity-60">
        <div class="w-full max-w-md p-6 bg-white border-l-4 border-green-500 shadow-2xl modal-slide-in rounded-xl">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0 p-2 bg-green-100 rounded-full">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                        </path>
                    </svg>
                </div>
                <h2 class="ml-3 text-xl font-bold text-gray-800">Layanan Berhasil Ditambahkan</h2>
            </div>
            <p class="mb-5 text-gray-600">Layanan baru telah berhasil ditambahkan ke dalam sistem. Data telah disimpan
                dengan aman.</p>
            <div class="flex justify-end">
                <button id="closeSuccessModalButton"
                    class="px-4 py-2 text-white rounded-lg shadow-md bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 pulse-button">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="errorModal"
        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black modal-fade-in bg-opacity-60">
        <div class="w-full max-w-md p-6 bg-white border-l-4 border-red-500 shadow-2xl modal-slide-in rounded-xl">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0 p-2 bg-red-100 rounded-full">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="ml-3 text-xl font-bold text-gray-800">Data Tidak Sesuai</h2>
            </div>
            <p class="mb-5 text-gray-600">Pastikan semua data wajib diisi dengan benar. Mohon periksa kembali formulir
                Anda.</p>
            <div class="flex justify-end">
                <button id="closeErrorModalButton"
                    class="px-4 py-2 text-white rounded-lg shadow-md bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 pulse-button">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Cropper -->
    <div id="cropperModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-75">
        <div class="w-full max-w-3xl p-6 bg-white rounded-lg">
            <div class="flex justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Sesuaikan Gambar</h3>
                <button onclick="closeCropperModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="relative mb-4 bg-gray-100 h-96">
                <img id="cropperImage" src="" alt="Image to crop" class="block max-w-full max-h-full">
            </div>

            <div class="flex flex-wrap gap-2 mt-4">
                <button onclick="rotateLeft()"
                    class="px-4 py-2 rounded-lg bg-emerald-100 text-emerald-700 hover:bg-emerald-200">
                    <i class="fas fa-undo"></i> Rotate Left
                </button>
                <button onclick="rotateRight()"
                    class="px-4 py-2 rounded-lg bg-emerald-100 text-emerald-700 hover:bg-emerald-200">
                    <i class="fas fa-redo"></i> Rotate Right
                </button>
                <button onclick="flipHorizontal()"
                    class="px-4 py-2 rounded-lg bg-emerald-100 text-emerald-700 hover:bg-emerald-200">
                    <i class="fas fa-arrows-alt-h"></i> Flip Horizontal
                </button>
                <button onclick="zoomIn()"
                    class="px-4 py-2 rounded-lg bg-emerald-100 text-emerald-700 hover:bg-emerald-200">
                    <i class="fas fa-search-plus"></i> Zoom In
                </button>
                <button onclick="zoomOut()"
                    class="px-4 py-2 rounded-lg bg-emerald-100 text-emerald-700 hover:bg-emerald-200">
                    <i class="fas fa-search-minus"></i> Zoom Out
                </button>
            </div>

            <div class="flex justify-between gap-2 mt-4">
                <button onclick="useOriginalImage()"
                    class="px-4 py-2 bg-white border rounded-lg text-emerald-700 border-emerald-300 hover:bg-emerald-50">
                    Gunakan Gambar Asli
                </button>

                <div class="flex gap-2">
                    <button onclick="cancelCrop()"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
                        Batal
                    </button>
                    <button onclick="cropImage()"
                        class="px-4 py-2 text-white rounded-lg bg-emerald-600 hover:bg-emerald-700">
                        Terapkan Crop
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer></x-footer>

    <!-- Script Cropper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
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
        document.addEventListener('DOMContentLoaded', function() {
            const errorModal = document.getElementById('errorModal');
            const closeErrorModalButton = document.getElementById('closeErrorModalButton');

            // Modal notifikasi sukses
            const successModal = document.getElementById('successModal');
            const closeSuccessModalButton = document.getElementById('closeSuccessModalButton');

            // Secara default kedua modal disembunyikan
            errorModal.classList.add('hidden');
            successModal.classList.add('hidden');

            // Tampilkan hanya modal error jika ada pesan error dari server
            @if ($errors->any())
                errorModal.classList.remove('hidden');
                successModal.classList.add('hidden'); // Pastikan modal success tetap tersembunyi
            @elseif (session('success'))
                // Tampilkan hanya modal sukses jika ada session success
                successModal.classList.remove('hidden');
                errorModal.classList.add('hidden'); // Pastikan modal error tetap tersembunyi
            @endif

            // Tutup modal error ketika tombol "Tutup" diklik
            closeErrorModalButton.addEventListener('click', () => {
                errorModal.classList.add('hidden');
            });

            // Tutup modal sukses ketika tombol "Tutup" diklik
            closeSuccessModalButton.addEventListener('click', () => {
                successModal.classList.add('hidden');
            });

            // modal tambah layanan
            const openModalButton = document.getElementById('openModalButton');
            const closeModalButton = document.getElementById('closeModalButton');
            const modalTambahLayanan = document.getElementById('modalTambahLayanan');
            const cancelModalButton = document.getElementById('cancelModalButton');

            openModalButton.addEventListener('click', () => {
                modalTambahLayanan.classList.remove('hidden');
            });

            closeModalButton.addEventListener('click', () => {
                modalTambahLayanan.classList.add('hidden');
            });

            cancelModalButton.addEventListener('click', () => {
                modalTambahLayanan.classList.add('hidden');
            });

            window.addEventListener('click', (e) => {
                if (e.target === modalTambahLayanan) {
                    modalTambahLayanan.classList.add('hidden');
                }
            });

            // Format currency input for harga_layanan
            const hargaInput = document.getElementById('harga_layanan');
            hargaInput.addEventListener('input', function(e) {
                // Remove non-digits
                let value = this.value.replace(/\D/g, '');

                // Format with thousand separators
                if (value) {
                    value = parseInt(value, 10).toLocaleString('id-ID');
                }

                this.value = value;
            });

            // Tambahkan event listener untuk file input
            const inputImage = document.getElementById('gambar_layanan');
            inputImage.addEventListener('change', function() {
                handleImageSelect(this);
            });

            // Tambahkan event listener saat form di-submit untuk validasi
            document.getElementById('layananForm').addEventListener('submit', function(e) {
                // Hapus pemisah ribuan dari harga
                const hargaInput = document.getElementById('harga_layanan');
                hargaInput.value = hargaInput.value.replace(/\D/g, '');

                // Periksa apakah gambar sudah dipilih
                if (!document.getElementById('croppedImageData').value) {
                    e.preventDefault(); // Hentikan submit form
                    alert('Silakan pilih dan sesuaikan gambar terlebih dahulu');
                }
            });
        });

        // CROPPER IMPLEMENTATION
        let cropper = null;
        let originalFile = null;

        function handleImageSelect(input) {
            if (input.files && input.files[0]) {
                originalFile = input.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const cropperModal = document.getElementById('cropperModal');
                    const cropperImage = document.getElementById('cropperImage');

                    cropperImage.src = e.target.result;
                    cropperModal.classList.remove('hidden');

                    if (cropper) {
                        cropper.destroy();
                    }

                    cropper = new Cropper(cropperImage, {
                        aspectRatio: 16 / 9,
                        viewMode: 2,
                        dragMode: 'move',
                        background: false,
                        modal: true,
                        guides: true,
                        highlight: true,
                        autoCropArea: 1,
                        responsive: true,
                        cropBoxMovable: true,
                        cropBoxResizable: true,
                        toggleDragModeOnDblclick: true,
                    });
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function rotateLeft() {
            if (cropper) cropper.rotate(-90);
        }

        function rotateRight() {
            if (cropper) cropper.rotate(90);
        }

        function flipHorizontal() {
            if (cropper) cropper.scaleX(-cropper.getData().scaleX || -1);
        }

        function zoomIn() {
            if (cropper) cropper.zoom(0.1);
        }

        function zoomOut() {
            if (cropper) cropper.zoom(-0.1);
        }

        function useOriginalImage() {
            if (originalFile) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Set preview image
                    const previewGambar = document.getElementById('previewGambar');
                    previewGambar.src = e.target.result;

                    // Simpan data gambar asli ke dalam hidden input
                    document.getElementById('croppedImageData').value = e.target.result;

                    // Juga atur file asli ke input file (penting untuk mengirim file ke server)
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(originalFile);
                    document.getElementById('gambar_layanan').files = dataTransfer.files;

                    closeCropperModal();
                };

                reader.readAsDataURL(originalFile);
            }
        }

        function cancelCrop() {
            closeCropperModal();
            document.getElementById('gambar_layanan').value = '';
            document.getElementById('previewGambar').src = "{{ asset('images/UploadFoto.png') }}";
            document.getElementById('croppedImageData').value = '';
        }

        function cropImage() {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas({
                    width: 1280,
                    height: 720,
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                });

                canvas.toBlob((blob) => {
                    const croppedFile = new File([blob], originalFile.name, {
                        type: 'image/jpeg',
                        lastModified: Date.now()
                    });

                    const preview = document.getElementById('previewGambar');

                    preview.src = canvas.toDataURL('image/jpeg');

                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(croppedFile);
                    document.getElementById('gambar_layanan').files = dataTransfer.files;

                    // Simpan data gambar yang di-crop ke dalam hidden input
                    document.getElementById('croppedImageData').value = canvas.toDataURL('image/jpeg');

                    closeCropperModal();
                }, 'image/jpeg', 0.9);
            }
        }

        function closeCropperModal() {
            const modal = document.getElementById('cropperModal');
            modal.classList.add('hidden');
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        }
    </script>
</body>

</html>
