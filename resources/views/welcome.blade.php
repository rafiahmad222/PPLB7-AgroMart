{{-- filepath: d:\PPL-AgroMart\resources\views\welcome.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="images/icon-40x40.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('{{ asset('images/Landing Page.png')}}'); /* Gambar latar belakang */
            background-size: cover; /* Menyesuaikan ukuran gambar */
            background-position: center; /* Memusatkan gambar */
            background-repeat: no-repeat;
            color: #1b5e20; /* Hijau gelap */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background-color: #ffffff; /* Putih */
            border: 2px solid #5ed362; /* Hijau */
            border-radius: 10px;
            padding: 1rem;
            margin: 0 28rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2rem;
            margin-top: 1rem;
            text-align: center;
            margin-bottom: 0.3rem;

        }
        p {
            font-size: 0.9rem;
            margin-top: 0;
            margin-bottom: 1.5rem;
            text-align: center;
            line-height: 1.2;

        }
        .button {
            display: inline-block;
            marrgin-right: 0.5rem;
            margin-left: 0.5rem;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
            padding: 0.75rem 2.3rem;
            font-size: 1rem;
            color: #ffffff;
            background-color: #3A5B22; /* Hijau */
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;

            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.4s ease-out, background-color 0.3s ease;
        }
        .button:hover {
            transform: scale(1.10);
            background-color: #45a049; /* Hijau lebih gelap */
        }

        .google-button {
            display: inline-block;
            margin-top: 1rem;
            margin-bottom: 1rem;
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
            color: black;
            background-color: white;
            border: 1px solid grey; /* Warna biru Google */
            border-radius: 15px;
            text-decoration: none;
            cursor: pointer;

            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            transition: transform 0.4s ease-out, background-color 0.3s ease;
        }

        .google-button:hover {
            transform: scale(1.05);
            background-color: #d6d2d2; /* Warna latar belakang saat hover */
        }
        .google-button img{
            width: 30px;
            height: 30px;
            vertical-align: middle;
        }

        .google-button span {
            margin-left: 0.2rem;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Logo AgroMart" style="width: 150px; height: auto; ">
        <h1>Selamat Datang!</h1>
        <p>AgroMart adalah sistem berbasis website yang dirancang untuk mendigitalisasi proses pemesanan, mengoptimalkan pengantaran produk melalui kurir lokal, serta memudahkan manajemen bisnis hidroponik pada CV. Hidroponik Jember.</p>
        @if (Route::has('login'))
            @auth
                @if (Auth::user()->hasRole('admin'))
                    <a href="{{ url('/admin/dashboard') }}" class="button">Admin Dashboard</a>
                @elseif (Auth::user()->hasRole('user'))
                    <a href="{{ url('/home') }}" class="button">Back To Home</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="button">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="button">Register</a>
                @endif
            @endauth
        @endif
    </div>
</body>
</html>
