<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Layanan - AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="images/icon-40x40.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans bg-gray-100">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <nav class="flex items-center justify-between max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Logo AgroMart" class="h-12">
                </a>
                <div class="items-center hidden gap-4 text-base font-semibold md:flex text-emerald-700">
                    <a href="{{ route('home') }}" class="hover:text-emerald-400">HOME</a>
                    <a href="{{ route('produk.index') }}" class="hover:text-emerald-400">PRODUK</a>
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
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Akun</a>
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('dashboard') }}"
                                class="block px-4 py-2 text-sm hover:bg-gray-100">Transaksi</a>
                            <a href="{{ route('profile.adminshowuser') }}"
                                class="block px-4 py-2 text-sm hover:bg-gray-100">Akun Customer</a>
                        @else
                            <a href="{{ route('pesananku') }}"
                                class="block px-4 py-2 text-sm hover:bg-gray-100">Transaksi</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full px-4 py-2 text-sm text-left hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="container px-4 py-8 mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Layanan</h1>
            @if (Auth::user()->hasRole('admin'))
                <button id="openModalButton" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                    +Tambah Layanan
                </button>
            @endif
        </div>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($layanans as $layanan)
                <a href="{{ route('layanan.show', $layanan->id_layanan) }}">
                    <div class="overflow-hidden bg-white rounded-lg shadow-md">
                        <img src="{{ asset('storage/' . $layanan->gambar_layanan) }}"
                            alt="{{ $layanan->nama_layanan }}" class="object-contain w-full h-48">
                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-800">{{ $layanan->nama_layanan }}</h2>
                            <p class="font-bold text-emerald-600">Rp
                                {{ number_format($layanan->harga_layanan, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
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
                            class="object-cover w-32 h-32 border border-gray-300 rounded-md">
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
    <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="w-full max-w-sm p-6 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-800">Layanan Berhasil Ditambahkan</h2>
            <div class="flex justify-center">
                <button id="closeSuccessModalButton"
                    class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                    Oke
                </button>
            </div>
        </div>
    </div>
    <div id="errorModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="w-full max-w-sm p-6 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-red-600">Data Tidak Sesuai</h2>
            <p class="mb-4 text-gray-800">Pastikan semua data wajib diisi dengan benar.</p>
            <div class="flex justify-center">
                <button id="closeErrorModalButton" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                    Oke
                </button>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="py-8 text-white bg-gray-800">
        <div class="container flex flex-wrap justify-between px-4 mx-auto">
            <div class="mb-4">
                <h4 class="text-lg font-bold">Hidroponik Jember</h4>
                <p>Website sistem pemasaran produk hidroponik.</p>
            </div>
            <div class="mb-4">
                <h4 class="text-lg font-bold">Explore</h4>
                <ul>
                    <li><a href="#" class="hover:text-emerald-400">Home</a></li>
                    <li><a href="#" class="hover:text-emerald-400">Produk</a></li>
                    <li><a href="#" class="hover:text-emerald-400">Edukasi</a></li>
                </ul>
            </div>
            <div class="mb-4">
                <h4 class="text-lg font-bold">Contact</h4>
                <p>Email: hidroponik@gmail.com</p>
                <p>Telepon: 0821-xxxx-xxxx</p>
            </div>
        </div>
    </footer>

    <script>
        // Modal notifikasi error
        const errorModal = document.getElementById('errorModal');
        const closeErrorModalButton = document.getElementById('closeErrorModalButton');

        // Tampilkan modal jika ada pesan error dari server
        @if ($errors->any())
            errorModal.classList.remove('hidden');
        @endif

        // Tutup modal ketika tombol "Oke" diklik
        closeErrorModalButton.addEventListener('click', () => {
            errorModal.classList.add('hidden');
        });
        // Modal notifikasi sukses
        const successModal = document.getElementById('successModal');
        const closeSuccessModalButton = document.getElementById('closeSuccessModalButton');

        // Tampilkan modal jika ada pesan sukses dari server
        @if (session('success'))
            successModal.classList.remove('hidden');
        @endif

        // Tutup modal ketika tombol "Oke" diklik
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

        menuButton.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownUser.classList.toggle('hidden');
        });

        document.addEventListener('click', function() {
            dropdownUser.classList.add('hidden');
        });

        dropdownUser.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    </script>
</body>

</html>
