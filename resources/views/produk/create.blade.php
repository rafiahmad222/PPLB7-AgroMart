<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="icon" type="image/png" sizes="45x45" href="{{ asset('images/icon-40x40.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@400;600;700&family=Signika:wght@300..700&family=Volkhov:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; }

        header {
            position: sticky;
            top: 0;
            z-index: 100;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        nav {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            justify-content: start;
        }

        .logo img { height: 48px; margin-right: 1.5rem; }

        .keranjang img, .notifikasi img {
            width: 40px;
            height: 40px;
            margin-left: 0.75rem;
            cursor: pointer;
        }

        .notifikasi img { margin-right: auto; }
        .keranjang img:hover, .notifikasi img:hover {
            transform: scale(1.1);
            transition: transform 0.3s;
        }
        .keranjang img:active, .notifikasi img:active {
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

        .nav-menu a:hover { color: #059669; }

        .dropdown-container { position: relative; }
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
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
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

        .user-info { display: none; }
        @media (min-width: 768px) {
            .user-info { display: block; }
        }

        .user-info span { font-weight: bold; }
        .user-info small { font-size: 12px; color: gray; }

        .dropdown-user {
            position: absolute;
            right: 0;
            top: 100%;
            display: none;
            background: white;
            border-radius: 0.375rem;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            width: 200px;
            z-index: 20;
        }

        .dropdown-user a, .dropdown-user button {
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

        .dropdown-user a:hover, .dropdown-user button:hover {
            background-color: #f3f4f6;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .banner {
            width: 100%;
            height: 400px;
            background-size: cover;
            background-position: center;
            margin-top: 20px;
            position: relative;
            border-radius: 1.5rem;
            overflow: hidden;
        }

        .banner-content {
            position: absolute;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
        }

        .banner a {
            background-color: #10b981;
            padding: 10px 20px;
            color: white;
            border-radius: 8px;
            text-decoration: none;
        }

        .banner a:hover { background-color: #059669; }

        .form-wrapper {
            max-width: 850px;
            margin: 2.5rem auto;
            background-color: #ffffff;
            padding: 2rem 5rem;
            border-radius: 10px;
            display: flex;
            gap: 1rem;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }

        .image-upload {
            flex: 1;
            text-align: center;
            font-weight: bold;
            margin-left: 2rem;
            margin-top: 0.5rem;

        }

        .image-upload img {
            width: 100%;
            max-width: 250px;
            height: auto;
            opacity: 0.6;
        }

        .form-fields {
            flex: 2;
            margin-top: 0.5rem;
        }

        .form-group {
            margin-bottom: 0.8rem;
        }

        .form-group label {
            display: block;
            font-size: 15px;
        }


        .form-group input,
        .form-group select{
            width: 70%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #28a745;
            outline: none;
        }

        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            resize: horizontal;
            min-height: 10rem;
        }

        .char-limit {
            font-size: 12px;
            text-align: right;
            color: #6c757d;
        }

        .btn-submit {
            background-color: #28a745;
            margin-top:0;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-submit:hover {
            background-color: #218838;
        }

        @media (max-width: 768px) {
            .form-wrapper {
                flex-direction: column;
                padding: 20px;
            }

            .image-upload {
                margin-bottom: 20px;
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
                        <a href="#" class="kategori-link" data-id="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</a>
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
                <img src="{{  asset('images/avatar.png') }}" alt="Avatar">
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

    <div class="banner" style="background-image: url('{{ asset('images/Landing Page.png') }}');">
        <div class="banner-content">
            <h1 class="mb-2 text-4xl font-bold">CV. Hidroponik Jember</h1>
            <p class="text-lg">We all need a little space to grow. Give yourself the space you need to grow your inner you.</p>
            <a href="#">Hubungi Kami</a>
        </div>
    </div>
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-wrapper">
            <div class="image-upload">
                    <label for="gambar_produk">Foto Produk
                        <img id="preview-image" src="{{ asset('images/UploadFoto.png') }}" alt="Upload Icon">
                    </label>
                    <input type="file" id="gambar_produk" name="gambar_produk" accept="image/*" required style="display: none;">
            </div>

            <div class="form-fields">
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" id="nama_produk" name="nama_produk" placeholder="Nama Produk" required>
                    </div>

                    <div class="form-group">
                        <label for="jumlah_stok">Jumlah Stok</label>
                        <input type="number" id="jumlah_stok" name="jumlah_stok" placeholder="0" min="0" required>
                    </div>

                    <div class="form-group">
                        <label for="harga_produk">Harga Produk</label>
                        <input type="text" id="harga_produk" name="harga_produk" placeholder="Rp. 10.000" required>
                    </div>

                    <div class="form-group">
                        <label for="id_kategori">Kategori</label>
                        <select id="id_kategori" name="id_kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi_produk">Deskripsi Produk</label>
                        <textarea id="deskripsi_produk" name="deskripsi_produk" maxlength="800" placeholder="A detailed description of the product helps customers to learn more about the product."></textarea>
                        <div class="char-limit">0/800</div>
                    </div>

                    <button type="submit" class="btn-submit">Tambahkan Produk</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('gambar_produk').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview-image');

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result; // Set preview image source
                };

                reader.readAsDataURL(file); // Read file as Data URL
            }
        });

        const menuButton = document.getElementById('menuButton');
        const dropdownUser = document.getElementById('dropdownUser');
        const productGrid = document.getElementById('product-grid');

        menuButton.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownUser.style.display = dropdownUser.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', function() {
            dropdownUser.style.display = 'none';
        });

        dropdownUser.addEventListener('click', function(e) {
            e.stopPropagation();
        });
        const textarea = document.getElementById("deskripsi_produk");
        const counter = document.querySelector(".char-limit");

        textarea.addEventListener("input", function () {
            const count = textarea.value.length;
            counter.textContent = `${count}/800`;
        });
    </script>

</body>
</html>
