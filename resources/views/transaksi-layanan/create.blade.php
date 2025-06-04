<!-- filepath: d:\PPL-AgroMart\resources\views\transaksi-layanan\create.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Layanan - AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="{{ asset('images/icon-40x40.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-out forwards',
                        'slide-up': 'slideUp 0.5s ease-out forwards',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .input-transition {
            transition: all 0.3s ease;
        }
        .input-transition:focus {
            border-color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.2);
        }
        .date-input::-webkit-calendar-picker-indicator {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="%2316a34a" class="bi bi-calendar3" viewBox="0 0 16 16"><path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/><path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg>');
        }
    </style>
</head>

<body class="min-h-screen bg-gray-50">
    <main class="container px-4 py-10 mx-auto">
        <!-- Breadcrumbs -->
        <nav class="flex mb-8 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-emerald-600">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('layanan.index') }}" class="text-gray-500 hover:text-emerald-600">Layanan</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-500">Transaksi Layanan</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Main Content -->
        <div class="flex flex-col gap-8 lg:flex-row">
            <!-- Order Form Card -->
            <div class="w-full lg:w-2/3 animate-fade-in">
                <div class="p-8 bg-white shadow-md rounded-xl">
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Form Transaksi Layanan</h1>
                        <div class="px-3 py-1 text-xs font-semibold text-white rounded-full bg-emerald-500">
                            Step 1 dari 1
                        </div>
                    </div>

                    <form id="transactionForm" action="{{ route('transaksi-layanan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Layanan -->
                            <div class="md:col-span-2">
                                <label for="layanan_id" class="block mb-2 text-sm font-medium text-gray-700">Pilih Layanan</label>
                                <div class="relative">
                                    <select id="layanan_id" name="layanan_id" class="block w-full px-4 py-3 pr-10 text-base border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 input-transition" required>
                                        @foreach ($layanans as $layanan)
                                            <option value="{{ $layanan->id_layanan }}"
                                                {{ isset($layananTerpilih) && $layananTerpilih == $layanan->id_layanan ? 'selected' : '' }}
                                                data-price="{{ $layanan->harga_layanan }}">
                                                {{ $layanan->nama_layanan }} - Rp {{ number_format($layanan->harga_layanan, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="md:col-span-2">
                                <label for="alamat_id" class="block mb-2 text-sm font-medium text-gray-700">Alamat Layanan</label>
                                <div class="relative">
                                    <select id="alamat_id" name="alamat_id" class="block w-full px-4 py-3 pr-10 text-base border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 input-transition" required>
                                        <option value="">Pilih Alamat</option>
                                        @foreach ($alamat as $item)
                                            <option value="{{ $item->id_alamat }}">
                                                {{ $item->label_alamat }} - {{ $item->detail_alamat }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <a href="#" class="text-sm text-emerald-600 hover:text-emerald-800">+ Tambah Alamat Baru</a>
                                </div>
                            </div>

                            <!-- Jumlah -->
                            <div>
                                <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-700">Jumlah</label>
                                <div class="relative flex items-center">
                                    <button type="button" id="decrementJumlah" class="flex items-center justify-center w-10 h-10 text-gray-600 bg-gray-100 rounded-l-lg hover:bg-gray-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <input type="number" id="jumlah" name="jumlah" min="1" value="1" class="block w-full h-10 px-4 py-2 text-center border-gray-300 input-transition" required>
                                    <button type="button" id="incrementJumlah" class="flex items-center justify-center w-10 h-10 text-gray-600 bg-gray-100 rounded-r-lg hover:bg-gray-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Jadwal Booking -->
                            <div>
                                <label for="jadwal_booking" class="block mb-2 text-sm font-medium text-gray-700">Jadwal Booking</label>
                                <input type="datetime-local" id="jadwal_booking" name="jadwal_booking" class="block w-full px-4 py-3 border-gray-300 rounded-lg shadow-sm date-input focus:ring-emerald-500 focus:border-emerald-500 input-transition" required>
                            </div>

                            <!-- Metode Pembayaran -->
                            <div class="md:col-span-2">
                                <label class="block mb-4 text-sm font-medium text-gray-700">Metode Pembayaran</label>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div>
                                        <input type="radio" id="transfer" name="pembayaran" value="transfer" class="hidden peer" checked>
                                        <label for="transfer" class="flex items-center justify-between w-full p-4 text-gray-700 transition-all bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-emerald-500 peer-checked:bg-emerald-50 hover:border-emerald-300">
                                            <div class="flex items-center">
                                                <svg class="w-6 h-6 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                                </svg>
                                                <span class="font-medium">Transfer Bank</span>
                                            </div>
                                            <svg class="hidden w-5 h-5 text-emerald-500 peer-checked:block" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                        </label>
                                    </div>
                                    <div>
                                        <input type="radio" id="cod" name="pembayaran" value="cod" class="hidden peer">
                                        <label for="cod" class="flex items-center justify-between w-full p-4 text-gray-700 transition-all bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-emerald-500 peer-checked:bg-emerald-50 hover:border-emerald-300">
                                            <div class="flex items-center">
                                                <svg class="w-6 h-6 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                </svg>
                                                <span class="font-medium">Cash on Delivery</span>
                                            </div>
                                            <svg class="hidden w-5 h-5 text-emerald-500 peer-checked:block" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Bukti Transfer (Hanya jika transfer) -->
                            <div id="bukti_transfer_div" class="md:col-span-2 payment-method-transfer">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Bukti Transfer</label>
                                <div class="flex items-center justify-center w-full">
                                    <label for="bukti_transfer" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-emerald-500">
                                        <div id="upload_placeholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                            </svg>
                                            <p class="mb-1 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                                            <p class="text-xs text-gray-500">PNG, JPG or JPEG (Maks. 2MB)</p>
                                        </div>
                                        <div id="preview_container" class="hidden w-full h-full">
                                            <img id="preview_image" class="object-contain w-full h-full" src="#" alt="Bukti Transfer">
                                        </div>
                                        <input id="bukti_transfer" name="bukti_transfer" type="file" class="hidden" accept="image/*" />
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <button type="submit" class="w-full px-6 py-3 text-base font-medium text-white transition-all rounded-lg shadow-md bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                Konfirmasi Transaksi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order Summary Card -->
            <div class="w-full lg:w-1/3 animate-slide-up">
                <div class="sticky p-6 bg-white shadow-md rounded-xl top-10">
                    <h2 class="mb-4 text-xl font-bold text-gray-800">Ringkasan Transaksi</h2>

                    <div class="py-4 border-t border-b border-gray-200">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center">
                                <span class="text-gray-600">Layanan:</span>
                            </div>
                            <span class="font-medium text-gray-800" id="summary-layanan">-</span>
                        </div>

                        <div class="flex items-center justify-between mb-3">
                            <span class="text-gray-600">Jumlah:</span>
                            <span class="font-medium text-gray-800" id="summary-jumlah">1</span>
                        </div>

                        <div class="flex items-center justify-between mb-3">
                            <span class="text-gray-600">Jadwal:</span>
                            <span class="font-medium text-gray-800" id="summary-jadwal">-</span>
                        </div>

                        <div class="flex items-center justify-between mb-3">
                            <span class="text-gray-600">Alamat:</span>
                            <span class="font-medium text-gray-800" id="summary-alamat">-</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Pembayaran:</span>
                            <span class="font-medium text-gray-800" id="summary-pembayaran">Transfer Bank</span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-gray-600">Harga Layanan:</span>
                            <span class="font-medium text-gray-800" id="summary-harga">Rp 0</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 mt-4 border-t border-gray-200">
                        <span class="text-lg font-semibold text-gray-800">Total:</span>
                        <span class="text-xl font-bold text-emerald-600" id="summary-total">Rp 0</span>
                    </div>

                    <div class="p-4 mt-6 rounded-lg bg-gray-50">
                        <div class="flex items-start">
                            <svg class="flex-shrink-0 w-5 h-5 mt-0.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            <p class="ml-3 text-xs text-gray-600">
                                Pastikan jadwal layanan yang dipilih tersedia. Tim kami akan menghubungi Anda untuk konfirmasi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-6 mt-12 text-center text-gray-500 bg-gray-50">
        <p>&copy; {{ date('Y') }} AgroMart. All rights reserved.</p>
    </footer>

    <script>
        // Elements
        const layananSelect = document.getElementById('layanan_id');
        const jumlahInput = document.getElementById('jumlah');
        const decrementButton = document.getElementById('decrementJumlah');
        const incrementButton = document.getElementById('incrementJumlah');
        const jadwalInput = document.getElementById('jadwal_booking');
        const alamatSelect = document.getElementById('alamat_id');
        const transferRadio = document.getElementById('transfer');
        const codRadio = document.getElementById('cod');
        const buktiTransferDiv = document.getElementById('bukti_transfer_div');
        const buktiTransferInput = document.getElementById('bukti_transfer');
        const previewContainer = document.getElementById('preview_container');
        const previewImage = document.getElementById('preview_image');
        const uploadPlaceholder = document.getElementById('upload_placeholder');

        // Summary elements
        const summaryLayanan = document.getElementById('summary-layanan');
        const summaryJumlah = document.getElementById('summary-jumlah');
        const summaryJadwal = document.getElementById('summary-jadwal');
        const summaryAlamat = document.getElementById('summary-alamat');
        const summaryPembayaran = document.getElementById('summary-pembayaran');
        const summaryHarga = document.getElementById('summary-harga');
        const summaryTotal = document.getElementById('summary-total');

        // Initialize
        updateSummaryLayanan();

        // Event listeners
        layananSelect.addEventListener('change', updateSummaryLayanan);
        jumlahInput.addEventListener('change', updateSummary);
        jadwalInput.addEventListener('change', updateSummary);
        alamatSelect.addEventListener('change', updateSummary);

        transferRadio.addEventListener('change', () => {
            buktiTransferDiv.classList.remove('hidden');
            summaryPembayaran.textContent = 'Transfer Bank';
        });

        codRadio.addEventListener('change', () => {
            buktiTransferDiv.classList.add('hidden');
            summaryPembayaran.textContent = 'Cash on Delivery';
        });

        // Increment/decrement buttons
        decrementButton.addEventListener('click', () => {
            if (jumlahInput.value > 1) {
                jumlahInput.value = parseInt(jumlahInput.value) - 1;
                jumlahInput.dispatchEvent(new Event('change'));
            }
        });

        incrementButton.addEventListener('click', () => {
            jumlahInput.value = parseInt(jumlahInput.value) + 1;
            jumlahInput.dispatchEvent(new Event('change'));
        });

        // File preview
        buktiTransferInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    uploadPlaceholder.classList.add('hidden');
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Functions
        function formatRupiah(amount) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);
        }

        function formatDateTime(dateTimeStr) {
            if (!dateTimeStr) return '-';
            const date = new Date(dateTimeStr);
            return new Intl.DateTimeFormat('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            }).format(date);
        }

        function updateSummaryLayanan() {
            const selectedOption = layananSelect.options[layananSelect.selectedIndex];
            const layananText = selectedOption.text.split(' - ')[0];

            summaryLayanan.textContent = layananText;
            updateSummary();
        }

        function updateSummary() {
            // Update jumlah
            summaryJumlah.textContent = jumlahInput.value;

            // Update jadwal
            summaryJadwal.textContent = jadwalInput.value ? formatDateTime(jadwalInput.value) : '-';

            // Update alamat
            if (alamatSelect.selectedIndex > 0) {
                summaryAlamat.textContent = alamatSelect.options[alamatSelect.selectedIndex].text;
            } else {
                summaryAlamat.textContent = '-';
            }

            // Update harga
            const selectedOption = layananSelect.options[layananSelect.selectedIndex];
            const price = parseFloat(selectedOption.dataset.price || 0);
            const quantity = parseInt(jumlahInput.value);
            const total = price * quantity;

            summaryHarga.textContent = formatRupiah(price);
            summaryTotal.textContent = formatRupiah(total);
        }
    </script>
</body>

</html>
