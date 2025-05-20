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
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 @error('judul') border-red-500 @enderror"
                        required>
                    @error('judul')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-700">Deskripsi Video</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 @error('deskripsi') border-red-500 @enderror"
                        required>{{ old('deskripsi', $video->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="youtube_id" class="block mb-2 text-sm font-medium text-gray-700">ID atau URL YouTube</label>
                    <input type="text" name="youtube_id" id="youtube_id" value="{{ old('youtube_id', $video->youtube_id) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 @error('youtube_id') border-red-500 @enderror"
                        required>
                    <div class="mt-1 text-xs text-gray-500">
                        Masukkan ID YouTube (misal: dQw4w9WgXcQ) atau URL lengkap (misal: https://www.youtube.com/watch?v=dQw4w9WgXcQ)
                    </div>
                    @error('youtube_id')
                        <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-6">
                    <div class="mb-4">
                        <h3 class="mb-2 text-lg font-semibold text-gray-700">Preview Video</h3>
                        <div class="overflow-hidden rounded-lg shadow-md aspect-w-16 aspect-h-9">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $video->youtube_id }}"
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
