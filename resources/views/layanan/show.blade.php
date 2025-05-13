<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container px-4 py-8 mx-auto">
        <div class="max-w-xl mx-auto overflow-hidden bg-white rounded-lg shadow-md">
            <img src="{{ asset('storage/' . $layanan->gambar_layanan) }}" alt="{{ $layanan->nama_layanan }}"
                class="object-contain w-full h-64">
            <div class="p-6">
                <!-- Nama Layanan dan Tombol Edit -->
                @if (Auth::user()->hasRole('admin'))
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-bold text-gray-800">{{ $layanan->nama_layanan }}</h1>
                        <a href="{{ route('layanan.edit', $layanan->id_layanan) }}"
                            class="px-4 py-2 text-white bg-yellow-500 rounded hover:bg-yellow-600">Edit</a>
                    </div>
                @endif
                <p class="mt-2 text-lg font-bold text-emerald-600">Rp
                    {{ number_format($layanan->harga_layanan, 0, ',', '.') }}</p>
                <p class="mt-4 text-gray-600">{{ $layanan->deskripsi_layanan }}</p>
                <!-- Tombol Beli -->
                <div class="flex mt-6">
                    <form action="#" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                            class="w-full px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Beli</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
