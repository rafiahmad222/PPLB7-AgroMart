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

        body {
            height: 100vh;
            overflow: hidden;
        }

        .product-container {
            height: calc(100vh - 4rem);
            /* Subtract header height */
            overflow: hidden;
        }

        .product-info {
            height: 100%;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #22c55e #e5e7eb;
        }

        .product-info::-webkit-scrollbar {
            width: 6px;
        }

        .product-info::-webkit-scrollbar-track {
            background: #e5e7eb;
            border-radius: 3px;
        }

        .product-info::-webkit-scrollbar-thumb {
            background-color: #22c55e;
            border-radius: 3px;
        }

        .animate-fadeIn {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .animate-fadeOut {
            animation: fadeOut 0.3s ease-out forwards;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
            /* Firefox */
            appearance: none;
            /* Modern browsers */
        }
    </style>
</head>

<body class="h-screen bg-gray-50 font-[Poppins] flex flex-col">
    <!-- Breadcrumb -->
    <nav class="flex my-4 ml-2 text-sm" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-emerald-600">Home</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z">
                        </path>
                    </svg>
                    <a href="{{ route('produk.index') }}" class="text-gray-500 hover:text-emerald-600">Produk</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z">
                        </path>
                    </svg>
                    <span class="text-gray-500">{{ $produk->nama_produk }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <main class="container flex-1 px-4 mx-auto product-container">
        <div class="grid h-full grid-cols-1 gap-8 lg:grid-cols-2">
            <!-- Left: Product Image -->
            <div class="flex flex-col h-full">
                <div class="flex items-center justify-center flex-1 p-4 overflow-hidden bg-white rounded-xl">
                    <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}"
                        class="object-cover transition-transform duration-500 max-h-64 hover:scale-105">
                </div>
                <!-- Product Features -->
                <div class="grid grid-cols-3 gap-4 mt-4">
                    <div class="p-3 text-center bg-white rounded-xl">
                        <svg class="w-5 h-5 mx-auto mb-1 text-emerald-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <span class="text-xs text-gray-600">Original</span>
                    </div>
                    <div class="p-3 text-center bg-white rounded-xl">
                        <svg class="w-5 h-5 mx-auto mb-1 text-emerald-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-xs text-gray-600">Cepat</span>
                    </div>
                    <div class="p-3 text-center bg-white rounded-xl">
                        <svg class="w-5 h-5 mx-auto mb-1 text-emerald-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                        <span class="text-xs text-gray-600">Garansi</span>
                    </div>
                </div>
            </div>

            <!-- Right: Product Info -->
            <div class="p-6 bg-white shadow-sm product-info rounded-xl">
                <div class="space-y-6">
                    <!-- Product Title & Stock -->
                    <div class="pb-4 border-b">
                        <h1 class="mb-2 text-2xl font-bold text-gray-800">{{ $produk->nama_produk }}</h1>
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-1 text-sm font-semibold rounded-full text-emerald-600 bg-emerald-100">
                                Stok: {{ $produk->jumlah_stok }}
                            </span>
                        </div>
                    </div>

                    <!-- Price & Description -->
                    <div class="pb-4 space-y-3 border-b">
                        <div class="flex items-baseline">
                            <span class="text-2xl font-bold text-emerald-600">
                                Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}
                            </span>
                            <span class="ml-2 text-sm text-gray-500">/pcs</span>
                        </div>
                        <p class="text-sm text-gray-600">{{ $produk->deskripsi_produk }}</p>
                    </div>

                    <!-- Quantity Selection -->
                    <div class="pb-4 border-b">
                        <label class="block mb-2 text-sm font-medium text-gray-700">Jumlah</label>
                        <div class="flex items-center space-x-3">
                            <button id="decrement"
                                class="flex items-center justify-center w-8 h-8 text-gray-600 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4">
                                    </path>
                                </svg>
                            </button>
                            <input type="number" id="jumlah" name="jumlah" value="1" min="1"
                                max="{{ $produk->jumlah_stok }}"
                                class="w-16 h-8 text-center border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                            <button id="increment"
                                class="flex items-center justify-center w-8 h-8 text-gray-600 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Total Price -->
                    <div class="pb-4 border-b">
                        <div class="flex items-baseline justify-between">
                            <span class="text-lg font-medium text-gray-700">Total</span>
                            <span class="text-2xl font-bold text-emerald-600" id="totalHarga">
                                Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col gap-3">
                        <form action="{{ route('checkout.index') }}" method="GET">
                            <input type="hidden" id="jumlahCheckout" name="jumlah" value="1">
                            <input type="hidden" name="produk_id" value="{{ $produk->id_produk }}">
                            <button type="submit"
                                class="w-full px-6 py-3 text-sm font-medium text-white transition-colors rounded-lg bg-emerald-600 hover:bg-emerald-700">
                                Beli Sekarang
                            </button>
                        </form>
                        <button
                            class="w-full px-6 py-3 text-sm font-medium transition-colors border rounded-lg text-emerald-600 border-emerald-600 hover:bg-emerald-50">
                            Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Keep existing JavaScript -->
    <script>
        // Inisialisasi elemen DOM
        const decrementButton = document.getElementById('decrement');
        const incrementButton = document.getElementById('increment');
        const jumlahInput = document.getElementById('jumlah');
        const maxPembelian = {{ $produk->jumlah_stok - 2 }};
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

            // Update tampilan total harga
            totalHargaElement.textContent = formatRupiah(totalHarga);

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
