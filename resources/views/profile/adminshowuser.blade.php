<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Customer - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans bg-gray-100">

    <div class="px-4 py-8 mx-auto max-w-7xl">
        <a href="{{ route('home') }}"
            class="inline-block px-4 py-2 mb-6 text-sm font-semibold text-white rounded-md bg-emerald-600 hover:bg-emerald-700">
            Kembali ke Home
        </a>
        <h1 class="mb-6 text-3xl font-bold text-emerald-700">Daftar Customer</h1>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($users as $user)
                <div class="p-4 transition duration-300 bg-white shadow-lg rounded-2xl hover:shadow-xl">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="{{ $user->avatar_url ? asset($user->avatar_url) : asset('images/avatar.png') }}"
                            alt="Avatar" class="w-16 h-16 border border-gray-200 rounded-full">
                        <div>
                            <h2 class="text-lg font-semibold">{{ $user->name }}</h2>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="text-sm text-gray-600">
                        <p><span class="font-medium">No. Telepon:</span> {{ $user->phone }}</p>
                        <p><span class="font-semibold">Alamat:</span>
                            @if ($user->alamat)
                                {{ $user->alamat->nama_jalan ?? '-' }},
                                {{ $user->alamat->detail_alamat }},
                                {{ $user->alamat->kecamatan->nama_kecamatan ?? '-' }},
                                {{ $user->alamat->kabupatenKota->nama_kabupaten_kota ?? '-' }},
                                {{ $user->alamat->kodePos->kode_pos ?? '-' }}
                            @else
                                <span class="text-gray-500">Alamat tidak tersedia</span>
                            @endif
                        </p>
                        <p><span class="font-medium">ID:</span> {{ $user->id }}</p>
                        <p><span class="font-medium">Terdaftar:</span> {{ $user->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>

</html>
