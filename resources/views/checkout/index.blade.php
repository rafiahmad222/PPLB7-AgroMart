<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="py-10 bg-gray-100">
    <div class="max-w-2xl p-6 mx-auto bg-white rounded shadow">
        <h2 class="mb-6 text-2xl font-bold">Checkout</h2>

        <div class="mb-4">
            <h3 class="text-lg font-semibold">Produk yang Dipesan</h3>
            <p class="mt-2 text-gray-700">{{ $produk->nama_produk }}</p>
        </div>
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf

            <!-- Detail Pembeli -->
            <div class="mb-4">
                <label class="block mb-1 font-medium">Nama</label>
                <input type="text" name="nama" value="{{ Auth::user()->name }}" class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Alamat</label>
                <textarea name="alamat" rows="2" required class="w-full px-3 py-2 border rounded"></textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">No. HP</label>
                <input type="text" name="no_hp" required class="w-full px-3 py-2 border rounded">
            </div>

            <!-- Pengiriman -->
            <div class="mb-4">
                <label class="block mb-1 font-medium">Metode Pengiriman</label>
                <select name="pengiriman" id="pengiriman" class="w-full px-3 py-2 border rounded" required onchange="toggleOngkir()">
                    <option value="">-- Pilih --</option>
                    <option value="wa_jek">WA Jek</option>
                    <option value="ambil_ditempat">Ambil di Tempat</option>
                </select>
            </div>

            <div class="hidden mb-4" id="ongkirField">
                <label class="block mb-1 font-medium">Perkiraan Jarak (KM)</label>
                <input type="number" name="jarak" min="1" placeholder="Contoh: 3" class="w-full px-3 py-2 border rounded" onchange="hitungTotal()">
            </div>

            <!-- Pembayaran -->
            <div class="mb-4">
                <label class="block mb-1 font-medium">Metode Pembayaran</label>
                <select name="pembayaran" id="pembayaran" class="w-full px-3 py-2 border rounded" required onchange="toggleRekening()">
                    <option value="">-- Pilih --</option>
                    <option value="transfer">Transfer</option>
                    <option value="cod">COD</option>
                </select>
            </div>

            <div class="hidden mb-4" id="rekeningField">
                <p class="text-sm text-gray-600">Transfer ke: BRI 123456789 a.n. Toko Hidroponik</p>
            </div>

            <!-- Ringkasan -->
            <div class="pt-4 mt-6 border-t">
                <p>Harga {{ $jumlah }} Produk: <strong>Rp {{ number_format($totalHarga, 0, ',', '.') }}</strong></p>
                <p>Ongkir: <strong id="ongkirDisplay">Rp 0</strong></p>
                <p>Total Pembayaran: <strong id="totalDisplay">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</strong></p>
            </div>

            <!-- Hidden -->

            <input type="hidden" name="jumlah" value="{{ $jumlah }}">
            <input type="hidden" name="produk_id" value="{{ $produk->id_produk }}">
            <input type="hidden" name="total" value="{{ $totalHarga }}">
            <input type="hidden" id="harga_produk" value="{{ $produk->harga_produk }}">
            <input type="hidden" name="ongkir" id="ongkirInput" value="0">

            <!-- Submit -->
            <button type="submit" class="w-full px-4 py-2 mt-6 text-white bg-green-600 rounded hover:bg-green-700">
                Pesan Sekarang
            </button>
        </form>
    </div>

    <script>
        function toggleOngkir() {
            const pengiriman = document.getElementById('pengiriman').value;
            const ongkirField = document.getElementById('ongkirField');

            if (pengiriman === 'wa_jek') {
                ongkirField.classList.remove('hidden');
            } else {
                ongkirField.classList.add('hidden');
                document.getElementById('ongkirInput').value = 0;
                document.getElementById('ongkirDisplay').innerText = 'Rp 0';
                hitungTotal();
            }
        }

        function toggleRekening() {
            const pembayaran = document.getElementById('pembayaran').value;
            const rekeningField = document.getElementById('rekeningField');

            if (pembayaran === 'transfer') {
                rekeningField.classList.remove('hidden');
            } else {
                rekeningField.classList.add('hidden');
            }
        }

        function hitungTotal() {
            const jarak = document.querySelector('input[name="jarak"]')?.value || 0; // Ambil jarak dari input
            const hargaProduk = parseInt(document.getElementById('harga_produk').value); // Harga produk
            const jumlah = parseInt(document.querySelector('input[name="jumlah"]').value); // Jumlah produk
            const ongkir = jarak * 5000; // Contoh perhitungan ongkir (5000 per km)

            const totalHarga = hargaProduk * jumlah; // Total harga produk
            const totalPembayaran = totalHarga + ongkir; // Total pembayaran (harga + ongkir)

            // Perbarui input tersembunyi untuk ongkir
            document.getElementById('ongkirInput').value = ongkir;

            // Perbarui tampilan ongkir dan total pembayaran
            document.getElementById('ongkirDisplay').innerText = 'Rp ' + ongkir.toLocaleString();
            document.getElementById('totalDisplay').innerText = 'Rp ' + totalPembayaran.toLocaleString();
        }

            // Inisialisasi total saat halaman dimuat
            document.addEventListener('DOMContentLoaded', function() {
                hitungTotal();
        });
    </script>
</body>
</html>
