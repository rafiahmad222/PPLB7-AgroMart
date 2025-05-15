<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pesananku - AgroMart</title>
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

    <main class="px-4 py-8 mx-auto ">
        <h2 class="mb-6 text-2xl font-bold text-gray-800">Daftar Pesananku</h2>

        @if (session('success'))
            <div class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="p-4 mb-4 text-red-800 bg-red-100 rounded-lg">{{ session('error') }}</div>
        @endif

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach ($pesanans as $pesanan)
                <div class="flex flex-row items-center justify-center h-full p-4 bg-white rounded-lg shadow-md">
                    <div class="flex items-start">
                        <img src="{{ asset('storage/' . $pesanan->produk->gambar_produk ?? 'images/default-product.png') }}"
                            alt="{{ $pesanan->produk->nama_produk }}" class="object-cover w-20 h-20 mr-3 rounded-md">
                        @if ($pesanan->status === 'Diterima')
                            <form action="{{ route('pesananku.konfirmasi', $pesanan->id_pesanan) }}" method="POST"
                                class="mt-4">
                                @csrf
                                <button type="submit"
                                    class="w-full px-4 py-2 text-sm text-white bg-green-600 rounded hover:bg-green-700">
                                    Selesaikan Pesanan
                                </button>
                            </form>
                        @else
                            <div class="flex-1 space-y-1">
                                <p class="text-base font-semibold text-gray-800 truncate">
                                    {{ $pesanan->produk->nama_produk }}</p>
                                <p class="text-sm text-gray-600">Jumlah Pembelian: {{ $pesanan->jumlah }}</p>
                                <p class="text-sm text-gray-600">Pembayaran: Rp
                                    {{ number_format($pesanan->total, 0, ',', '.') }}</p>
                                <p class="text-sm text-gray-600">Status Pesanan: <span
                                        class="font-semibold">{{ $pesanan->status }}</span></p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </main>

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
    </script>
</body>

</html>
