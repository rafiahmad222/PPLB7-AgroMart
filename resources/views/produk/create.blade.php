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

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
            appearance: none;
        }
    </style>
</head>

<body class="text-gray-800 bg-gray-50 font-poppins">
    <!-- Header yang lebih rapi dengan padding dan margin yang konsisten -->
    <div class="max-w-5xl px-6 mx-auto my-8">
        <nav class="flex mb-2" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center text-sm font-medium text-emerald-600 hover:text-emerald-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('produk.index') }}"
                            class="ml-1 text-sm font-medium text-emerald-600 hover:text-emerald-700 md:ml-2">Produk</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Tambah Produk</span>
                    </div>
                </li>
            </ol>
        </nav>
        <h1 class="mb-2 text-3xl font-bold text-gray-800">Tambah Produk</h1>
        <p class="mb-2 text-gray-600">Tambahkan informasi lengkap tentang produk Anda</p>
    </div>

    <!-- Main Content dengan container yang lebih konsisten -->
    <main class="max-w-5xl px-6 py-2 mx-auto mb-16">
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="mb-10">
            @csrf
            <div class="p-8 bg-white shadow-lg rounded-xl">
                <div class="grid grid-cols-1 gap-10 lg:grid-cols-3">
                    <!-- Left Side - Image Upload dengan desain yang lebih baik -->
                    <div class="lg:col-span-1">
                        <div
                            class="flex flex-col items-center p-6 space-y-4 transition-colors border-2 border-dashed rounded-lg border-emerald-200 bg-emerald-50 hover:bg-emerald-100">
                            <h3 class="text-xl font-bold text-emerald-700">Foto Produk</h3>

                            <div
                                class="relative w-full overflow-hidden rounded-lg shadow-sm aspect-square image-container">
                                <img id="preview-image" src="{{ asset('images/UploadFoto.png') }}" alt="Upload Icon"
                                    class="object-contain w-full h-full transition-all duration-300">

                                <div
                                    class="absolute inset-0 flex flex-col items-center justify-center transition-opacity bg-black opacity-0 bg-opacity-40 hover:opacity-100">
                                    <span
                                        class="px-4 py-2 mb-2 font-medium text-white transition-colors rounded-lg shadow-lg bg-emerald-600 hover:bg-emerald-700">
                                        <i class="mr-2 fas fa-camera"></i> Pilih Foto
                                    </span>
                                    <p class="text-xs text-white">Klik untuk mengunggah gambar</p>
                                </div>
                            </div>

                            <input type="file" id="gambar_produk" name="gambar_produk" accept="image/*" required
                                class="hidden">

                            <p class="w-full px-3 py-2 text-sm text-center text-gray-500 bg-white rounded-md">
                                Format gambar: JPG, PNG, atau GIF<br>
                                Maksimal ukuran: 2MB
                            </p>
                        </div>
                    </div>

                    <!-- Right Side - Form Fields dengan spacing yang lebih baik -->
                    <div class="lg:col-span-2">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div class="col-span-2">
                                <label for="nama_produk" class="block mb-2 text-sm font-semibold text-gray-700">Nama
                                    Produk</label>
                                <input type="text" id="nama_produk" name="nama_produk" required
                                    class="w-full px-4 py-3 transition-colors border-2 rounded-lg border-emerald-500 focus:border-emerald-600 focus:ring focus:ring-emerald-200 focus:ring-opacity-50"
                                    placeholder="Masukkan nama produk">
                            </div>

                            <div>
                                <label for="jumlah_stok" class="block mb-2 text-sm font-semibold text-gray-700">Jumlah
                                    Stok</label>
                                <div class="relative">
                                    <input type="number" id="jumlah_stok" name="jumlah_stok" required min="1"
                                        class="w-full px-4 py-3 transition-colors border-2 rounded-lg border-emerald-500 focus:border-emerald-600 focus:ring focus:ring-emerald-200 focus:ring-opacity-50"
                                        placeholder="0">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span class="font-medium text-gray-500">unit</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="harga_produk" class="block mb-2 text-sm font-semibold text-gray-700">Harga
                                    Produk</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <span class="font-medium text-gray-500">Rp</span>
                                    </div>
                                    <input type="text" id="harga_produk" name="harga_produk" required
                                        class="w-full px-4 py-3 pl-10 transition-colors border-2 rounded-lg border-emerald-500 focus:border-emerald-600 focus:ring focus:ring-emerald-200 focus:ring-opacity-50"
                                        placeholder="10.000">
                                </div>
                            </div>

                            <div class="col-span-2">
                                <label for="id_kategori"
                                    class="block mb-2 text-sm font-semibold text-gray-700">Kategori</label>
                                <div class="relative">
                                    <select id="id_kategori" name="id_kategori" required
                                        class="w-full px-4 py-3 transition-colors bg-white border-2 rounded-lg appearance-none border-emerald-500 focus:border-emerald-600 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                                        <option value="">-- Pilih Kategori Produk --</option>
                                        @foreach ($kategoris as $kategori)
                                            <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500"
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
                                    class="block mb-2 text-sm font-semibold text-gray-700">Deskripsi Produk</label>
                                <textarea id="deskripsi_produk" name="deskripsi_produk" rows="5" maxlength="305" required
                                    class="w-full px-4 py-3 transition-colors border-2 rounded-lg resize-none border-emerald-500 focus:border-emerald-600 focus:ring focus:ring-emerald-200 focus:ring-opacity-50"
                                    placeholder="Jelaskan secara detail tentang produk ini agar pelanggan dapat mengenal produk Anda dengan baik."></textarea>
                                <div class="flex justify-end mt-2 text-xs text-gray-500">
                                    <span id="char-count">0</span>/305 karakter
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions dengan tombol yang lebih menarik -->
                <div class="flex flex-col justify-end mt-10 space-y-3 sm:flex-row sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('produk.index') }}"
                        class="px-6 py-3 font-medium text-center text-gray-700 transition-colors bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 focus:ring-2 focus:ring-gray-300 focus:outline-none">
                        <i class="mr-2 fas fa-arrow-left"></i> Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-3 font-medium text-center text-white transition-all transform rounded-lg shadow-md bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 hover:-translate-y-0.5 hover:shadow-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                        <i class="mr-2 fas fa-plus"></i> Tambahkan Produk
                    </button>
                </div>
            </div>
        </form>
    </main>

    <script>
        // Image upload preview dengan animasi yang lebih halus
        document.querySelector('.image-container').addEventListener('click', function() {
            document.getElementById('gambar_produk').click();
        });

        document.getElementById('gambar_produk').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview-image');

            if (file) {
                // Validasi ukuran file (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB.');
                    this.value = '';
                    return;
                }

                // Validasi tipe file
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Gunakan JPG, PNG, atau GIF.');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    // Add fade effect
                    preview.classList.add('opacity-70');
                    setTimeout(() => {
                        preview.src = e.target.result;
                        preview.classList.remove('opacity-70');
                    }, 200);
                };
                reader.readAsDataURL(file);
            }
        });

        // Character counter for description with better feedback
        const textarea = document.getElementById("deskripsi_produk");
        const charCount = document.getElementById("char-count");

        textarea.addEventListener("input", function() {
            const count = textarea.value.length;
            charCount.textContent = count;

            // Add visual feedback as user approaches limit
            if (count > 290) {
                charCount.classList.add('text-red-500', 'font-bold');
                charCount.classList.remove('text-yellow-500');
            } else if (count > 250) {
                charCount.classList.add('text-yellow-500', 'font-semibold');
                charCount.classList.remove('text-red-500', 'font-bold');
            } else {
                charCount.classList.remove('text-yellow-500', 'text-red-500', 'font-semibold', 'font-bold');
            }
        });

        // Format currency input with better handling
        const hargaInput = document.getElementById('harga_produk');
        hargaInput.addEventListener('input', function(e) {
            // Remove non-digits
            let value = this.value.replace(/\D/g, '');

            // Format with thousand separators
            if (value) {
                value = new Intl.NumberFormat('id-ID').format(parseInt(value, 10));
            }

            this.value = value;
        });

        // Form validation before submit
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const namaInput = document.getElementById('nama_produk');
            const stokInput = document.getElementById('jumlah_stok');
            const hargaInput = document.getElementById('harga_produk');
            const kategoriInput = document.getElementById('id_kategori');
            const gambarInput = document.getElementById('gambar_produk');

            let isValid = true;

            // Basic validation example
            if (namaInput.value.trim().length < 3) {
                alert('Nama produk terlalu pendek');
                isValid = false;
            }

            if (parseInt(stokInput.value) <= 0) {
                alert('Jumlah stok harus lebih dari 0');
                isValid = false;
            }

            if (!hargaInput.value) {
                alert('Harga produk harus diisi');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>
</body>

</html>
