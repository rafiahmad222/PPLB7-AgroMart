<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $artikel->judul }} - Edukasi AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="images/icon-40x40.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&family=Signika:wght@300..700&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .artikel-content img {
            max-width: 100%;
            height: auto;
        }

        .artikel-header-img {
            max-height: 400px;
            width: 100%;
            object-fit: cover;
        }

        .comment-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .artikel-content {
            font-family: 'Poppins', sans-serif;
            line-height: 1.7;
        }

        .artikel-content p {
            margin-bottom: 1.2rem;
        }

        .artikel-content h2,
        .artikel-content h3,
        .artikel-content h4 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .artikel-content a {
            color: #10B981;
            text-decoration: underline;
        }

        .artikel-content ul,
        .artikel-content ol {
            padding-left: 1.5rem;
            margin-bottom: 1.2rem;
        }

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

        .animate-fadeIn {
            animation: fadeIn 0.8s ease-out forwards;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white shadow-lg">
        <nav class="flex items-center justify-between max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}" class="transition-transform hover:scale-105">
                    <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Logo AgroMart" class="h-12">
                </a>
                <div class="items-center hidden gap-6 text-base font-semibold md:flex text-emerald-700 font-[signika]">
                    <a href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'px-4 py-1.5 text-white font-medium bg-emerald-600 rounded-full' : 'transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4' }}">HOME</a>
                    <div class="relative group">
                        <a href="{{ route('produk.index') }}"
                            class="{{ request()->routeIs('produk.*') ? 'px-4 py-1.5 text-white font-medium bg-emerald-600 rounded-full flex items-center' : 'flex items-center gap-1 transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4' }}">PRODUK</a>
                        <div
                            class="absolute hidden bg-white border rounded-lg shadow-xl w-44 z-5 group-hover:block animate-fadeIn border-emerald-100">
                            @foreach ($kategoris as $kategori)
                                <a href="{{ route('produk.index', $kategori->id_kategori) }}"
                                    class="block px-4 py-2.5 text-sm rounded-md text-emerald-700 hover:bg-emerald-50">
                                    {{ $kategori->nama_kategori }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('edukasi.index') }}"
                        class="{{ request()->routeIs('edukasi.*') ? 'px-4 py-1.5 text-white font-medium bg-emerald-600 rounded-full' : 'transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4' }}">EDUKASI</a>
                    <a href="{{ route('galeri.index') }}"
                        class="{{ request()->routeIs('galeri.*') ? 'px-4 py-1.5 text-white font-medium bg-emerald-600 rounded-full' : 'transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4' }}">GALERI</a>
                    <a href="{{ route('layanan.index') }}"
                        class="{{ request()->routeIs('layanan.*') ? 'px-4 py-1.5 text-white font-medium bg-emerald-600 rounded-full' : 'transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4' }}">LAYANAN</a>
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('status.index') }}"
                            class="{{ request()->routeIs('status.*') ? 'px-4 py-1.5 text-white font-medium bg-emerald-600 rounded-full' : 'transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4' }}">TRANSAKSI</a>
                    @else
                        <a href="{{ route('pesananku') }}"
                            class="{{ request()->routeIs('pesananku') ? 'px-4 py-1.5 text-white font-medium bg-emerald-600 rounded-full' : 'transition-all hover:text-emerald-500 hover:underline hover:underline-offset-4' }}">TRANSAKSI</a>
                    @endif
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative" id="notificationContainer">
                    <img src="{{ asset('images/notifIcon.png') }}" alt="Notifikasi"
                        class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90"
                        id="notificationButton">
                    <div class="absolute flex items-center justify-center w-5 h-5 text-xs font-bold text-white transform -translate-y-1/2 rounded-full -right-1 bg-emerald-500 top-1"
                        id="unreadCount">
                        0</div>

                    <!-- Notification Dropdown -->
                    <div id="notificationDropdown"
                        class="absolute right-0 z-50 hidden mt-2 overflow-hidden bg-white rounded-lg shadow-xl w-80 animate-fadeIn">
                        <div class="flex items-center justify-between p-4 border-b">
                            <h3 class="font-semibold text-gray-800">Notifikasi</h3>
                            <button id="markAllAsRead" class="text-sm text-emerald-600 hover:text-emerald-800">Tandai
                                semua dibaca</button>
                        </div>
                        <div id="notificationsList" class="overflow-y-auto max-h-80">
                            <!-- Notifications will be loaded here -->
                            <div id="emptyNotification" class="p-6 text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                    </path>
                                </svg>
                                <p>Tidak ada notifikasi baru</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="menuButton" class="relative">
                    <div
                        class="flex items-center gap-3 p-1.5 rounded-full cursor-pointer hover:bg-gray-100 transition-all">
                        <img src="{{ Auth::user()->avatar_url }}" alt="Avatar"
                            class="object-cover w-10 h-10 border-2 rounded-full border-emerald-500">
                        <div class="hidden text-left md:block">
                            <span class="block font-bold text-gray-800">{{ Auth::user()->name }}</span>
                            <small class="text-gray-500">{{ Auth::user()->email }}</small>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="text-gray-500" viewBox="0 0 16 16">
                            <path
                                d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                        </svg>
                    </div>
                    <div id="dropdownUser"
                        class="absolute right-0 z-30 flex-col hidden w-56 mt-2 overflow-hidden bg-white rounded-lg shadow-2xl">
                        <div class="p-4 bg-emerald-50">
                            <p class="font-semibold text-emerald-700">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="border-t">
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-2 px-4 py-3 text-sm transition-colors hover:bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    fill="currentColor" class="text-gray-600" viewBox="0 0 16 16">
                                    <path
                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                </svg>
                                Akun
                            </a>
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('profile.adminshowuser') }}"
                                    class="flex items-center gap-2 px-4 py-3 text-sm transition-colors hover:bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        fill="currentColor" class="text-gray-600" viewBox="0 0 16 16">
                                        <path
                                            d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                                    </svg>
                                    Akun Customer
                                </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                                @csrf
                                <button type="button" id="logoutButton"
                                    class="flex items-center w-full gap-2 px-4 py-3 text-sm text-red-600 transition-colors hover:bg-red-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        fill="currentColor" class="text-red-500" viewBox="0 0 16 16">
                                        <path
                                            d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                                        <path
                                            d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container max-w-screen-xl py-5 mx-auto">
        <div class="mb-4">
            <a href="{{ route('edukasi.index') }}"
                class="inline-flex items-center text-decoration-none text-emerald-700 hover:text-emerald-500">
                <i class="mr-2 fas fa-arrow-left"></i> Kembali ke Daftar Edukasi
            </a>
        </div>

        <article class="p-6 mb-5 bg-white rounded-lg shadow-md">
            <header class="mb-8 text-center">
                <h1 class="text-3xl font-bold mb-3 font-[Volkhov] text-emerald-800">{{ $artikel->judul }}</h1>
                <div class="mb-4 text-gray-600">
                    Ditulis oleh {{ $artikel->user->name }} pada {{ $artikel->created_at->format('d M Y, H:i') }}
                </div>
                @if ($artikel->gambar)
                    <img src="{{ asset('storage/' . $artikel->gambar) }}" class="mb-6 rounded-lg artikel-header-img"
                        alt="{{ $artikel->judul }}">
                @endif

                <div class="p-4 mb-8 text-left rounded-lg bg-emerald-50">
                    <h5 class="mb-2 font-semibold text-emerald-800">Ringkasan:</h5>
                    <p class="text-gray-700">{{ $artikel->ringkasan }}</p>
                </div>
            </header>

            <div class="mx-auto prose artikel-content prose-emerald lg:prose-lg">
                {!! $artikel->konten !!}
            </div>

            @if (Auth::check() && Auth::user()->id === $artikel->user_id)
                <div class="mt-8 text-end">
                    <a href="{{ route('edukasi.edit', $artikel->id_artikel) }}"
                        class="px-4 py-2 mr-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                        <i class="mr-1 fas fa-edit"></i> Edit Artikel
                    </a>
                    <button type="button" class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600"
                        onclick="openDeleteModal('{{ $artikel->id_artikel }}', '{{ $artikel->judul }}')">
                        <i class="mr-1 fas fa-trash"></i> Hapus
                    </button>
                </div>
            @endif
        </article>

        <section class="p-6 mt-8 bg-white rounded-lg shadow-md">
            <h3 class="text-2xl font-semibold mb-6 text-emerald-800 font-[Volkhov]">Komentar
                ({{ $artikel->komentar->count() }})</h3>

            @auth
                <div class="mb-6 border border-gray-200 rounded-lg card">
                    <div class="p-4">
                        <form action="{{ route('edukasi.komentar.store', $artikel->id_artikel) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="konten" class="block mb-2 text-sm font-medium text-gray-700">Tambahkan
                                    komentar</label>
                                <textarea
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 @error('konten') border-red-500 @enderror"
                                    id="konten" name="konten" rows="3" required>{{ old('konten') }}</textarea>
                                @error('konten')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <button type="submit"
                                    class="px-4 py-2 text-white rounded-md bg-emerald-600 hover:bg-emerald-700">
                                    Kirim Komentar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="p-4 mb-6 text-blue-700 rounded-md bg-blue-50">
                    <a href="{{ route('login') }}" class="font-medium underline">Login</a> untuk menambahkan komentar.
                </div>
            @endauth

            <div class="space-y-4 komentar-list">
                @forelse($artikel->komentar->sortByDesc('created_at') as $komentar)
                    <div class="mb-3 border border-gray-200 rounded-lg shadow-sm card animate-fadeIn">
                        <div class="p-4">
                            <div class="flex mb-3">
                                @if (isset($komentar->user->avatar_url) && $komentar->user->avatar_url)
                                    <img src="{{ asset($komentar->user->avatar_url) }}"
                                        alt="{{ $komentar->user->name }}" class="mr-3 comment-avatar">
                                @else
                                    <div
                                        class="flex items-center justify-center mr-3 text-white comment-avatar bg-emerald-600">
                                        {{ substr($komentar->user->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <h6 class="mb-0 font-semibold">{{ $komentar->user->name }}</h6>
                                    <small class="text-gray-500">{{ $komentar->created_at->diffForHumans() }}</small>
                                </div>
                            </div>

                            <p class="mb-0 text-gray-700">{{ $komentar->konten }}</p>

                            @if (Auth::check() && (Auth::id() === $komentar->user_id || Auth::id() === $artikel->user_id))
                                <div class="mt-2 text-end">
                                    <form
                                        action="{{ route('edukasi.komentar.destroy', [$artikel->id_artikel, $komentar->id_komentar]) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-sm font-medium text-red-600 hover:text-red-800"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-gray-600 rounded-md bg-gray-50">
                        Belum ada komentar. Jadilah yang pertama berkomentar!
                    </div>
                @endforelse
            </div>
            <!-- Modal Konfirmasi Hapus -->
            <div id="deleteModal"
                class="fixed inset-0 z-50 flex items-center justify-center hidden overflow-auto bg-black bg-opacity-50">
                <div class="w-full max-w-md p-6 mx-4 bg-white rounded-lg shadow-xl animate-fadeIn">
                    <div class="mb-4 text-center">
                        <i class="text-5xl text-red-500 fas fa-exclamation-triangle"></i>
                        <h3 class="mt-4 mb-2 text-xl font-semibold text-gray-800">Konfirmasi Hapus</h3>
                        <p class="text-gray-600" id="deleteModalText">Apakah Anda yakin ingin menghapus artikel ini?
                        </p>
                    </div>
                    <div class="flex justify-center gap-4">
                        <button type="button"
                            class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300"
                            onclick="closeDeleteModal()">
                            Batal
                        </button>
                        <form id="deleteForm" action="" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600">
                                Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const routes = {
            destroy: id => `{{ url('edukasi') }}/${id_artikel}`,
        };

        function openDeleteModal(id, judul) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            const modalText = document.getElementById('deleteModalText');

            // Ganti dengan URL yang langsung dibentuk
            form.action = `{{ url('edukasi') }}/${id}`;
            modalText.textContent = `Apakah Anda yakin ingin menghapus artikel "${judul}"?`;

            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Tutup modal ketika klik di luar modal
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target === modal) {
                closeDeleteModal();
            }
        });

        // Tutup modal dengan tombol ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDeleteModal();
            }
        });
        // Animasi untuk menampilkan komentar baru
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success')) {
                const commentSection = document.querySelector('.komentar-list');
                commentSection.scrollIntoView({
                    behavior: 'smooth'
                });

                setTimeout(() => {
                    const firstComment = document.querySelector('.komentar-list .card:first-child');
                    if (firstComment) {
                        firstComment.classList.add('bg-emerald-50');
                        setTimeout(() => {
                            firstComment.classList.remove('bg-emerald-50');
                        }, 2000);
                    }
                }, 500);
            }
        });
        // Notification Logic
        document.addEventListener('DOMContentLoaded', function() {
            const notificationButton = document.getElementById('notificationButton');
            const notificationDropdown = document.getElementById('notificationDropdown');
            const notificationsList = document.getElementById('notificationsList');
            const unreadCount = document.getElementById('unreadCount');
            const markAllAsRead = document.getElementById('markAllAsRead');
            const emptyNotification = document.getElementById('emptyNotification');

            let isNotificationOpen = false;

            // Tampilkan atau sembunyikan dropdown notifikasi
            notificationButton.addEventListener('click', function(e) {
                e.stopPropagation();

                if (!isNotificationOpen) {
                    notificationDropdown.classList.remove('hidden');
                    isNotificationOpen = true;
                    // Load notifications when dropdown is opened
                    loadNotifications();
                } else {
                    notificationDropdown.classList.add('hidden');
                    isNotificationOpen = false;
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function() {
                if (isNotificationOpen) {
                    notificationDropdown.classList.add('hidden');
                    isNotificationOpen = false;
                }
            });

            notificationDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });

            // Function to load notifications from backend
            function loadNotifications() {
                fetch('/notifications')
                    .then(response => response.json())
                    .then(data => {
                        displayNotifications(data.data);
                        getUnreadCount();
                    })
                    .catch(error => {
                        console.error('Error fetching notifications:', error);
                    });
            }

            // Function to get unread notification count
            function getUnreadCount() {
                fetch('/notifications/unread-count')
                    .then(response => response.json())
                    .then(data => {
                        const count = data.count;
                        unreadCount.textContent = count;

                        // Hide unread badge if count is 0
                        if (count === 0) {
                            unreadCount.classList.add('hidden');
                        } else {
                            unreadCount.classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching unread count:', error);
                    });
            }

            // Function to display notifications
            function displayNotifications(notifications) {
                // Clear previous notifications except the empty state
                const notificationItems = notificationsList.querySelectorAll('.notification-item');
                notificationItems.forEach(item => item.remove());

                // Show empty state if no notifications
                if (notifications.length === 0) {
                    emptyNotification.classList.remove('hidden');
                    return;
                }

                // Hide empty state if there are notifications
                emptyNotification.classList.add('hidden');

                // Add notifications to the list
                notifications.forEach(notification => {
                    const notificationItem = createNotificationItem(notification);
                    notificationsList.insertBefore(notificationItem, notificationsList.firstChild);
                });
            }

            // Create notification item element
            function createNotificationItem(notification) {
                const item = document.createElement('div');
                item.className = 'notification-item p-4 border-b hover:bg-gray-50 transition cursor-pointer';
                if (!notification.is_read) {
                    item.classList.add('bg-emerald-50');
                }

                const time = new Date(notification.created_at);
                const formattedTime = time.toLocaleDateString() + ' ' + time.toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });

                // Pilih ikon berdasarkan tipe notifikasi
                let iconMarkup = '<i class="fas fa-info-circle text-emerald-500"></i>'; // default icon

                if (notification.type === 'new_order') {
                    iconMarkup = '<i class="fas fa-shopping-bag text-emerald-500"></i>';
                } else if (notification.type === 'status_update') {
                    iconMarkup = '<i class="fas fa-sync-alt text-emerald-500"></i>';
                }

                item.innerHTML = `
    <div class="flex items-start">
        <div class="flex-shrink-0 mr-3">
            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100">
                ${iconMarkup}
            </div>
        </div>
        <div class="flex-grow">
            <p class="text-sm text-gray-800">${notification.message}</p>
            <p class="mt-1 text-xs text-gray-500">${formattedTime}</p>
        </div>
        ${!notification.is_read ? '<div class="w-2 h-2 mt-2 ml-2 rounded-full bg-emerald-500"></div>' : ''}
    </div>
    `;

                // Mark as read when clicked
                item.addEventListener('click', function() {
                    if (!notification.is_read) {
                        markAsRead(notification.id, item);
                    }

                    // Arahkan pengguna ke halaman yang berbeda berdasarkan tipe notifikasi
                    if (notification.pesanan_id) {
                        // Untuk pelanggan, arahkan berdasarkan tipe notifikasi
                        if (notification.type === 'new_order') {
                            window.location.href = `/status`;
                        } else if (notification.type === 'status_update') {
                            window.location.href = `/pesananku`;
                        }
                    }
                });

                return item;
            }

            // Function to mark a notification as read
            function markAsRead(notificationId, itemElement) {
                fetch(`/notifications/${notificationId}/read`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    })
                    .then(response => response.json())
                    .then(() => {
                        // Update UI
                        itemElement.classList.remove('bg-emerald-50');
                        const dot = itemElement.querySelector('.bg-emerald-500');
                        if (dot) {
                            dot.remove();
                        }
                        getUnreadCount();
                    })
                    .catch(error => {
                        console.error('Error marking notification as read:', error);
                    });
            }

            // Mark all notifications as read
            markAllAsRead.addEventListener('click', function(e) {
                e.preventDefault();

                fetch('/notifications/mark-all-read', {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(() => {
                        // Reload notifications
                        loadNotifications();
                    })
                    .catch(error => {
                        console.error('Error marking all notifications as read:', error);
                    });
            });

            // Load unread count on page load
            getUnreadCount();

            // Set up polling for notifications (every 30 seconds)
            setInterval(getUnreadCount, 30000);
        });
    </script>
</body>

</html>
