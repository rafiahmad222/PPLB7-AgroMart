<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil Pengguna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-4xl p-8 mx-auto mt-12 bg-white rounded-lg shadow">
    <h2 class="mb-6 text-2xl font-bold text-gray-800">Profil Pengguna</h2>

    <!-- Avatar -->
    <div class="flex items-center justify-center mb-6">
        <div class="relative w-32 h-32">
            <img id="avatar-preview"
                src="{{ Auth::user()->avatar_url ?? asset('images/avatar.png') }}"
                alt="Avatar"
                class="object-cover w-32 h-32 border-4 border-gray-300 rounded-full cursor-pointer">
            <input type="file" id="avatar-input" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
        </div>
    </div>

    <!-- Form update profile -->
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PATCH')

        <!-- Avatar Hidden Upload -->
        <input type="hidden" name="cropped_avatar" id="cropped-avatar-input">

        <div>
            <label class="block font-semibold text-gray-700">Nama</label>
            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="text-right">
            <button type="submit"
                    class="px-6 py-2 mt-4 font-semibold text-white bg-blue-600 rounded hover:bg-blue-700">Simpan Perubahan</button>
        </div>
    </form>
</div>

<!-- Crop Modal -->
<div id="crop-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow">
        <h2 class="mb-4 text-lg font-semibold text-center">Crop Avatar</h2>
        <img id="crop-image" class="mx-auto max-h-80" />
        <div class="flex justify-end mt-4 space-x-4">
            <button id="crop-cancel" class="px-4 py-2 text-white bg-gray-500 rounded hover:bg-gray-600">Batal</button>
            <button id="crop-save" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Simpan</button>
        </div>
    </div>
</div>

<script>
    const avatarInput = document.getElementById('avatar-input');
    const avatarPreview = document.getElementById('avatar-preview');
    const cropModal = document.getElementById('crop-modal');
    const cropImage = document.getElementById('crop-image');
    const cropSaveButton = document.getElementById('crop-save');
    const cropCancelButton = document.getElementById('crop-cancel');
    const croppedAvatarInput = document.getElementById('cropped-avatar-input');
    let cropper;

    avatarInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                cropImage.src = e.target.result;
                cropModal.classList.remove('hidden');
                if (cropper) cropper.destroy();
                cropper = new Cropper(cropImage, {
                    aspectRatio: 1,
                    viewMode: 1,
                });
            };
            reader.readAsDataURL(file);
        }
    });

    cropSaveButton.addEventListener('click', () => {
        if (cropper) {
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
            }, 'image/png');
        }
    });

    cropCancelButton.addEventListener('click', () => {
        cropModal.classList.add('hidden');
        if (cropper) cropper.destroy();
        avatarInput.value = '';
    });
</script>

</body>
</html>
