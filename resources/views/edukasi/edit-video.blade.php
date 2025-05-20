<!-- filepath: d:\PPL-AgroMart\resources\views\edukasi\edit-video.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Video - AgroMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&family=Signika:wght@300..700&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1050;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 90%;
        }

        .fade-enter {
            animation: fadeIn 0.3s ease-out;
        }

        .fade-exit {
            animation: fadeOut 0.3s ease-out;
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
    </style>
</head>

<body>
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <nav class="flex items-center justify-between max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Logo AgroMart" class="h-12">
                </a>
                <div class="items-center hidden gap-4 text-base font-semibold md:flex text-emerald-700 font-[signika]">
                    <a href="{{ route('home') }}" class="hover:text-emerald-400">HOME</a>
                    <div class="relative group">
                        <a href="{{ route('produk.index') }}"
                            class="flex items-center gap-1 hover:text-emerald-400">PRODUK</a>
                    </div>
                    <a href="{{ route('edukasi.index') }}" class="hover:text-emerald-400">EDUKASI</a>
                    <a href="#galeri" class="hover:text-emerald-400">GALERI</a>
                    <a href="{{ route('layanan.index') }}" class="hover:text-emerald-400">LAYANAN</a>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/notifIcon.png') }}" alt="Notifikasi"
                    class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90">
            </div>
        </nav>
    </header>

    <div class="container max-w-screen-xl py-5 mx-auto">
        <div class="mb-4">
            <a href="{{ route('edukasi.index', ['tab' => 'video']) }}"
                class="inline-flex items-center text-decoration-none text-emerald-700 hover:text-emerald-500">
                <i class="mr-2 fas fa-arrow-left"></i> Kembali ke Daftar Video
            </a>
        </div>

        <div class="p-6 mb-5 bg-white rounded-lg shadow-md">
            <h1 class="mb-6 text-2xl font-bold text-emerald-800 font-[Volkhov]">Edit Video</h1>

            <form action="{{ route('edukasi.video.update', $video->id_video) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="judul" class="block mb-2 text-sm font-medium text-gray-700">Judul Video</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $video->judul) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-700">Deskripsi Video</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        >{{ old('deskripsi', $video->deskripsi) }}</textarea>
                </div>

                <div class="mb-6">
                    <label for="youtube_id" class="block mb-2 text-sm font-medium text-gray-700">ID atau URL
                        YouTube</label>
                    <input type="text" name="youtube_id" id="youtube_id"
                        value="{{ old('youtube_id', $video->youtube_id) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    <div class="mt-1 text-xs text-gray-500">
                        Masukkan ID YouTube (misal: dQw4w9WgXcQ) atau URL lengkap (misal:
                        https://www.youtube.com/watch?v=dQw4w9WgXcQ)
                    </div>
                </div>

                <div class="mt-6">
                    <div class="mb-4">
                        <h3 class="mb-2 text-lg font-semibold text-gray-700">Preview Video</h3>
                        <div class="overflow-hidden rounded-lg shadow-md aspect-w-16 aspect-h-9">
                            <iframe width="560" height="315"
                                src="https://www.youtube.com/embed/{{ $video->youtube_id }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen class="w-full h-64 rounded-md"></iframe>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="px-6 py-2 text-white rounded-md bg-emerald-600 hover:bg-emerald-700">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    @if (session('success'))
        <div id="successModal" class="modal-backdrop fade-enter">
            <div class="modal-content">
                <div class="text-center">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-emerald-100">
                        <i class="text-3xl text-emerald-500 fas fa-check"></i>
                    </div>
                    <h4 class="mb-4 text-xl font-bold text-gray-800">Berhasil!</h4>
                    <p class="mb-6 text-gray-600">{{ session('success') }}</p>
                    <button onclick="closeSuccessModal()"
                        class="px-6 py-2 text-white transition-colors rounded-lg bg-emerald-600 hover:bg-emerald-700">
                        OK
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Error Modal -->
    @if ($errors->any())
        <div id="errorModal" class="modal-backdrop fade-enter">
            <div class="modal-content">
                <div class="text-center">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full">
                        <i class="text-3xl text-red-500 fas fa-exclamation-triangle"></i>
                    </div>
                    <h4 class="mb-4 text-xl font-bold text-gray-800">Peringatan!</h4>
                    <ul class="mb-6 space-y-1 text-sm text-red-500">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button onclick="closeErrorModal()"
                        class="px-6 py-2 text-white transition-colors bg-red-500 rounded-lg hover:bg-red-600">
                        OK
                    </button>
                </div>
            </div>
        </div>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function closeSuccessModal() {
            const modal = document.getElementById('successModal');
            if (modal) {
                modal.classList.replace('fade-enter', 'fade-exit');
                setTimeout(() => {
                    window.location.href = "{{ route('edukasi.index', ['tab' => 'video']) }}";
                }, 300);
            }
        }

        function closeErrorModal() {
            const modal = document.getElementById('errorModal');
            if (modal) {
                modal.classList.replace('fade-enter', 'fade-exit');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 300);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const successModal = document.getElementById('successModal');
            const errorModal = document.getElementById('errorModal');

            if (successModal) successModal.classList.add('fade-enter');
            if (errorModal) errorModal.classList.add('fade-enter');
        });
        // Live preview untuk YouTube ID
        $(document).ready(function() {
            $('#youtube_id').on('change keyup paste', function() {
                let youtubeId = $(this).val();

                // Extract YouTube ID from URL if needed
                if (youtubeId.includes('youtube.com/watch?v=')) {
                    const urlParams = new URLSearchParams(youtubeId.split('?')[1]);
                    youtubeId = urlParams.get('v');
                } else if (youtubeId.includes('youtu.be/')) {
                    youtubeId = youtubeId.split('youtu.be/')[1].split('&')[0];
                }

                // Update iframe src
                $('iframe').attr('src', `https://www.youtube.com/embed/${youtubeId}`);
            });
        });
    </script>
</body>

</html>
