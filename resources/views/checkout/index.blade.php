<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 ">
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <nav class="flex items-center justify-between max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Logo AgroMart" class="h-12">
                </a>
            </div>
        </nav>
    </header>

    <div class="grid max-w-5xl grid-cols-1 gap-6 p-6 mx-auto mt-4 bg-white rounded shadow-md md:grid-cols-3">
        <!-- Alamat Pengiriman dan Produk -->
        <div class="space-y-6 md:col-span-2">
            <div>
                <h2 class="mb-2 text-xl font-bold">Alamat Pengiriman</h2>
                <div class="p-4 border rounded bg-gray-50">
                    <p class="font-semibold">{{ Auth::user()->name }}</p>
                    <p>{{ Auth::user()->address }}</p>
                    <p>{{ Auth::user()->phone }}</p>
                </div>
            </div>

            <div>
                <h2 class="mb-2 text-xl font-bold">Produk yang Dipesan</h2>
                <div class="flex items-start gap-4 p-4 border rounded bg-gray-50">
                    <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="Produk" class="object-cover w-20 h-20 rounded">
                    <div>
                        <p class="font-semibold">{{ $produk->nama_produk }}</p>
                        <p class="text-gray-600">Harga: Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
                        <p class="text-gray-600">Jumlah: {{ $jumlah }}</p>
                    </div>
                </div>
            </div>
        </div>


        <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4">
            @csrf
        <!-- Ringkasan dan Submit -->
            <div class="space-y-4">
                <div>
                    <h2 class="mb-2 text-xl font-bold">Metode Pengiriman</h2>
                    <div class="space-y-2">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="pengiriman" value="wa_jek" onclick="toggleOngkir()" class="pengiriman-radio">
                            WA Jek
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="pengiriman" value="ambil_ditempat" onclick="toggleOngkir()" class="pengiriman-radio">
                            Ambil di Tempat
                        </label>
                    </div>
                    <div class="hidden mt-2" id="ongkirField">
                        <label class="block text-sm font-medium">Perkiraan Jarak (KM)</label>
                        <input type="number" name="jarak" min="1" placeholder="Contoh: 3" class="w-full px-3 py-2 mt-1 border rounded" onchange="hitungTotal()">
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div>
                    <h2 class="mb-2 text-xl font-bold">Metode Pembayaran</h2>
                    <div class="space-y-2">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="pembayaran" value="transfer" class="pembayaran-radio" onclick="toggleRekening()">
                            Transfer
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="pembayaran" value="cod" class="pembayaran-radio" onclick="toggleRekening()" id="codOption">
                            COD
                        </label>
                    </div>
                    <div class="hidden mt-2 text-sm text-gray-600" id="rekeningField">
                        Transfer ke: BRI 123456789 a.n. Toko Hidroponik
                    </div>
                </div>

                <div class="p-4 border rounded bg-gray-50">
                    <h2 class="mb-4 text-xl font-bold">Ringkasan Pembayaran</h2>
                    <p>Harga Produk: <strong>Rp {{ number_format($totalHarga, 0, ',', '.') }}</strong></p>
                    <p>Ongkir: <strong id="ongkirDisplay">Rp 0</strong></p>
                    <p>Total: <strong id="totalDisplay">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</strong></p>
                </div>

                    <input type="hidden" name="jumlah" value="{{ $jumlah }}">
                    <input type="hidden" name="produk_id" value="{{ $produk->id_produk }}">
                    <input type="hidden" name="total" value="{{ $totalHarga }}">
                    <input type="hidden" id="harga_produk" value="{{ $produk->harga_produk }}">
                    <input type="hidden" name="ongkir" id="ongkirInput" value="0">
                    <input type="hidden" name="nama" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="alamat" value="{{ Auth::user()->address }}">
                    <input type="hidden" name="no_hp" value="{{ Auth::user()->phone }}">
                    <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-green-600 rounded hover:bg-green-700">
                        Bayar Sekarang
                    </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function toggleOngkir() {
            const pengirimanRadios = document.querySelectorAll('.pengiriman-radio');
            let selectedPengiriman = '';
            pengirimanRadios.forEach(radio => {
                if (radio.checked) selectedPengiriman = radio.value;
            });

            const ongkirField = document.getElementById('ongkirField');
            const codOption = document.getElementById('codOption');

            if (selectedPengiriman === 'wa_jek') {
                ongkirField.classList.remove('hidden');
                codOption.disabled = true;
                codOption.checked = false;
                toggleRekening(); // to hide rekeningField if needed
            } else {
                ongkirField.classList.add('hidden');
                codOption.disabled = false;
                document.getElementById('ongkirInput').value = 0;
                document.getElementById('ongkirDisplay').innerText = 'Rp 0';
                hitungTotal();
            }
        }

        function toggleRekening() {
            const pembayaranRadios = document.querySelectorAll('.pembayaran-radio');
            let selectedPembayaran = '';
            pembayaranRadios.forEach(radio => {
                if (radio.checked) selectedPembayaran = radio.value;
            });

            const rekeningField = document.getElementById('rekeningField');
            if (selectedPembayaran === 'transfer') {
                rekeningField.classList.remove('hidden');
            } else {
                rekeningField.classList.add('hidden');
            }
        }

        function hitungTotal() {
            const jarak = document.querySelector('input[name="jarak"]').value || 0;
            const hargaProduk = parseInt(document.getElementById('harga_produk').value);
            const jumlah = parseInt(document.querySelector('input[name="jumlah"]').value);
            const ongkir = jarak * 5000;

            const totalHarga = hargaProduk * jumlah;
            const totalPembayaran = totalHarga + ongkir;

            document.getElementById('ongkirInput').value = ongkir;
            document.getElementById('ongkirDisplay').innerText = 'Rp ' + ongkir.toLocaleString();
            document.getElementById('totalDisplay').innerText = 'Rp ' + totalPembayaran.toLocaleString();
        }

        document.addEventListener('DOMContentLoaded', function () {
            hitungTotal();
        });
    </script>
</body>
</html>
