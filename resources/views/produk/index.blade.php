<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Produk - AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="images/icon-40x40.png">
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&family=Signika:wght@300..700&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .sidebar-transition {
            transition: transform 0.3s ease-out, box-shadow 0.3s ease-out;
        }

        .sidebar-hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Hover effect untuk kategori links */
        .kategori-link {
            transition: all 0.2s ease-out;
        }

        .kategori-link:hover {
            transform: translateX(8px);
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

<body class="font-sans bg-gray-100">
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <nav class="flex items-center justify-between max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Logo AgroMart" class="h-12">
                </a>
                <div class="items-center hidden gap-4 text-base font-semibold md:flex text-emerald-700 font-[signika]">
                    <a href="{{ route('home') }}" class=x`">HOME</a>
                    <div class="relative group">
                        <a href="{{ route('produk.index') }}" class="flex items-center gap-1">PRODUK</a>
                        <div
                            class="absolute hidden w-40 bg-white rounded-md shadow-lg z-5 group-hover:block animate-fadeIn text-emerald-600">
                            @foreach ($kategoris as $kategori)
                                <a href="{{ route('produk.index', $kategori->id_kategori) }}"
                                    class="block px-4 py-2 text-sm rounded-md text-emerald-700 hover:bg-gray-100 hover:text-emerald-400">{{ $kategori->nama_kategori }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{#edukasi}" class="hover:text-emerald-400">EDUKASI</a>
                    <a href="#galeri" class="hover:text-emerald-400">GALERI</a>
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

    <main class="px-4 py-8 mx-auto max-w-7xl">
        <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">
            <form action="{{ route('produk.index') }}" method="GET" class="flex w-full gap-2 md:w-auto">
                <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}"
                    class="w-full px-4 py-2 border rounded-lg border-emerald-400 focus:outline-none focus:border-emerald-600 md:w-64">
                <button type="submit"
                    class="px-4 py-2 text-white rounded-lg bg-emerald-600 hover:bg-emerald-700">Cari</button>
            </form>
            @if (Auth::user()->hasRole('admin'))
                <a href="{{ route('produk.create') }}"
                    class="px-4 py-2 text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700">+ Tambah
                    Produk</a>
            @endif
        </div>

        <div class="flex flex-col gap-6 md:flex-row">
            <!-- Sidebar Kategori -->
            <aside
                class="sticky top-24 w-full p-4 mb-4 bg-white rounded-lg shadow md:w-64 md:mb-0 h-fit max-h-[calc(100vh-8rem)] overflow-y-auto sidebar-transition">
                <h3 class="mb-3 text-lg font-bold text-emerald-700">Kategori</h3>
                <ul>
                    <li>
                        <a href="#"
                            class="block px-2 py-2 transition-all duration-200 rounded text-emerald-600 kategori-link hover:bg-emerald-50"
                            data-id="">Semua Kategori</a>
                    </li>
                    @foreach ($kategoris as $kategori)
                        <li>
                            <a href="#"
                                class="block px-2 py-2 transition-all duration-200 rounded text-emerald-600 kategori-link hover:bg-emerald-50"
                                data-id="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</a>
                        </li>
                    @endforeach
                </ul>
            </aside>

            <!-- Produk Grid -->
            <section class="flex-1">
                <div id="product-grid"
                    class="grid grid-cols-1 gap-6 transition-opacity duration-500 opacity-100 sm:grid-cols-2 lg:grid-cols-3">
                    @include('produk._list', ['produks' => $produks])
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <x-footer></x-footer>

    <script>
        // Dropdown user
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

        // Filter produk berdasarkan kategori (AJAX)
        document.querySelectorAll('.kategori-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const kategoriId = this.getAttribute('data-id');
                const url = kategoriId ? `{{ url('/produk/filter') }}?kategori=${kategoriId}` :
                    `{{ url('/produk/filter') }}`;
                const productGrid = document.getElementById('product-grid');

                // Fade out
                productGrid.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                setTimeout(() => {
                    productGrid.innerHTML =
                        '<div class="py-10 text-center col-span-full text-emerald-600 animate-pulse">Loading...</div>';

                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            productGrid.innerHTML = html;
                            // Fade in
                            productGrid.classList.remove('opacity-0');
                            productGrid.classList.add('opacity-100');
                        })
                        .catch(error => {
                            productGrid.innerHTML =
                                '<div class="py-10 text-center text-red-600 col-span-full">Gagal memuat produk.</div>';
                            productGrid.classList.remove('opacity-0');
                            productGrid.classList.add('opacity-100');
                        });
                }, 400); // waktu fade out
            });
        });
        const searchForm = document.querySelector('form[action="{{ route('produk.index') }}"]');
        if (searchForm) {
            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const productGrid = document.getElementById('product-grid');
                const formData = new FormData(searchForm);
                const params = new URLSearchParams(formData).toString();
                const url = `{{ route('produk.index') }}?${params}`;

                // Fade out
                productGrid.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                setTimeout(() => {
                    productGrid.innerHTML =
                        '<div class="py-10 text-center col-span-full text-emerald-600 animate-pulse">Loading...</div>';

                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            // Ambil hanya isi grid produk dari response (jika response full HTML)
                            // Jika response partial (hanya grid), langsung tampilkan
                            productGrid.innerHTML = html;
                            productGrid.classList.remove('opacity-0');
                            productGrid.classList.add('opacity-100');
                        })
                        .catch(error => {
                            productGrid.innerHTML =
                                '<div class="py-10 text-center text-red-600 col-span-full">Gagal memuat produk.</div>';
                            productGrid.classList.remove('opacity-0');
                            productGrid.classList.add('opacity-100');
                        });
                }, 400);
            });
        }
        // Animasi sidebar saat scroll
        const sidebar = document.querySelector('aside');
        let lastScrollTop = 0;

        window.addEventListener('scroll', () => {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // Tambahkan class hover effect saat scroll naik
            if (scrollTop < lastScrollTop) {
                sidebar.classList.add('sidebar-hover');
            } else {
                sidebar.classList.remove('sidebar-hover');
            }

            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        });

        // Tambahkan efek klik untuk kategori
        document.querySelectorAll('.kategori-link').forEach(link => {
            link.addEventListener('click', function(e) {
                // Remove active state dari semua link
                document.querySelectorAll('.kategori-link').forEach(l => {
                    l.classList.remove('bg-emerald-50', 'font-medium');
                });

                // Add active state ke link yang diklik
                this.classList.add('bg-emerald-50', 'font-medium');
            });
        });
    </script>
</body>

</html>
