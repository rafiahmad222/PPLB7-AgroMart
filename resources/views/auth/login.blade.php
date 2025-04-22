<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hidroponik Jember</title>
    <link rel="icon" type="image/png" sizes="45x45" href="{{ asset('images/icon-40x40.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex h-screen bg-white">

    <!-- Bagian Kiri: Form Login -->
    <div class="flex flex-col justify-center w-1/2 px-16">
        <div class="flex justify-center mb-8">
            <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Hidroponik Jember" class="w-40">
        </div>

        <h1 class="text-2xl font-bold text-gray-900">Selamat Datang!</h1>
        <p class="mb-6 text-gray-600">Silahkan memasukkan data akunmu!</p>

        <!-- Notifikasi session -->
        @if (session('status'))
            <div class="p-3 mb-4 text-green-700 bg-green-200 rounded">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" placeholder="Masukkan Email Anda"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-green-500 focus:border-green-500"
                    required autofocus>
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" placeholder="Masukkan Password Anda"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-green-500 focus:border-green-500"
                        required>
                    <button type="button" onclick="togglePassword()"
                        class="absolute inset-y-0 flex items-center text-gray-500 right-3">
                        <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-colors duration-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <!-- Mata tertutup default -->
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.982 9.982 0 012.38-4.413m2.32-2.197A9.953 9.953 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.973 9.973 0 01-4.154 5.317M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3l18 18" />
                        </svg>
                    </button>
                </div>
                <a href="{{ route('password.request') }}" class="float-right text-sm text-blue-600">Forgot password?</a>
                @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember"
                    class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                <label for="remember" class="ml-2 text-sm text-gray-700">Remember Me</label>
            </div>

            <!-- Tombol Login -->
            <button type="submit"
                class="w-full py-2 text-white transition bg-green-700 rounded hover:bg-green-800">Login</button>

            <!-- Login dengan Google -->
            <a href="{{ url('auth/redirect') }}"
                class="flex items-center justify-center w-full py-2 transition border border-gray-300 rounded hover:bg-gray-100">
                <img src="{{ asset('images/google_icons.png') }}" alt="Google" class="w-5 h-5 mr-2"> Login with
                Google
            </a>

            <!-- Link ke Register -->
            <p class="mt-4 text-sm text-center text-gray-600">
                Tidak mempunyai akun? <a href="{{ route('register') }}" class="text-blue-600">Sign Up</a>
            </p>
        </form>
    </div>

    <!-- Bagian Kanan: Gambar Hidroponik -->
    <div class="w-1/2 h-full">
        <img src="{{ asset('images/Landing Page.png') }}" alt="Hidroponik" class="object-cover w-full h-full">
    </div>

    <script>
        function togglePassword() {
                const passwordField = document.getElementById('password');
                const eyeIcon = document.getElementById('eye-icon');

                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    eyeIcon.setAttribute('stroke', '#6b7280');
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    `;
                } else {
                    passwordField.type = 'password';
                    eyeIcon.setAttribute('stroke', '#6b7280');
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.982 9.982 0 012.38-4.413m2.32-2.197A9.953 9.953 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.973 9.973 0 01-4.154 5.317M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3l18 18" />
                    `;
                }
            }
    </script>

</body>
</html>
