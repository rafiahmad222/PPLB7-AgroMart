<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Produk - AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="{{ asset('images/icon-40x40.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&family=Signika:wght@300..700&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-5px); }
        }

        .animate-fadeIn {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .animate-fadeOut {
            animation: fadeOut 0.3s ease-out forwards;
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield; /* Firefox */
            appearance: none; /* Modern browsers */
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
                        <div class="absolute hidden w-40 bg-white rounded-md shadow-lg z-5 group-hover:block animate-fadeIn text-emerald-600">
                            @foreach($kategoris as $kategori)
                            <a href="{{ route('produk.index', $kategori->id_kategori) }}" class="block px-4 py-2 text-sm rounded-md text-emerald-700 hover:bg-gray-100 hover:text-emerald-400">{{ $kategori->nama_kategori }}</a>
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
                <img src="{{ asset('images/keranjangIcon.png') }}" alt="Keranjang" class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90">
                <img src="{{ asset('images/notifIcon.png') }}" alt="Notifikasi" class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90">
                <div id="menuButton" class="relative">
                    <div class="flex items-center gap-2 cursor-pointer">
                        <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" class="w-12 h-12 rounded-full">
                        <div class="hidden text-left md:block">
                            <span class="block font-bold">{{ Auth::user()->name }}</span>
                            <small class="text-gray-500">{{ Auth::user()->email }}</small>
                        </div>
                    </div>
                    <div id="dropdownUser" class="absolute right-0 z-30 flex-col hidden w-48 mt-4 bg-white rounded-md shadow-2xl">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Akun</a>
                        @if (Auth::user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100" >Transaksi</a>
                        <a href="{{ route('profile.adminshowuser') }}" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Akun Customer</a>
                        @else
                            <a href="{{ route('pesananku') }}" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Transaksi</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 text-sm text-left rounded-md hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container px-4 py-2 mx-auto">
        <a href="{{ route('produk.index') }}" class="inline-block mb-2 font-bold text-emerald-600">← Kembali ke Daftar Produk</a>
        <div class="flex flex-wrap gap-8">
            <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}"
                class="w-full max-w-md rounded-lg shadow-md">
            <div class="flex-1">
                <h1 class="mb-4 text-2xl font-bold text-gray-800">{{ $produk->nama_produk }}</h1>
                <p class="mb-2 text-lg font-semibold text-gray-600">Stok: <span class="text-gray-800">{{ $produk->jumlah_stok }}</span></p>
                <p class="mb-4 text-xl font-bold text-emerald-600">Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
                <div class="flex items-center gap-4 mb-4">
                    <button id="decrement"
                        class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">-</button>
                    <input type="number" id="jumlah" name="jumlah" value="1" min="1"
                        max="{{ $produk->jumlah_stok }}"
                        class="w-16 px-4 py-2 text-center border border-gray-300 rounded-md">
                    <button id="increment"
                        class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">+</button>
                </div>
                <p class="mb-4 text-sm text-gray-500">Max. pembelian {{ $produk->jumlah_stok - 2 }} pcs</p>
                <p class="mb-4 text-lg font-bold text-gray-800">Total: Rp <span id="totalHarga">{{ number_format($produk->harga_produk, 0, ',', '.') }}</span></p>
                <p class="mb-4 text-gray-600">{{ $produk->deskripsi_produk }}</p>
                <div class="flex flex-col gap-4">
                    <button class="w-full px-4 py-2 text-white rounded-md bg-emerald-600 hover:bg-emerald-500">+ Keranjang</button>
                    <form action="{{ route('checkout.index') }}" method="GET">
                        <input type="hidden" id="jumlahCheckout" name="jumlah" value="1">
                        <input type="hidden" name="produk_id" value="{{ $produk->id_produk }}">
                        <button type="submit"
                            class="w-full px-4 py-2 bg-white border rounded-md text-emerald-600 border-emerald-600 hover:bg-emerald-50">Beli Langsung</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const menuButton = document.getElementById('menuButton');
        const dropdownUser = document.getElementById('dropdownUser');

        let isDropdownVisible = false;

        menuButton.addEventListener('click', function (e) {
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

        document.addEventListener('click', function () {
            if (isDropdownVisible) {
                dropdownUser.classList.remove('animate-fadeIn');
                dropdownUser.classList.add('animate-fadeOut');
                setTimeout(() => {
                    dropdownUser.classList.add('hidden');
                    isDropdownVisible = false;
                }, 300);
            }
        });

        dropdownUser.addEventListener('click', function (e) {
            e.stopPropagation();
        });

        const decrementButton = document.getElementById('decrement');
        const incrementButton = document.getElementById('increment');
        const jumlahInput = document.getElementById('jumlah');
        const maxPembelian = {{ $produk->jumlah_stok - 2 }};
        const hargaProduk = {{ $produk->harga_produk }};
        const totalHargaElement = document.getElementById('totalHarga');
        const jumlahCheckoutInput = document.getElementById('jumlahCheckout');

        function updateTotalHarga() {
            const jumlah = parseInt(jumlahInput.value);
            const totalHarga = hargaProduk * jumlah;
            totalHargaElement.textContent = totalHarga.toLocaleString('id-ID');

            jumlahCheckoutInput.value = jumlah; // Update hidden input for checkout
        }

        decrementButton.addEventListener('click', () => {
            let currentValue = parseInt(jumlahInput.value);
            if (currentValue > 1) {
                jumlahInput.value = currentValue - 1;
                updateTotalHarga();
            }
        });

        incrementButton.addEventListener('click', () => {
            let currentValue = parseInt(jumlahInput.value);
            if (currentValue < maxPembelian) {
                jumlahInput.value = currentValue + 1;
                updateTotalHarga();
            }
        });

        jumlahInput.addEventListener('input', () => {
            let currentValue = parseInt(jumlahInput.value);
            if (currentValue < 1 || isNaN(currentValue)) {
                jumlahInput.value = 1;
            } else if (currentValue >= maxPembelian) {
                jumlahInput.value = maxPembelian;
            }
            updateTotalHarga();
        });
    </script>
</body>

</html>
