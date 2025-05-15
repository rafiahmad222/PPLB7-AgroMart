<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'bounce-slow': 'bounce 3s linear infinite',
                        'fade-in': 'fadeIn 0.5s ease-out forwards',
                        'slide-up': 'slideUp 0.5s ease-out forwards',
                        'pulse-ring': 'pulseRing 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        pulseRing: {
                            '0%': { transform: 'scale(0.8)', opacity: '0.8' },
                            '50%': { transform: 'scale(1)', opacity: '0.4' },
                            '100%': { transform: 'scale(0.8)', opacity: '0.8' },
                        }
                    }
                }
            }
        }
    </script>
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
                    class="block w-full px-3 py-1 mt-1 border-2 border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="gambar_layanan" class="block text-sm font-medium text-gray-700">Gambar Layanan</label>
                <!-- Gambar Preview -->
                <div class="flex items-center space-x-4">
                    <img id="previewGambar" src="{{ asset('storage/' . $layanan->gambar_layanan) }}"
                        alt="Gambar Layanan" class="object-cover w-32 h-32 border border-gray-300 rounded-md">
                    <!-- Input File -->
                    <input type="file" name="gambar_layanan" id="gambar_layanan" class="block w-full mt-1"
                        accept="image/*">
                </div>
            </div>
            <div class="mb-4">
                <label for="harga_layanan" class="block text-sm font-medium text-gray-700">Harga Layanan</label>
                <input type="number" name="harga_layanan" id="harga_layanan" value="{{ $layanan->harga_layanan }}"
                    class="block w-full px-3 py-1 mt-1 border-2 border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="deskripsi_layanan" class="block text-sm font-medium text-gray-700">Deskripsi Layanan</label>
                <textarea name="deskripsi_layanan" id="deskripsi_layanan" rows="4"
                    class="block w-full px-3 py-1 mt-1 border-2 border-gray-300 rounded-md shadow-sm">{{ $layanan->deskripsi_layanan }}</textarea>
            </div>
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Simpan</button>
        </form>
    </div>
    <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <!-- Backdrop dengan blur -->
        <div class="absolute inset-0 bg-gray-900/70 backdrop-blur-sm animate-fade-in"></div>
        <div class="relative w-full max-w-md mx-4 overflow-hidden bg-white shadow-2xl rounded-2xl animate-slide-up">
            <!-- Modal Header dengan gradient -->
            <div class="relative h-24 bg-gradient-to-r from-blue-600 to-blue-800">
                <div class="absolute -translate-x-1/2 -bottom-12 left-1/2">
                    <!-- Icon container dengan pulse effect -->
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
                        class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-full shadow-lg hover:shadow-blue-500/30 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-150 focus:outline-none">
                        Oke
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Modal notifikasi sukses
        const successModal = document.getElementById('successModal');
        const closeSuccessModalButton = document.getElementById('closeSuccessModalButton');

        // Tampilkan modal jika ada pesan sukses dari server
        @if (session('success'))
            successModal.classList.remove('hidden');
        @endif

        // Tutup modal ketika tombol "Oke" diklik
        closeSuccessModalButton.addEventListener('click', () => {
            successModal.classList.add('hidden');
            window.location.href = "{{ route('layanan.index') }}";
        });
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
