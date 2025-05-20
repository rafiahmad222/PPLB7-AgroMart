<!-- filepath: d:\PPL-AgroMart\resources\views\edukasi\show.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $artikel->judul }} - Edukasi AgroMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&family=Signika:wght@300..700&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .artikel-content img {
            max-width: 100%;
            height: auto;
        }

        .artikel-header-img {
            max-height: 400px;
            width: 100%;
            object-fit: cover;
        }

        .comment-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .artikel-content {
            font-family: 'Poppins', sans-serif;
            line-height: 1.7;
        }

        .artikel-content p {
            margin-bottom: 1.2rem;
        }

        .artikel-content h2,
        .artikel-content h3,
        .artikel-content h4 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .artikel-content a {
            color: #10B981;
            text-decoration: underline;
        }

        .artikel-content ul,
        .artikel-content ol {
            padding-left: 1.5rem;
            margin-bottom: 1.2rem;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.8s ease-out forwards;
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
            <a href="{{ route('edukasi.index') }}"
                class="inline-flex items-center text-decoration-none text-emerald-700 hover:text-emerald-500">
                <i class="mr-2 fas fa-arrow-left"></i> Kembali ke Daftar Edukasi
            </a>
        </div>

        <article class="p-6 mb-5 bg-white rounded-lg shadow-md">
            <header class="mb-8 text-center">
                <h1 class="text-3xl font-bold mb-3 font-[Volkhov] text-emerald-800">{{ $artikel->judul }}</h1>
                <div class="mb-4 text-gray-600">
                    Ditulis oleh {{ $artikel->user->name }} pada {{ $artikel->created_at->format('d M Y, H:i') }}
                </div>
                @if ($artikel->gambar)
                    <img src="{{ asset('storage/' . $artikel->gambar) }}" class="mb-6 rounded-lg artikel-header-img"
                        alt="{{ $artikel->judul }}">
                @endif

                <div class="p-4 mb-8 text-left rounded-lg bg-emerald-50">
                    <h5 class="mb-2 font-semibold text-emerald-800">Ringkasan:</h5>
                    <p class="text-gray-700">{{ $artikel->ringkasan }}</p>
                </div>
            </header>

            <div class="mx-auto prose artikel-content prose-emerald lg:prose-lg">
                {!! $artikel->konten !!}
            </div>

            @if (Auth::check() && Auth::user()->id === $artikel->user_id)
                <div class="mt-8 text-end">
                    <a href="{{ route('edukasi.edit', $artikel->id_artikel) }}"
                        class="px-4 py-2 mr-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                        <i class="mr-1 fas fa-edit"></i> Edit Artikel
                    </a>
                    <button type="button" class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600"
                        onclick="openDeleteModal('{{ $artikel->id_artikel }}', '{{ $artikel->judul }}')">
                        <i class="mr-1 fas fa-trash"></i> Hapus
                    </button>
                </div>
            @endif
        </article>

        <section class="p-6 mt-8 bg-white rounded-lg shadow-md">
            <h3 class="text-2xl font-semibold mb-6 text-emerald-800 font-[Volkhov]">Komentar
                ({{ $artikel->komentar->count() }})</h3>

            @auth
                <div class="mb-6 border border-gray-200 rounded-lg card">
                    <div class="p-4">
                        <form action="{{ route('edukasi.komentar.store', $artikel->id_artikel) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="konten" class="block mb-2 text-sm font-medium text-gray-700">Tambahkan
                                    komentar</label>
                                <textarea
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 @error('konten') border-red-500 @enderror"
                                    id="konten" name="konten" rows="3" required>{{ old('konten') }}</textarea>
                                @error('konten')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <button type="submit"
                                    class="px-4 py-2 text-white rounded-md bg-emerald-600 hover:bg-emerald-700">
                                    Kirim Komentar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="p-4 mb-6 text-blue-700 rounded-md bg-blue-50">
                    <a href="{{ route('login') }}" class="font-medium underline">Login</a> untuk menambahkan komentar.
                </div>
            @endauth

            <div class="space-y-4 komentar-list">
                @forelse($artikel->komentar->sortByDesc('created_at') as $komentar)
                    <div class="mb-3 border border-gray-200 rounded-lg shadow-sm card animate-fadeIn">
                        <div class="p-4">
                            <div class="flex mb-3">
                                @if (isset($komentar->user->avatar_url) && $komentar->user->avatar_url)
                                    <img src="{{ asset($komentar->user->avatar_url) }}"
                                        alt="{{ $komentar->user->name }}" class="mr-3 comment-avatar">
                                @else
                                    <div
                                        class="flex items-center justify-center mr-3 text-white comment-avatar bg-emerald-600">
                                        {{ substr($komentar->user->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <h6 class="mb-0 font-semibold">{{ $komentar->user->name }}</h6>
                                    <small class="text-gray-500">{{ $komentar->created_at->diffForHumans() }}</small>
                                </div>
                            </div>

                            <p class="mb-0 text-gray-700">{{ $komentar->konten }}</p>

                            @if (Auth::check() && (Auth::id() === $komentar->user_id || Auth::id() === $artikel->user_id))
                                <div class="mt-2 text-end">
                                    <form
                                        action="{{ route('edukasi.komentar.destroy', [$artikel->id_artikel, $komentar->id_komentar]) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-sm font-medium text-red-600 hover:text-red-800"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-gray-600 rounded-md bg-gray-50">
                        Belum ada komentar. Jadilah yang pertama berkomentar!
                    </div>
                @endforelse
            </div>
            <!-- Modal Konfirmasi Hapus -->
            <div id="deleteModal"
                class="fixed inset-0 z-50 flex items-center justify-center hidden overflow-auto bg-black bg-opacity-50">
                <div class="w-full max-w-md p-6 mx-4 bg-white rounded-lg shadow-xl animate-fadeIn">
                    <div class="mb-4 text-center">
                        <i class="text-5xl text-red-500 fas fa-exclamation-triangle"></i>
                        <h3 class="mt-4 mb-2 text-xl font-semibold text-gray-800">Konfirmasi Hapus</h3>
                        <p class="text-gray-600" id="deleteModalText">Apakah Anda yakin ingin menghapus artikel ini?
                        </p>
                    </div>
                    <div class="flex justify-center gap-4">
                        <button type="button"
                            class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300"
                            onclick="closeDeleteModal()">
                            Batal
                        </button>
                        <form id="deleteForm" action="" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600">
                                Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const routes = {
            destroy: id => `{{ url('edukasi') }}/${id_artikel}`,
        };

        function openDeleteModal(id, judul) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            const modalText = document.getElementById('deleteModalText');

            // Ganti dengan URL yang langsung dibentuk
            form.action = `{{ url('edukasi') }}/${id}`;
            modalText.textContent = `Apakah Anda yakin ingin menghapus artikel "${judul}"?`;

            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Tutup modal ketika klik di luar modal
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target === modal) {
                closeDeleteModal();
            }
        });

        // Tutup modal dengan tombol ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDeleteModal();
            }
        });
        // Animasi untuk menampilkan komentar baru
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success')) {
                const commentSection = document.querySelector('.komentar-list');
                commentSection.scrollIntoView({
                    behavior: 'smooth'
                });

                setTimeout(() => {
                    const firstComment = document.querySelector('.komentar-list .card:first-child');
                    if (firstComment) {
                        firstComment.classList.add('bg-emerald-50');
                        setTimeout(() => {
                            firstComment.classList.remove('bg-emerald-50');
                        }, 2000);
                    }
                }, 500);
            }
        });
    </script>
</body>

</html>
