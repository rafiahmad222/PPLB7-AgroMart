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
                            <input class="form-check-input" type="radio" name="tipe" id="tipeArtikel" value="artikel" checked>
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
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="artikelFields">
                        <div class="mb-3">
                            <label for="ringkasan" class="form-label">Ringkasan</label>
                            <textarea class="form-control @error('ringkasan') is-invalid @enderror" id="ringkasan" name="ringkasan" rows="3">{{ old('ringkasan') }}</textarea>
                            @error('ringkasan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="konten" class="form-label">Konten Artikel</label>
                            <textarea class="form-control @error('konten') is-invalid @enderror" id="konten" name="konten" rows="10">{{ old('konten') }}</textarea>
                            @error('konten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Artikel (Opsional)</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar">
                            <div class="form-text">Format yang didukung: JPEG, PNG, JPG, GIF. Ukuran maksimal: 2MB</div>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div id="videoFields" style="display: none;">
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Video</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="youtube_id" class="form-label">ID atau URL YouTube</label>
                            <input type="text" class="form-control @error('youtube_id') is-invalid @enderror" id="youtube_id" name="youtube_id" value="{{ old('youtube_id') }}">
                            <div class="form-text">Masukkan ID YouTube (misal: dQw4w9WgXcQ) atau URL lengkap (misal: https://www.youtube.com/watch?v=dQw4w9WgXcQ)</div>
                            @error('youtube_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
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
