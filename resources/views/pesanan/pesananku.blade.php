<!DOCTYPE html>
<html>

<head>
    <title>Pesananku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans bg-gray-100">
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <nav class="flex items-center justify-between px-4 py-3 mx-auto max-w-7xl">
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Logo AgroMart" class="h-12">
                </a>
                <div class="hidden space-x-4 md:flex">
                    <a href="{{ route('home') }}" class="font-medium text-green-600 hover:text-green-700">HOME</a>
                    <div class="relative group">
                        <a href="{{ route('produk.index') }}"
                            class="font-medium text-green-600 hover:text-green-700">PRODUK</a>
                        <div class="absolute hidden mt-2 bg-white rounded-lg shadow-lg group-hover:block">
                            @foreach ($kategoris as $kategori)
                                <a href="{{ route('produk.index', $kategori->id_kategori) }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ $kategori->nama_kategori }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="#edukasi" class="font-medium text-green-600 hover:text-green-700">EDUKASI</a>
                    <a href="#galeri" class="font-medium text-green-600 hover:text-green-700">GALERI</a>
                    <a href="#layanan" class="font-medium text-green-600 hover:text-green-700">LAYANAN</a>
                    <a href="#contact" class="font-medium text-green-600 hover:text-green-700">CONTACT US</a>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <a href="#" class="relative">
                    <img src="{{ asset('images/keranjangIcon.png') }}" alt="Keranjang"
                        class="w-10 h-10 transition-transform hover:scale-110">
                </a>
                <a href="#" class="relative">
                    <img src="{{ asset('images/notifIcon.png') }}" alt="Notifikasi"
                        class="w-10 h-10 transition-transform hover:scale-110">
                </a>
                <div class="relative">
                    <button id="menuButton" class="flex items-center space-x-2">
                        <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="w-12 h-12 rounded-full">
                        <div class="hidden md:block">
                            <p class="font-semibold">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                    </button>
                    <div id="dropdownUser" class="absolute right-0 hidden w-48 mt-2 bg-white rounded-lg shadow-lg">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('dashboard') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
                        @else
                            <a href="{{ route('pesananku') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Pesananku</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full px-4 py-2 text-left text-gray-700 hover:bg-gray-100">Logout</button>
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

        menuButton.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownUser.classList.toggle('hidden');
        });

        document.addEventListener('click', function() {
            dropdownUser.classList.add('hidden');
        });

        dropdownUser.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    </script>
</body>

</html>
