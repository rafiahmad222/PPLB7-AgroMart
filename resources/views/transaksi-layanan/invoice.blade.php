<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Transaksi - AgroMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .invoice-container {
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .invoice-header {
            background-image: linear-gradient(to right, #16a34a, #15803d);
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 8rem;
            font-weight: bold;
            color: rgba(22, 163, 74, 0.05);
            z-index: -1;
            pointer-events: none;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
        }

        .slide-up {
            animation: slideUp 0.5s ease forwards;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    @if (session('success'))
        <div class="fixed p-4 bg-green-100 border-l-4 border-green-500 rounded-lg top-4 right-4 slide-up no-print">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="text-green-500 fas fa-check-circle"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-800">{{ session('success') }}</p>
                </div>
                <div class="pl-3 ml-auto">
                    <div class="-mx-1.5 -my-1.5">
                        <button class="inline-flex text-green-500 hover:text-green-600 focus:outline-none">
                            <span class="sr-only">Close</span>
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="relative max-w-3xl mx-auto my-8">
        <div class="bg-white border border-gray-100 invoice-container">
            <!-- Invoice Header -->
            <div class="px-8 py-6 text-white invoice-header">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold tracking-wide">INVOICE</h1>
                        <p class="mt-1 text-sm text-white/80">
                            #No. Pesanan - {{ $transaksi->id_transaksi_layanan }}
                        </p>
                    </div>
                    <div class="text-right">
                        <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="AgroMart Logo" class="h-12">
                    </div>
                </div>
            </div>

            <!-- Invoice Body -->
            <div class="relative p-8">
                <div class="watermark">PAID</div>

                <!-- Grid layout for customer and transaction info -->
                <div class="grid grid-cols-2 gap-8 mb-8">
                    <div>
                        <h2 class="mb-2 text-sm font-semibold text-gray-500 uppercase">Detail Pelanggan</h2>
                        <p class="text-lg font-medium text-gray-800">{{ $transaksi->user->name }}</p>
                        <p class="text-gray-600">{{ $transaksi->user->email }}</p>
                        <div class="mt-3 text-gray-600">
                            <p>{{ $transaksi->alamat->detail_alamat }}</p>
                        </div>
                    </div>
                    <div>
                        <h2 class="mb-2 text-sm font-semibold text-gray-500 uppercase">Detail Transaksi</h2>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-gray-600">Tanggal Invoice:</span>
                            <span class="text-gray-800">{{ $transaksi->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-gray-600">Waktu:</span>
                            <span class="text-gray-800">{{ $transaksi->created_at->format('H:i') }} WIB</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Pembayaran Via:</span>
                            <span class="text-gray-800">{{ ucfirst($transaksi->pembayaran) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Booking Information -->
                <div class="mb-8">
                    <h2 class="mb-3 text-sm font-semibold text-gray-500 uppercase">Jadwal Booking</h2>
                    <div class="flex items-center p-4 rounded-lg bg-gray-50">
                        <i class="mr-4 text-2xl fas fa-calendar-alt text-primary-600"></i>
                        <div>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ \Carbon\Carbon::parse($transaksi->jadwal_booking)->format('l, d F Y') }}</p>
                            <p class="text-gray-600">
                                {{ \Carbon\Carbon::parse($transaksi->jadwal_booking)->format('H:i') }} WIB</p>
                        </div>
                    </div>
                </div>

                <!-- Service Details -->
                <h2 class="mb-3 text-sm font-semibold text-gray-500 uppercase">Detail Layanan</h2>
                <div class="mb-8 overflow-hidden border rounded-lg">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Layanan</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                    Jumlah</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                    Harga</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">
                                    Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $transaksi->layanan->nama_layanan }}</div>
                                    <div class="text-xs text-gray-500">{{ $transaksi->layanan->jenis_layanan }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-right text-gray-500">{{ $transaksi->jumlah }}</td>
                                <td class="px-6 py-4 text-sm text-right text-gray-500">
                                    Rp{{ number_format($transaksi->layanan->harga_layanan, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-right text-gray-900">
                                    Rp{{ number_format($transaksi->total, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="px-6 py-3 text-sm font-semibold text-right text-gray-700">
                                    Total</td>
                                <td class="px-6 py-3 text-sm font-bold text-right text-gray-900">
                                    Rp{{ number_format($transaksi->total, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                @if ($transaksi->pembayaran === 'transfer' && $transaksi->bukti_transfer)
                    <div class="mb-8">
                        <h2 class="mb-3 text-sm font-semibold text-gray-500 uppercase">Bukti Pembayaran</h2>
                        <div class="p-4 border rounded-lg">
                            <img src="{{ asset('storage/' . $transaksi->bukti_transfer) }}"
                                class="object-contain h-48 mx-auto border" alt="Bukti Transfer">
                        </div>
                    </div>
                @endif

                <!-- Notes -->
                <div class="p-4 mb-6 rounded-lg bg-gray-50">
                    <h2 class="mb-2 font-semibold text-gray-800">Catatan:</h2>
                    <p class="text-sm text-gray-600">Terima kasih telah menggunakan layanan AgroMart. Invoice ini adalah
                        bukti resmi pembayaran layanan. Pastikan jadwal booking sesuai dengan kesepakatan.</p>
                </div>
            </div>

            <!-- Invoice Footer -->
            <div class="p-8 border-t bg-gray-50">
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col items-start justify-start">
                        <div class="mt-4 text-center no-print">
                            <a href="https://wa.me/{{ $ownerPhone }}?text={{ urlencode($waMessage) }}"
                                target="_blank"
                                class="inline-flex items-center px-5 py-2 text-white transition-colors duration-200 bg-green-500 rounded-lg shadow-sm hover:bg-green-600">
                                <i class="mr-2 fab fa-whatsapp"></i> Kirim ke WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-6 text-sm text-center text-gray-500">
                    &copy; {{ date('Y') }} AgroMart. All Rights Reserved.
                </div>
            </div>
        </div>

        <div class="mt-4 text-center no-print">
            <a href="{{ route('home') }}"
                class="inline-block px-5 py-2 text-white transition-colors duration-200 bg-blue-600 rounded-lg shadow-sm hover:bg-blue-700">
                <i class="mr-2 fas fa-home"></i> Kembali ke Home
            </a>
        </div>
    </div>

    <script>
        // Auto-hide success notification after 5 seconds
        setTimeout(() => {
            const notification = document.querySelector('.slide-up');
            if (notification) {
                notification.style.display = 'none';
            }
        }, 5000);
    </script>
</body>

</html>
