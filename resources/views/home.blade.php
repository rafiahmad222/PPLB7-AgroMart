<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home - AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="images/icon-40x40.png">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&family=Signika:wght@300..700&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
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

        @keyframes slideIn {
            from {
                transform: translateX(-20px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .animate-fadeOut {
            animation: fadeOut 0.3s ease-out forwards;
        }

        .animate-slideIn {
            animation: slideIn 0.6s ease-out forwards;
        }

        .hero-gradient {
            background: linear-gradient(to right, rgba(16, 185, 129, 0.8), rgba(5, 150, 105, 0.8));
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body class="text-gray-800 bg-gray-100">
    <!-- Header with Glassmorphism -->
    <header class="sticky top-0 z-50 shadow-lg backdrop-blur-md bg-white/70">
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
                            class="absolute hidden w-40 border rounded-md shadow-lg backdrop-blur-md bg-white/80 z-5 group-hover:block animate-fadeIn text-emerald-600 border-white/20">
                            @foreach ($kategoris as $kategori)
                                <a href="{{ route('produk.index', $kategori->id_kategori) }}"
                                    class="block px-4 py-2 text-sm rounded-md text-emerald-700 hover:bg-emerald-50/50 hover:text-emerald-400">{{ $kategori->nama_kategori }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('edukasi.index') }}" class="hover:text-emerald-400">EDUKASI</a>
                    <a href="{{ route('galeri.index') }}" class="hover:text-emerald-400">GALERI</a>
                    <a href="{{ route('layanan.index') }}" class="hover:text-emerald-400">LAYANAN</a>
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('status.index') }}" class="hover:text-emerald-400">TRANSAKSI</a>
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
                        class="absolute right-0 z-30 flex-col hidden w-48 mt-4 border rounded-md shadow-2xl backdrop-blur-md bg-white/80 border-white/20 font-[signika]">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm rounded-md hover:bg-emerald-50/50">Akun</a>
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('profile.adminshowuser') }}"
                                class="block px-4 py-2 text-sm rounded-md hover:bg-emerald-50/50">Akun Customer</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full px-4 py-2 text-sm text-left rounded-md hover:bg-emerald-50/50">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- Modern Hero Section -->
    <section class="mx-2 my-2 relative h-[600px] bg-cover bg-center rounded-xl"
        style="background-image: url('{{ asset('images/Landing Page.png') }}');">
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40 rounded-xl"></div>
        <div class="relative flex flex-col items-start justify-center h-full px-6 mx-auto max-w-7xl lg:px-8">
            <div class="max-w-lg animate-fadeIn">
                <h1 class="text-4xl font-bold leading-tight text-white md:text-5xl lg:text-6xl">CV. Hidroponik
                    Jember</h1>
                <p class="mt-4 text-lg text-gray-200">We all need a little space to grow. Give yourself the space
                    you need to grow your inner you.</p>
                <div class="flex flex-wrap gap-4 mt-8">
                    <a href="#kontak"
                        class="px-8 py-3 text-base font-medium text-white transition-all rounded-full shadow-lg bg-primary-600 hover:bg-primary-700 hover:shadow-xl">Hubungi
                        Kami</a>
                    <a href="#produk"
                        class="px-8 py-3 text-base font-medium text-white transition-all rounded-full bg-white/20 backdrop-blur-sm hover:bg-white/30">Lihat
                        Produk</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Elegant Features Section -->
    <section class="py-10">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="mb-12 text-center">
                <h2 class="mb-2 text-3xl font-bold text-gray-800">Kenapa Memilih Kami?</h2>
                <p class="max-w-lg mx-auto text-gray-600">Kami menyediakan produk hidroponik berkualitas tinggi
                    dengan pelayanan terbaik untuk kepuasan pelanggan.</p>
            </div>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                <!-- Feature Card -->
                <div class="p-6 bg-white shadow-md rounded-xl hover:shadow-xl card-hover">
                    <div
                        class="flex items-center justify-center w-16 h-16 mx-auto mb-6 rounded-full bg-primary-100 text-primary-600">
                        <i class="text-2xl fas fa-leaf"></i>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-center text-gray-800">Produk</h3>
                    <p class="text-sm text-center text-gray-600">Temukan berbagai produk hidroponik berkualitas
                        dari sayuran hingga peralatan.</p>
                    <div class="mt-6 text-center">
                        <a href="#produk" class="inline-block text-primary-600 hover:text-primary-700">Lihat
                            Produk <i class="ml-1 fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="p-6 bg-white shadow-md rounded-xl hover:shadow-xl card-hover">
                    <div
                        class="flex items-center justify-center w-16 h-16 mx-auto mb-6 rounded-full bg-primary-100 text-primary-600">
                        <i class="text-2xl fas fa-book-open"></i>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-center text-gray-800">Edukasi</h3>
                    <p class="text-sm text-center text-gray-600">Pelajari berbagai hal tentang hidroponik melalui
                        materi edukasi kami.</p>
                    <div class="mt-6 text-center">
                        <a href="#edukasi" class="inline-block text-primary-600 hover:text-primary-700">Pelajari
                            <i class="ml-1 fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="p-6 bg-white shadow-md rounded-xl hover:shadow-xl card-hover">
                    <div
                        class="flex items-center justify-center w-16 h-16 mx-auto mb-6 rounded-full bg-primary-100 text-primary-600">
                        <i class="text-2xl fas fa-images"></i>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-center text-gray-800">Galeri</h3>
                    <p class="text-sm text-center text-gray-600">Lihat koleksi foto dan video produk hidroponik
                        kami yang menarik.</p>
                    <div class="mt-6 text-center">
                        <a href="#galeri" class="inline-block text-primary-600 hover:text-primary-700">Lihat
                            Galeri <i class="ml-1 fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="p-6 bg-white shadow-md rounded-xl hover:shadow-xl card-hover">
                    <div
                        class="flex items-center justify-center w-16 h-16 mx-auto mb-6 rounded-full bg-primary-100 text-primary-600">
                        <i class="text-2xl fas fa-handshake"></i>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-center text-gray-800">Layanan</h3>
                    <p class="text-sm text-center text-gray-600">Dapatkan layanan konsultasi dan pengelolaan
                        hidroponik terbaik.</p>
                    <div class="mt-6 text-center">
                        <a href="#layanan" class="inline-block text-primary-600 hover:text-primary-700">Lihat
                            Layanan <i class="ml-1 fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modern Produk Carousel with Hover-visible Navigation -->
    <section class="py-5">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="text-center mb-7">
                <h2 class="mb-2 text-3xl font-bold text-gray-800">Produk Terbaru</h2>
                <p class="max-w-lg mx-auto text-gray-600">Temukan produk hidroponik terbaru dan terbaik dari kami.</p>
            </div>

            <div id="carouselContainer" class="relative group">
                <div class="absolute inset-0 z-10 pointer-events-none"
                    style="width: 100%;"></div>

                <div id="produkCarousel" class="flex transition-transform duration-500 ease-in-out">
                    @foreach ($produks as $produk)
                        <div class="flex-none w-full p-4 sm:w-1/2 md:w-1/3">
                            <div
                                class="p-6 transition bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl card-hover">
                                @if ($produk->gambar_produk)
                                    <div class="mb-4 overflow-hidden rounded-lg">
                                        <img src="{{ asset('storage/' . $produk->gambar_produk) }}"
                                            alt="{{ $produk->nama_produk }}"
                                            class="object-cover w-full h-48 transition-transform hover:scale-105">
                                    </div>
                                @endif
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800">{{ $produk->nama_produk }}</h3>
                                        <p class="mt-1 text-sm text-gray-500">Stok: {{ $produk->jumlah_stok }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between mt-1">
                                    <p class="text-lg font-bold text-primary-600">Rp
                                        {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
                                    <a href="{{ route('produk.show', $produk->id_produk) }}"
                                        class="px-3 py-2 text-sm font-medium text-center text-white rounded-full bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Buttons with Opacity Transition -->
                <div
                    class="absolute inset-y-0 left-0 z-20 flex items-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                    <button id="prevCarousel"
                        class="flex items-center justify-center w-10 h-10 ml-2 text-white transition-transform -translate-y-1/2 rounded-full bg-primary-600/80 hover:bg-primary-700 hover:shadow-lg hover:scale-110">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                </div>
                <div
                    class="absolute inset-y-0 right-0 z-20 flex items-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                    <button id="nextCarousel"
                        class="flex items-center justify-center w-10 h-10 mr-2 text-white transition-transform -translate-y-1/2 rounded-full bg-primary-600/80 hover:bg-primary-700 hover:shadow-lg hover:scale-110">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <!-- Dots Navigation -->
                <div class="flex justify-center mt-2 space-x-2" id="carouselDots">
                    <!-- Dots will be added dynamically by JS -->
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-gray-100">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="mb-12 text-center">
                <h2 class="mb-2 text-3xl font-bold text-gray-800">Apa Kata Mereka?</h2>
                <p class="max-w-lg mx-auto text-gray-600">Pendapat pelanggan tentang produk dan layanan kami.</p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="p-6 bg-white shadow-md rounded-xl">
                    <div class="flex items-center mb-4">
                        <div
                            class="flex items-center justify-center w-12 h-12 mr-4 text-gray-500 bg-gray-200 rounded-full">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Budi Santoso</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="italic text-gray-600">"Produk hidroponik dari AgroMart sangat berkualitas. Sayuran
                        tumbuh dengan cepat dan hasil panen sangat memuaskan!"</p>
                </div>

                <div class="p-6 bg-white shadow-md rounded-xl">
                    <div class="flex items-center mb-4">
                        <div
                            class="flex items-center justify-center w-12 h-12 mr-4 text-gray-500 bg-gray-200 rounded-full">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Siti Rahayu</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p class="italic text-gray-600">"Layanan konsultasi dari tim AgroMart sangat membantu. Mereka
                        memberikan solusi yang tepat untuk masalah hidroponik saya."</p>
                </div>

                <div class="p-6 bg-white shadow-md rounded-xl">
                    <div class="flex items-center mb-4">
                        <div
                            class="flex items-center justify-center w-12 h-12 mr-4 text-gray-500 bg-gray-200 rounded-full">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Ahmad Fauzi</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="italic text-gray-600">"Saya sangat puas dengan media tanam dari AgroMart. Sangat
                        cocok untuk pemula dan mudah digunakan. Panen selalu memuaskan!"</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <x-footer></x-footer>

    <script>
        // Carousel Logic
        const carousel = document.getElementById('produkCarousel');
        const prevButton = document.getElementById('prevCarousel');
        const nextButton = document.getElementById('nextCarousel');
        const dotsContainer = document.getElementById('carouselDots');

        let currentIndex = 0;
        const itemsPerPage = 3;
        const totalItems = @json($produks).length;
        const maxIndex = Math.ceil(totalItems / itemsPerPage) - 1;

        // Create dots
        for (let i = 0; i <= maxIndex; i++) {
            const dot = document.createElement('button');
            dot.className = 'w-3 h-3 rounded-full bg-gray-300 hover:bg-primary-500 transition-colors';
            dot.setAttribute('data-index', i);
            dot.addEventListener('click', () => {
                currentIndex = i;
                updateCarousel();
                updateDots();
            });
            dotsContainer.appendChild(dot);
        }

        function updateCarousel() {
            const offset = currentIndex * -100;
            carousel.style.transform = `translateX(${offset}%)`;
        }

        function updateDots() {
            const dots = dotsContainer.querySelectorAll('button');
            dots.forEach((dot, index) => {
                if (index === currentIndex) {
                    dot.classList.remove('bg-gray-300');
                    dot.classList.add('bg-primary-600');
                } else {
                    dot.classList.remove('bg-primary-600');
                    dot.classList.add('bg-gray-300');
                }
            });
        }

        prevButton.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
                updateDots();
            }
        });

        nextButton.addEventListener('click', () => {
            if (currentIndex < maxIndex) {
                currentIndex++;
                updateCarousel();
                updateDots();
            }
        });

        // Initialize
        updateCarousel();
        updateDots();
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
    </script>
</body>

</html>
