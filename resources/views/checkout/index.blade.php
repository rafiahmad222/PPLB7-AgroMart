<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - AgroMart</title>
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
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
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

        .animate-fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }

        .animate-fade-in-delay-1 {
            animation: fadeIn 0.4s ease-out 0.1s forwards;
            opacity: 0;
        }

        .animate-fade-in-delay-2 {
            animation: fadeIn 0.4s ease-out 0.2s forwards;
            opacity: 0;
        }

        .animate-fade-in-delay-3 {
            animation: fadeIn 0.4s ease-out 0.3s forwards;
            opacity: 0;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        .animate-pulse-slow {
            animation: pulse 1s ease-in-out;
        }

        /* Custom radio styles */
        .custom-radio input[type="radio"] {
            display: none;
        }

        .custom-radio .radio-label {
            display: flex;
            align-items: center;
            padding: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .custom-radio input[type="radio"]:checked+.radio-label {
            border-color: #059669;
            background-color: #ecfdf5;
        }

        .custom-radio .radio-circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #d1d5db;
            margin-right: 12px;
            position: relative;
            flex-shrink: 0;
        }

        .custom-radio input[type="radio"]:checked+.radio-label .radio-circle {
            border-color: #059669;
        }

        .custom-radio input[type="radio"]:checked+.radio-label .radio-circle:after {
            content: '';
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #059669;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body class="flex flex-col min-h-screen font-sans text-gray-800 bg-gray-50">
    <nav class="flex mt-4 ml-12 text-sm" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-emerald-600">Home</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('produk.index') }}" class="text-gray-500 hover:text-emerald-600">Produk</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('produk.show', $produk->id_produk) }}"
                        class="text-gray-500 hover:text-emerald-600 truncate max-w-[150px]">{{ $produk->nama_produk }}</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-gray-500">Transaksi Produk</span>
                </div>
            </li>
        </ol>
    </nav>
    <!-- Main Content -->
    <main class="container flex-grow px-4 py-8 mx-auto">
        <div class="max-w-5xl mx-auto">
            <h1 class="mb-6 text-2xl font-bold text-gray-800 animate-fade-in">Checkout</h1>

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <!-- Left Column: Delivery & Product -->
                <div class="space-y-6 lg:col-span-2">
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf

                        <!-- Delivery Address -->
                        <div class="p-6 bg-white shadow-sm rounded-xl animate-fade-in-delay-1">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="flex items-center text-xl font-semibold">
                                    <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Alamat Pengiriman
                                </h2>
                                <a href="{{ route('profile.edit') }}"
                                    class="text-sm text-emerald-600 hover:text-emerald-700">+ Tambah
                                    Alamat</a>
                            </div>

                            <div class="p-4 border border-gray-200 rounded-lg">
                                @if (count($alamat) > 0)
                                    <div class="relative">
                                        <select name="alamat_id"
                                            class="w-full px-4 py-3 pr-10 text-base border border-gray-300 rounded-lg appearance-none focus:ring-emerald-500 focus:border-emerald-500"
                                            required>
                                            <option value="" disabled selected>Pilih alamat pengiriman</option>
                                            @foreach ($alamat as $item)
                                                <option value="{{ $item->id_alamat }}"
                                                    data-latitude="{{ $item->latitude }}"
                                                    data-longitude="{{ $item->longitude }}">
                                                    {{ $item->label_alamat }} - {{ $item->nama_jalan }}
                                                    {{ $item->detail_alamat }},
                                                    {{ $item->kecamatan->nama_kecamatan }},
                                                    {{ $item->kabupatenKota->nama_kabupaten_kota }},
                                                    {{ $item->kodePos->kode_pos }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div id="selected-address-details"
                                        class="hidden p-3 mt-3 border border-gray-200 rounded bg-gray-50">
                                        <p class="font-medium" id="selected-label"></p>
                                        <p class="mt-1 text-sm text-gray-600" id="selected-detail"></p>
                                    </div>
                                @else
                                    <div class="p-4 text-center text-gray-500">
                                        Belum ada alamat tersimpan
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Product Ordered -->
                        <div class="p-6 bg-white shadow-sm rounded-xl animate-fade-in-delay-2">
                            <h2 class="flex items-center mb-4 text-xl font-semibold">
                                <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Produk yang Dipesan
                            </h2>

                            <div class="flex items-start p-4 border border-gray-200 rounded-lg">
                                <div class="flex-shrink-0 w-20 h-20 overflow-hidden bg-gray-100 rounded-md">
                                    <img src="{{ asset('storage/' . $produk->gambar_produk) }}"
                                        alt="{{ $produk->nama_produk }}" class="object-cover w-full h-full">
                                </div>

                                <div class="flex-grow ml-4">
                                    <div class="flex justify-between">
                                        <h3 class="font-medium">{{ $produk->nama_produk }}</h3>
                                        <p class="font-semibold text-emerald-600">Rp
                                            {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500">Jumlah: {{ $jumlah }}</p>
                                    <div class="flex items-center mt-2">
                                        <span class="px-2 py-1 text-xs rounded-full bg-emerald-50 text-emerald-700">
                                            Stok tersedia
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Method -->
                        <div class="p-6 bg-white shadow-sm rounded-xl animate-fade-in-delay-3">
                            <h2 class="flex items-center mb-4 text-xl font-semibold">
                                <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                </svg>
                                Metode Pengiriman
                            </h2>

                            <div class="space-y-3">
                                <div class="custom-radio">
                                    <input type="radio" name="pengiriman" id="paxel" value="wa_jek"
                                        onclick="toggleOngkir()">
                                    <label for="paxel" class="radio-label">
                                        <div class="radio-circle"></div>
                                        <div>
                                            <div class="font-medium">Paxel (Via Jasa Kurir)</div>
                                            <div class="mt-1 text-sm text-gray-500">Estimasi tiba 2-3 hari</div>
                                        </div>
                                        <img src="{{ asset('images/paxelLogo.png') }}" alt="Paxel"
                                            class="h-8 ml-auto">
                                    </label>
                                </div>

                                <div class="custom-radio">
                                    <input type="radio" name="pengiriman" id="pickup" value="ambil_ditempat"
                                        onclick="toggleOngkir()">
                                    <label for="pickup" class="radio-label">
                                        <div class="radio-circle"></div>
                                        <div>
                                            <div class="font-medium">Ambil di Tempat</div>
                                            <div class="mt-1 text-sm text-gray-500">Diambil langsung di toko AgroMart
                                            </div>
                                        </div>
                                    </label>
                                </div>

                                <!-- Tambahkan div info jarak pengiriman yang akan muncul ketika Paxel dipilih -->
                                <div id="ongkirField" class="hidden p-4 mt-4 border rounded-lg bg-gray-50">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-emerald-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-sm text-gray-700">Ongkir dihitung berdasarkan jarak</p>
                                    </div>
                                    <div id="jarak-info" class="mt-2 font-medium text-emerald-600"></div>
                                    <div class="mt-2 text-xs text-gray-500">
                                        <ul class="space-y-1">
                                            <li>• 0-10 km: Rp 5.000</li>
                                            <li>• 11-15 km: Rp 8.000</li>
                                            <li>• 16-25 km: Rp 15.000</li>
                                            <li>• 26-40 km: Rp 20.000</li>
                                            <li>• >40 km: Rp 30.000</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <!-- Right Column: Summary -->
                <div class="lg:col-span-1">
                    <div class="sticky p-6 bg-white shadow-sm rounded-xl top-24 animate-fade-in-delay-1">
                        <h2 class="flex items-center pb-4 mb-4 text-xl font-semibold border-b">
                            <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                            Ringkasan Pesanan
                        </h2>

                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal ({{ $jumlah }} item)</span>
                                <span>Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Ongkos Kirim</span>
                                <span id="ongkirDisplay">Rp 0</span>
                            </div>
                        </div>

                        <div class="pt-4 my-4 border-t border-dashed">
                            <div class="flex items-center justify-between">
                                <span class="font-medium">Total Pembayaran</span>
                                <span class="text-xl font-bold text-emerald-600" id="totalDisplay">Rp
                                    {{ number_format($totalPembayaran, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="my-6">
                            <h3 class="mb-3 font-semibold">Metode Pembayaran</h3>
                            <div class="space-y-3">
                                <div class="custom-radio">
                                    <input type="radio" name="pembayaran" id="transfer" value="transfer"
                                        onclick="toggleRekening()">
                                    <label for="transfer" class="radio-label">
                                        <div class="radio-circle"></div>
                                        <div>
                                            <div class="font-medium">Transfer Bank</div>
                                            <div class="mt-1 text-sm text-gray-500">BRI, BCA, Mandiri</div>
                                        </div>
                                    </label>
                                </div>

                                <div class="custom-radio">
                                    <input type="radio" name="pembayaran" id="cod" value="cod"
                                        onclick="toggleRekening()">
                                    <label for="cod" class="radio-label">
                                        <div class="radio-circle"></div>
                                        <div>
                                            <div class="font-medium">Bayar di Tempat (COD)</div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div id="rekeningField"
                                class="hidden p-4 mt-4 text-sm border border-blue-100 rounded-lg bg-blue-50">
                                <p class="font-medium text-blue-800">Informasi Rekening:</p>
                                <p class="mt-2 text-blue-700">Bank BRI: 123456789</p>
                                <p class="text-blue-700">A/N: Toko Hidroponik</p>
                            </div>
                        </div>

                        <input type="hidden" name="jumlah" value="{{ $jumlah }}">
                        <input type="hidden" name="produk_id" value="{{ $produk->id_produk }}">
                        <input type="hidden" name="total" value="{{ $totalHarga }}">
                        <input type="hidden" id="harga_produk" value="{{ $produk->harga_produk }}">
                        <input type="hidden" name="ongkir" id="ongkirInput" value="0">

                        <button type="submit"
                            class="flex items-center justify-center w-full py-3 font-medium text-white transition-colors rounded-lg bg-emerald-600 hover:bg-emerald-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            Bayar Sekarang
                        </button>
                        <div class="mt-3 text-xs text-center text-gray-500">
                            Dengan melanjutkan, saya setuju dengan Syarat & Ketentuan
                        </div>
                    </div>
                </div>
                </form>
            </div>
    </main>

    <!-- Footer -->
    <footer class="py-6 mt-12 text-white bg-gray-800">
        <div class="container px-4 mx-auto">
            <div class="flex flex-wrap items-center justify-between">
                <div class="mb-4 md:mb-0">
                    <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="AgroMart"
                        class="h-8 filter brightness-0 invert">
                    <p class="mt-2 text-sm text-gray-400">© 2025 AgroMart. All rights reserved.</p>
                </div>

                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 transition-colors hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z">
                            </path>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 transition-colors hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const TOKO_LATITUDE = -8.157610;
        const TOKO_LONGITUDE = 113.746971;

        // Tabel tarif ongkir berdasarkan tier jarak
        const ONGKIR_TIERS = [{
                minDistance: 0,
                maxDistance: 10,
                price: 5000
            }, // 0-10 km: Rp 5.000
            {
                minDistance: 10,
                maxDistance: 15,
                price: 8000
            }, // 11-15 km: Rp 8.000
            {
                maxDistance: 25,
                price: 15000
            }, // 16-25 km: Rp 15.000
            {
                maxDistance: 40,
                price: 20000
            }, // 26-40 km: Rp 20.000
            {
                maxDistance: Infinity,
                price: 30000
            } // >40 km: Rp 30.000
        ];

        function toggleOngkir() {
            const pengirimanRadios = document.querySelectorAll('input[name="pengiriman"]');
            let selectedPengiriman = '';
            pengirimanRadios.forEach(radio => {
                if (radio.checked) selectedPengiriman = radio.value;
            });

            const ongkirField = document.getElementById('ongkirField');
            const codOption = document.getElementById('cod');

            if (selectedPengiriman === 'wa_jek') {
                ongkirField.classList.remove('hidden');
                ongkirField.classList.add('animate-fade-in');
                codOption.disabled = true;
                codOption.checked = false;

                // Hitung ongkir saat opsi pengiriman dipilih
                hitungOngkirOtomatis();
                toggleRekening();
            } else {
                ongkirField.classList.add('hidden');
                codOption.disabled = false;
                document.getElementById('ongkirInput').value = 0;
                document.getElementById('ongkirDisplay').innerText = 'Rp 0';
                hitungTotal(0);
            }
        }

        // Fungsi untuk menghitung jarak antara dua titik koordinat (Haversine formula)
        function hitungJarakHaversine(lat1, lon1, lat2, lon2) {
            const R = 6371; // Radius bumi dalam kilometer
            const dLat = toRad(lat2 - lat1);
            const dLon = toRad(lon2 - lon1);

            const a =
                Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);

            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            const distance = R * c; // Jarak dalam kilometer

            return distance;
        }

        // Fungsi untuk mengkonversi derajat ke radian
        function toRad(degrees) {
            return degrees * (Math.PI / 180);
        }

        // Fungsi untuk mendapatkan tarif ongkir berdasarkan jarak
        function hitungTarifOngkir(jarak) {
            const koreksiJarak = jarak * 1.51;

            // Cari tier yang sesuai dengan jarak
            for (const tier of ONGKIR_TIERS) {
                if (koreksiJarak <= tier.maxDistance) {
                    return tier.price;
                }
            }

            // Default untuk jarak sangat jauh
            return ONGKIR_TIERS[ONGKIR_TIERS.length - 1].price;
        }

        // Fungsi untuk menghitung ongkir otomatis berdasarkan alamat yang dipilih
        function hitungOngkirOtomatis() {
            const addressSelect = document.querySelector('select[name="alamat_id"]');

            if (!addressSelect || addressSelect.selectedIndex <= 0) {
                if (document.getElementById('jarak-info')) {
                    document.getElementById('jarak-info').textContent = "Pilih alamat untuk melihat biaya pengiriman";
                }
                return;
            }

            const selectedOption = addressSelect.options[addressSelect.selectedIndex];
            const latitude = parseFloat(selectedOption.dataset.latitude);
            const longitude = parseFloat(selectedOption.dataset.longitude);

            if (latitude && longitude) {
                // Hitung jarak
                const jarak = hitungJarakHaversine(
                    TOKO_LATITUDE,
                    TOKO_LONGITUDE,
                    latitude,
                    longitude
                );

                // Bulatkan jarak ke 1 desimal
                const jarakBulat = Math.ceil(jarak * 10) / 10;

                // Hitung ongkir berdasarkan tier jarak
                const ongkir = hitungTarifOngkir(jarakBulat);

                // Tampilkan info jarak
                if (document.getElementById('jarak-info')) {
                    document.getElementById('jarak-info').textContent =
                        `Jarak pengiriman: ${(jarakBulat * 1.51).toFixed(1)} km - Ongkir: Rp ${ongkir.toLocaleString('id-ID')}`;
                }

                // Update ongkir
                document.getElementById('ongkirInput').value = ongkir;
                document.getElementById('ongkirDisplay').innerText = 'Rp ' + ongkir.toLocaleString('id-ID');

                // Hitung total
                hitungTotal(ongkir);
            } else {
                if (document.getElementById('jarak-info')) {
                    document.getElementById('jarak-info').textContent =
                        "Tidak dapat menemukan koordinat alamat";
                }
            }
        }

        function toggleRekening() {
            const pembayaranRadios = document.querySelectorAll('input[name="pembayaran"]');
            let selectedPembayaran = '';
            pembayaranRadios.forEach(radio => {
                if (radio.checked) selectedPembayaran = radio.value;
            });

            const rekeningField = document.getElementById('rekeningField');
            if (selectedPembayaran === 'transfer') {
                rekeningField.classList.remove('hidden');
                rekeningField.classList.add('animate-fade-in');
            } else {
                rekeningField.classList.add('hidden');
            }
        }

        function hitungTotal(ongkir) {
            const hargaProduk = parseInt(document.getElementById('harga_produk').value);
            const jumlah = parseInt(document.querySelector('input[name="jumlah"]').value);

            // Gunakan parameter ongkir atau ambil dari input jika tidak diberikan
            const ongkirValue = ongkir !== undefined ? ongkir :
                parseInt(document.getElementById('ongkirInput').value) || 0;

            const totalHarga = hargaProduk * jumlah;
            const totalPembayaran = totalHarga + ongkirValue;

            // Update hidden input for total
            document.querySelector('input[name="total"]').value = totalPembayaran;

            // Animate total change
            const totalDisplay = document.getElementById('totalDisplay');
            if (totalDisplay.classList.contains('animate-pulse-slow')) {
                totalDisplay.classList.remove('animate-pulse-slow');
            }
            totalDisplay.classList.add('animate-pulse-slow');
            setTimeout(() => {
                totalDisplay.innerText = 'Rp ' + totalPembayaran.toLocaleString('id-ID');
                totalDisplay.classList.remove('animate-pulse-slow');
            }, 200);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const addressSelect = document.querySelector('select[name="alamat_id"]');
            const selectedAddressDetails = document.getElementById('selected-address-details');
            const selectedLabel = document.getElementById('selected-label');
            const selectedDetail = document.getElementById('selected-detail');

            if (addressSelect) {
                addressSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const addressText = selectedOption.text;

                    if (this.value) {
                        const [label, detail] = addressText.split(' - ');

                        selectedLabel.textContent = label;
                        selectedDetail.textContent = detail;
                        selectedAddressDetails.classList.remove('hidden');
                        selectedAddressDetails.classList.add('animate-fade-in');

                        // Hitung ongkir jika metode pengiriman adalah wa_jek
                        const isPaxelSelected = document.getElementById('paxel').checked;
                        if (isPaxelSelected) {
                            hitungOngkirOtomatis();
                        }
                    } else {
                        selectedAddressDetails.classList.add('hidden');
                    }
                });
            }

            hitungTotal();
        });
    </script>
</body>

</html>
