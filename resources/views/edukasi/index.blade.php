<!-- filepath: d:\PPL-AgroMart\resources\views\edukasi\index.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edukasi AgroMart</title>
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
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <nav class="flex items-center justify-between max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/Logo_AgroMart.png') }}" alt="Logo AgroMart" class="h-12">
                </a>
                <div class="items-center hidden gap-4 text-base font-semibold md:flex text-emerald-700 font-[signika]">
                    <a href="{{ route('home') }}" class="hover:text-emerald-400">HOME</a>
                    <div class="relative group">
                        <a href="{{ route('produk.index') }}"
                            class="flex items-center gap-1 hover:text-emerald-400">PRODUK</a>
                        <div
                            class="absolute hidden w-40 bg-white rounded-md shadow-lg z-5 group-hover:block animate-fadeIn text-emerald-600">
                            @foreach ($kategoris as $kategori)
                                <a href="{{ route('produk.index', $kategori->id_kategori) }}"
                                    class="block px-4 py-2 text-sm rounded-md text-emerald-700 hover:bg-gray-100 hover:text-emerald-400">{{ $kategori->nama_kategori }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('edukasi.index') }}" class="hover:text-emerald-400">EDUKASI</a>
                    <a href="#galeri" class="hover:text-emerald-400">GALERI</a>
                    <a href="{{ route('layanan.index') }}" class="hover:text-emerald-400">LAYANAN</a>
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('status.index') }}" class="hover:text-emerald-400">TRANSAKSI</a>
                    @else
                        <a href="{{ route('pesananku') }}" class="hover:text-emerald-400">TRANSAKSI</a>
                    @endif
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/notifIcon.png') }}" alt="Notifikasi"
                    class="w-10 h-10 transition-transform cursor-pointer hover:scale-110 active:scale-90">
                <div id="menuButton" class="relative">
                    <div class="flex items-center gap-2 cursor-pointer">
                        <img src="{{ Auth::user()->avatar_url }}" alt="Avatar"
                            class="w-12 h-12 border-2 rounded-full border-emerald-500">
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
                            <a href="{{ route('profile.adminshowuser') }}"
                                class="block px-4 py-2 text-sm rounded-md hover:bg-gray-100">Akun Customer</a>
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
        function confirmDelete(deleteUrl) {
            const deleteForm = document.getElementById('deleteVideoForm');
            deleteForm.action = deleteUrl;

            const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            modal.show();
        }
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
    </script>
</body>

</html>
