<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edukasi AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="images/icon-40x40.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&family=Signika:wght@300..700&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .video-thumbnail {
            position: relative;
            cursor: pointer;
        }

        .play-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 3rem;
            color: white;
            opacity: 0.8;
        }

        .video-thumbnail:hover .play-icon {
            opacity: 1;
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
                                Pengaturan Akun
                            </a>
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('profile.adminshowuser') }}"
                                    class="flex items-center gap-2 px-4 py-3 text-sm transition-colors hover:bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        fill="currentColor" class="text-gray-600" viewBox="0 0 16 16">
                                        <path
                                            d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                                    </svg>
                                    Manajemen Pengguna
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

    <div class="container mt-2 mb-4">
        <h1 class="mb-2 text-xl font-bold">Edukasi AgroMart</h1>

        <div class="mb-4 row">
            <div class="col-md-6">
                <form action="{{ route('edukasi.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2"
                        placeholder="Cari artikel atau video..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
            <div class="col-md-6 text-end">
                @auth
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('edukasi.create') }}" class="btn btn-success">Tambah Konten Edukasi</a>
                    @endif
                @endauth
            </div>
        </div>

        <ul class="mb-4 nav nav-tabs" id="edukasiTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ request('tab') !== 'video' ? 'active' : '' }}" id="artikel-tab"
                    data-bs-toggle="tab" data-bs-target="#artikel" type="button" role="tab">Artikel</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ request('tab') === 'video' ? 'active' : '' }}" id="video-tab"
                    data-bs-toggle="tab" data-bs-target="#video" type="button" role="tab">Video</button>
            </li>
        </ul>

        <div class="tab-content" id="edukasiTabContent">
            <!-- Tab Artikel -->
            <div class="tab-pane fade {{ request('tab') !== 'video' ? 'show active' : '' }}" id="artikel"
                role="tabpanel">
                <div class="row">
                    @forelse($artikels as $artikel)
                        <div class="mb-4 col-md-4">
                            <div class="card h-100">
                                @if ($artikel->gambar)
                                    <img src="{{ asset('storage/' . $artikel->gambar) }}" class="card-img-top"
                                        alt="{{ $artikel->judul }}">
                                @else
                                    <div class="text-white bg-secondary d-flex align-items-center justify-content-center"
                                        style="height: 200px;">
                                        <span>Tidak ada gambar</span>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $artikel->judul }}</h5>
                                    <p class="card-text text-muted">
                                        <small>Oleh: {{ $artikel->user->name }} |
                                            {{ $artikel->created_at->format('d M Y') }}</small>
                                    </p>
                                    <p class="card-text">{{ Str::limit($artikel->ringkasan, 100) }}</p>
                                </div>
                                <div class="bg-white card-footer border-top-0">
                                    <a href="{{ route('edukasi.show', $artikel->id_artikel) }}"
                                        class="btn btn-primary btn-sm">Baca selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info">
                                Belum ada artikel edukasi tersedia.
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $artikels->appends(['tab' => request('tab'), 'search' => request('search')])->links() }}
                </div>
            </div>

            <!-- Tab Video -->
            <div class="tab-pane fade {{ request('tab') === 'video' ? 'show active' : '' }}" id="video"
                role="tabpanel">
                <div class="row">
                    @forelse($videos as $video)
                        <div class="mb-4 col-md-4">
                            <div class="card h-100">
                                <div class="video-thumbnail" onclick="openYoutubeVideo('{{ $video->youtube_id }}')">
                                    <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/mqdefault.jpg"
                                        class="card-img-top" alt="{{ $video->judul }}">
                                    <div class="play-icon">
                                        <i class="fas fa-play-circle"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $video->judul }}</h5>
                                    <p class="card-text text-muted">
                                        <small>Oleh: {{ $video->user->name }} |
                                            {{ $video->created_at->format('d M Y') }}</small>
                                    </p>
                                    <p class="card-text">{{ Str::limit($video->deskripsi, 100) }}</p>
                                </div>
                                @auth
                                    @if (Auth::user()->id === $video->user_id)
                                        <div class="bg-white card-footer border-top-0">
                                            <a href="{{ route('edukasi.video.edit', $video->id_video) }}"
                                                class="btn btn-primary btn-sm me-2">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete('{{ route('edukasi.destroy-video', $video->id_video) }}')">
                                                Hapus
                                            </button>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info">
                                Belum ada video edukasi tersedia.
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $videos->appends(['tab' => request('tab'), 'search' => request('search')])->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk YouTube Video -->
    <div class="modal fade" id="youtubeModal" tabindex="-1" aria-labelledby="youtubeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="youtubeModalLabel">Video Edukasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ratio ratio-16x9">
                        <iframe id="youtubeIframe" src="" title="YouTube video" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah yakin ingin menghapus video ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteVideoForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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

        function confirmDelete(deleteUrl) {
            const deleteForm = document.getElementById('deleteVideoForm');
            deleteForm.action = deleteUrl;

            const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            modal.show();
        }

        function openYoutubeVideo(youtubeId) {
            const iframe = document.getElementById('youtubeIframe');
            iframe.src = `https://www.youtube.com/embed/${youtubeId}`;
            const modal = new bootstrap.Modal(document.getElementById('youtubeModal'));
            modal.show();
        }

        // Reset iframe when modal is closed to stop video playback
        document.getElementById('youtubeModal').addEventListener('hidden.bs.modal', function() {
            document.getElementById('youtubeIframe').src = '';
        });

        // Mengaktifkan tab sesuai parameter URL
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');

            if (tab === 'video') {
                const videoTab = document.getElementById('video-tab');
                videoTab.click();
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
