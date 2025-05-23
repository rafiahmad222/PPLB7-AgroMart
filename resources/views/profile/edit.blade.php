<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pengaturan Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="45x45" href="images/icon-40x40.png">
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&family=Signika:wght@300..700&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(-5px);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .animate-fadeOut {
            animation: fadeOut 0.3s ease-out forwards;
        }
    </style>
</head>

<body>
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <nav class="flex items-center justify-between max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Logo AgroMart" class="h-12">
                </a>
                <div class="items-center hidden gap-4 text-base font-semibold md:flex text-emerald-700 font-[signika]">
                    <a href="{{ route('home') }}" class=x`">HOME</a>
                    <div class="relative group">
                        <a href="{{ route('produk.index') }}" class="flex items-center gap-1">PRODUK</a>
                        <div
                            class="absolute hidden w-40 bg-white rounded-md shadow-lg z-5 group-hover:block animate-fadeIn text-emerald-600">
                            @foreach ($kategoris as $kategori)
                                <a href="{{ route('produk.index', $kategori->id_kategori) }}"
                                    class="block px-4 py-2 text-sm rounded-md text-emerald-700 hover:bg-gray-100 hover:text-emerald-400">{{ $kategori->nama_kategori }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="#edukasi" class="hover:text-emerald-400">EDUKASI</a>
                    <a href="#galeri" class="hover:text-emerald-400">GALERI</a>
                    <a href="#layanan" class="hover:text-emerald-400">LAYANAN</a>
                    <a href="#contact" class="hover:text-emerald-400">CONTACT US</a>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/keranjangIcon.png') }}" alt="Keranjang"
                    class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90">
                <img src="{{ asset('images/notifIcon.png') }}" alt="Notifikasi"
                    class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90">
                <div id="menuButton" class="relative">
                    <div class="flex items-center gap-2 cursor-pointer">
                        <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" class="w-12 h-12 rounded-full">
                        <div class="hidden text-left md:block">
                            <span class="block font-bold">{{ Auth::user()->name }}</span>
                            <small class="text-gray-500">{{ Auth::user()->email }}</small>
                        </div>
                    </div>
                    <div id="dropdownUser"
                        class="absolute right-0 z-30 flex-col hidden w-48 mt-4 bg-white rounded-md shadow-2xl">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Akun</a>
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('dashboard') }}"
                                class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Transaksi</a>
                            <a href="{{ route('profile.adminshowuser') }}"
                                class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Akun Customer</a>
                        @else
                            <a href="{{ route('pesananku') }}"
                                class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Transaksi</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full px-4 py-2 text-sm text-left rounded-md hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="max-w-5xl mx-auto mt-4 rounded shadow-md spa4ce-y-10 bg-white-500">
        <div class="grid grid-cols-3 gap-8">
            {{-- FORM EDIT PROFIL --}}
            <section class="p-6 mb-4 bg-[#F3F3E0] rounded shadow-md">
                <h2 class="mb-2 text-xl font-bold">Edit Profil</h2>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="flex justify-center mb-2">
                        <div class="relative w-32 h-32">
                            <img id="avatar-preview" src="{{ Auth::user()->avatar_url ?? asset('images/avatar.png') }}"
                                class="object-cover w-32 h-32 border-4 border-gray-300 rounded-full">
                            <input type="file" id="avatar-input" accept="image/*"
                                class="absolute inset-0 opacity-0 cursor-pointer">
                        </div>
                    </div>

                    <input type="hidden" name="cropped_avatar" id="cropped-avatar-input">

                    <div class="mb-2">
                        <label class="font-bold">Nama</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                            class="w-full px-3 py-2 border rounded">
                    </div>

                    <div class="mb-2">
                        <label class="font-bold">Email</label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                            class="w-full px-3 py-2 border rounded">
                    </div>

                    <div class="mb-4">
                        <label class="font-bold">Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}"
                            class="w-full px-3 py-2 border rounded">
                    </div>

                    <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                        Simpan Profil
                    </button>
                </form>
            </section>
            {{-- UBAH PASSWORD --}}
            <section class="p-6 mb-4 bg-[#F3F3E0] rounded shadow-md">
                <h2 class="mb-4 text-xl font-bold">Ganti Password</h2>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label>Password Saat Ini</label>
                        <input type="password" name="current_password" class="w-full px-3 py-2 border rounded"
                            required>
                    </div>

                    <div class="mb-4">
                        <label>Password Baru</label>
                        <input type="password" name="password" class="w-full px-3 py-2 border rounded" required>
                    </div>

                    <div class="mb-4">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="w-full px-3 py-2 border rounded"
                            required>
                    </div>

                    <button type="submit" class="px-6 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                        Simpan Password
                    </button>
                </form>
            </section>
            {{-- ALAMAT CUSTOMER --}}
            <section class="h-auto p-6 mb-4 bg-[#F3F3E0] rounded shadow-md">
                <h2 class="mb-4 text-xl font-bold">Alamat Customer</h2>
                <div class="space-y-4">
                    @if ($alamat->isEmpty())
                        <p class="text-gray-500">Tidak ada alamat yang ditambahkan.</p>
                    @else
                        @foreach ($alamat as $alamats)
                            <div class="p-4 border rounded shadow">
                                <p class="font-semibold">{{ $alamats->label_alamat }}</p>
                                <p>{{ $alamats->detail_alamat }}</p>
                                <p>{{ $alamats->kecamatan->nama_kecamatan }},
                                    {{ $alamats->kabupatenKota->nama_kabupaten_kota }}</p>
                                <p>{{ $alamats->kodePos->kode_pos }}</p>
                                <div class="flex justify-end mt-2 space-x-2">
                                    <button id="openEditModal"
                                        class="px-4 py-2 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600">Edit</button>
                                    <button
                                        class="px-4 py-2 text-sm text-white bg-red-500 rounded hover:bg-red-600">Hapus</button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <button id="add-address"
                    class="w-full px-4 py-2 mt-4 text-white bg-green-600 rounded hover:bg-green-700">
                    Tambah Alamat
                </button>
            </section>
        </div>
    </div>

    {{-- ADD ALAMAT --}}
    <div id="add-address-modal"
        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-lg font-bold text-gray-800">Tambah Alamat</h2>
            <form method="POST" action="{{ route('alamat.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block font-bold">Label Alamat (contoh: Rumah, Kantor)</label>
                    <input type="text" name="label_alamat" class="w-full px-3 py-2 border rounded"
                        placeholder="Label Alamat" required>
                </div>
                <div class="mb-4">
                    <label class="block font-bold">Detail Alamat</label>
                    <textarea name="detail_alamat" class="w-full px-3 py-2 border rounded" placeholder="Detail Alamat" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block font-bold">Kabupaten/Kota</label>
                    <select id="kabupaten-kota" name="id_kabupaten_kota" class="w-full px-3 py-2 border rounded"
                        required>
                        <option value="">Pilih Kabupaten/Kota</option>
                        @foreach ($kabupatenKota as $kabupaten)
                            <option value="{{ $kabupaten->id_kabupaten_kota }}">{{ $kabupaten->nama_kabupaten_kota }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block font-bold">Kecamatan</label>
                    <select id="kecamatan" name="id_kecamatan" class="w-full px-3 py-2 border rounded" required>
                        <option value="">Pilih Kecamatan</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block font-bold">Kode Pos</label>
                    <select id="kode-pos" name="id_kode_pos" class="w-full px-3 py-2 border rounded" required>
                        <option value="">Pilih Kode Pos</option>
                    </select>
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" id="cancel-add-address"
                        class="px-4 py-2 text-white bg-gray-400 rounded hover:bg-gray-500">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- MODAL CROP --}}
    <div id="crop-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="w-full max-w-lg p-4 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-lg font-semibold text-center">Crop Gambar</h2>
            <div class="flex justify-center">
                <img id="crop-image" class="max-w-full rounded-md shadow max-h-64" />
            </div>
            <div class="flex justify-end mt-4 space-x-4">
                <button id="crop-cancel"
                    class="px-4 py-2 text-white bg-gray-400 rounded hover:bg-gray-500">Batal</button>
                <button id="crop-save"
                    class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">Simpan</button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addAddressButton = document.getElementById('add-address');
            const addAddressModal = document.getElementById('add-address-modal');
            const cancelAddAddressButton = document.getElementById('cancel-add-address');

            // Buka modal ketika tombol "Tambah Alamat" diklik
            addAddressButton.addEventListener('click', () => {
                addAddressModal.classList.remove('hidden');
            });

            // Tutup modal ketika tombol "Batal" diklik
            cancelAddAddressButton.addEventListener('click', () => {
                addAddressModal.classList.add('hidden');
            });
        });
        // ALAMAT
        document.addEventListener('DOMContentLoaded', function() {
            const kabupatenKotaSelect = document.getElementById('kabupaten-kota');
            const kecamatanSelect = document.getElementById('kecamatan');
            const kodePosSelect = document.getElementById('kode-pos');

            // Ketika kabupaten/kota dipilih
            kabupatenKotaSelect.addEventListener('change', function() {
                const kabupatenKotaId = this.value;

                // Kosongkan dropdown kecamatan dan kode pos
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                kodePosSelect.innerHTML = '<option value="">Pilih Kode Pos</option>';

                if (kabupatenKotaId) {
                    fetch(`/get-kecamatan/${kabupatenKotaId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(kecamatan => {
                                const option = document.createElement('option');
                                option.value = kecamatan.id_kecamatan;
                                option.textContent = kecamatan.nama_kecamatan;
                                kecamatanSelect.appendChild(option);
                            });
                        });
                }
            });

            // Ketika kecamatan dipilih
            kecamatanSelect.addEventListener('change', function() {
                const kecamatanId = this.value;

                // Kosongkan dropdown kode pos
                kodePosSelect.innerHTML = '<option value="">Pilih Kode Pos</option>';

                if (kecamatanId) {
                    fetch(`/get-kode-pos/${kecamatanId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(kodePos => {
                                const option = document.createElement('option');
                                option.value = kodePos.id_kode_pos;
                                option.textContent = kodePos.kode_pos;
                                kodePosSelect.appendChild(option);
                            });
                        });
                }
            });
        });
        const menuButton = document.getElementById('menuButton');
        const dropdownUser = document.getElementById('dropdownUser');

        let isDropdownVisible = false;

        menuButton.addEventListener('click', function(e) {
            e.stopPropagation();
            if (!isDropdownVisible) {
                dropdownUser.classList.remove('hidden');
                dropdownUser.classList.remove('animate-fadeOut');
                dropdownUser.classList.add('animate-fadeIn');
                isDropdownVisible = true;
            } else {
                dropdownUser.classList.remove('animate-fadeIn');
                dropdownUser.classList.add('animate-fadeOut');
                setTimeout(() => {
                    dropdownUser.classList.add('hidden');
                    isDropdownVisible = false;
                }, 300);
            }
        });

        document.addEventListener('click', function() {
            if (isDropdownVisible) {
                dropdownUser.classList.remove('animate-fadeIn');
                dropdownUser.classList.add('animate-fadeOut');
                setTimeout(() => {
                    dropdownUser.classList.add('hidden');
                    isDropdownVisible = false;
                }, 300);
            }
        });

        dropdownUser.addEventListener('click', function(e) {
            e.stopPropagation();
        });
        const avatarInput = document.getElementById('avatar-input');
        const avatarPreview = document.getElementById('avatar-preview');
        const cropModal = document.getElementById('crop-modal');
        const cropImage = document.getElementById('crop-image');
        const cropSave = document.getElementById('crop-save');
        const cropCancel = document.getElementById('crop-cancel');
        const croppedAvatarInput = document.getElementById('cropped-avatar-input');
        let cropper;

        avatarInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    cropImage.src = reader.result;
                    cropModal.classList.remove('hidden');
                    cropper = new Cropper(cropImage, {
                        aspectRatio: 1,
                        viewMode: 1,
                        responsive: true,
                        autoCropArea: 1,
                    });
                };
                reader.readAsDataURL(file);
            }
        });

        cropSave.addEventListener('click', () => {
            const canvas = cropper.getCroppedCanvas({
                width: 300,
                height: 300
            });
            canvas.toBlob(blob => {
                const reader = new FileReader();
                reader.onloadend = () => {
                    croppedAvatarInput.value = reader.result;
                    avatarPreview.src = reader.result;
                    cropModal.classList.add('hidden');
                    cropper.destroy();
                };
                reader.readAsDataURL(blob);
            });
        });

        cropCancel.addEventListener('click', () => {
            cropModal.classList.add('hidden');
            avatarInput.value = '';
            if (cropper) cropper.destroy();
        });
    </script>

</body>

</html>
