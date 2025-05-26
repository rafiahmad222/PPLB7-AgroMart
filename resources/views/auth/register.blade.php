<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="{{ asset('images/icon-40x40.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'slide-up': 'slideUp 0.5s ease-out forwards',
                        'pulse-slow': 'pulse 3s infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-10px)'
                            },
                        },
                        slideUp: {
                            '0%': {
                                transform: 'translateY(20px)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'translateY(0)',
                                opacity: '1'
                            },
                        }
                    },
                    boxShadow: {
                        'input': '0 2px 4px rgba(0, 0, 0, 0.05)',
                        'card': '0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans antialiased text-gray-800 bg-gray-50">
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full min-h-screen shadow-xl md:grid md:grid-cols-2">
            <!-- Left: Form Section -->
            <div class="relative flex flex-col justify-center px-8 py-12 overflow-hidden bg-white md:px-12 lg:px-16">
                <!-- Background decorative elements -->
                <div
                    class="absolute top-0 left-0 w-64 h-64 -translate-x-24 -translate-y-24 rounded-full bg-brand-100 mix-blend-multiply filter blur-xl opacity-30">
                </div>
                <div
                    class="absolute bottom-0 right-0 translate-x-24 translate-y-24 rounded-full w-80 h-80 bg-brand-200 mix-blend-multiply filter blur-xl opacity-30">
                </div>

                <div class="relative z-10 w-full max-w-md mx-auto">
                    <div class="flex justify-center mb-8">
                        <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="AgroMart" class="h-16">
                    </div>

                    <div class="mb-8 text-center">
                        <h2 class="mb-2 text-3xl font-bold text-gray-800">Buat Akun Baru</h2>
                        <p class="text-gray-600">Bergabunglah dengan AgroMart untuk akses ke produk pertanian segar</p>
                    </div>

                    <form id="register-form" class="space-y-5" novalidate>
                        <!-- Username -->
                        <div class="animate-slide-up" style="animation-delay: 0.1s; opacity: 0;">
                            <label for="name" class="block mb-1 text-sm font-medium text-gray-700">Username</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input id="name" type="text" name="name" value="{{ old('name') }}"
                                    class="w-full px-4 py-3 pl-10 transition border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 shadow-input"
                                    placeholder="Masukkan username Anda" required autofocus />
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="animate-slide-up" style="animation-delay: 0.2s; opacity: 0;">
                            <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                </div>
                                <input id="email" type="email" name="email" value="{{ old('email') }}"
                                    class="w-full px-4 py-3 pl-10 transition border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 shadow-input"
                                    placeholder="nama@email.com" required />
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="animate-slide-up" style="animation-delay: 0.3s; opacity: 0;">
                            <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input id="password" type="password" name="password"
                                    class="w-full px-4 py-3 pl-10 transition border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 shadow-input"
                                    placeholder="Minimal 8 karakter" required />
                                <button type="button" onclick="togglePassword()"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg id="eye-icon" class="w-5 h-5 text-gray-400 transition hover:text-gray-600"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="animate-slide-up" style="animation-delay: 0.4s; opacity: 0;">
                            <label for="phone" class="block mb-1 text-sm font-medium text-gray-700">No. HP</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                </div>
                                <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                                    class="w-full px-4 py-3 pl-10 transition border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 shadow-input"
                                    placeholder="08xxxxxxxxxx" required />
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="pt-2 space-y-3 animate-slide-up" style="animation-delay: 0.5s; opacity: 0;">
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-brand-600 to-brand-700 text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-150">
                                Buat Akun
                            </button>

                            <div class="flex items-center justify-between">
                                <hr class="w-full border-gray-300">
                                <span class="px-4 text-sm text-gray-500">atau</span>
                                <hr class="w-full border-gray-300">
                            </div>

                            <a href="{{ url('auth/redirect') }}"
                                class="flex items-center justify-center w-full px-4 py-3 transition-colors duration-150 border border-gray-300 rounded-lg hover:bg-gray-50">
                                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" width="24" height="24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g transform="matrix(1, 0, 0, 1, 0, 0)" fill="none">
                                        <path
                                            d="M21.8055 10.0415H21V10H12V14H17.6515C16.827 16.3285 14.6115 18 12 18C8.6865 18 6 15.3135 6 12C6 8.6865 8.6865 6 12 6C13.5295 6 14.921 6.577 15.9805 7.5195L18.809 4.691C17.023 3.0265 14.634 2 12 2C6.4775 2 2 6.4775 2 12C2 17.5225 6.4775 22 12 22C17.5225 22 22 17.5225 22 12C22 11.3295 21.931 10.675 21.8055 10.0415Z"
                                            fill="#FFC107" />
                                        <path
                                            d="M3.15295 7.3455L6.43845 9.755C7.32645 7.554 9.48045 6 12 6C13.5295 6 14.921 6.577 15.9805 7.5195L18.809 4.691C17.023 3.0265 14.634 2 12 2C8.15895 2 4.82795 4.1685 3.15295 7.3455Z"
                                            fill="#FF3D00" />
                                        <path
                                            d="M12 22C14.583 22 16.93 21.0115 18.7045 19.404L15.6095 16.785C14.5718 17.5742 13.3038 18.001 12 18C9.39903 18 7.19053 16.3415 6.35853 14.027L3.09753 16.5395C4.75253 19.778 8.11353 22 12 22Z"
                                            fill="#4CAF50" />
                                        <path
                                            d="M21.8055 10.0415H21V10H12V14H17.6515C17.2571 15.1082 16.5467 16.0766 15.608 16.7855L15.6095 16.784L18.7045 19.403C18.4855 19.6015 22 17 22 12C22 11.3295 21.931 10.675 21.8055 10.0415Z"
                                            fill="#1976D2" />
                                    </g>
                                </svg>
                                <span>Daftar dengan Google</span>
                            </a>
                        </div>

                        <!-- Login link -->
                        <div class="pt-4 text-center animate-slide-up" style="animation-delay: 0.6s; opacity: 0;">
                            <p class="text-gray-600">
                                Sudah mempunyai akun?
                                <a href="{{ route('login') }}"
                                    class="font-medium text-brand-600 hover:text-brand-800">
                                    Masuk sekarang
                                </a>
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Terms & Privacy -->
                <div class="relative z-10 mt-8 text-xs text-center text-gray-500">
                    <p>Dengan mendaftar, Anda menyetujui <a href="#"
                            class="text-brand-600 hover:underline">Syarat & Ketentuan</a> dan <a href="#"
                            class="text-brand-600 hover:underline">Kebijakan Privasi</a> kami.</p>
                </div>
            </div>
            <div class="relative hidden overflow-hidden md:block bg-gradient-to-br from-brand-600 to-brand-800">
                <div class="absolute inset-0 bg-pattern opacity-5"></div>

                <!-- Subtle header with navigation -->
                <div class="absolute top-0 left-0 right-0 p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-medium text-white/90">AgroMart</h3>
                        <a href="{{ route('home') }}"
                            class="flex items-center px-4 py-2 text-sm transition-colors border rounded-lg text-white/90 border-white/20 backdrop-blur-sm hover:bg-white/10">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke beranda
                        </a>
                    </div>
                </div>

                <!-- Main content area - Cleaner approach -->
                <div class="absolute inset-0 flex flex-col items-center justify-center px-8 py-20">
                    <!-- Subtle decorative accent -->
                    <div
                        class="absolute w-64 h-64 rounded-full top-20 right-10 bg-brand-300/20 mix-blend-overlay filter blur-3xl">
                    </div>
                    <div
                        class="absolute rounded-full bottom-20 left-10 w-80 h-80 bg-brand-100/20 mix-blend-overlay filter blur-3xl">
                    </div>

                    <div class="relative z-10 w-full max-w-lg">
                        <!-- Clean, modern messaging -->
                        <div class="mb-10 text-center">
                            <span
                                class="inline-block px-4 py-1.5 mb-4 text-sm font-medium text-brand-700 bg-brand-100 rounded-full">
                                Pertanian Modern untuk Masa Depan Berkelanjutan
                            </span>
                            <h2 class="text-3xl font-bold text-white">Selamat Datang di Ekosistem Pertanian Digital
                            </h2>
                        </div>

                        <!-- Main image with clean overlay -->
                        <div class="relative overflow-hidden shadow-2xl rounded-xl">
                            <img src="{{ asset('images/Landing Page.png') }}" alt="AgroMart Platform"
                                class="relative object-cover w-full h-72">
                        </div>

                        <!-- Clean feature highlights -->
                        <div class="grid grid-cols-3 gap-4 mt-6">
                            <div
                                class="flex flex-col items-center p-4 text-center text-white rounded-lg bg-white/5 backdrop-blur-sm">
                                <span
                                    class="flex items-center justify-center w-10 h-10 mb-3 rounded-full bg-brand-200/20">
                                    <svg class="w-5 h-5 text-brand-200" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                        </path>
                                    </svg>
                                </span>
                                <h4 class="text-sm font-medium">Kualitas Terjamin</h4>
                            </div>
                            <div
                                class="flex flex-col items-center p-4 text-center text-white rounded-lg bg-white/5 backdrop-blur-sm">
                                <span
                                    class="flex items-center justify-center w-10 h-10 mb-3 rounded-full bg-brand-200/20">
                                    <svg class="w-5 h-5 text-brand-200" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </span>
                                <h4 class="text-sm font-medium">Belanja Mudah</h4>
                            </div>
                            <div
                                class="flex flex-col items-center p-4 text-center text-white rounded-lg bg-white/5 backdrop-blur-sm">
                                <span
                                    class="flex items-center justify-center w-10 h-10 mb-3 rounded-full bg-brand-200/20">
                                    <svg class="w-5 h-5 text-brand-200" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M11.933 12.8a1 1 0 000-1.6L6.6 7.2A1 1 0 005 8v8a1 1 0 001.6.8l5.333-4zM19.933 12.8a1 1 0 000-1.6l-5.333-4A1 1 0 0013 8v8a1 1 0 001.6.8l5.333-4z">
                                        </path>
                                    </svg>
                                </span>
                                <h4 class="text-sm font-medium">Pengiriman Cepat</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Clean stats footer -->
                <div class="absolute bottom-0 left-0 right-0 p-6">
                    <div class="flex items-center justify-between py-4 border-t border-white/10">
                        <div class="flex items-center space-x-2">
                            <span class="text-2xl font-bold text-white">100+</span>
                            <span class="text-xs text-white/70">Produk<br>Pertanian</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-2xl font-bold text-white">50+</span>
                            <span class="text-xs text-white/70">Petani<br>Terdaftar</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-2xl font-bold text-white">10+</span>
                            <span class="text-xs text-white/70">Kota<br>Terjangkau</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: `
                    <ul class="text-left">
                        @foreach ($errors->all() as $error)
                            <li class="mb-1">{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                    confirmButtonColor: '#16a34a',
                    confirmButtonText: 'Coba Lagi'
                });
            </script>
        @endif

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Registrasi Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#16a34a',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

        <script>
            function togglePassword() {
                const passwordField = document.getElementById('password');
                const eyeIcon = document.getElementById('eye-icon');

                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.982 9.982 0 012.38-4.413m2.32-2.197A9.953 9.953 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.973 9.973 0 01-4.154 5.317M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                `;
                } else {
                    passwordField.type = 'password';
                    eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
                }
            }

            document.getElementById('register-form').addEventListener('submit', async function(e) {
                e.preventDefault();

                const form = e.target;
                const formData = new FormData(form);

                try {
                    const response = await fetch("{{ route('register') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const result = await response.json();

                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registrasi Berhasil!',
                            text: 'Akun Anda berhasil dibuat.',
                            confirmButtonColor: '#16a34a',
                            confirmButtonText: 'Lanjutkan'
                        }).then(() => {
                            window.location.href = "{{ route('home') }}";
                        });
                        form.reset();
                    } else {
                        let errorMessages = '';
                        for (let key in result.errors) {
                            result.errors[key].forEach(msg => {
                                errorMessages += `<li class="mb-1">${msg}</li>`;
                            });
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Mendaftar',
                            html: `<ul class="text-left">${errorMessages}</ul>`,
                            confirmButtonColor: '#16a34a',
                            confirmButtonText: 'Coba Lagi'
                        });
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Email mungkin sudah terdaftar atau terjadi masalah server.',
                        confirmButtonColor: '#16a34a',
                        confirmButtonText: 'Coba Lagi'
                    });
                }
            });
        </script>

        <style>
            .bg-pattern {
                background-image: url("data:image/svg+xml,%3Csvg width='52' height='26' viewBox='0 0 52 26' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-rule='nonzero'%3E%3Cpath d='M10 10c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6h2c0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4v2c-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6zm25.464-1.95l8.486 8.486-1.414 1.414-8.486-8.486 1.414-1.414z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }

            /* Adding staggered animations for form fields */
            @keyframes slideUp {
                from {
                    transform: translateY(20px);
                    opacity: 0;
                }

                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }
        </style>
</body>

</html>
