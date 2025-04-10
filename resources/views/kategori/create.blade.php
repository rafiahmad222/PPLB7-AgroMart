<x-app-layout>
    <div class="max-w-xl p-6 mx-auto bg-white shadow rounded-xl">
        <h2 class="mb-4 text-2xl font-bold">Tambah Kategori</h2>

        <form action="{{ route('kategori.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium">Nama Kategori</label>
                <input type="text" name="nama_kategori" class="w-full px-3 py-2 border rounded" required>
            </div>

            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Simpan</button>
        </form>
    </div>
</x-app-layout>
