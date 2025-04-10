@forelse ($produks as $produk)
    <div class="product-card" style="border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; margin-bottom: 16px; background: white; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <a href="{{ route('produk.show', $produk->id_produk) }}" style="text-decoration: none; color: inherit;">
            @if ($produk->gambar_produk)
                <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}" style="width: 100%; height: 200px; object-fit: contain;">
            @else
                <div style="height: 200px; background: #f3f4f6; display: flex; align-items: center; justify-content: center; color: #9ca3af;">
                    Tidak ada gambar
                </div>
            @endif

            <div style="padding: 16px; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="margin: 0; font-size: 18px; font-weight: bold;">{{ $produk->nama_produk }}</h3>
                    <p style="margin: 4px 0; color: #10b981; font-weight: 600;">Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p style="margin: 0; color: #6b7280;">Stok: {{ $produk->jumlah_stok }}</p>
                </div>
            </div>
        </a>
        
    </div>
@empty
    <p style="color: #6b7280;">Produk tidak ditemukan.</p>
@endforelse
