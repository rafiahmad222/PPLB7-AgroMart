<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - AgroMart</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                        },
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                },
            },
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
</head>

<body class="font-sans text-gray-800 bg-gray-50">
    <div class="min-h-screen py-10">
        <!-- Header -->
        <div class="max-w-5xl px-6 mx-auto mb-8">
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-sm font-medium text-emerald-600 hover:text-emerald-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('produk.index') }}"
                                class="ml-1 text-sm font-medium text-emerald-600 hover:text-emerald-700 md:ml-2">Produk</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('produk.show', $produk->id_produk) }}"
                                class="ml-1 text-sm font-medium text-emerald-600 hover:text-emerald-700 md:ml-2 truncate max-w-[150px]">{{ $produk->nama_produk }}</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edit Produk</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-3xl font-bold text-gray-800">Edit Produk</h1>
            <p class="text-gray-600">Perbarui informasi untuk {{ $produk->nama_produk }}</p>
        </div>

        <!-- Main Form -->
        <div class="max-w-5xl px-6 mx-auto">
            <form method="POST" action="{{ route('produk.update', $produk->id_produk) }}" enctype="multipart/form-data"
                class="w-full">
                @csrf
                @method('PUT')

                <div class="overflow-hidden bg-white shadow-sm rounded-xl">
                    <!-- Form Content -->
                    <div class="grid gap-10 p-8 md:grid-cols-2">
                        <!-- Left Column - Image Upload -->
                        <div class="space-y-6">
                            <div>
                                <label class="block mb-3 text-lg font-medium text-gray-800">Foto Produk</label>
                                <div class="relative group">
                                    <div
                                        class="overflow-hidden transition-all border-2 border-gray-300 border-dashed rounded-xl bg-gray-50 group-hover:border-emerald-500">
                                        <img id="preview-image"
                                            src="{{ $produk->gambar_produk ? asset('storage/' . $produk->gambar_produk) : asset('images/UploadFoto.png') }}"
                                            alt="Gambar Produk" class="object-contain w-full p-2 h-80">
                                        <div
                                            class="absolute inset-0 flex items-center justify-center transition-opacity bg-black bg-opacity-0 opacity-0 group-hover:bg-opacity-10 group-hover:opacity-100">
                                            <div class="px-4 py-2 text-white rounded-lg bg-emerald-600">
                                                <div class="flex items-center">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                    Ubah Gambar
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="file" name="gambar_produk" id="gambar_produk" accept="image/*"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                </div>
                                @error('gambar_produk')
                                    <span class="block mt-1 text-sm text-red-600">{{ $message }}</span>
                                @enderror
                                <p class="mt-2 text-sm text-gray-500">Format: JPG, PNG. Ukuran maks: 2MB</p>
                            </div>
                        </div>

                        <!-- Right Column - Product Details -->
                        <div class="space-y-6">
                            <div>
                                <label for="nama_produk" class="block mb-1 text-sm font-medium text-gray-700">Nama
                                    Produk</label>
                                <input type="text" name="nama_produk" id="nama_produk"
                                    value="{{ old('nama_produk', $produk->nama_produk) }}" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                @error('nama_produk')
                                    <span class="block mt-1 text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="harga_produk" class="block mb-1 text-sm font-medium text-gray-700">Harga
                                        Produk (Rp)</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <span class="text-gray-500">Rp</span>
                                        </div>
                                        <input type="number" name="harga_produk" id="harga_produk"
                                            value="{{ old('harga_produk', $produk->harga_produk) }}" required
                                            class="w-full py-3 pl-10 pr-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                    </div>
                                    @error('harga_produk')
                                        <span class="block mt-1 text-sm text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="jumlah_stok"
                                        class="block mb-1 text-sm font-medium text-gray-700">Jumlah
                                        Stok</label>
                                    <input type="number" name="jumlah_stok" id="jumlah_stok"
                                        value="{{ old('jumlah_stok', $produk->jumlah_stok) }}" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                    @error('jumlah_stok')
                                        <span class="block mt-1 text-sm text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="id_kategori"
                                    class="block mb-1 text-sm font-medium text-gray-700">Kategori</label>
                                <div class="relative">
                                    <select name="id_kategori" id="id_kategori"
                                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg appearance-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($kategoris as $kat)
                                            <option value="{{ $kat->id_kategori }}"
                                                {{ $produk->id_kategori == $kat->id_kategori ? 'selected' : '' }}>
                                                {{ $kat->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('id_kategori')
                                    <span class="block mt-1 text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="deskripsi" class="block mb-1 text-sm font-medium text-gray-700">Deskripsi
                                    Produk</label>
                                <textarea name="deskripsi" id="deskripsi" maxlength="305" rows="5"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg resize-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">{{ old('deskripsi', $produk->deskripsi_produk) }}</textarea>
                                <div class="flex justify-between mt-1">
                                    <span class="text-sm text-gray-500">Tuliskan deskripsi yang informatif</span>
                                    <span class="text-sm text-gray-500"
                                        id="char-count">{{ strlen(old('deskripsi', $produk->deskripsi_produk)) }}/305</span>
                                </div>
                                @error('deskripsi')
                                    <span class="block mt-1 text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Form Actions -->
                            <div class="flex justify-end px-8 py-6 border-t bg-gray-50">
                                <div class="flex space-x-3">
                                    <a href="{{ route('produk.show', $produk->id_produk) }}"
                                        class="px-6 py-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        Batal
                                    </a>
                                    <button type="submit"
                                        class="px-6 py-3 text-white rounded-lg bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Cropper -->
    <div id="crop-modal"
        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-75 backdrop-blur-sm">
        <div class="w-full max-w-2xl p-6 mx-4 bg-white shadow-xl rounded-2xl">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Sesuaikan Gambar</h2>
                <button id="crop-cancel" type="button" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="flex justify-center">
                <div class="relative">
                    <img id="crop-image" class="max-w-full max-h-[60vh] rounded-lg" />
                </div>
            </div>
            <div class="flex justify-end mt-6 space-x-4">
                <button id="crop-cancel-btn"
                    class="px-5 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                <button id="crop-save"
                    class="px-5 py-2 text-white rounded-lg bg-emerald-600 hover:bg-emerald-700">Simpan Gambar</button>
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
        const cropCancelBtnAlt = document.getElementById('crop-cancel-btn');
        let cropper;

        inputFile.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    cropImage.src = e.target.result;
                    cropModal.classList.remove('hidden');
                    if (cropper) cropper.destroy();
                    setTimeout(() => {
                        cropper = new Cropper(cropImage, {
                            aspectRatio: 1,
                            viewMode: 2,
                            autoCropArea: 0.8,
                            responsive: true,
                            guides: true,
                            highlight: false,
                            dragMode: 'move'
                        });
                    }, 200);
                };
                reader.readAsDataURL(file);
            }
        });

        cropSaveButton.addEventListener('click', () => {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas({
                    width: 600,
                    height: 600,
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                });

                canvas.toBlob(blob => {
                    const fileInput = document.getElementById('gambar_produk');
                    const dataTransfer = new DataTransfer();
                    const file = new File([blob], 'cropped.jpg', {
                        type: 'image/jpeg'
                    });
                    dataTransfer.items.add(file);
                    fileInput.files = dataTransfer.files;

                    previewImage.src = URL.createObjectURL(blob);
                    cropModal.classList.add('hidden');
                    cropper.destroy();
                    cropper = null;
                }, 'image/jpeg', 0.9);
            }
        });

        const closeCrop = () => {
            cropModal.classList.add('hidden');
            inputFile.value = '';
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        };

        cropCancelButton.addEventListener('click', closeCrop);
        cropCancelBtnAlt.addEventListener('click', closeCrop);

        const textarea = document.getElementById('deskripsi');
        const countDisplay = document.getElementById('char-count');
        textarea.addEventListener('input', () => {
            countDisplay.textContent = `${textarea.value.length}/305`;
        });
        countDisplay.textContent = `${textarea.value.length}/305`;
    </script>
</body>

</html>
