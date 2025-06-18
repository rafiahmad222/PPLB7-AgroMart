<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Produk - AgroMart</title>
    <link rel="icon" type="image/png" sizes="45x45" href="images/icon-40x40.png">
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:wght@100..900&family=Signika:wght@300..700&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .sidebar-transition {
            transition: transform 0.3s ease-out, box-shadow 0.3s ease-out;
        }

        .sidebar-hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Hover effect untuk kategori links */
        .kategori-link {
            transition: all 0.2s ease-out;
        }

        .kategori-link:hover {
            transform: translateX(8px);
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

<body class="font-sans bg-gray-100">
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

    <main class="px-4 py-8 mx-auto max-w-7xl">
        <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">
            <form action="{{ route('produk.index') }}" method="GET" class="flex w-full gap-2 md:w-auto">
                <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}"
                    class="w-full px-4 py-2 border rounded-lg border-emerald-400 focus:outline-none focus:border-emerald-600 md:w-64">
                <button type="submit"
                    class="px-4 py-2 text-white rounded-lg bg-emerald-600 hover:bg-emerald-700">Cari</button>
            </form>
            @if (Auth::user()->hasRole('admin'))
                <a href="{{ route('produk.create') }}"
                    class="px-4 py-2 text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700">+ Tambah
                    Produk</a>
            @endif
        </div>

        <div class="flex flex-col gap-6 md:flex-row">
            <!-- Sidebar Kategori -->
            <aside
                class="sticky top-24 w-full p-4 mb-4 bg-white rounded-lg shadow md:w-64 md:mb-0 h-fit max-h-[calc(100vh-8rem)] overflow-y-auto sidebar-transition">
                <h3 class="mb-3 text-lg font-bold text-emerald-700">Kategori</h3>
                <ul>
                    <li>
                        <a href="#"
                            class="block px-2 py-2 transition-all duration-200 rounded text-emerald-600 kategori-link hover:bg-emerald-50"
                            data-id="">Semua Kategori</a>
                    </li>
                    @foreach ($kategoris as $kategori)
                        <li>
                            <a href="#"
                                class="block px-2 py-2 transition-all duration-200 rounded text-emerald-600 kategori-link hover:bg-emerald-50"
                                data-id="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</a>
                        </li>
                    @endforeach
                </ul>
            </aside>

            <!-- Produk Grid -->
            <section class="flex-1">
                <div id="product-grid"
                    class="grid grid-cols-1 gap-6 transition-opacity duration-500 opacity-100 sm:grid-cols-2 lg:grid-cols-3">
                    @include('produk._list', ['produks' => $produks])
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <x-footer></x-footer>
    <!-- Logout Confirmation Modal -->
    <div id="logoutModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div id="logoutModalBackdrop" class="absolute inset-0 bg-black/60"></div>
        <div class="relative w-full max-w-md p-6 mx-4 bg-white rounded-lg shadow-xl">
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor"
                    class="mx-auto mb-4 text-red-500" viewBox="0 0 16 16">
                    <path
                        d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                    <path
                        d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                </svg>
                <h3 class="mb-5 text-lg font-semibold text-gray-800">Konfirmasi Logout</h3>
                <p class="mb-6 text-gray-600">Apakah Anda yakin ingin keluar dari akun ini?</p>
                <div class="flex justify-center space-x-3">
                    <button id="cancelLogout"
                        class="px-4 py-2 font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
                        Batal
                    </button>
                    <button id="confirmLogout"
                        class="px-4 py-2 font-medium text-white bg-red-500 rounded-lg hover:bg-red-600">
                        Ya, Keluar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Dropdown user
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

        // Logout Confirmation Modal Logic
        const logoutButton = document.getElementById('logoutButton');
        const logoutModal = document.getElementById('logoutModal');
        const logoutModalBackdrop = document.getElementById('logoutModalBackdrop');
        const confirmLogout = document.getElementById('confirmLogout');
        const cancelLogout = document.getElementById('cancelLogout');
        const logoutForm = document.getElementById('logoutForm');

        logoutButton.addEventListener('click', function(e) {
            e.preventDefault();
            logoutModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden'); // Prevent scrolling when modal is open
        });

        function closeLogoutModal() {
            logoutModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        confirmLogout.addEventListener('click', function() {
            logoutForm.submit(); // Submit the logout form
        });

        cancelLogout.addEventListener('click', closeLogoutModal);
        logoutModalBackdrop.addEventListener('click', closeLogoutModal);

        // Filter produk berdasarkan kategori (AJAX)
        document.querySelectorAll('.kategori-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const kategoriId = this.getAttribute('data-id');
                const url = kategoriId ? `{{ url('/produk/filter') }}?kategori=${kategoriId}` :
                    `{{ url('/produk/filter') }}`;
                const productGrid = document.getElementById('product-grid');

                // Fade out
                productGrid.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                setTimeout(() => {
                    productGrid.innerHTML =
                        '<div class="py-10 text-center col-span-full text-emerald-600 animate-pulse">Loading...</div>';

                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            productGrid.innerHTML = html;
                            // Fade in
                            productGrid.classList.remove('opacity-0');
                            productGrid.classList.add('opacity-100');
                        })
                        .catch(error => {
                            productGrid.innerHTML =
                                '<div class="py-10 text-center text-red-600 col-span-full">Gagal memuat produk.</div>';
                            productGrid.classList.remove('opacity-0');
                            productGrid.classList.add('opacity-100');
                        });
                }, 400); // waktu fade out
            });
        });
        const searchForm = document.querySelector('form[action="{{ route('produk.index') }}"]');
        if (searchForm) {
            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const productGrid = document.getElementById('product-grid');
                const formData = new FormData(searchForm);
                const params = new URLSearchParams(formData).toString();
                const url = `{{ route('produk.index') }}?${params}`;

                // Fade out
                productGrid.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                setTimeout(() => {
                    productGrid.innerHTML =
                        '<div class="py-10 text-center col-span-full text-emerald-600 animate-pulse">Loading...</div>';

                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            // Ambil hanya isi grid produk dari response (jika response full HTML)
                            // Jika response partial (hanya grid), langsung tampilkan
                            productGrid.innerHTML = html;
                            productGrid.classList.remove('opacity-0');
                            productGrid.classList.add('opacity-100');
                        })
                        .catch(error => {
                            productGrid.innerHTML =
                                '<div class="py-10 text-center text-red-600 col-span-full">Gagal memuat produk.</div>';
                            productGrid.classList.remove('opacity-0');
                            productGrid.classList.add('opacity-100');
                        });
                }, 400);
            });
        }
        // Animasi sidebar saat scroll
        const sidebar = document.querySelector('aside');
        let lastScrollTop = 0;

        window.addEventListener('scroll', () => {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // Tambahkan class hover effect saat scroll naik
            if (scrollTop < lastScrollTop) {
                sidebar.classList.add('sidebar-hover');
            } else {
                sidebar.classList.remove('sidebar-hover');
            }

            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        });

        // Tambahkan efek klik untuk kategori
        document.querySelectorAll('.kategori-link').forEach(link => {
            link.addEventListener('click', function(e) {
                // Remove active state dari semua link
                document.querySelectorAll('.kategori-link').forEach(l => {
                    l.classList.remove('bg-emerald-50', 'font-medium');
                });

                // Add active state ke link yang diklik
                this.classList.add('bg-emerald-50', 'font-medium');
            });
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
