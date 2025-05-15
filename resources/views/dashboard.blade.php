<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home - AgroMart</title>
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

<body>
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <nav class="flex items-center justify-between max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center space-x-6">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Logo AgroMart" class="h-12">
                </a>
                <div class="items-center hidden gap-4 text-base font-semibold md:flex text-emerald-700 font-[signika]">
                    <a href="{{ route('home') }}" class="hover:text-emerald-600">HOME</a>
                    <div class="relative group">
                        <a href="{{ route('produk.index') }}" class="flex items-center gap-1">PRODUK</a>
                        <div class="absolute hidden w-40 bg-white rounded-md shadow-lg z-5 group-hover:block animate-fadeIn text-emerald-600">
                            @foreach($kategoris as $kategori)
                            <a href="{{ route('produk.index', $kategori->id_kategori) }}" class="block px-4 py-2 text-sm rounded-md text-emerald-700 hover:bg-gray-100 hover:text-emerald-400">{{ $kategori->nama_kategori }}</a>
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
                <img src="{{ asset('images/keranjangIcon.png') }}" alt="Keranjang"
                    class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90">
                <img src="{{ asset('images/notifIcon.png') }}" alt="Notifikasi"
                    class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90">
                <div id="menuButton" class="relative">
                    <div class="flex items-center gap-2 cursor-pointer">
                        <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="w-12 h-12 rounded-full">
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

    <div class="max-w-4xl px-4 py-10 mx-auto">
        <div class="flex justify-center mb-6 text-lg font-semibold text-gray-700 gap-80">
            <button id="tabPesanan"
                class="px-4 py-2 text-white rounded-full bg-emerald-600 hover:bg-emerald-500">Manajemen Pesanan</button>
            <button id="tabGrafik" class="px-4 py-2 bg-gray-200 rounded-full hover:bg-emerald-500">Grafik
                Penjualan</button>
        </div>
        <div id="contentPesanan">
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
                <div class="p-6 mb-6 bg-[#F3F3E0] shadow-md rounded-2xl">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset($pesanan->user->avatar_url ?? 'images/avatar.png') }}" alt="Avatar"
                                class="object-cover w-16 h-16 rounded-full">
                            <div>
                                <p class="text-lg font-semibold text-gray-800">{{ $pesanan->user->name }}</p>
                                <div class="mb-2">
                                    <span class="font-semibold">Alamat:</span>
                                    {{ $pesanan->alamat->detail_alamat }},
                                    {{ $pesanan->alamat->kecamatan->nama_kecamatan }},
                                    {{ $pesanan->alamat->kabupatenKota->nama_kabupaten_kota }},
                                    {{ $pesanan->alamat->kodePos->kode_pos }}
                                </div>
                            </div>
                        </div>

                        <div class=>
                            <p class="mb-1 text-sm text-right text-gray-600">Status Pengiriman:</p>
                            <form action="{{ route('dashboard.pesanan.updateStatus', $pesanan->id_pesanan) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()"
                                    class="text-sm font-semibold py-2 rounded-full text-white px-5 text-left cursor-pointer
                                        {{ $pesanan->status === 'Diterima' ? 'bg-green-500' : ($pesanan->status === 'Dikirim' ? 'bg-yellow-400' : 'bg-blue-400') }}">
                                    <option value="Diproses" @selected($pesanan->status === 'Diproses')>Diproses</option>
                                    <option value="Dikirim" @selected($pesanan->status === 'Dikirim')>Dikirim</option>
                                    <option value="Diterima" @selected($pesanan->status === 'Diterima')>Diterima</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 mt-2">
                        <img src="{{ asset('storage/' . $pesanan->produk->gambar_produk ?? 'images/default-product.png') }}"
                            alt="{{ $pesanan->produk->nama_produk }}" class="object-cover w-20 h-20 rounded-lg">
                        <div class="space-y-1">
                            <p><span class="font-medium">Nama Barang</span>: {{ $pesanan->produk->nama_produk }}</p>
                            <p><span class="font-medium">Jumlah</span>: {{ $pesanan->jumlah }} pcs</p>
                            <p><span class="font-medium">Total</span>: Rp
                                {{ number_format($pesanan->total, 0, ',', '.') }}</p>
                            <p><span class="font-medium">Metode Pembayaran</span>:
                                @if ($pesanan->pembayaran === 'transfer')
                                    Transfer
                                @elseif ($pesanan->pembayaran === 'cod')
                                    Cash on Delivery (COD)
                                @else
                                    {{ $pesanan->pembayaran ?? '-' }}
                                @endif
                            </p>
                        </div>
                        <div class="space-y-1">
                            <p><span class="font-medium">Metode Pengiriman</span>:
                                @if ($pesanan->pengiriman === 'wa_jek')
                                    WA Jek
                                @elseif ($pesanan->pengiriman === 'ambil_ditempat')
                                    Ambil di Tempat
                                @else
                                    {{ $pesanan->pengiriman ?? '-' }}
                                @endif
                            </p>
                            <p><span class="font-medium">Tanggal Pesan</span>: {{ $pesanan->created_at->format('d M Y') }}
                            </p>
                            <p><span class="font-medium">ID Pesanan</span>: {{ $pesanan->id_pesanan }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div id="contentGrafik" class="hidden">
        <div class="p-2 bg-white shadow-md rounded-2xl"> <!-- Kurangi padding -->
            <div class="flex flex-wrap items-center justify-between gap-2 px-4"> <!-- Kurangi margin -->
                <div class="flex gap-2">
                    <select id="filterBulan" class="px-2 py-1 text-sm border rounded-md"> <!-- Kurangi padding -->
                        <option value="">Semua Bulan</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                    <select id="filterTahun" class="px-2 py-1 text-sm border rounded-md"> <!-- Kurangi padding -->
                        <option value="">Semua Tahun</option>
                        @foreach ($listTahun as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <canvas id="chartPenjualan" class="w-full max-h-64"></canvas> <!-- Atur tinggi maksimal -->
        </div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        // Tab Switching
        const tabPesanan = document.getElementById('tabPesanan');
        const tabGrafik = document.getElementById('tabGrafik');
        const contentPesanan = document.getElementById('contentPesanan');
        const contentGrafik = document.getElementById('contentGrafik');

        tabPesanan.addEventListener('click', () => {
            tabPesanan.classList.add('bg-green-700', 'text-white');
            tabGrafik.classList.remove('bg-green-700', 'text-white');
            tabGrafik.classList.add('bg-gray-200');

            contentPesanan.classList.remove('hidden');
            contentGrafik.classList.add('hidden');
        });

        tabGrafik.addEventListener('click', () => {
            tabGrafik.classList.add('bg-green-700', 'text-white');
            tabPesanan.classList.remove('bg-green-700', 'text-white');
            tabPesanan.classList.add('bg-gray-200');

            contentGrafik.classList.remove('hidden');
            contentPesanan.classList.add('hidden');
        });
        // Chart.js
        const ctx = document.getElementById('chartPenjualan').getContext('2d');
        let chartInstance;

        function fetchChartData(bulan = '', tahun = '') {
            fetch(`/api/chart-data?bulan=${bulan}&tahun=${tahun}`)
                .then(res => res.json())
                .then(data => {
                    if (chartInstance) chartInstance.destroy();

                    chartInstance = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Jumlah Terjual',
                                data: data.values,
                                backgroundColor: 'rgba(16, 185, 129, 0.7)',
                                borderRadius: 6,
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        }

        // Inisialisasi awal
        fetchChartData();

        document.getElementById('filterBulan').addEventListener('change', function() {
            const bulan = this.value;
            const tahun = document.getElementById('filterTahun').value;
            fetchChartData(bulan, tahun);
        });

        document.getElementById('filterTahun').addEventListener('change', function() {
            const tahun = this.value;
            const bulan = document.getElementById('filterBulan').value;
            fetchChartData(bulan, tahun);
        });
    </script>
</body>

</html>
