<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Layanan - AgroMart</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                        },
                    },
                    animation: {
                        'bounce-slow': 'bounce 3s linear infinite',
                        'fade-in': 'fadeIn 0.5s ease-out forwards',
                        'slide-up': 'slideUp 0.5s ease-out forwards',
                        'pulse-ring': 'pulseRing 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
                            },
                        },
                        slideUp: {
                            '0%': {
                                transform: 'translateY(20px)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'translateY(0)',
                                opacity: '1'
                            },
                        },
                        pulseRing: {
                            '0%': {
                                transform: 'scale(0.8)',
                                opacity: '0.8'
                            },
                            '50%': {
                                transform: 'scale(1)',
                                opacity: '0.4'
                            },
                            '100%': {
                                transform: 'scale(0.8)',
                                opacity: '0.8'
                            },
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen font-sans text-gray-800 bg-gray-50">
    <div class="container max-w-4xl px-4 py-12 mx-auto">
        <!-- Breadcrumb -->
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
                        <a href="{{ route('layanan.index') }}"
                            class="ml-1 text-sm font-medium text-emerald-600 hover:text-emerald-700 md:ml-2">Layanan</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('layanan.show', $layanan->id_layanan) }}"
                            class="ml-1 text-sm font-medium text-emerald-600 hover:text-emerald-700 md:ml-2 truncate max-w-[150px]">{{ $layanan->nama_layanan }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edit Layanan</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Page title -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Edit Layanan</h1>
            <p class="mt-2 text-gray-600">Perbarui informasi untuk {{ $layanan->nama_layanan }}</p>
        </div>

        <!-- Main Form Card -->
        <div class="overflow-hidden bg-white shadow-sm rounded-xl animate-fade-in">
            <form action="{{ route('layanan.update', $layanan->id_layanan) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="p-8">
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                        <!-- Left Column - Image Upload -->
                        <div>
                            <label class="block mb-3 text-lg font-medium text-gray-800">Foto Layanan</label>
                            <div class="relative group">
                                <div
                                    class="rounded-xl border-2 border-dashed border-gray-300 overflow-hidden bg-gray-50 transition-all group-hover:border-emerald-500 min-h-[300px] flex items-center justify-center">
                                    <img id="previewGambar" src="{{ asset('storage/' . $layanan->gambar_layanan) }}"
                                        alt="Gambar Layanan" class="object-contain w-full h-full p-2">
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
                                <input type="file" name="gambar_layanan" id="gambar_layanan" accept="image/*"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            </div>
                            <p class="mt-2 text-sm text-gray-500">Format: JPG, PNG. Ukuran maksimal: 2MB</p>
                        </div>

                        <!-- Right Column - Service Details -->
                        <div class="space-y-6">
                            <div>
                                <label for="nama_layanan" class="block mb-1 text-sm font-medium text-gray-700">Nama
                                    Layanan</label>
                                <input type="text" name="nama_layanan" id="nama_layanan"
                                    value="{{ $layanan->nama_layanan }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                                    required>
                                @error('nama_layanan')
                                    <span class="block mt-1 text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="harga_layanan" class="block mb-1 text-sm font-medium text-gray-700">Harga
                                    Layanan</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <span class="text-gray-500">Rp</span>
                                    </div>
                                    <input type="number" name="harga_layanan" id="harga_layanan"
                                        value="{{ $layanan->harga_layanan }}"
                                        class="w-full py-3 pl-10 pr-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                                        required>
                                </div>
                                @error('harga_layanan')
                                    <span class="block mt-1 text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="deskripsi_layanan"
                                    class="block mb-1 text-sm font-medium text-gray-700">Deskripsi Layanan</label>
                                <textarea name="deskripsi_layanan" id="deskripsi_layanan" rows="6"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg resize-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">{{ $layanan->deskripsi_layanan }}</textarea>
                                <div class="flex justify-between mt-1">
                                    <span class="text-sm text-gray-500">Berikan deskripsi yang jelas tentang
                                        layanan</span>
                                    <span class="text-sm text-gray-500" id="char-count">0/300</span>
                                </div>
                                @error('deskripsi_layanan')
                                    <span class="block mt-1 text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end px-8 py-6 border-t bg-gray-50">
                    <div class="flex space-x-3">
                        <a href="{{ route('layanan.show', $layanan->id_layanan) }}"
                            class="px-6 py-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-3 text-white rounded-lg bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <!-- Backdrop with blur -->
        <div class="absolute inset-0 bg-gray-900/70 backdrop-blur-sm animate-fade-in"></div>
        <div class="relative w-full max-w-md mx-4 overflow-hidden bg-white shadow-2xl rounded-2xl animate-slide-up">
            <!-- Modal Header with gradient -->
            <div class="relative h-24 bg-gradient-to-r from-emerald-600 to-emerald-800">
                <div class="absolute -translate-x-1/2 -bottom-12 left-1/2">
                    <!-- Icon container with pulse effect -->
                    <div class="relative">
                        <span class="absolute inset-0 rounded-full bg-green-500/30 animate-pulse-ring"></span>
                        <div
                            class="relative z-10 flex items-center justify-center w-24 h-24 border-4 border-white rounded-full shadow-lg bg-gradient-to-br from-green-400 to-green-600">
                            <!-- Checkmark icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-white" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-6 pt-16 pb-6">
                <h2 class="mb-2 text-2xl font-bold text-center text-gray-800">Berhasil!</h2>
                <p class="mb-6 text-center text-gray-600">Data layanan berhasil diubah dan telah disimpan ke sistem</p>
                <div class="flex justify-center">
                    <button id="closeSuccessModalButton"
                        class="px-8 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white font-medium rounded-full shadow-lg hover:shadow-emerald-500/30 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-150 focus:outline-none">
                        Oke
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Character counter for description
        const textarea = document.getElementById('deskripsi_layanan');
        const countDisplay = document.getElementById('char-count');

        textarea.addEventListener('input', function() {
            countDisplay.textContent = `${this.value.length}/300`;

            // Optional: Add red text when approaching limit
            if (this.value.length > 280) {
                countDisplay.classList.add('text-red-500');
            } else {
                countDisplay.classList.remove('text-red-500');
            }
        });

        // Initialize count on load
        countDisplay.textContent = `${textarea.value.length}/300`;

        // Image preview functionality
        const inputGambar = document.getElementById('gambar_layanan');
        const previewGambar = document.getElementById('previewGambar');

        inputGambar.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewGambar.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Modal functionality
        const successModal = document.getElementById('successModal');
        const closeSuccessModalButton = document.getElementById('closeSuccessModalButton');

        @if (session('success'))
            successModal.classList.remove('hidden');
        @endif

        closeSuccessModalButton.addEventListener('click', () => {
            successModal.classList.add('hidden');
            window.location.href = "{{ route('layanan.index') }}";
        });
    </script>
</body>

</html>
