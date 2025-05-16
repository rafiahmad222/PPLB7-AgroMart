{{-- filepath: d:\PPL-AgroMart\resources\views\produk\_list.blade.php --}}
@forelse ($produks as $produk)
    <div
        class="overflow-hidden transition duration-300 transform bg-white rounded-lg shadow-md hover:shadow-lg hover:-translate-y-1">
        <a href="{{ route('produk.show', $produk->id_produk) }}" class="block">
            @if ($produk->gambar_produk)
                <div class="h-48 overflow-hidden bg-gray-100">
                    <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}"
                        class="object-contain w-full h-full">
                </div>
            @else
                <div class="flex items-center justify-center h-48 bg-gray-100">
                    <span class="text-gray-400">Tidak ada gambar</span>
                </div>
            @endif

            <div class="p-4">
                <h3 class="mb-1 text-lg font-bold text-gray-800">{{ $produk->nama_produk }}</h3>
                <p class="mb-2 text-lg font-semibold text-emerald-600">Rp
                    {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500">Stok: {{ $produk->jumlah_stok }}</p>
            </div>
        </a>
    </div>
@empty
    <div class="py-16 text-center col-span-full">
        <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <p class="mt-4 text-lg text-gray-500">Produk tidak ditemukan</p>
    </div>
@endforelse
