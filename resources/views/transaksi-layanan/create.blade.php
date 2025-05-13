<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Layanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen px-4 py-10 bg-gray-100">

    <div class="max-w-xl p-6 mx-auto bg-white rounded-lg shadow">
        <h2 class="mb-6 text-2xl font-semibold text-center">Form Transaksi Layanan</h2>

        <form action="{{ route('transaksi-layanan.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf

            <!-- Layanan -->
            <div>
                <label class="block mb-1 font-medium">Layanan:</label>
                <select name="layanan_id" class="w-full px-3 py-2 border rounded" required>
                    @foreach ($layanans as $layanan)
                        <option value="{{ $layanan->id_layanan }}"
                            {{ isset($layananTerpilih) && $layananTerpilih == $layanan->id_layanan ? 'selected' : '' }}>
                            {{ $layanan->nama_layanan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Alamat -->
            <div>
                <label class="block mb-1 font-medium">Alamat:</label>
                <select name="alamat_id" class="w-full px-3 py-2 border rounded" required>
                    <option value="">Pilih Alamat</option>
                    @foreach ($alamat as $item)
                        <option value="{{ $item->id_alamat }}">
                            {{ $item->label_alamat }} - {{ $item->detail_alamat }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Jumlah -->
            <div>
                <label class="block mb-1 font-medium">Jumlah:</label>
                <input type="number" name="jumlah" min="1" class="w-full px-3 py-2 border rounded" required>
            </div>

            <!-- Jadwal Booking -->
            <div>
                <label class="block mb-1 font-medium">Jadwal Booking:</label>
                <input type="datetime-local" name="jadwal_booking" class="w-full px-3 py-2 border rounded" required>
            </div>

            <!-- Metode Pembayaran -->
            <div>
                <label class="block mb-1 font-medium">Metode Pembayaran:</label>
                <select name="pembayaran" id="pembayaran" onchange="toggleBukti()"
                    class="w-full px-3 py-2 border rounded" required>
                    <option value="transfer">Transfer</option>
                    <option value="cod">Cash (COD)</option>
                </select>
            </div>

            <!-- Bukti Transfer (Hanya jika transfer) -->
            <div id="bukti_transfer_div" style="display: none;">
                <label class="block mb-1 font-medium">Bukti Transfer:</label>
                <input type="file" name="bukti_transfer" accept="image/*" class="w-full px-3 py-2 border rounded">
            </div>

            <div class="text-center">
                <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                    Submit Transaksi
                </button>
            </div>
        </form>
    </div>

    <script>
        function toggleBukti() {
            let metode = document.getElementById('pembayaran').value;
            document.getElementById('bukti_transfer_div').style.display = metode === 'transfer' ? 'block' : 'none';
        }
        document.addEventListener('DOMContentLoaded', toggleBukti);
    </script>

</body>

</html>
