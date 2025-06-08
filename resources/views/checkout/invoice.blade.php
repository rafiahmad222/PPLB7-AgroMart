<!-- filepath: d:\PPL B7 - AgroMart\PPLB7-AgroMart\resources\views\checkout\invoice.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="flex items-center justify-center min-h-screen py-8 bg-gray-100">
    <div class="w-full max-w-lg p-6 bg-white border border-gray-300 rounded-lg shadow-lg">
        <h2 class="mb-4 text-2xl font-bold text-center">Invoice Pesanan</h2>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
                <div class="mb-2">
                    <span class="font-semibold">Nama Produk:</span> <strong>{{ $pesanan->produk->nama_produk }}</strong>
                </div>
                <div class="mb-2">
                    <span class="font-semibold">Harga Produk:</span> Rp
                    {{ number_format($pesanan->produk->harga_produk, 0, ',', '.') }}
                </div>
                <div class="mb-2">
                    <span class="font-semibold">Nama Pemesan:</span> {{ $pesanan->user->name }}
                </div>
                <div class="mb-2">
                    <span class="font-semibold">No HP:</span> {{ $pesanan->user->phone }}
                </div>
            </div>
            <div>
                <div class="mb-2">
                    <span class="font-semibold">Alamat:</span>
                    {{ $pesanan->alamat->detail_alamat }},
                    {{ $pesanan->alamat->kecamatan->nama_kecamatan }},
                    {{ $pesanan->alamat->kabupatenKota->nama_kabupaten_kota }},
                    {{ $pesanan->alamat->kodePos->kode_pos }}
                </div>
                <div class="mb-2">
                    <span class="font-semibold">Metode Pengiriman:</span>
                    {{ $pesanan->pengiriman == 'Paxel' ? 'Paxel' : 'Ambil Ditempat' }}
                </div>
                @if ($pesanan->pengiriman == 'Paxel')
                    <div class="mb-2">
                        <span class="font-semibold">Ongkir:</span> Rp
                        {{ number_format($pesanan->ongkir, 0, ',', '.') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-3 mb-2">
            <span class="font-semibold">Metode Pembayaran:</span>
            {{ $pesanan->pembayaran == 'Transfer' ? 'Transfer' : 'COD' }}
        </div>

        @if ($pesanan->pembayaran == 'Transfer')
            <!-- Tampilkan Bukti Pembayaran -->
            <div class="mb-4">
                <h3 class="mb-2 font-semibold text-md">Bukti Pembayaran:</h3>
                @if (isset($pesanan->bukti_pembayaran) && $pesanan->bukti_pembayaran)
                    <div class="p-2 mb-2 border border-gray-300 rounded-lg">
                        <img src="{{ asset('storage/' . $pesanan->bukti_pembayaran) }}" alt="Bukti Pembayaran"
                            class="h-auto max-w-full rounded">
                    </div>
                    <a href="{{ asset('storage/' . $pesanan->bukti_pembayaran) }}" target="_blank"
                        class="text-sm text-blue-500 hover:text-blue-700">
                        Lihat Gambar Ukuran Penuh
                    </a>
                @else
                    <p class="text-red-500">Bukti pembayaran belum diunggah</p>
                @endif
            </div>
        @endif

        <div class="p-3 mt-4 text-lg font-bold text-center bg-gray-100 rounded-lg">
            Total Bayar: Rp {{ number_format($pesanan->total, 0, ',', '.') }}
        </div>

        <hr class="my-4">

        <div class="mb-4">
            <span class="font-semibold">Status Pesanan:</span>
            <span
                class="px-2 py-1 rounded text-white text-sm {{ $pesanan->status == 'pending' ? 'bg-yellow-500' : ($pesanan->status == 'confirmed' ? 'bg-green-500' : 'bg-blue-500') }}">
                <strong>{{ ucfirst($pesanan->status) }}</strong>
            </span>
        </div>

        <!-- WhatsApp Button -->
        @php
            $ownerPhone = '6281216237388';
            $waMessage =
                "Halo, berikut adalah detail pesanan:\n\n" .
                "Nama Produk: {$pesanan->produk->nama_produk}\n" .
                'Harga: Rp' .
                number_format($pesanan->produk->harga_produk, 0, ',', '.') .
                "\n" .
                "Nama Pemesan: {$pesanan->user->name}\n" .
                "No HP: {$pesanan->user->phone}\n" .
                "Alamat: {$pesanan->alamat->detail_alamat}, {$pesanan->alamat->kecamatan->nama_kecamatan}, {$pesanan->alamat->kabupatenKota->nama_kabupaten_kota}, {$pesanan->alamat->kodePos->kode_pos}\n" .
                'Metode Pengiriman: ' .
                ($pesanan->pengiriman == 'Paxel' ? 'Paxel' : 'Ambil Ditempat') .
                "\n" .
                ($pesanan->pengiriman == 'Paxel'
                    ? "Jarak: {$pesanan->jarak} km\nOngkir: Rp" . number_format($pesanan->ongkir, 0, ',', '.') . "\n"
                    : '') .
                'Metode Pembayaran: ' .
                ($pesanan->pembayaran == 'Transfer' ? 'Transfer' : 'COD') .
                "\n" .
                'Total: Rp' .
                number_format($pesanan->total, 0, ',', '.') .
                "\n" .
                "Status: {$pesanan->status}";

            if (isset($pesanan->bukti_pembayaran) && $pesanan->bukti_pembayaran) {
                $waMessage .= "\n\nBukti Pembayaran: " . asset('storage/' . $pesanan->bukti_pembayaran);
            }
        @endphp

        <div class="flex items-center justify-between mt-5">
            <a href="{{ route('home') }}"
                class="px-4 py-2 font-semibold text-white bg-green-600 rounded hover:bg-green-700">
                Kembali ke Home
            </a>

            <a href="https://wa.me/{{ $ownerPhone }}?text={{ urlencode($waMessage) }}" target="_blank"
                class="flex items-center px-4 py-2 font-semibold text-white bg-green-500 rounded hover:bg-green-600">
                <i class="mr-2 fab fa-whatsapp"></i> Kirim ke WhatsApp
            </a>
        </div>
    </div>
</body>

</html>
