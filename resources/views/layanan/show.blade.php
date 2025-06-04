<!-- filepath: d:\PPL-AgroMart\resources\views\layanan\show.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $layanan->nama_layanan }} - AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="{{ asset('images/icon-40x40.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&family=Signika:wght@300..700&display=swap"
        rel="stylesheet">
    <style>
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .bg-gradient-radial {
            background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
        }
    </style>
</head>

<body class="font-sans bg-gray-50">

    <main class="container px-4 py-20 mx-auto">
        <div class="max-w-6xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-sm font-medium text-emerald-600 hover:text-emerald-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('layanan.index') }}"
                                class="ml-1 text-sm font-medium text-emerald-600 hover:text-emerald-700 md:ml-2">Layanan</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('layanan.show', $layanan->id_layanan) }}"
                                class="ml-1 text-sm font-medium text-emerald-600 hover:text-emerald-700 md:ml-2 truncate max-w-[150px]">{{ $layanan->nama_layanan }}</a>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Product Detail -->
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
                <!-- Left: Product Images -->
                <div class="relative overflow-hidden bg-white shadow-lg rounded-xl">
                    <div class="absolute inset-0 bg-gradient-radial opacity-30"></div>
                    <img src="{{ asset('storage/' . $layanan->gambar_layanan) }}" alt="{{ $layanan->nama_layanan }}"
                        class="object-cover w-full p-4 h-96 animate-fade-in">
                </div>

                <!-- Right: Product Info -->
                <div class="flex flex-col">
                    <div class="flex items-center justify-between">
                        <h1 class="text-3xl font-bold text-gray-800">{{ $layanan->nama_layanan }}</h1>
                    </div>

                    <p class="mt-4 text-3xl font-bold text-emerald-600">
                        Rp {{ number_format($layanan->harga_layanan, 0, ',', '.') }}
                    </p>

                    <div class="p-6 mt-4 border border-gray-200 rounded-lg bg-gray-50">
                        <h2 class="mb-3 text-lg font-semibold text-gray-800">Deskripsi Layanan</h2>
                        <p class="text-gray-600 whitespace-pre-line">{{ $layanan->deskripsi_layanan }}</p>

                        <div class="grid grid-cols-2 gap-4 mt-6">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-emerald-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                <span>Garansi Kualitas</span>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-emerald-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Layanan Cepat</span>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-emerald-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span>Tim Profesional</span>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-emerald-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Hasil Terjamin</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col gap-3 mt-8 sm:flex-row">
                        @if (Auth::user()->hasRole('admin'))
                            <!-- Admin Actions: Edit and Delete buttons -->
                            <div class="flex flex-col w-full gap-3 sm:flex-row">
                                <a href="{{ route('layanan.edit', $layanan->id_layanan) }}"
                                    class="flex items-center justify-center flex-1 px-6 py-3 text-white transition transform bg-yellow-500 rounded-lg shadow-md hover:bg-yellow-600 active:scale-95 hover:shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    Edit Layanan
                                </a>

                                <form action="{{ route('layanan.destroy', $layanan->id_layanan) }}" method="POST"
                                    class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')"
                                        class="flex items-center justify-center w-full px-6 py-3 text-white transition transform bg-red-500 rounded-lg shadow-md hover:bg-red-600 active:scale-95 hover:shadow-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus Layanan
                                    </button>
                                </form>
                            </div>
                        @else
                            <!-- Regular User Action: Buy button -->
                            <form action="{{ route('transaksi-layanan.create') }}" method="GET" class="flex-1">
                                @csrf
                                <input type="hidden" name="layanan_id" value="{{ $layanan->id_layanan }}">
                                <button type="submit"
                                    class="w-full px-6 py-3 text-white transition transform bg-green-600 rounded-lg shadow-md hover:bg-green-700 active:scale-95 hover:shadow-lg">
                                    Beli
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
    </main>
</body>

</html>
