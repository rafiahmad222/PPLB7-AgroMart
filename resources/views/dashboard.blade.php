<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home - AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="images/icon-40x40.png">
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
    </style>
</head>

<body>
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <nav class="flex items-center justify-between max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center space-x-6">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Logo AgroMart" class="h-12">
                </a>
                <div class="items-center hidden gap-4 text-base font-semibold md:flex text-emerald-700 font-[signika]">
                    <a href="{{ route('dashboard') }}" class="hover:text-emerald-600">DASHBOARD</a>
                    <div class="relative group">
                        <a href="{{ route('produk.index') }}" class="flex items-center gap-1">PRODUK</a>
                        <div class="absolute hidden w-40 bg-white rounded-md shadow-lg z-5 group-hover:block animate-fadeIn">
                            @foreach($kategoris as $kategori)
                            <a href="{{ route('produk.index', $kategori->id_kategori) }}" class="block px-4 py-2 text-xs text-gray-800 rounded-md hover:bg-gray-100">{{ $kategori->nama_kategori }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="#edukasi" class="hover:text-emerald-600">EDUKASI</a>
                    <a href="#galeri" class="hover:text-emerald-600">GALERI</a>
                    <a href="#layanan" class="hover:text-emerald-600">LAYANAN</a>
                    <a href="#contact" class="hover:text-emerald-600">CONTACT US</a>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/keranjangIcon.png') }}" alt="Keranjang" class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90">
                <img src="{{ asset('images/notifIcon.png') }}" alt="Notifikasi" class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90">
                <div id="menuButton" class="relative">
                    <div class="flex items-center gap-2 cursor-pointer">
                        <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="w-12 h-12 rounded-full">
                        <div class="hidden text-left md:block">
                            <span class="block font-bold">{{ Auth::user()->name }}</span>
                            <small class="text-gray-500">{{ Auth::user()->email }}</small>
                        </div>
                    </div>
                    <div id="dropdownUser" class="absolute right-0 z-30 flex-col hidden w-48 mt-4 bg-white rounded-md shadow-2xl">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Profile</a>
                        <a href="{{ route('pesananku') }}" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Pesananku</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 text-sm text-left rounded-md hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="max-w-4xl px-4 py-10 mx-auto">
        <h1 class="mb-6 text-2xl font-bold">Manajemen Pesanan</h1>

        <div class="flex justify-center gap-4 mb-6">
            @php
                $statuses = ['Diproses', 'Dikirim', 'Diterima'];
                $currentStatus = request('status');
            @endphp

            <a href="{{ route('dashboard') }}"
                class="px-4 py-2 rounded-full text-sm font-semibold
                    {{ !$currentStatus ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-emerald-100' }}">
                Semua
            </a>

            @foreach ($statuses as $status)
                <a href="{{ route('dashboard', ['status' => $status]) }}"
                    class="px-4 py-2 rounded-full text-sm font-semibold
                        {{ $currentStatus === $status ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-emerald-100' }}">
                    {{ $status }}
                </a>
            @endforeach
        </div>

        @foreach ($pesanans as $pesanan)
        <div class="p-6 mb-6 bg-white shadow-md rounded-2xl">
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-4">
                    <img src="{{ asset($pesanan->user->avatar_url ?? 'images/avatar.png') }}" alt="Avatar"
                        class="object-cover w-16 h-16 rounded-full">
                    <div>
                        <p class="text-lg font-semibold text-gray-800">{{ $pesanan->nama }}</p>
                        <p class="text-sm text-gray-600">{{ $pesanan->alamat }}</p>
                        <p class="text-sm text-gray-600">{{ $pesanan->no_hp }}</p>
                    </div>
                </div>

                <div class=>
                    <p class="mb-1 text-sm text-right text-gray-600">Status Pengiriman:</p>
                    <form action="{{ route('dashboard.pesanan.updateStatus', $pesanan->id_pesanan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status"
                                onchange="this.form.submit()"
                                class="text-sm font-semibold py-2 rounded-full text-white px-5 text-left cursor-pointer
                                    {{ $pesanan->status === 'Diterima' ? 'bg-green-500' : ($pesanan->status === 'Dikirim' ? 'bg-yellow-400' : 'bg-blue-400') }}">
                            <option value="Diproses" @selected($pesanan->status === 'Diproses')>Diproses</option>
                            <option value="Dikirim" @selected($pesanan->status === 'Dikirim')>Dikirim</option>
                            <option value="Diterima" @selected($pesanan->status === 'Diterima')>Diterima</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="mt-4 space-y-1 text-sm text-gray-700">
                <div>
                    <img src="{{ asset('storage/' . $pesanan->produk->gambar_produk ?? 'images/default-product.png') }}" alt="{{ $pesanan->produk->nama_produk }}"
                        class="object-cover w-20 h-20 rounded-lg">
                </div>
                <p><span class="font-medium">Nama Barang</span> : {{ $pesanan->produk->nama_produk }}</p>
                <p><span class="font-medium">Jumlah</span> : {{ $pesanan->jumlah }} pcs</p>
                <p><span class="font-medium">Total</span> : Rp {{ number_format($pesanan->total, 0, ',', '.') }}</p>
                <p><span class="font-medium">Metode Pembayaran</span> :
                    @if ($pesanan->pembayaran === 'transfer')
                        Transfer
                    @elseif ($pesanan->pembayaran === 'cod')
                        Cash on Delivery (COD)
                    @else
                        {{ $pesanan->pembayaran ?? '-' }}
                    @endif
                </p>

                <p><span class="font-medium">Metode Pengiriman</span> :
                    @if ($pesanan->pengiriman === 'wa_jek')
                        WA Jek
                    @elseif ($pesanan->pengiriman === 'ambil_ditempat')
                        Ambil di Tempat
                    @else
                        {{ $pesanan->pengiriman ?? '-' }}
                    @endif
                </p>
            </div>
        </div>
        @endforeach
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
    </script>
</body>

</html>
