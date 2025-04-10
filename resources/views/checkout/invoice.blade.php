<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice Pesanan</title>
    <style>
        body { font-family: sans-serif; padding: 2rem; }
        .invoice-box { border: 1px solid #ccc; padding: 2rem; max-width: 600px; margin: auto; }
        h2 { margin-bottom: 1rem; }
        .line { margin: 0.5rem 0; }
        .total { font-weight: bold; font-size: 1.2rem; margin-top: 1rem; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <h2>Invoice Pesanan</h2>
        <div class="line">Nama Produk: <strong>{{ $pesanan->produk->nama_produk }}</strong></div>
        <div class="line">Harga Produk: Rp {{ number_format($pesanan->produk->harga_produk, 0, ',', '.') }}</div>
        <div class="line">Nama Pemesan: {{ $pesanan->nama }}</div>
        <div class="line">Alamat: {{ $pesanan->alamat }}</div>
        <div class="line">No HP: {{ $pesanan->no_hp }}</div>
        <div class="line">Metode Pengiriman: {{ $pesanan->pengiriman == 'wa_jek' ? 'WA Jek' : 'Ambil di tempat' }}</div>
        @if($pesanan->pengiriman == 'wa_jek')
            <div class="line">Jarak: {{ $pesanan->jarak }} km</div>
            <div class="line">Ongkir: Rp {{ number_format($pesanan->ongkir, 0, ',', '.') }}</div>
        @endif
        <div class="line">Metode Pembayaran: {{ $pesanan->pembayaran == 'transfer' ? 'Transfer' : 'COD' }}</div>
        @if($pesanan->pembayaran == 'transfer')
            <div class="line">No Rekening: 1234567890 (Bank Dummy)</div>
        @endif
        <div class="total">Total Bayar: Rp {{ number_format($pesanan->total, 0, ',', '.') }}</div>
        <hr>
        <div class="line">Status Pesanan: <strong>{{ $pesanan->status }}</strong></div>
    </div>
</body>
</html>
