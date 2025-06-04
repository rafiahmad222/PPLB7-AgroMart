<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="{{ asset('images/icon-40x40.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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
                        'slide-in': 'slideIn 0.5s ease-out forwards',
                        'slide-out': 'slideOut 0.5s ease-out forwards',
                        'fade-in': 'fadeIn 0.3s ease-out forwards',
                        'fade-out': 'fadeOut 0.3s ease-out forwards',
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
                        slideIn: {
                            '0%': {
                                transform: 'translateX(100%)'
                            },
                            '100%': {
                                transform: 'translateX(0)'
                            }
                        },
                        slideOut: {
                            '0%': {
                                transform: 'translateX(0)'
                            },
                            '100%': {
                                transform: 'translateX(100%)'
                            }
                        },
                        fadeIn: {
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
                            }
                        },
                        fadeOut: {
                            '0%': {
                                opacity: '1'
                            },
                            '100%': {
                                opacity: '0'
                            }
                        }
                    },
                }
            }
        }
    </script>
</head>

<body class="font-sans antialiased text-gray-800 bg-gray-50">
    <!-- Custom Error Popup (Hidden by default) -->
    <div id="errorPopup"
        class="fixed z-50 hidden w-full max-w-sm transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg shadow-md top-1/2 left-1/2">
        <div class="flex items-center px-4 py-3 text-white bg-red-500 rounded-t-lg">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="font-semibold">Gagal Login</p>
            <button onclick="closeErrorPopup()" class="ml-auto">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
        <div class="px-6 py-4">
            <div class="mb-2 text-center text-red-600">
                <p>Email/Password salah!</p>
            </div>
            <div class="flex justify-center mt-4">
                <button onclick="closeErrorPopup()"
                    class="px-4 py-2 font-medium text-white transition-colors bg-red-500 rounded-lg hover:bg-red-600">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Backdrop for popup -->
    <div id="backdrop" class="fixed inset-0 z-40 hidden bg-black bg-opacity-50"></div>

    <div class="flex flex-col min-h-screen md:flex-row">
        <!-- Left: Login Form -->
        <div class="z-10 flex flex-col justify-center w-full px-4 md:w-1/2 sm:px-6 md:px-8 lg:px-16 xl:px-24">
            <div class="w-full max-w-md mx-auto">
                <div class="text-center">
                    <div class="flex justify-center">
                        <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="AgroMart" class="h-16 mb-4">
                    </div>

                    <h2 class="mb-2 text-3xl font-bold text-gray-900">Selamat Datang Kembali!</h2>
                    <p class="mb-6 text-gray-600">Masukkan kredensial Anda untuk mengakses akun</p>
                </div>

                <!-- Success Notification -->
                @if (session('status'))
                    <div class="flex items-center p-4 mb-6 border-l-4 rounded-lg bg-green-50 border-brand-500">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-brand-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-brand-700">{{ session('status') }}</p>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6" id="loginForm">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <input type="email" name="email" id="email"
                                class="block w-full py-3 pl-10 transition duration-150 border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500"
                                placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>

                    <!-- Password field and rest of the form -->
                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <a href="{{ route('password.request') }}"
                                class="text-sm font-medium text-brand-600 hover:text-brand-500">
                                Lupa password?
                            </a>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="password" name="password" id="password"
                                class="block w-full py-3 pl-10 transition duration-150 border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500"
                                placeholder="••••••••" required>
                            <button type="button" onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg id="eye-icon" class="w-5 h-5 text-gray-400 transition-colors hover:text-gray-600"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="w-4 h-4 border-gray-300 rounded text-brand-600 focus:ring-brand-500">
                        <label for="remember" class="block ml-2 text-sm text-gray-700">
                            Ingat saya
                        </label>
                    </div>

                    <div class="space-y-4">
                        <!-- Login Button -->
                        <button type="submit"
                            class="relative flex justify-center w-full px-4 py-3 text-sm font-medium text-white transition duration-150 border border-transparent rounded-lg shadow-sm group bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-5 h-5 text-brand-500 group-hover:text-brand-400"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            Masuk
                        </button>

                        <!-- Google Login -->
                        <a href="{{ url('auth/redirect') }}"
                            class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 transition duration-150 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">
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
                            Masuk dengan Google
                        </a>
                    </div>

                    <!-- Sign Up Link -->
                    <div class="mt-2 text-center">
                        <p class="text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="font-medium text-brand-600 hover:text-brand-500">
                                Daftar sekarang
                            </a>
                        </p>
                    </div>

                    <footer>
                        <p class="mt-2 text-xs text-center text-gray-500">
                            &copy; {{ date('Y') }} AgroMart. All rights reserved.
                        </p>
                    </footer>
                </form>
            </div>
        </div>

        <!-- Right: Banner Image - Remains the same -->
        <div class="relative hidden overflow-hidden md:block md:w-1/2 bg-gradient-to-br from-brand-500 to-brand-800">
            <!-- Existing content -->
            <div class="absolute inset-0 bg-pattern opacity-10"></div>
            <div class="absolute top-0 bottom-0 left-0 right-0 flex items-center justify-center p-8">
                <div class="relative w-full max-w-lg animate-float">
                    <div
                        class="absolute top-0 w-40 h-40 transform -translate-x-1/2 -translate-y-12 rounded-full left-1/2 bg-brand-300 mix-blend-multiply filter blur-xl opacity-20">
                    </div>
                    <div
                        class="absolute rounded-full top-8 right-1/4 w-72 h-72 bg-brand-400 mix-blend-multiply filter blur-xl opacity-20 animate-pulse">
                    </div>
                    <div
                        class="absolute w-56 h-56 bg-green-200 rounded-full -bottom-8 left-1/4 mix-blend-multiply filter blur-xl opacity-20">
                    </div>
                    <img src="{{ asset('images/Landing Page.png') }}" alt="Hidroponik"
                        class="relative w-full rounded-lg shadow-2xl"
                        style="clip-path: inset(0% 0% 0% 0% round 1rem);">
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                <div class="max-w-md mx-auto text-center">
                    <h3 class="mb-2 text-xl font-semibold">AgroMart</h3>
                    <p class="text-sm text-white/80">Solusi pertanian modern untuk Indonesia yang lebih hijau dan
                        berkelanjutan.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Password toggle function
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

        // Error popup functions
        function showErrorPopup() {
            const errorPopup = document.getElementById('errorPopup');
            const backdrop = document.getElementById('backdrop');

            errorPopup.classList.add('animate-fade-in');
            errorPopup.classList.remove('hidden');

            backdrop.classList.add('animate-fade-in');
            backdrop.classList.remove('hidden');

            // Auto close after 5 seconds
            setTimeout(() => {
                closeErrorPopup();
            }, 5000);
        }

        function closeErrorPopup() {
            const errorPopup = document.getElementById('errorPopup');
            const backdrop = document.getElementById('backdrop');

            errorPopup.classList.add('animate-fade-out');
            backdrop.classList.add('animate-fade-out');

            setTimeout(() => {
                errorPopup.classList.add('hidden');
                backdrop.classList.add('hidden');

                errorPopup.classList.remove('animate-fade-in', 'animate-fade-out');
                backdrop.classList.remove('animate-fade-in', 'animate-fade-out');
            }, 300);
        }

        // Show the error popup if there's an authentication error
        @if (session('error') || $errors->has('email'))
            document.addEventListener('DOMContentLoaded', function() {
                showErrorPopup();
            });
        @endif

        // For handling the form submission - optional AJAX approach
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            // For now, we'll let the form submit normally and handle errors via Laravel's session
            // If you want to implement AJAX login later, you can add the code here
        });
    </script>

    <style>
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='52' height='26' viewBox='0 0 52 26' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-rule='nonzero'%3E%3Cpath d='M10 10c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6h2c0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4v2c-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6zm25.464-1.95l8.486 8.486-1.414 1.414-8.486-8.486 1.414-1.414z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }

        .animate-fade-out {
            animation: fadeOut 0.3s ease-out forwards;
        }
    </style>
</body>

</html>
