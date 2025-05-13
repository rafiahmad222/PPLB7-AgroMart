<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-10 bg-white">
    @if (session('success'))
        <div class="p-3 mb-4 text-green-800 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif
    <div class="max-w-2xl p-6 mx-auto border rounded shadow">
        <h1 class="mb-4 text-2xl font-bold">Invoice Transaksi Layanan</h1>

        <div>
            <p><strong>Nama Customer:</strong> {{ $transaksi->user->name }}</p>
            <p><strong>Email:</strong> {{ $transaksi->user->email }}</p>
            <p><strong>Tanggal Transaksi:</strong> {{ $transaksi->created_at->format('d M Y H:i') }}</p>
        </div>

        <div>
            <p><strong>Layanan:</strong> {{ $transaksi->layanan->nama_layanan }}</p>
            <p><strong>Jumlah:</strong> {{ $transaksi->jumlah }}</p>
            <p><strong>Total:</strong> Rp{{ number_format($transaksi->total, 0, ',', '.') }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ ucfirst($transaksi->pembayaran) }}</p>
            <p><strong>Jadwal Booking:</strong>
                {{ \Carbon\Carbon::parse($transaksi->jadwal_booking)->format('d M Y H:i') }}</p>
        </div>

        <div>
            <p><strong>Alamat Instalasi:</strong> {{ $transaksi->alamat->detail_alamat }}</p>
        </div>

        @if ($transaksi->pembayaran === 'transfer' && $transaksi->bukti_transfer)
            <div class="mb-4">
                <p class="font-semibold">Bukti Transfer:</p>
                <img src="{{ asset('storage/' . $transaksi->bukti_transfer) }}" class="w-40 mt-2 border"
                    alt="Bukti Transfer">
            </div>
        @endif
        <div class="mt-6 text-center">
            <a href="https://wa.me/{{ $ownerPhone }}?text={{ urlencode($waMessage) }}" target="_blank"
                class="px-6 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                Kirim ke WhatsApp Owner
            </a>
        </div>
        <div class="mt-4 text-center">
            <a href="{{ route('home') }}" class="px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                Kembali ke Home
            </a>
        </div>
    </div>
</body>

</html>
