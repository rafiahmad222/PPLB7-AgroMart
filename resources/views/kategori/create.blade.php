<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori - AgroMart</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .hydroponic-bg {
            background-image: url('https://images.unsplash.com/photo-1606054512044-22abf1012b17?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aHlkcm9wb25pY3xlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .leaf-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 30c-4 0-10-8-10-8s6-8 10-8 10 8 10 8-6 8-10 8zm0 0c4 0 10 8 10 8s-6 8-10 8-10-8-10-8 6-8 10-8z' fill='%2344a34c' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .hydroponic-border {
            border: 2px solid #44a34c;
        }
    </style>
</head>

<body class="bg-gray-100 leaf-pattern">
    <div class="flex items-center justify-center min-h-screen px-4 py-12 sm:px-6 lg:px-8">
        <div class="relative w-full max-w-xl p-6 overflow-hidden bg-white shadow-lg rounded-xl">
            <!-- Dekoratif elemen hidroponik di sudut kiri atas -->
            <div class="absolute top-0 left-0 w-24 h-24 opacity-20">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#44a34c"
                        d="M45.7,-46.9C58.9,-34.4,69,-17.2,70.2,1.2C71.4,19.7,63.7,39.3,50.5,52.2C37.3,65.1,18.7,71.1,0.6,70.5C-17.5,70,-35,62.7,-47.1,49.9C-59.2,37,-65.8,18.5,-66.8,-0.9C-67.8,-20.4,-63.1,-40.9,-51,-53.4C-38.9,-65.9,-19.5,-70.6,-1.2,-69.4C17,-68.1,34,-59.5,45.7,-46.9Z"
                        transform="translate(100 100)" />
                </svg>
            </div>

            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-green-700">Tambah Kategori</h2>
                    <a href="{{ route('produk.index') }}" class="text-green-600 hover:text-green-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                </div>

                <div class="flex items-center justify-center h-24 mb-6 rounded-lg hydroponic-bg">
                    <div class="px-4 py-2 bg-white rounded-lg bg-opacity-80">
                        <h3 class="text-lg font-semibold text-green-700">Kategori Hidroponik</h3>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="p-4 mb-4 text-red-700 border border-red-200 rounded bg-red-50">
                        <ul class="pl-5 list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('kategori.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="nama_kategori" class="block mb-1 font-medium text-green-700">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Nama Kategori
                            </span>
                        </label>
                        <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori') }}"
                            class="w-full px-3 py-2 border border-green-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500"
                            required placeholder="Contoh: Sayuran Hidroponik">
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <a href="{{ route('produk.index') }}"
                            class="px-4 py-2 text-gray-700 transition duration-200 bg-gray-200 rounded hover:bg-gray-300">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-4 py-2 text-white transition duration-200 bg-green-600 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Simpan
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Dekoratif elemen hidroponik di sudut kanan bawah -->
            <div class="absolute bottom-0 right-0 w-20 h-20 transform rotate-180 opacity-20">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#44a34c"
                        d="M45.7,-46.9C58.9,-34.4,69,-17.2,70.2,1.2C71.4,19.7,63.7,39.3,50.5,52.2C37.3,65.1,18.7,71.1,0.6,70.5C-17.5,70,-35,62.7,-47.1,49.9C-59.2,37,-65.8,18.5,-66.8,-0.9C-67.8,-20.4,-63.1,-40.9,-51,-53.4C-38.9,-65.9,-19.5,-70.6,-1.2,-69.4C17,-68.1,34,-59.5,45.7,-46.9Z"
                        transform="translate(100 100)" />
                </svg>
            </div>
        </div>
    </div>
</body>

</html>
