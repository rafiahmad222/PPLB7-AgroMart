<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Hidroponik - AgroMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&family=Signika:wght@300..700&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .masonry-item {
            break-inside: avoid;
            margin-bottom: 1.5rem;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .masonry {
            column-count: 3;
            column-gap: 1.5rem;
        }

        @media (max-width: 1024px) {
            .masonry {
                column-count: 2;
            }
        }

        @media (max-width: 640px) {
            .masonry {
                column-count: 1;
            }
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

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(-5px);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .animate-fadeOut {
            animation: fadeOut 0.3s ease-out forwards;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-emerald-50 to-teal-50">
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
                        <div
                            class="absolute hidden w-40 bg-white rounded-md shadow-lg z-5 group-hover:block animate-fadeIn text-emerald-600">
                            @foreach ($kategoris as $kategori)
                                <a href="{{ route('produk.index', $kategori->id_kategori) }}"
                                    class="block px-4 py-2 text-sm rounded-md text-emerald-700 hover:bg-gray-100 hover:text-emerald-400">{{ $kategori->nama_kategori }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('edukasi.index') }}" class="hover:text-emerald-400">EDUKASI</a>
                    <a href="{{ route('galeri.index') }}" class="hover:text-emerald-400">GALERI</a>
                    <a href="{{ route('layanan.index') }}" class="hover:text-emerald-400">LAYANAN</a>
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" class="hover:text-emerald-400">TRANSAKSI</a>
                    @else
                        <a href="{{ route('pesananku') }}" class="hover:text-emerald-400">TRANSAKSI</a>
                    @endif
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/notifIcon.png') }}" alt="Notifikasi"
                    class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90">
                <div id="menuButton" class="relative">
                    <div class="flex items-center gap-2 cursor-pointer">
                        <img src="{{ Auth::user()->avatar_url }}" alt="Avatar"
                            class="w-12 h-12 border-2 rounded-full border-emerald-500">
                        <div class="hidden text-left md:block">
                            <span class="block font-bold">{{ Auth::user()->name }}</span>
                            <small class="text-gray-500">{{ Auth::user()->email }}</small>
                        </div>
                    </div>
                    <div id="dropdownUser"
                        class="absolute right-0 z-30 flex-col hidden w-48 mt-4 bg-white rounded-md shadow-2xl">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Akun</a>
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('profile.adminshowuser') }}"
                                class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Akun Customer</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full px-4 py-2 text-sm text-left rounded-md hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container px-4 py-12 mx-auto">
        <!-- Hero Section -->
        <div class="mb-12 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-emerald-800 mb-4 font-[Poppins]">
                Galeri Hidroponik
            </h1>
            <p class="max-w-2xl mx-auto mb-8 text-lg text-gray-600">
                Jelajahi koleksi foto-foto terbaik dari sistem hidroponik kami dan temukan inspirasi untuk berkebun
                modern
            </p>
            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('galeri.create') }}"
                        class="inline-flex items-center px-6 py-3 font-semibold text-white transition duration-300 transform rounded-lg shadow-lg bg-emerald-600 hover:bg-emerald-700 hover:scale-105">
                        <i class="mr-2 fas fa-plus"></i>
                        Tambah Foto Baru
                    </a>
                @endif
            @endauth
        </div>

        <!-- Filter & Search Section (Opsional) -->
        <div class="flex flex-wrap items-center justify-between mb-8">
            <div class="relative">
                <input type="text" placeholder="Cari galeri..."
                    class="py-2 pl-10 pr-4 border border-gray-200 rounded-lg outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                <i class="absolute text-gray-400 fas fa-search left-3 top-3"></i>
            </div>
        </div>

        <!-- Masonry Grid -->
        <div class="masonry">
            @forelse($galeris as $galeri)
                <div class="mb-6 masonry-item">
                    <div
                        class="overflow-hidden transition duration-300 transform bg-white shadow-lg rounded-xl hover:shadow-2xl">
                        <!-- Gambar dan Overlay -->
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="{{ $galeri->judul }}"
                                class="object-cover w-full h-64 transition duration-500 transform group-hover:scale-105">

                            <!-- Gradient Overlay -->
                            <div
                                class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-b from-transparent via-black/20 to-black/70 group-hover:opacity-100">
                            </div>

                            <!-- Hover Content -->
                            <div
                                class="absolute inset-0 flex flex-col justify-end p-6 transition-all duration-300 translate-y-4 opacity-0 group-hover:opacity-100 group-hover:translate-y-0">
                                <h3 class="mb-2 text-xl font-bold text-white">{{ $galeri->judul }}</h3>
                                <p class="text-sm text-white/90">{{ $galeri->deskripsi }}</p>
                            </div>
                        </div>

                        <!-- Info Card -->
                        <div class="p-4 border-t border-gray-100">
                            <!-- Title and Description for non-hover state -->
                            <div class="mb-3">
                                <h4 class="font-bold text-gray-800">{{ $galeri->judul }}</h4>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{ $galeri->deskripsi }}
                                </p>
                            </div>

                            <!-- User Info and Date -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    @if ($galeri->user && $galeri->user->avatar_url)
                                        <img src="{{ $galeri->user->avatar_url }}" alt="{{ $galeri->user->name }}"
                                            class="w-8 h-8 border-2 rounded-full border-emerald-500">
                                    @endif
                                    <div>
                                        <span class="block text-sm font-medium text-gray-700">
                                            {{ optional($galeri->user)->name ?? 'Anonymous' }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            {{ $galeri->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Actions -->
                                @auth
                                    @if (Auth::id() === $galeri->user_id)
                                        <div class="flex items-center space-x-2">
                                            <form action="{{ route('galeri.destroy', $galeri->id_galeri) }}" method="POST"
                                                class="inline-flex">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-red-500 transition-colors duration-200 rounded-full hover:text-red-700 hover:bg-red-50"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-12 text-center col-span-full">
                    <div class="max-w-sm mx-auto">
                        <div class="mb-4 text-gray-400">
                            <i class="text-5xl fas fa-images"></i>
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-gray-600">Belum ada foto</h3>
                        <p class="text-gray-500">Galeri masih kosong. Mulai tambahkan foto untuk menampilkan konten di
                            sini.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $galeris->links() }}
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black/90">
        <button class="absolute text-2xl text-white top-4 right-4" onclick="closeLightbox()">
            <i class="fas fa-times"></i>
        </button>
        <img id="lightbox-image" src="" alt="" class="max-h-[90vh] max-w-[90vw] object-contain">
    </div>

    <script>
        const menuButton = document.getElementById('menuButton');
        const dropdownUser = document.getElementById('dropdownUser');

        let isDropdownVisible = false;

        menuButton.addEventListener('click', function(e) {
            e.stopPropagation();
            if (!isDropdownVisible) {
                dropdownUser.classList.remove('hidden');
                dropdownUser.classList.remove('animate-fadeOut');
                dropdownUser.classList.add('animate-fadeIn');
                isDropdownVisible = true;
            } else {
                dropdownUser.classList.remove('animate-fadeIn');
                dropdownUser.classList.add('animate-fadeOut');
                setTimeout(() => {
                    dropdownUser.classList.add('hidden');
                    isDropdownVisible = false;
                }, 300);
            }
        });

        document.addEventListener('click', function() {
            if (isDropdownVisible) {
                dropdownUser.classList.remove('animate-fadeIn');
                dropdownUser.classList.add('animate-fadeOut');
                setTimeout(() => {
                    dropdownUser.classList.add('hidden');
                    isDropdownVisible = false;
                }, 300);
            }
        });

        dropdownUser.addEventListener('click', function(e) {
            e.stopPropagation();
        });
        // Lightbox functionality
        function openLightbox(imageSrc) {
            const lightbox = document.getElementById('lightbox');
            const lightboxImage = document.getElementById('lightbox-image');
            lightbox.classList.remove('hidden');
            lightboxImage.src = imageSrc;
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.add('hidden');
        }

        // Add click event to all gallery images
        document.querySelectorAll('.masonry-item img').forEach(img => {
            img.addEventListener('click', () => openLightbox(img.src));
        });

        // Close lightbox when clicking outside the image
        document.getElementById('lightbox').addEventListener('click', (e) => {
            if (e.target.id === 'lightbox') {
                closeLightbox();
            }
        });

        // Close lightbox with ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });
    </script>
</body>

</html>
