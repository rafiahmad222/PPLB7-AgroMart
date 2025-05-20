<!-- filepath: d:\PPL-AgroMart\resources\views\edukasi\create.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Konten Edukasi - AgroMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1050;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 90%;
        }

        .modal-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .success-icon {
            color: #10B981;
        }

        .error-icon {
            color: #EF4444;
        }

        .fade-enter {
            animation: fadeIn 0.3s ease-out;
        }

        .fade-exit {
            animation: fadeOut 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
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
                transform: translateY(-20px);
            }
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="mb-4">
            <a href="{{ route('edukasi.index') }}" class="text-decoration-none">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Edukasi
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Tambah Konten Edukasi</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('edukasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Jenis Konten</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipe" id="tipeArtikel"
                                value="artikel" checked>
                            <label class="form-check-label" for="tipeArtikel">
                                Artikel
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipe" id="tipeVideo" value="video">
                            <label class="form-check-label" for="tipeVideo">
                                Video YouTube
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                            name="judul" value="{{ old('judul') }}">
                    </div>

                    <div id="artikelFields">
                        <div class="mb-3">
                            <label for="ringkasan" class="form-label">Ringkasan</label>
                            <textarea class="form-control @error('ringkasan') is-invalid @enderror" id="ringkasan" name="ringkasan" rows="3">{{ old('ringkasan') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="konten" class="form-label">Konten Artikel</label>
                            <textarea class="form-control @error('konten') is-invalid @enderror" id="konten" name="konten" rows="10">{{ old('konten') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Artikel (Opsional)</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                id="gambar" name="gambar">
                            <div class="form-text">Format yang didukung: JPEG, PNG, JPG, GIF. Ukuran maksimal: 2MB</div>
                        </div>
                    </div>

                    <div id="videoFields" style="display: none;">
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Video</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="youtube_id" class="form-label">ID atau URL YouTube</label>
                            <input type="text" class="form-control @error('youtube_id') is-invalid @enderror"
                                id="youtube_id" name="youtube_id" value="{{ old('youtube_id') }}">
                            <div class="form-text">Masukkan ID YouTube (misal: dQw4w9WgXcQ) atau URL lengkap (misal:
                                https://www.youtube.com/watch?v=dQw4w9WgXcQ)</div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div id="successModal" class="modal-backdrop fade-enter">
            <div class="text-center modal-content">
                <div class="modal-icon success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h4 class="mb-3">Berhasil!</h4>
                <p class="mb-4">{{ session('success') }}</p>
                <button onclick="closeSuccessModal()" class="px-4 btn btn-success">
                    OK
                </button>
            </div>
        </div>
    @endif

    <!-- Error Modal -->
    @if ($errors->any())
        <div id="errorModal" class="modal-backdrop fade-enter">
            <div class="text-center modal-content">
                <div class="modal-icon error-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h4 class="mb-3">Peringatan!</h4>
                <ul class="mb-4 list-unstyled text-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button onclick="closeErrorModal()" class="px-4 btn btn-danger">
                    OK
                </button>
            </div>
        </div>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        function closeSuccessModal() {
            const modal = document.getElementById('successModal');
            if (modal) {
                modal.classList.replace('fade-enter', 'fade-exit');
                setTimeout(() => {
                    window.location.href = "{{ route('edukasi.index') }}";
                }, 300);
            }
        }

        function closeErrorModal() {
            const modal = document.getElementById('errorModal');
            if (modal) {
                modal.classList.replace('fade-enter', 'fade-exit');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 300);
            }
        }

        // Auto-show modals
        document.addEventListener('DOMContentLoaded', function() {
            const successModal = document.getElementById('successModal');
            const errorModal = document.getElementById('errorModal');

            if (successModal) successModal.classList.add('fade-enter');
            if (errorModal) errorModal.classList.add('fade-enter');
        });
        $(document).ready(function() {
            // Summernote
            $('#konten').summernote({
                placeholder: 'Tulis konten artikel lengkap di sini...',
                tabsize: 2,
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Toggle fields based on content type
            $('input[name="tipe"]').change(function() {
                if ($(this).val() === 'artikel') {
                    $('#artikelFields').show();
                    $('#videoFields').hide();
                } else {
                    $('#artikelFields').hide();
                    $('#videoFields').show();
                }
            });
        });
    </script>
</body>

</html>
