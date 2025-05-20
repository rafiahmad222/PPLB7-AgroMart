<!-- filepath: d:\PPL-AgroMart\resources\views\galeri\edit.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Foto Galeri - AgroMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .image-preview {
            transition: transform 0.3s ease;
        }

        .image-preview:hover {
            transform: scale(1.02);
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-emerald-50 to-teal-50 font-[Poppins]">
    <div class="container px-4 py-8 mx-auto">
        <div class="max-w-3xl mx-auto">
            <div class="mb-8">
                <a href="{{ route('galeri.index') }}"
                    class="inline-flex items-center px-4 py-2 transition-colors bg-white rounded-lg shadow-sm text-emerald-600 hover:bg-emerald-50 group">
                    <i class="mr-2 transition-transform fas fa-arrow-left group-hover:-translate-x-1"></i>
                    Kembali ke Galeri
                </a>
            </div>

            <div class="overflow-hidden bg-white shadow-xl rounded-2xl">
                <div class="px-6 py-8 text-center bg-emerald-50">
                    <h1 class="mb-2 text-3xl font-bold text-emerald-800">Edit Foto Galeri</h1>
                    <p class="text-gray-600">Perbarui informasi foto galeri Anda</p>
                </div>

                <div class="p-8">
                    <form action="{{ route('galeri.update', $galeri->id_galeri) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Current Image Preview -->
                        <div class="mb-8">
                            <div class="relative overflow-hidden rounded-lg aspect-video bg-gray-50">
                                <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="Current Image"
                                    class="object-cover w-full h-full">
                            </div>
                        </div>

                        <!-- New Image Upload -->
                        <div class="mb-8">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Ganti Foto (Opsional)</label>
                            <div id="uploadButton" class="relative">
                                <input type="file" name="gambar" id="gambar"
                                    class="absolute inset-0 z-50 w-full h-full opacity-0 cursor-pointer"
                                    accept="image/jpeg,image/png,image/jpg">
                                <div
                                    class="p-4 text-center transition-colors border-2 border-dashed rounded-lg cursor-pointer border-emerald-300 hover:bg-emerald-50">
                                    <i class="mb-2 text-2xl text-emerald-500 fas fa-cloud-upload-alt"></i>
                                    <p class="text-sm text-gray-500">Klik untuk mengganti foto</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Fields -->
                        <div class="space-y-6">
                            <div>
                                <label for="judul" class="block mb-2 text-sm font-medium text-gray-700">Judul
                                    Foto</label>
                                <input type="text" name="judul" id="judul" required
                                    class="w-full px-4 py-3 transition-colors border-gray-300 rounded-lg shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                    value="{{ old('judul', $galeri->judul) }}">
                            </div>

                            <div>
                                <label for="deskripsi"
                                    class="block mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" required
                                    class="w-full px-4 py-3 transition-colors border-gray-300 rounded-lg shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                            </div>

                            <div class="flex justify-end pt-4">
                                <button type="submit"
                                    class="inline-flex items-center px-6 py-3 text-white transition-all transform rounded-lg bg-emerald-600 hover:bg-emerald-700 hover:scale-105">
                                    <i class="mr-2 fas fa-save"></i>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    @if (session('success'))
        <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center animate-fadeIn">
            <div class="fixed inset-0 bg-black/50"></div>
            <div class="relative px-8 py-6 bg-white shadow-lg rounded-xl">
                <div class="flex flex-col items-center">
                    <div class="p-3 mb-4 text-green-600 bg-green-100 rounded-full">
                        <i class="text-3xl fas fa-check"></i>
                    </div>
                    <h3 class="mb-4 text-xl font-bold text-gray-800">Berhasil!</h3>
                    <p class="mb-6 text-center text-gray-600">{{ session('success') }}</p>
                    <button onclick="window.location.href='{{ route('galeri.index') }}'"
                        class="px-6 py-2 text-white transition rounded-lg bg-emerald-600 hover:bg-emerald-700">
                        OK
                    </button>
                </div>
            </div>
        </div>
    @endif
</body>

</html>
