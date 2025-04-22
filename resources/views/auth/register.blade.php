<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('js/eyeicon.js') }}"></script>
</head>

<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="grid w-full min-h-screen grid-cols-1 bg-white md:grid-cols-2">
            <!-- Form Section -->
            <div class="flex flex-col justify-center w-full max-w-lg p-10 mx-auto">
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Hidroponik Jember" class="w-32">
                </div>
                <h2 class="text-3xl font-bold text-center text-gray-800">Daftar Akun!</h2>
                <p class="mt-2 text-sm text-center text-gray-600">Harap Mengisi Data Akun Dengan Lengkap</p>
                <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-4" novalidate>
                    @csrf

                    <!-- Username -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Username</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required
                            autofocus placeholder="Masukkan Username Anda"
                            class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            placeholder="Masukkan Email Anda"
                            class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required
                            placeholder="Masukkan Password Anda"
                            class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" />
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
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Informasi Alamat</label>
                        <input id="address" type="text" name="address" value="{{ old('address') }}" required
                            placeholder="Masukkan Alamat Anda"
                            class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" />
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">No. HP</label>
                        <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required
                            placeholder="Masukkan Nomor HP Anda"
                            class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" />
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex flex-col space-y-2">
                        <button type="submit"
                            class="w-full px-6 py-3 text-white bg-green-700 rounded-lg shadow-md hover:bg-green-800">Save</button>
                        <a href="{{ route('welcome') }}"
                            class="w-full px-6 py-3 text-center text-white bg-gray-500 rounded-lg shadow-md hover:bg-gray-600">Batal</a>
                        <a href="{{ url('auth/redirect') }}"
                            class="flex items-center justify-center w-full py-2 transition border border-gray-300 rounded hover:bg-gray-100">
                            <img src="{{ asset('images/google_icons.png') }}" alt="Google" class="w-5 h-5 mr-2"> Login
                            with Google
                        </a>
                    </div>

                    <p class="mt-4 text-center text-gray-600">Sudah mempunyai akun? <a href="{{ route('login') }}"
                            class="text-blue-600">Login</a></p>
                </form>
                @if ($errors->any())
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: `
                                    <ul style="text-align: left;">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                `,
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif
            </div>

            <!-- Image Section -->
            <div class="hidden w-full min-h-screen md:block">
                <img src="{{ asset('images/Landing Page.png') }}" alt="Hidroponik" class="object-cover w-full h-full">
            </div>
        </div>
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
        function toggleConfirmPassword() {
            const ConfirmpasswordField = document.getElementById('password_confirmation');
            const Eye_Icon = document.getElementById('eyeicon');

            if (ConfirmpasswordField.type === 'password') {
                ConfirmpasswordField.type = 'text';
                Eye_Icon.setAttribute('stroke', '#6b7280');
                Eye_Icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            } else {
                ConfirmpasswordField.type = 'password';
                Eye_Icon.setAttribute('stroke', '#6b7280');
                Eye_Icon.innerHTML = `
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
