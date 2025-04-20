<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-5xl p-8 mx-auto mt-10 bg-white rounded-lg shadow-md">
        <h1 class="mb-8 text-3xl font-bold text-center text-gray-800">Edit Produk</h1>

        <form method="POST" action="{{ route('produk.update', $produk->id_produk) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid items-start grid-cols-1 md:grid-cols-2">
                <!-- Kolom Kiri - Gambar Produk -->
                <div class="flex flex-col items-center">
                    <label for="gambar_produk" class="block mb-2 text-lg font-semibold text-gray-800">Foto Produk</label>
                    <div class="relative">
                        <img id="preview-image"
                            src="{{ $produk->gambar_produk ? asset('storage/' . $produk->gambar_produk) : asset('images/UploadFoto.png') }}"
                            alt="Gambar Produk"
                            class="object-cover w-auto h-64 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50">
                        <input type="file" name="gambar_produk" id="gambar_produk" accept="image/*"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    </div>
                    @error('gambar_produk')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Kolom Kanan - Form Input -->
                <div class="space-y-4">
                    <div>
                        <label for="nama_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" required
                               class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        @error('nama_produk')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="jumlah_stok" class="block text-sm font-medium text-gray-700">Jumlah Stok</label>
                        <input type="number" name="jumlah_stok" id="jumlah_stok" value="{{ old('jumlah_stok', $produk->jumlah_stok) }}" required
                               class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        @error('jumlah_stok')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="harga_produk" class="block text-sm font-medium text-gray-700">Harga Produk</label>
                        <input type="number" name="harga_produk" id="harga_produk" value="{{ old('harga_produk', $produk->harga_produk) }}" required
                               class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        @error('harga_produk')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="id_kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="id_kategori" id="id_kategori"
                                class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option>-- Pilih Kategori --</option>
                            @foreach ($kategoris as $kat)
                                <option value="{{ $kat->id_kategori }}" {{ $produk->id_kategori == $kat->id_kategori ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Produk</label>
                        <textarea name="deskripsi" id="deskripsi" maxlength="305" rows="4"
                                  class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('deskripsi', $produk->deskripsi_produk) }}</textarea>
                        <div class="text-sm text-right text-gray-500" id="char-count">{{ strlen(old('deskripsi', $produk->deskripsi_produk)) }}/305</div>
                        @error('deskripsi')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-8">
                <button type="submit" class="px-8 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300">
                    Update Produk
                </button>
            </div>
        </form>
    </div>

    <!-- Modal Cropper -->
    <div id="crop-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="w-full max-w-3xl max-h-[90vh] overflow-auto p-6 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-lg font-semibold text-center">Crop Gambar</h2>
            <div class="flex justify-center">
                <img id="crop-image" class="max-w-full max-h-[70vh] rounded-md shadow" />
            </div>
            <div class="flex justify-end mt-4 space-x-4">
                <button id="crop-cancel" class="px-4 py-2 text-white bg-gray-400 rounded hover:bg-gray-500">Batal</button>
                <button id="crop-save" class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        const inputFile = document.getElementById('gambar_produk');
        const previewImage = document.getElementById('preview-image');
        const cropModal = document.getElementById('crop-modal');
        const cropImage = document.getElementById('crop-image');
        const cropSaveButton = document.getElementById('crop-save');
        const cropCancelButton = document.getElementById('crop-cancel');
        let cropper;

        inputFile.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    cropImage.src = e.target.result;
                    cropModal.classList.remove('hidden');
                    if (cropper) cropper.destroy();
                    cropper = new Cropper(cropImage, {
                        aspectRatio: 1,
                        viewMode: 2,
                    });
                };
                reader.readAsDataURL(file);
            }
        });

        cropSaveButton.addEventListener('click', () => {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas({
                    width: 400,
                    height: 400,
                });

                canvas.toBlob(blob => {
                    const fileInput = document.getElementById('gambar_produk');
                    const dataTransfer = new DataTransfer();
                    const file = new File([blob], 'cropped.jpg', { type: 'image/jpeg' });
                    dataTransfer.items.add(file);
                    fileInput.files = dataTransfer.files;

                    previewImage.src = URL.createObjectURL(blob);
                    cropModal.classList.add('hidden');
                    cropper.destroy();
                }, 'image/jpeg');
            }
        });

        cropCancelButton.addEventListener('click', () => {
            cropModal.classList.add('hidden');
            inputFile.value = '';
            if (cropper) cropper.destroy();
        });

        const textarea = document.getElementById('deskripsi');
        const countDisplay = document.getElementById('char-count');
        textarea.addEventListener('input', () => {
            countDisplay.textContent = `${textarea.value.length}/305`;
        });
        countDisplay.textContent = `${textarea.value.length}/305`;
    </script>
</body>
</html>
