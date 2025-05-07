<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="max-w-xl px-4 py-3 mx-auto mt-4 bg-gray-200 rounded-lg shadow-md">
        <h1 class="mb-4 text-2xl font-bold">Edit Layanan</h1>
        <form action="{{ route('layanan.update', $layanan->id_layanan) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nama_layanan" class="block text-sm font-medium text-gray-700">Nama Layanan</label>
                <input type="text" name="nama_layanan" id="nama_layanan" value="{{ $layanan->nama_layanan }}"
                    class="block w-full mt-1 border-2 border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="gambar_layanan" class="block text-sm font-medium text-gray-700">Gambar Layanan</label>
                <!-- Gambar Preview -->
                <div class="flex items-center space-x-4">
                    <img id="previewGambar" src="{{ asset('storage/' . $layanan->gambar_layanan) }}" alt="Gambar Layanan"
                        class="object-cover w-32 h-32 border border-gray-300 rounded-md">
                    <!-- Input File -->
                    <input type="file" name="gambar_layanan" id="gambar_layanan" class="block w-full mt-1" accept="image/*">
                </div>
            </div>
            <div class="mb-4">
                <label for="harga_layanan" class="block text-sm font-medium text-gray-700">Harga Layanan</label>
                <input type="number" name="harga_layanan" id="harga_layanan" value="{{ $layanan->harga_layanan }}"
                    class="block w-full mt-1 border-2 border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="deskripsi_layanan" class="block text-sm font-medium text-gray-700">Deskripsi Layanan</label>
                <textarea name="deskripsi_layanan" id="deskripsi_layanan" rows="4"
                    class="block w-full mt-1 border-2 border-gray-300 rounded-md shadow-sm">{{ $layanan->deskripsi_layanan }}</textarea>
            </div>
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Simpan</button>
        </form>
    </div>
    <script>
        const inputGambar = document.getElementById('gambar_layanan');
        const previewGambar = document.getElementById('previewGambar');

        inputGambar.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewGambar.src = e.target.result; // Ganti src gambar dengan file yang diunggah
                };
                reader.readAsDataURL(file); // Membaca file sebagai URL
            }
        });
    </script>
</body>
</html>
