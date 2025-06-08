<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $produk->nama_produk }} - AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="{{ asset('images/icon-40x40.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                        },
                    },
                },
            },
        }
    </script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        .animate-slide-in {
            animation: slideIn 0.5s ease-out forwards;
        }

        .animate-pulse-slow {
            animation: pulse 2s ease-in-out infinite;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Smooth scrolling */
        .smooth-scroll {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        .custom-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: #10b981 #e5e7eb;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 10px;
        }

        /* Glassmorphism effect */
        .glassmorphism {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Remove arrows from number input */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
            appearance: none;
        }

        /* Image zoom effect */
        .zoom-container {
            overflow: hidden;
        }

        .zoom-effect {
            transition: transform 1s ease;
        }

        .zoom-container:hover .zoom-effect {
            transform: scale(1.15);
        }
    </style>
</head>

<body class="min-h-screen bg-gray-50">
    <main class="container px-4 pt-6 pb-12 mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
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
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('produk.show', $produk->id_produk) }}"
                            class="ml-1 text-sm font-medium text-emerald-600 hover:text-emerald-700 md:ml-2 truncate max-w-[150px]">{{ $produk->nama_produk }}</a>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Product Details -->
        <div class="grid grid-cols-1 gap-10 lg:grid-cols-5">
            <!-- Left: Product Images + Info -->
            <div class="space-y-8 lg:col-span-3 animate-fade-in">
                <!-- Main Image -->
                <div class="p-6 bg-white shadow-sm rounded-2xl zoom-container">
                    <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}"
                        class="w-full h-[400px] object-contain zoom-effect">
                </div>

                <!-- Product Features -->
                <div class="grid grid-cols-3 gap-4">
                    <div
                        class="flex flex-col items-center p-4 transition-transform duration-300 bg-white shadow-sm rounded-xl hover:-translate-y-1">
                        <span class="p-2 mb-2 rounded-full bg-emerald-50">
                            <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </span>
                        <span class="font-medium text-gray-800">Kualitas Original</span>
                        <span class="mt-1 text-xs text-center text-gray-500">Produk dijamin asli</span>
                    </div>
                    <div
                        class="flex flex-col items-center p-4 transition-transform duration-300 bg-white shadow-sm rounded-xl hover:-translate-y-1">
                        <span class="p-2 mb-2 rounded-full bg-emerald-50">
                            <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </span>
                        <span class="font-medium text-gray-800">Pengiriman Cepat</span>
                        <span class="mt-1 text-xs text-center text-gray-500">Sampai tepat waktu</span>
                    </div>
                    <div
                        class="flex flex-col items-center p-4 transition-transform duration-300 bg-white shadow-sm rounded-xl hover:-translate-y-1">
                        <span class="p-2 mb-2 rounded-full bg-emerald-50">
                            <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </span>
                        <span class="font-medium text-gray-800">Terpercaya</span>
                        <span class="mt-1 text-xs text-center text-gray-500">Jaminan kualitas</span>
                    </div>
                </div>

                <!-- Product Description -->
                <div class="p-6 bg-white shadow-sm rounded-2xl">
                    <h2 class="flex items-center mb-4 text-xl font-bold text-gray-800">
                        <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Deskripsi Produk
                    </h2>
                    <div class="space-y-4 text-gray-600">
                        <p>{{ $produk->deskripsi_produk }}</p>

                        <!-- Additional info if needed -->
                        <div class="pt-4 border-t border-gray-100">
                            <div class="flex items-center mb-2">
                                <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm">Kualitas terjamin oleh tim AgroMart</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Product Info + Actions -->
            <div class="lg:col-span-2 animate-slide-in">
                <div class="sticky top-24">
                    <div class="p-6 bg-white shadow-sm rounded-2xl">
                        <!-- Product Title & Badges -->
                        <div class="mb-4">
                            <h1 class="mb-2 text-2xl font-bold text-gray-800">{{ $produk->nama_produk }}</h1>
                        </div>

                        <!-- Price & Stock -->
                        <div class="mb-6">
                            <div class="flex items-end mb-2">
                                <span class="text-3xl font-bold text-emerald-600">
                                    Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex items-center mt-1">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-1 text-sm text-gray-600">
                                    Tersedia <span class="font-semibold">{{ $produk->jumlah_stok }}</span> stok
                                </span>
                            </div>
                        </div>

                        <!-- Separator -->
                        <div class="w-full h-px my-6 bg-gray-200"></div>

                        <!-- Quantity Selector -->
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Jumlah</label>
                            <div class="flex items-center">
                                <button id="decrement"
                                    class="flex items-center justify-center w-10 h-10 transition-colors bg-gray-100 border border-r-0 border-gray-300 rounded-l-lg hover:bg-gray-200">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 12H4"></path>
                                    </svg>
                                </button>

                                <input type="number" id="jumlah" name="jumlah" value="1" min="1"
                                    max="{{ $produk->jumlah_stok }}"
                                    class="w-16 h-10 text-center text-gray-700 border-gray-300 border-y focus:ring-emerald-500 focus:border-emerald-500">

                                <button id="increment"
                                    class="flex items-center justify-center w-10 h-10 transition-colors bg-gray-100 border border-l-0 border-gray-300 rounded-r-lg hover:bg-gray-200">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </button>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">*Maksimum pembelian
                                {{ $produk->jumlah_stok - 2 }} item</p>
                        </div>

                        <!-- Total Price -->
                        <div class="flex items-center justify-between px-5 py-4 mb-6 bg-emerald-50 rounded-xl">
                            <span class="text-base font-medium text-gray-700">Total</span>
                            <span class="text-2xl font-bold text-emerald-600" id="totalHarga">
                                Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}
                            </span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-3">
                            @if (Auth::user()->hasRole('admin'))
                                <div class="flex space-x-2">
                                    <a href="{{ route('produk.edit', $produk->id_produk) }}"
                                        class="flex items-center justify-center flex-1 py-3 font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                            </path>
                                        </svg>
                                        Edit Produk
                                    </a>

                                    <button type="button" onclick="showDeleteModal()"
                                        class="flex items-center justify-center flex-1 py-3 font-medium text-white transition-colors bg-red-600 rounded-lg hover:bg-red-700">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        Nonaktifkan
                                    </button>
                                </div>
                            @else
                                <form action="{{ route('checkout.index') }}" method="GET">
                                    <input type="hidden" id="jumlahCheckout" name="jumlah" value="1">
                                    <input type="hidden" name="produk_id" value="{{ $produk->id_produk }}">
                                    <button type="submit"
                                        class="flex items-center justify-center w-full py-3 font-medium text-white transition-colors rounded-lg bg-emerald-600 hover:bg-emerald-700">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Beli Sekarang
                                    </button>
                                </form>
                            @endif
                        </div>
                        <!-- Shipping Info -->
                        <div class="mt-6">
                            <div class="flex items-start p-4 space-x-3 bg-blue-50 rounded-xl">
                                <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-blue-800">Info Pengiriman</p>
                                    <p class="mt-1 text-xs text-blue-600">Estimasi pengiriman 1-2 hari</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm"></div>
            <div class="relative w-full max-w-md p-6 mx-4 bg-white shadow-xl rounded-xl">
                <div class="flex items-start mb-4">
                    <div
                        class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full">
                        <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>
                <h3 class="mb-4 text-xl font-medium text-center text-gray-900">Nonaktifkan Produk</h3>
                <p class="mb-6 text-sm text-center text-gray-500">
                    Apakah Anda yakin ingin menonaktifkan produk ini? Produk yang dinonaktifkan tidak
                    akan ditampilkan kepada pengguna tetapi masih dapat dipulihkan nanti.
                </p>
                <div class="flex justify-center space-x-3">
                    <button type="button" onclick="hideDeleteModal()"
                        class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <form action="{{ route('produk.destroy', $produk->id_produk) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700">
                            Ya, Nonaktifkan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        function showDeleteModal() {
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function hideDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Close modal when clicking on backdrop
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideDeleteModal();
            }
        });
        // Inisialisasi elemen DOM
        const decrementButton = document.getElementById('decrement');
        const incrementButton = document.getElementById('increment');
        const jumlahInput = document.getElementById('jumlah');
        const maxPembelian = Math.min({{ $produk->jumlah_stok - 2 }}, 10);
        const hargaProduk = {{ $produk->harga_produk }};
        const totalHargaElement = document.getElementById('totalHarga');
        const jumlahCheckoutInput = document.getElementById('jumlahCheckout');

        // Format number to IDR currency
        function formatRupiah(number) {
            return 'Rp ' + number.toLocaleString('id-ID');
        }

        // Update total harga dan jumlah checkout
        function updateTotalHarga() {
            const jumlah = parseInt(jumlahInput.value) || 1;
            const totalHarga = hargaProduk * jumlah;

            // Update tampilan total harga dengan animasi
            totalHargaElement.classList.add('animate-pulse-slow');
            setTimeout(() => {
                totalHargaElement.textContent = formatRupiah(totalHarga);
                totalHargaElement.classList.remove('animate-pulse-slow');
            }, 150);

            // Update hidden input untuk checkout
            jumlahCheckoutInput.value = jumlah;
        }

        // Event listener untuk tombol decrement
        decrementButton.addEventListener('click', () => {
            let currentValue = parseInt(jumlahInput.value) || 1;
            if (currentValue > 1) {
                jumlahInput.value = currentValue - 1;
                updateTotalHarga();
            }
        });

        // Event listener untuk tombol increment
        incrementButton.addEventListener('click', () => {
            let currentValue = parseInt(jumlahInput.value) || 1;
            if (currentValue < maxPembelian) {
                jumlahInput.value = currentValue + 1;
                updateTotalHarga();
            }
        });

        // Event listener untuk input manual
        jumlahInput.addEventListener('change', () => {
            let currentValue = parseInt(jumlahInput.value) || 1;

            // Validasi nilai minimum dan maksimum
            if (currentValue < 1) {
                currentValue = 1;
            } else if (currentValue > maxPembelian) {
                currentValue = maxPembelian;
            }

            // Update nilai input dan total harga
            jumlahInput.value = currentValue;
            updateTotalHarga();
        });

        // Inisialisasi total harga saat halaman dimuat
        updateTotalHarga();
    </script>
</body>

</html>
