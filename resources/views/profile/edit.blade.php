<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pengaturan Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 ">
        <!-- Navbar -->
        <header class="sticky top-0 z-50 bg-white shadow-md">
            <nav class="flex items-center justify-between max-w-screen-xl px-4 py-3 mx-auto">
                <div class="flex items-center space-x-6">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Logo AgroMart" class="h-12">
                    </a>
                    <div class="items-center hidden gap-4 text-base font-semibold md:flex text-emerald-700 font-[signika]">
                        <a href="{{ route('dashboard') }}" class="hover:text-emerald-600">DASHBOARD</a>
                        <div class="relative group">
                            <a href="{{ route('produk.index') }}" class="flex items-center gap-1">PRODUK</a>
                            <div class="absolute hidden w-40 bg-white rounded-md shadow-lg z-5 group-hover:block animate-fadeIn">
                                @foreach($kategoris as $kategori)
                                <a href="{{ route('produk.index', $kategori->id_kategori) }}" class="block px-4 py-2 text-xs text-gray-800 rounded-md hover:bg-gray-100">{{ $kategori->nama_kategori }}</a>
                                @endforeach
                            </div>
                        </div>
                        <a href="#edukasi" class="hover:text-emerald-600">EDUKASI</a>
                        <a href="#galeri" class="hover:text-emerald-600">GALERI</a>
                        <a href="#layanan" class="hover:text-emerald-600">LAYANAN</a>
                        <a href="#contact" class="hover:text-emerald-600">CONTACT US</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('images/keranjangIcon.png') }}" alt="Keranjang" class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90">
                    <img src="{{ asset('images/notifIcon.png') }}" alt="Notifikasi" class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90">
                    <div id="menuButton" class="relative">
                        <div class="flex items-center gap-2 cursor-pointer">
                            <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="w-12 h-12 rounded-full">
                            <div class="hidden text-left md:block">
                                <span class="block font-bold">{{ Auth::user()->name }}</span>
                                <small class="text-gray-500">{{ Auth::user()->email }}</small>
                            </div>
                        </div>
                        <div id="dropdownUser" class="absolute right-0 z-30 flex-col hidden w-48 mt-4 bg-white rounded-md shadow-2xl">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Profile</a>
                            <a href="{{ route('pesananku') }}" class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Pesananku</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full px-4 py-2 text-sm text-left rounded-md hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="max-w-3xl p-8 mx-auto mt-10 space-y-10 bg-white rounded shadow">
    {{-- STATUS NOTIFIKASI --}}
    @if (session('status'))
        <div class="mb-4 text-green-600">
            {{ session('status') }}
        </div>
    @endif

    {{-- ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM EDIT PROFIL --}}
    <section>
        <h2 class="mb-4 text-xl font-bold">Edit Profil</h2>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="flex justify-center mb-6">
                <div class="relative w-32 h-32">
                    <img id="avatar-preview"
                        src="{{ Auth::user()->avatar_url ?? asset('images/avatar.png') }}"
                        class="object-cover w-32 h-32 border-4 border-gray-300 rounded-full">
                    <input type="file" id="avatar-input" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
            </div>

            <input type="hidden" name="cropped_avatar" id="cropped-avatar-input">

            <div class="mb-4">
                <label>Nama</label>
                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                    class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                    class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label>Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}"
                    class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label>Alamat</label>
                <textarea name="address" class="w-full px-3 py-2 border rounded">{{ old('address', Auth::user()->address) }}</textarea>
            </div>

            <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                Simpan Profil
            </button>
        </form>
    </section>

    {{-- FORM GANTI PASSWORD --}}
    <section>
        <h2 class="mb-4 text-xl font-bold">Ganti Password</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Password Saat Ini</label>
                <input type="password" name="current_password"
                    class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label>Password Baru</label>
                <input type="password" name="password"
                    class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation"
                    class="w-full px-3 py-2 border rounded" required>
            </div>

            <button type="submit" class="px-6 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                Simpan Password
            </button>
        </form>
    </section>
</div>

{{-- MODAL CROP --}}
<div id="crop-modal" class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-50">
    <div class="w-full max-w-md p-4 bg-white rounded">
        <h2 class="mb-2 font-bold">Crop Avatar</h2>
        <img id="crop-image" class="mx-auto max-h-64">
        <div class="flex justify-end gap-2 mt-4">
            <button id="crop-cancel" class="px-4 py-2 text-white bg-gray-400 rounded">Batal</button>
            <button id="crop-save" class="px-4 py-2 text-white bg-green-600 rounded">Simpan</button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
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
                });
            };
            reader.readAsDataURL(file);
        }
    });

    cropSave.addEventListener('click', () => {
        const canvas = cropper.getCroppedCanvas({ width: 300, height: 300 });
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
