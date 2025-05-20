<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Foto Galeri - AgroMart</title>
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

        .cropper-container {
            width: 100% !important;
            height: 500px !important;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out forwards;
        }

        .animate-fadeOut {
            animation: fadeOut 0.3s ease-out forwards;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-emerald-50 to-teal-50 font-[Poppins]">
    <!-- Back Button -->
    <div class="container px-4 py-8 mx-auto">
        <div class="max-w-3xl mx-auto">
            <div class="mb-8">
                <a href="{{ route('galeri.index') }}"
                    class="inline-flex items-center px-4 py-2 transition-colors bg-white rounded-lg shadow-sm text-emerald-600 hover:bg-emerald-50 group">
                    <i class="mr-2 transition-transform fas fa-arrow-left group-hover:-translate-x-1"></i>
                    Kembali ke Galeri
                </a>
            </div>

            <!-- Main Form Card -->
            <div class="overflow-hidden bg-white shadow-xl rounded-2xl">
                <div class="px-6 py-8 text-center bg-emerald-50">
                    <h1 class="mb-2 text-3xl font-bold text-emerald-800">Tambah Foto ke Galeri</h1>
                    <p class="text-gray-600">Bagikan momen hidroponik terbaik Anda dengan komunitas</p>
                </div>

                <div class="p-8">
                    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Image Upload Area -->
                        <div class="mb-8">
                            <div id="imagePreview"
                                class="relative hidden mb-4 overflow-hidden rounded-lg aspect-video bg-gray-50">
                                <img id="preview" src="#" alt="Preview"
                                    class="object-cover w-full h-full image-preview">
                                <button type="button" onclick="removeImage()"
                                    class="absolute p-2 text-white transition-colors bg-red-500 rounded-full hover:bg-red-600 top-4 right-4">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            <div id="uploadButton" class="relative">
                                <input type="file" name="gambar" id="gambar"
                                    class="absolute inset-0 z-50 w-full h-full opacity-0 cursor-pointer"
                                    accept="image/jpeg,image/png,image/jpg" onchange="handleImageSelect(this)">
                                <div
                                    class="p-8 text-center transition-colors border-2 border-dashed rounded-lg cursor-pointer border-emerald-300 hover:bg-emerald-50">
                                    <i class="mb-4 text-4xl text-emerald-500 fas fa-cloud-upload-alt"></i>
                                    <p class="mb-2 font-medium text-emerald-600">Klik atau seret foto ke sini</p>
                                    <p class="text-sm text-gray-500">PNG, JPG atau JPEG (Maks. 2MB)</p>
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
                                    value="{{ old('judul') }}" placeholder="Masukkan judul foto yang menarik">
                            </div>

                            <div>
                                <label for="deskripsi"
                                    class="block mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" required
                                    class="w-full px-4 py-3 transition-colors border-gray-300 rounded-lg shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                    placeholder="Ceritakan tentang foto ini...">{{ old('deskripsi') }}</textarea>
                            </div>

                            <div class="flex justify-end pt-4">
                                <button type="submit"
                                    class="inline-flex items-center px-6 py-3 text-white transition-all transform rounded-lg bg-emerald-600 hover:bg-emerald-700 hover:scale-105">
                                    <i class="mr-2 fas fa-save"></i>
                                    Simpan Foto
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Cropper Modal -->
    <div id="cropperModal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black/70"></div>
        <div class="relative z-[60] max-w-4xl max-h-[90vh] p-6 mx-auto mt-10 bg-white rounded-xl overflow-y-auto">
            <div class="flex justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-800">Sesuaikan Foto</h3>
                <button onclick="closeCropperModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="text-xl fas fa-times"></i>
                </button>
            </div>

            <div class="relative mb-6 overflow-hidden bg-gray-100 rounded-lg" style="height: 60vh;">
                <img id="cropperImage" src="" alt="Image to crop" class="max-w-full">
            </div>

            <div class="relative z-[70] flex flex-wrap items-center justify-between gap-4">
                <div class="flex flex-wrap gap-2">
                    <button onclick="rotateLeft()"
                        class="inline-flex items-center px-4 py-2 text-gray-700 transition bg-gray-100 rounded-lg hover:bg-gray-200">
                        <i class="mr-2 fas fa-undo"></i> Putar Kiri
                    </button>
                    <button onclick="rotateRight()"
                        class="inline-flex items-center px-4 py-2 text-gray-700 transition bg-gray-100 rounded-lg hover:bg-gray-200">
                        <i class="mr-2 fas fa-redo"></i> Putar Kanan
                    </button>
                    <button onclick="flipHorizontal()"
                        class="inline-flex items-center px-4 py-2 text-gray-700 transition bg-gray-100 rounded-lg hover:bg-gray-200">
                        <i class="mr-2 fas fa-arrows-alt-h"></i> Balik Horizontal
                    </button>
                </div>
                <div class="flex gap-2">
                    <button onclick="cancelCrop()"
                        class="px-6 py-2 text-gray-600 transition bg-gray-100 rounded-lg hover:bg-gray-200">
                        Batal
                    </button>
                    <button onclick="cropImage()"
                        class="px-6 py-2 text-white transition rounded-lg bg-emerald-600 hover:bg-emerald-700">
                        Simpan
                    </button>
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
                    <button onclick="closeSuccessModal()"
                        class="px-6 py-2 text-white transition rounded-lg bg-emerald-600 hover:bg-emerald-700">
                        OK
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Error Modal -->
    @if ($errors->any())
        <div id="errorModal" class="fixed inset-0 z-50 flex items-center justify-center animate-fadeIn">
            <div class="fixed inset-0 bg-black/50"></div>
            <div class="relative px-8 py-6 bg-white shadow-lg rounded-xl">
                <div class="flex flex-col items-center">
                    <div class="p-3 mb-4 text-red-600 bg-red-100 rounded-full">
                        <i class="text-3xl fas fa-exclamation-triangle"></i>
                    </div>
                    <h3 class="mb-4 text-xl font-bold text-gray-800">Peringatan!</h3>
                    <div class="mb-6 text-center">
                        <p class="text-gray-600">Data tidak sesuai/ Data wajib diisi:</p>
                        <ul class="mt-2 space-y-1 text-sm text-red-500">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button onclick="closeErrorModal()"
                        class="px-6 py-2 text-white transition bg-red-500 rounded-lg hover:bg-red-600">
                        OK
                    </button>
                </div>
            </div>
        </div>
    @endif

    <script>
        let cropper = null;
        let originalFile = null;

        function handleImageSelect(input) {
            if (input.files && input.files[0]) {
                originalFile = input.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const cropperModal = document.getElementById('cropperModal');
                    const cropperImage = document.getElementById('cropperImage');

                    cropperImage.src = e.target.result;
                    cropperModal.classList.remove('hidden');

                    if (cropper) {
                        cropper.destroy();
                    }

                    cropper = new Cropper(cropperImage, {
                        aspectRatio: 16 / 9,
                        viewMode: 2,
                        dragMode: 'move',
                        background: false,
                        modal: true,
                        guides: true,
                        highlight: true,
                        autoCropArea: 1,
                        responsive: true,
                        cropBoxMovable: true,
                        cropBoxResizable: true,
                        toggleDragModeOnDblclick: true,
                    });
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function rotateLeft() {
            if (cropper) cropper.rotate(-90);
        }

        function rotateRight() {
            if (cropper) cropper.rotate(90);
        }

        function flipHorizontal() {
            if (cropper) cropper.scaleX(-cropper.getData().scaleX || -1);
        }

        function cancelCrop() {
            closeCropperModal();
            removeImage();
        }

        function cropImage() {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas({
                    width: 1280,
                    height: 720,
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                });

                canvas.toBlob((blob) => {
                    const croppedFile = new File([blob], originalFile.name, {
                        type: 'image/jpeg',
                        lastModified: Date.now()
                    });

                    const preview = document.getElementById('preview');
                    const previewContainer = document.getElementById('imagePreview');
                    const uploadButton = document.getElementById('uploadButton');

                    preview.src = canvas.toDataURL('image/jpeg');
                    previewContainer.classList.remove('hidden');
                    uploadButton.classList.add('hidden');

                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(croppedFile);
                    document.getElementById('gambar').files = dataTransfer.files;

                    closeCropperModal();
                }, 'image/jpeg', 0.9);
            }
        }

        function closeCropperModal() {
            const modal = document.getElementById('cropperModal');
            modal.classList.add('hidden');
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        }

        function removeImage() {
            const input = document.getElementById('gambar');
            const previewContainer = document.getElementById('imagePreview');
            const uploadButton = document.getElementById('uploadButton');

            input.value = '';
            previewContainer.classList.add('hidden');
            uploadButton.classList.remove('hidden');
        }

        function closeSuccessModal() {
            const modal = document.getElementById('successModal');
            if (modal) {
                modal.classList.add('animate-fadeOut');
                setTimeout(() => {
                    window.location.href = "{{ route('galeri.index') }}";
                }, 300);
            }
        }

        function closeErrorModal() {
            const modal = document.getElementById('errorModal');
            if (modal) {
                modal.classList.add('animate-fadeOut');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 300);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const successModal = document.getElementById('successModal');
            const errorModal = document.getElementById('errorModal');

            if (successModal) successModal.classList.add('animate-fadeIn');
            if (errorModal) errorModal.classList.add('animate-fadeIn');
        });
    </script>
</body>

</html>
