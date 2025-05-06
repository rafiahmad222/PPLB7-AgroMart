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

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .search-bar {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .search-bar input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            width: 250px;
        }

        .search-bar button,
        .search-bar a {
            background-color: #10b981;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
        }

        .search-bar button:hover,
        .search-bar a:hover {
            background-color: #059669;
        }

        .content {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            flex-wrap: wrap;
        }

        .sidebar {
            position: sticky;
            top: 100px;
            height: fit-content;
            min-width: 250px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .sidebar a {
            display: block;
            padding: 8px 0;
            color: #374151;
            text-decoration: none;
        }

        .sidebar a:hover {
            color: #10b981;
        }

        .product-grid {
            width: 70%;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-grid.fade-out {
            opacity: 0;
            transform: scale(0.98);
            transition: all 0.3s ease;
        }

        .product-grid.fade-in {
            opacity: 1;
            transform: scale(1);
            transition: all 0.3s ease;
        }

        .product-card {
            background-color: rgb(255, 251, 251);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            transition: 0.3s ease;
        }

        .product-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            margin-top: 1rem;
            object-fit: contain;
        }

        .product-card img:hover {
            transform: scale(1.10);
            transition: transform 0.8s;
        }

        .product-card .content {
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .info-kiri h3 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
            color: #111827;
        }

        .info-kiri .harga {
            margin-top: 4px;
            color: #10b981;
            font-weight: bold;
            font-size: 0.95rem;
        }

        .stok-kanan {
            text-align: right;
            margin: 0;
            font-size: 0.9rem;
            color: #6b7280;
            white-space: nowrap;
        }

        .footer {
            background-color: #1f2937;
            color: white;
            padding: 40px 20px;
            margin-top: 60px;
        }

        .footer .section {
            margin-bottom: 20px;
        }

        .footer h4 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .footer a {
            color: #d1d5db;
            text-decoration: none;
        }

        .footer a:hover {
            color: #10b981;
        }

        @media (max-width: 768px) {
            .content {
                flex-direction: column;
            }

            .sidebar,
            .product-grid {
                width: 100%;
            }
        }
    </style>
</head>

<body>
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
                    <a href="#edukasi" class="hover:text-emerald-400">EDUKASI</a>
                    <a href="#galeri" class="hover:text-emerald-400">GALERI</a>
                    <a href="#layanan" class="hover:text-emerald-400">LAYANAN</a>
                    <a href="#contact" class="hover:text-emerald-400">CONTACT US</a>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/keranjangIcon.png') }}" alt="Keranjang"
                    class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90">
                <img src="{{ asset('images/notifIcon.png') }}" alt="Notifikasi"
                    class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90">
                <div id="menuButton" class="relative">
                    <div class="flex items-center gap-2 cursor-pointer">
                        <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" class="w-12 h-12 rounded-full">
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
                            <a href="{{ route('dashboard') }}"
                                class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Transaksi</a>
                            <a href="{{ route('profile.adminshowuser') }}"
                                class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Akun Customer</a>
                        @else
                            <a href="{{ route('pesananku') }}"
                                class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Transaksi</a>
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

    <div class="container">
        <div class="search-bar">
            <form action="{{ route('produk.index') }}" method="GET">
                <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}">
                <button type="submit">Cari</button>
            </form>
            @if (Auth::user()->hasRole('admin'))
                <a href="{{ route('produk.create') }}">+ Tambah Produk</a>
            @endif
        </div>

        <div class="content">
            <div class="sidebar">
                <h3>Kategori</h3>
                <ul>
                    @foreach ($kategoris as $kategori)
                        <li><a href="#" class="kategori-link"
                                data-id="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="product-grid" id="product-grid">
                @include('produk._list', ['produks' => $produks])
            </div>
        </div>

        <footer class="footer">
            <div class="container" style="display: flex; flex-wrap: wrap; justify-content: space-between;">
                <div class="section">
                    <h4>Hidroponik Jember</h4>
                    <p>Website sistem pemasaran produk hidroponik.</p>
                </div>
                <div class="section">
                    <h4>Explore</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Produk</a></li>
                        <li><a href="#">Edukasi</a></li>
                    </ul>
                </div>
                <div class="section">
                    <h4>Contact</h4>
                    <p>Email: hidroponik@gmail.com</p>
                    <p>Telepon: 0821-xxxx-xxxx</p>
                </div>
            </div>
        </footer>

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

            // Filter produk berdasarkan kategori
            document.querySelectorAll('.kategori-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const kategoriId = this.getAttribute('data-id');

                    const scrollY = window.scrollY;
                    // ➤ Fade out sebelum load
                    productGrid.classList.add('fade-out');

                    fetch(`/produk/filter?kategori=${kategoriId}`)
                        .then(response => response.text())
                        .then(html => {
                            setTimeout(() => {
                                productGrid.innerHTML = html;

                                // ➤ Fade in setelah diganti
                                productGrid.classList.remove('fade-out');
                                productGrid.classList.add('fade-in');

                                // ➤ Hapus class fade-in setelah selesai
                                setTimeout(() => {
                                    productGrid.classList.remove('fade-in');
                                }, 300);
                            }, 300); // waktu fade-out
                        })
                        .catch(error => {
                            console.error('Gagal load produk:', error);
                        });
                });
            });
        </script>
</body>

</html>
