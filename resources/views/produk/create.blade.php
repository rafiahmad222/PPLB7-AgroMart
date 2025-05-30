<!-- filepath: d:\PPL-AgroMart\resources\views\produk\create.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="{{ asset('images/icon-40x40.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@400;600;700&family=Signika:wght@300..700&family=Volkhov:wght@400;700&display=swap"
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
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                        signika: ['Signika', 'sans-serif'],
                        manrope: ['Manrope', 'sans-serif'],
                        volkhov: ['Volkhov', 'serif']
                    },
                }
            }
        }
    </script>
    <style>
        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes dropdownFadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(-10px);
            }
        }

        .dropdown-animate-in {
            animation: dropdownFadeIn 0.3s forwards;
        }

        .dropdown-animate-out {
            animation: dropdownFadeOut 0.3s forwards;
        }

        .image-container {
            background-image: linear-gradient(45deg, #f3f4f6 25%, transparent 25%, transparent 75%, #f3f4f6 75%, #f3f4f6),
                linear-gradient(45deg, #f3f4f6 25%, transparent 25%, transparent 75%, #f3f4f6 75%, #f3f4f6);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
        }
    </style>
</head>

<body class="text-gray-800 bg-gray-50 font-poppins">
    <!-- Header with Glassmorphism -->
    <header class="sticky top-0 z-50 shadow-lg backdrop-blur-md bg-white/70">
        <nav class="flex items-center justify-between max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Logo AgroMart" class="h-12">
                </a>
                <div class="items-center hidden gap-4 text-base font-semibold md:flex text-emerald-700 font-signika">
                    <a href="{{ route('home') }}" class="hover:text-emerald-400">HOME</a>
                    <div class="relative group">
                        <a href="{{ route('produk.index') }}" class="flex items-center gap-1 hover:text-emerald-400">
                            PRODUK
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </a>
                        <div
                            class="absolute hidden w-40 border rounded-md shadow-lg backdrop-blur-md bg-white/80 z-5 group-hover:block animate-fadeIn text-emerald-600 border-white/20">
                            @foreach ($kategoris as $kategori)
                                <a href="{{ route('produk.index', $kategori->id_kategori) }}"
                                    class="block px-4 py-2 text-sm rounded-md text-emerald-700 hover:bg-emerald-50/50 hover:text-emerald-400">
                                    {{ $kategori->nama_kategori }}
                                </a>
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
                <button class="relative p-1.5 transition-transform hover:scale-110 active:scale-90">
                    <img src="{{ asset('images/keranjangIcon.png') }}" alt="Keranjang" class="w-8 h-8">
                    <div
                        class="absolute top-0 right-0 flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full">
                        0</div>
                </button>

                <button class="transition-transform hover:scale-110 active:scale-90">
                    <img src="{{ asset('images/notifIcon.png') }}" alt="Notifikasi" class="w-10 h-10">
                </button>

                <div id="menuButton" class="relative">
                    <div class="flex items-center gap-2 cursor-pointer">
                        <img src="{{ asset('images/avatar.png') }}" alt="Avatar"
                            class="w-12 h-12 border-2 rounded-full border-emerald-500">
                        <div class="hidden text-left md:block">
                            <span class="block font-bold">{{ Auth::user()->name }}</span>
                            <small class="text-gray-500">{{ Auth::user()->email }}</small>
                        </div>
                    </div>
                    <div id="dropdownUser"
                        class="absolute right-0 z-30 flex-col hidden w-48 mt-4 border rounded-md shadow-2xl backdrop-blur-md bg-white/80 border-white/20 font-signika">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm rounded-md hover:bg-emerald-50/50">Profile</a>
                        <a href="{{ route('pesananku') }}"
                            class="block px-4 py-2 text-sm rounded-md hover:bg-emerald-50/50">Pesananku</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full px-4 py-2 text-sm text-left rounded-md hover:bg-emerald-50/50">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container px-4 py-5 mx-auto">
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="mb-10">
            @csrf
            <div class="p-6 bg-white shadow-lg rounded-xl">
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                    <!-- Left Side - Image Upload -->
                    <div class="lg:col-span-1">
                        <div
                            class="flex flex-col items-center p-6 space-y-4 border-2 border-dashed rounded-lg border-emerald-200 bg-emerald-50">
                            <h3 class="text-xl font-bold text-emerald-700">Foto Produk</h3>

                            <div class="relative w-full overflow-hidden rounded-lg aspect-square image-container">
                                <img id="preview-image" src="{{ asset('images/UploadFoto.png') }}" alt="Upload Icon"
                                    class="object-contain w-full h-full transition-opacity">

                                <div
                                    class="absolute inset-0 flex flex-col items-center justify-center transition-opacity bg-black opacity-0 bg-opacity-40 hover:opacity-100">
                                    <span
                                        class="px-4 py-2 mb-2 font-medium text-white rounded-lg shadow-lg bg-emerald-600">
                                        <i class="mr-2 fas fa-camera"></i> Pilih Foto
                                    </span>
                                    <p class="text-xs text-white">Klik untuk mengunggah gambar</p>
                                </div>
                            </div>

                            <input type="file" id="gambar_produk" name="gambar_produk" accept="image/*" required
                                class="hidden">

                            <p class="text-sm text-center text-gray-500">
                                Format gambar: JPG, PNG, atau GIF<br>
                                Maksimal ukuran: 2MB
                            </p>
                        </div>
                    </div>

                    <!-- Right Side - Form Fields -->
                    <div class="lg:col-span-2">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div class="col-span-2">
                                <label for="nama_produk" class="block mb-1 text-sm font-medium text-gray-700">Nama
                                    Produk</label>
                                <input type="text" id="nama_produk" name="nama_produk" required
                                    class="w-full px-4 py-3 transition-colors border-2 rounded-lg border-emerald-600 focus:border-2 focus:border-emerald-400 focus:ring focus:ring-emerald-200"
                                    placeholder="Masukkan nama produk">
                            </div>

                            <div>
                                <label for="jumlah_stok" class="block mb-1 text-sm font-medium text-gray-700">Jumlah
                                    Stok</label>
                                <div class="relative">
                                    <input type="number" id="jumlah_stok" name="jumlah_stok" required
                                        min="1"
                                        class="w-full px-4 py-3 transition-colors border-2 rounded-lg border-emerald-600 focus:border-emerald-400 focus:ring focus:ring-emerald-200"
                                        placeholder="0">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span class="text-gray-500">unit</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="harga_produk" class="block mb-1 text-sm font-medium text-gray-700">Harga
                                    Produk</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <span class="font-medium text-gray-500">Rp</span>
                                    </div>
                                    <input type="text" id="harga_produk" name="harga_produk" required
                                        class="w-full px-4 py-3 pl-10 transition-colors border-2 rounded-lg border-emerald-600 focus:border-emerald-400 focus:ring focus:ring-emerald-200"
                                        placeholder="10000">
                                </div>
                            </div>

                            <div class="col-span-2">
                                <label for="id_kategori"
                                    class="block mb-1 text-sm font-medium text-gray-700">Kategori</label>
                                <select id="id_kategori" name="id_kategori" required
                                    class="w-full px-4 py-3 transition-colors bg-white border-2 rounded-lg appearance-none border-emerald-600 focus:border-emerald-400 focus:ring focus:ring-emerald-200">
                                    <option value="">-- Pilih Kategori Produk --</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="relative">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none"
                                        style="top: -30px">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-2">
                                <label for="deskripsi_produk"
                                    class="block mb-1 text-sm font-medium text-gray-700">Deskripsi Produk</label>
                                <textarea id="deskripsi_produk" name="deskripsi_produk" rows="5" maxlength="305" required
                                    class="w-full px-4 py-3 transition-colors border-2 rounded-lg resize-none border-emerald-600 focus:border-emerald-400 focus:ring focus:ring-emerald-200"
                                    placeholder="Jelaskan secara detail tentang produk ini agar pelanggan dapat mengenal produk Anda dengan baik."></textarea>
                                <div class="flex justify-end mt-1 text-xs text-gray-500">
                                    <span id="char-count">0</span>/305 karakter
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end mt-8 space-x-4">
                    <a href="{{ route('produk.index') }}"
                        class="px-6 py-3 font-medium text-gray-700 transition-colors bg-gray-200 rounded-lg hover:bg-gray-300">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-3 font-medium text-white transition-all transform rounded-lg shadow-md bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 hover:-translate-y-0.5 hover:shadow-lg">
                        <i class="mr-2 fas fa-plus"></i> Tambahkan Produk
                    </button>
                </div>
            </div>
        </form>
    </main>

    <script>
        // Image upload preview
        document.querySelector('.image-container').addEventListener('click', function() {
            document.getElementById('gambar_produk').click();
        });

        document.getElementById('gambar_produk').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview-image');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('opacity-50');
                };
                reader.readAsDataURL(file);
            }
        });

        // User dropdown menu
        const menuButton = document.getElementById('menuButton');
        const dropdownUser = document.getElementById('dropdownUser');

        menuButton.addEventListener('click', function(e) {
            e.stopPropagation();

            if (dropdownUser.classList.contains('hidden')) {
                dropdownUser.classList.remove('hidden');
                dropdownUser.classList.add('dropdown-animate-in');
            } else {
                dropdownUser.classList.add('dropdown-animate-out');
                setTimeout(() => {
                    dropdownUser.classList.add('hidden');
                    dropdownUser.classList.remove('dropdown-animate-out');
                }, 280);
            }
        });

        // Hide dropdown when clicking elsewhere
        document.addEventListener('click', function() {
            if (!dropdownUser.classList.contains('hidden')) {
                dropdownUser.classList.add('dropdown-animate-out');
                setTimeout(() => {
                    dropdownUser.classList.add('hidden');
                    dropdownUser.classList.remove('dropdown-animate-out');
                }, 280);
            }
        });

        // Prevent dropdown from closing when clicked
        dropdownUser.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Character counter for description
        const textarea = document.getElementById("deskripsi_produk");
        const charCount = document.getElementById("char-count");

        textarea.addEventListener("input", function() {
            const count = textarea.value.length;
            charCount.textContent = count;

            // Add visual feedback as user approaches limit
            if (count > 275) {
                charCount.classList.add('text-red-500', 'font-semibold');
            } else if (count > 240) {
                charCount.classList.add('text-yellow-500', 'font-semibold');
                charCount.classList.remove('text-red-500');
            } else {
                charCount.classList.remove('text-yellow-500', 'text-red-500', 'font-semibold');
            }
        });

        // Format currency input
        const hargaInput = document.getElementById('harga_produk');
        hargaInput.addEventListener('input', function(e) {
            // Remove non-digits
            let value = this.value.replace(/\D/g, '');

            // Format with thousand separators
            if (value) {
                value = parseInt(value, 10).toLocaleString('id-ID');
            }

            this.value = value;
        });
    </script>
</body>

</html>
