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
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeInn {
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

        .animate-fadeInn {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .animate-fadeOut {
            animation: fadeOut 0.3s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
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
                    <a href="{#edukasi}" class="hover:text-emerald-400">EDUKASI</a>
                    <a href="#galeri" class="hover:text-emerald-400">GALERI</a>
                    <a href="{{ route('layanan.index') }}" class="hover:text-emerald-400">LAYANAN</a>
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
                        <img src="{{ Auth::user()->avatar_url }}" alt="Avatar"
                            class="w-12 h-12 border-2 rounded-full border-emerald-500">
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
                            <a href="{{ route('dashboard') }}"
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
                                class="object-contain w-full h-56 transition-transform duration-500 group-hover:scale-105">
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
        <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-800">Tambah Layanan</h2>
            <form action="{{ route('layanan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="nama_layanan" class="block text-sm font-medium text-gray-700">Nama Layanan</label>
                    <input type="text" name="nama_layanan" id="nama_layanan"
                        class="w-full px-3 py-2 border-2 rounded border-emerald-600 focus:border-emerald-400">
                </div>
                <div class="mb-4">
                    <label for="gambar_layanan" class="block text-sm font-medium text-gray-700">Gambar Layanan</label>
                    <div class="flex items-center space-x-4">
                        <!-- Gambar Preview -->
                        <img id="previewGambar" src="{{ asset('images/UploadFoto.png') }}" alt="Preview Gambar"
                            class="object-contain w-32 h-32 border border-gray-300 rounded-md">
                        <!-- Input File -->
                        <input type="file" name="gambar_layanan" id="gambar_layanan" class="block w-full mt-1"
                            accept="image/*">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="harga_layanan" class="block text-sm font-medium text-gray-700">Harga Layanan</label>
                    <input type="text" name="harga_layanan" id="harga_layanan"
                        class="w-32 px-3 py-2 border-2 rounded shadow-md border-emerald-600">
                </div>
                <div class="mb-4">
                    <label for="deskripsi_layanan" class="block text-sm font-medium text-gray-700">Deskripsi
                        Layanan</label>
                    <textarea name="deskripsi_layanan" id="deskripsi_layanan" rows="4"
                        class="w-full px-3 py-2 border-2 rounded shadow-md border-emerald-600"></textarea>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" id="closeModalButton"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <div id="successModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black modal-fade-in bg-opacity-60">
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
    <<div id="errorModal"
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
        <!-- Footer -->
        <x-footer></x-footer>

        <script>
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
            // Preview gambar saat diupload
            const inputGambar = document.getElementById('gambar_layanan');
            const previewGambar = document.getElementById('previewGambar');

            inputGambar.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewGambar.src = e.target.result; // Ganti src gambar dengan file yang diunggah
                    };
                    reader.readAsDataURL(file); // Membaca file sebagai URL
                }
            });
            // modal tambah layanan
            const openModalButton = document.getElementById('openModalButton');
            const closeModalButton = document.getElementById('closeModalButton');
            const modalTambahLayanan = document.getElementById('modalTambahLayanan');

            openModalButton.addEventListener('click', () => {
                modalTambahLayanan.classList.remove('hidden');
            });

            closeModalButton.addEventListener('click', () => {
                modalTambahLayanan.classList.add('hidden');
            });

            window.addEventListener('click', (e) => {
                if (e.target === modalTambahLayanan) {
                    modalTambahLayanan.classList.add('hidden');
                }
            });
            const menuButton = document.getElementById('menuButton');
            const dropdownUser = document.getElementById('dropdownUser');

            let isDropdownVisible = false;

            menuButton.addEventListener('click', function(e) {
                e.stopPropagation();
                if (!isDropdownVisible) {
                    dropdownUser.classList.remove('hidden');
                    dropdownUser.classList.remove('animate-fadeOut');
                    dropdownUser.classList.add('animate-fadeInn');
                    isDropdownVisible = true;
                } else {
                    dropdownUser.classList.remove('animate-fadeInn');
                    dropdownUser.classList.add('animate-fadeOut');
                    setTimeout(() => {
                        dropdownUser.classList.add('hidden');
                        isDropdownVisible = false;
                    }, 300);
                }
            });

            document.addEventListener('click', function() {
                if (isDropdownVisible) {
                    dropdownUser.classList.remove('animate-fadeInn');
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
        </script>
</body>

</html>
