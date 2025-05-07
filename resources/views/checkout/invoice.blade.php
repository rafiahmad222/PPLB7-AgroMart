<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-lg p-6 bg-white border border-gray-300 rounded-lg shadow-lg">
        <h2 class="mb-4 text-2xl font-bold text-center">Invoice Pesanan</h2>
        <div class="mb-2">
            <span class="font-semibold">Nama Produk:</span> <strong>{{ $pesanan->produk->nama_produk }}</strong>
        </div>
        <div class="mb-2">
            <span class="font-semibold">Harga Produk:</span> Rp {{ number_format($pesanan->produk->harga_produk, 0, ',', '.') }}
        </div>
        <div class="mb-2">
            <span class="font-semibold">Nama Pemesan:</span> {{ $pesanan->user->name }}
        </div>
        <div class="mb-2">
            <span class="font-semibold">Alamat:</span>
            {{ $pesanan->alamat->detail_alamat }},
            {{ $pesanan->alamat->kecamatan->nama_kecamatan }},
            {{ $pesanan->alamat->kabupatenKota->nama_kabupaten_kota }},
            {{ $pesanan->alamat->kodePos->kode_pos }}
        </div>
        <div class="mb-2">
            <span class="font-semibold">No HP:</span> {{ $pesanan->user->phone }}
        </div>
        <div class="mb-2">
            <span class="font-semibold">Metode Pengiriman:</span> {{ $pesanan->pengiriman == 'wa_jek' ? 'WA Jek' : 'Ambil di tempat' }}
        </div>
        @if($pesanan->pengiriman == 'wa_jek')
            <div class="mb-2">
                <span class="font-semibold">Jarak:</span> {{ $pesanan->jarak }} km
            </div>
            <div class="mb-2">
                <span class="font-semibold">Ongkir:</span> Rp {{ number_format($pesanan->ongkir, 0, ',', '.') }}
            </div>
        @endif
        <div class="mb-2">
            <span class="font-semibold">Metode Pembayaran:</span> {{ $pesanan->pembayaran == 'transfer' ? 'Transfer' : 'COD' }}
        </div>
        @if($pesanan->pembayaran == 'transfer')
            <div class="mb-2">
                <span class="font-semibold">No Rekening:</span> 1234567890 (Bank Dummy)
            </div>
        @endif
        <div class="mt-4 text-lg font-bold">
            Total Bayar: Rp {{ number_format($pesanan->total, 0, ',', '.') }}
        </div>
        <hr class="my-4">
        <div class="mb-4">
            <span class="font-semibold">Status Pesanan:</span> <strong>{{ $pesanan->status }}</strong>
        </div>
        <div class="text-center">
            <a href="{{ route('home') }}" class="px-4 py-2 font-semibold text-white bg-green-600 rounded hover:bg-green-700">
                Kembali ke Home
            </a>
        </div>
    </div>
</body>
</html>
