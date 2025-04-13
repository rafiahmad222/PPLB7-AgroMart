<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Produk - AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="{{ asset('images/icon-40x40.png') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Signika:wght@300..700&display=swap"
        rel="stylesheet">
    <style>
        header {
            position: sticky;
            top: 0;
            z-index: 100;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        nav {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            justify-content: start;
        }

        .logo img {
            height: 48px;
            margin-right: 1.5rem;
        }

        .keranjang img,
        .notifikasi img {
            width: 40px;
            height: 40px;
            margin-left: 0.75rem;
            cursor: pointer;
        }

        .notifikasi img {
            margin-right: auto;
        }

        .keranjang img:hover,
        .notifikasi img:hover {
            transform: scale(1.1);
            transition: transform 0.3s;
        }

        .keranjang img:active,
        .notifikasi img:active {
            transform: scale(0.9);
            transition: transform 0.1s;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 21px;
            font-weight: 600;
            font-family: 'Signika', sans-serif;
            margin-right: auto;
        }

        .nav-menu a {
            color: #047857;
            text-decoration: none;
            position: relative;
            transition: color 0.3s;
        }

        .nav-menu a:hover {
            color: #059669;
        }

        .dropdown-container {
            position: relative;
        }

        .dropdown-container:hover .dropdown-menu {
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }

        .dropdown-label::after {
            content: '▼';
            font-size: 10px;
            margin-left: 6px;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 0.25rem;
            overflow: hidden;
            min-width: 160px;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px 16px;
            color: #333;
            font-size: 14px;
            text-decoration: none;
        }

        .dropdown-menu a:hover {
            background-color: #f3f4f6;
        }

        .avatar-section {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
            gap: 0.5rem;
            margin-left: 0.5rem;
        }

        .avatar-section img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
        }

        .user-info {
            display: none;
        }

        @media (min-width: 768px) {
            .user-info {
                display: block;
            }
        }

        .user-info span {
            font-weight: bold;
        }

        .user-info small {
            font-size: 12px;
            color: gray;
        }

        .dropdown-user {
            position: absolute;
            right: 0;
            top: 100%;
            display: none;
            background: white;
            border-radius: 0.375rem;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 200px;
            z-index: 20;
        }

        .dropdown-user a,
        .dropdown-user button {
            width: 100%;
            padding: 10px 16px;
            text-align: left;
            font-size: 14px;
            color: #333;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
        }

        .dropdown-user a:hover,
        .dropdown-user button:hover {
            background-color: #f3f4f6;
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

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9fafb;
        }

        .container {
            max-width: 1000px;
            margin: 1rem auto;
        }

        .back-link {
            text-decoration: none;
            color: #047857;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 20px;
        }

        .product-detail {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            flex-direction: row;
            /* Ensure text is beside the image */
            align-items: flex-start;
        }

        .product-detail img {
            order: 0;
            /* Keep the image on the left */
            width: 100%;
            max-width: 400px;
            height: auto;
            object-fit: contain;
            border-radius: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            position: static;
        }

        .product-info {
            flex: 1;
        }

        .product-info h1 {
            font-size: 2rem;
            margin: 0 0 10px;
            color: #111827;
        }

        .product-info .deskripsi {
            font-size: 1rem;
            color: #374151;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .product-detail {
                flex-direction: column;
                align-items: center;
            }
        }

        .jumlah_input {
            display: flex;
            align-items: center;
            justify-content: center;
            /* Tombol mentok ke kiri */
            gap: 8px;
            /* Jarak antar elemen */
            margin-top: 20px;
        }

        /* Styling tombol increment dan decrement */
        .jumlah_input button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.375rem;
            background-color: #e5e7eb;
            /* Warna abu-abu */
            color: #374151;
            /* Warna teks */
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .jumlah_input button:hover {
            background-color: #d1d5db;
            /* Warna hover */
        }

        .jumlah_input button:active {
            background-color: #9ca3af;
            /* Warna saat ditekan */
        }

        /* Styling input jumlah */
        .jumlah_input input[type="number"] {
            width: 60px;
            text-align: center;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.25rem;
            font-size: 1rem;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Menghilangkan spinner pada input number di Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }

        /* Styling tombol beli */
        .jumlah_input button[type="submit"] {
            flex: 1;
            /* Tombol beli memenuhi sisa ruang */
            padding: 0.5rem 1rem;
            background-color: #10b981;
            /* Warna hijau */
            color: white;
            font-size: 1rem;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .jumlah_input button[type="submit"]:hover {
            background-color: #059669;
            /* Warna hijau lebih gelap saat hover */
        }

        .jumlah_input button[type="submit"]:active {
            background-color: #047857;
            /* Warna hijau lebih gelap saat ditekan */
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .product-detail {
                flex-direction: row;
                /* Elemen disusun secara horizontal */
                align-items: flex-start;
            }

            .product-detail img {
                order: 0;
                /* Kembalikan urutan gambar ke posisi normal */
            }

            .jumlah_input {
                flex-direction: column;
                /* Elemen ditumpuk secara vertikal */
                align-items: stretch;
                /* Elemen memenuhi lebar container */
            }

            .jumlah_input button,
            .jumlah_input input[type="number"] {
                width: 100%;
                /* Elemen memenuhi lebar container */
            }
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Logo AgroMart" />
                </a>
            </div>

            <div class="nav-menu">
                <a href="{{ route('home') }}">HOME</a>
                <div class="dropdown-container">
                    <a class="dropdown-label" href="{{ route('produk.index') }}">PRODUK</a>
                    <div class="dropdown-menu">
                        @foreach ($kategoris as $kategori)
                            <a href="#" class="kategori-link"
                                data-id="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</a>
                        @endforeach
                    </div>
                </div>
                <a href="#edukasi">EDUKASI</a>
                <a href="#galeri">GALERI</a>
                <a href="#layanan">LAYANAN</a>
                <a href="#contact">CONTACT US</a>
            </div>

            <div class="keranjang">
                <img src="{{ asset('images/keranjangIcon.png') }}" alt="Keranjang" />
            </div>
            <div class="notifikasi">
                <img src="{{ asset('images/notifIcon.png') }}" alt="Notifikasi" />
            </div>
            <div class="avatar-section" id="menuButton">
                <img src="{{ asset('images/avatar.png') }}" alt="Avatar">
                <div class="user-info">
                    <span>{{ Auth::user()->name }}</span>
                    <br />
                    <small>{{ Auth::user()->email }}</small>
                </div>
                <div class="dropdown-user" id="dropdownUser">
                    <a href="{{ route('profile.edit') }}">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    </div>
    <div class="container">
        <a href="{{ route('produk.index') }}" class="back-link">← Kembali ke Daftar Produk</a>
        <div class="product-detail">
            <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}">

            <div class="product-info">
                <h1>{{ $produk->nama_produk }}</h1>
                <divstyle="border: none;">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 1rem;">
                        <button type="button" id="decrement"
                            style="padding: 0.5rem 1rem; border: none; background-color: #e5e7eb; border-radius: 8px;">-</button>
                        <input type="number" id="jumlah" name="jumlah" value="1" min="1"
                            max="{{ $produk->jumlah_stok }}"
                            style="width: 60px; text-align: center; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 8px;">
                        <button type="button" id="increment"
                            style="padding: 0.5rem 1rem; border: none; background-color: #e5e7eb; border-radius: 8px;">+</button>
                        <span>Stok: <strong>{{ $produk->jumlah_stok }}</strong></span>
                    </div>

                    <small id="max" style="display: block; color: gray; font-size: 13px;">Max. pembelian
                        {{ $produk->jumlah_stok - 2 }} pcs</small>

                    <p style="font-size: 20px; font-weight: bold; color: #111827;">
                        Rp <span id="totalHarga">{{ number_format($produk->harga_produk, 0, ',', '.') }}</span>
                    </p>

                    <div class="deskripsi">
                        {!! nl2br(e($produk->deskripsi_produk)) !!}
                    </div>

                    <div style="margin-top: 1rem;">
                        <button
                            style="width: 100%; padding: 0.75rem; background-color: #10b981; color: white; border: none; border-radius: 8px; font-weight: 600; margin-bottom: 0.5rem; box-sizing: border-box;">+
                            Keranjang</button>
                        <a href="{{ route('checkout.index', ['produk' => $produk->id_produk]) }}"
                            style="width: 100%; padding: 0.75rem; background-color: white; color: #10b981; border: 2px solid #10b981; border-radius: 8px; font-weight: 600; text-align: center; display: block; text-decoration: none; box-sizing: border-box;">Beli
                            Langsung</a>
                    </div>
            </div>
        </div>

        <script>
            const decrementButton = document.getElementById('decrement');
            const incrementButton = document.getElementById('increment');
            const jumlahInput = document.getElementById('jumlah');
            const maxPembelian = {{ $produk->jumlah_stok - 2 }};
            const hargaProduk = {{ $produk->harga_produk }};
            const totalHargaElement = document.getElementById('totalHarga');

            function updateTotalHarga() {
                const jumlah = parseInt(jumlahInput.value);
                const totalHarga = hargaProduk * jumlah;
                totalHargaElement.textContent = totalHarga.toLocaleString('id-ID');
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
