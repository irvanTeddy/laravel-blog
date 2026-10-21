@extends('blog.app')

@section('content')
<style>
    /* Styling Tambahan untuk Halaman Detail */
    .post-content-body {
        font-size: 1.125rem;
        line-height: 1.8;
        color: #334155;
    }

    .btn-back-hover {
        transition: all 0.2s ease;
    }

    .btn-back-hover:hover {
        background-color: #e2e8f0 !important;
        transform: translateX(-3px);
    }

    .share-card {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border: 1px solid #e2e8f0 !important;
        border-radius: 20px !important;
    }
</style>

<div class="row justify-content-center">
    <div class="col-lg-9 col-xl-8">

        <!-- Tombol Kembali ke Beranda -->
        <a href="{{ route('blog.index') }}" class="btn btn-light btn-sm rounded-pill px-3 py-2 mb-4 fw-semibold text-secondary btn-back-hover d-inline-flex align-items-center gap-1 shadow-sm">
            <span>&larr;</span> Kembali ke Beranda
        </a>

        <article class="bg-white p-4 p-md-5 rounded-4 shadow-sm border mb-4">

            <!-- Meta Informasi (Tanggal & Views) -->
            <div class="d-flex flex-wrap align-items-center gap-2 text-muted small fw-medium mb-3" style="font-size: 0.85rem;">
                <span>📅 Diterbitkan {{ $post->created_at->format('d M Y') }}</span>
                <span>•</span>
                <span>⏱️ {{ max(1, ceil(str_word_count(strip_tags($post->content)) / 200)) }} min baca</span>
                <span>•</span>
                <span>👁️ {{ number_format($post->views) }} dilihat</span>
            </div>

            <!-- Judul Artikel -->
            <h1 class="fw-extrabold display-6 mb-4 text-dark" style="letter-spacing: -0.03em; line-height: 1.25;">
                {{ $post->title }}
            </h1>

            <!-- Tombol Aksi CRUD (Khusus Admin) -->
            @auth
            <div class="d-flex align-items-center gap-2 mb-4 pb-3 border-bottom">
                <a href="{{ route('blog.edit', $post->slug) }}" class="btn btn-warning btn-sm rounded-pill px-3 fw-semibold text-white d-inline-flex align-items-center gap-1">
                    <span>✏️</span> Edit Artikel
                </a>
                <form action="{{ route('blog.destroy', $post->slug) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah kamu yakin ingin menghapus artikel ini secara permanen?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-semibold d-inline-flex align-items-center gap-1">
                        <span>🗑️</span> Hapus
                    </button>
                </form>
            </div>
            @endauth

            <!-- Gambar Utama / Thumbnail -->
            @if($post->image)
            <div class="mb-4 overflow-hidden rounded-4 shadow-sm" style="max-height: 440px;">
                <img src="{{ asset('images/' . $post->image) }}" class="img-fluid w-100 h-100 object-fit-cover" alt="{{ $post->title }}">
            </div>
            @endif

            <!-- Konten Artikel -->
            <div class="post-content-body mb-5" style="white-space: pre-line;">
                {{ $post->content }}
            </div>

            <!-- Bagian Share & Salin Link (Fitur Baru) -->
            <div class="share-card p-4 mt-5">
                <div class="row align-items-center g-3">
                    <div class="col-md-6 text-center text-md-start">
                        <h6 class="fw-extrabold text-dark mb-1">📢 Suka dengan artikel ini?</h6>
                        <p class="text-secondary small mb-0">Bagikan tulisan ini ke teman atau rekan kerjamu!</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-end gap-2">

                            <!-- Tombol WhatsApp -->
                            <a href="https://api.whatsapp.com/send?text={{ urlencode('Baca artikel menarik: ' . $post->title . ' - ' . request()->url()) }}"
                                target="_blank"
                                class="btn btn-success btn-sm rounded-pill px-3 fw-medium d-inline-flex align-items-center gap-1 text-decoration-none shadow-sm"
                                style="background-color: #25d366; border-color: #25d366;">
                                <span>💬</span> WhatsApp
                            </a>

                            <!-- Tombol Twitter / X -->
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}"
                                target="_blank"
                                class="btn btn-dark btn-sm rounded-pill px-3 fw-medium d-inline-flex align-items-center gap-1 text-decoration-none shadow-sm">
                                <span>🐦</span> X
                            </a>

                            <!-- Tombol Salin Link -->
                            <button type="button"
                                onclick="copyToClipboard('{{ request()->url() }}')"
                                class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-medium d-inline-flex align-items-center gap-1 bg-white shadow-sm">
                                <span>🔗</span> <span id="copyText">Salin Link</span>
                            </button>

                        </div>
                    </div>
                </div>
            </div>

        </article>

        <!-- Bagian Menampilkan Komentar -->
        <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm border mb-4">
            <h4 class="fw-bold mb-4 d-flex align-items-center gap-2">
                <span>💬</span> Komentar <span class="badge bg-light text-dark border fs-6">{{ $post->comments->count() }}</span>
            </h4>

            <div class="d-flex flex-column gap-3 mb-4">
                @forelse($post->comments as $comment)
                <div class="p-3 bg-light rounded-4 border-0">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="fw-bold mb-0 text-dark">👤 {{ $comment->name }}</h6>
                        <small class="text-muted" style="font-size: 0.78rem;">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="text-secondary mb-0 small" style="white-space: pre-line; line-height: 1.6;">{{ $comment->body }}</p>
                </div>
                @empty
                <div class="text-center py-4 text-muted fst-italic">
                    Belum ada komentar. Jadilah yang pertama berkomentar! ✨
                </div>
                @endforelse
            </div>

            <!-- Bagian Form Tulis Komentar -->
            <div class="pt-4 border-top">
                <h5 class="fw-bold mb-3">Tinggalkan Komentar</h5>

                <form action="{{ route('comment.store', $post->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label small fw-semibold text-secondary">Nama Kamu</label>
                        <input type="text" name="name" id="name" class="form-control rounded-3 shadow-none" placeholder="Masukkan nama..." required>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label small fw-semibold text-secondary">Isi Komentar</label>
                        <textarea name="body" id="body" rows="3" class="form-control rounded-3 shadow-none" placeholder="Tulis komentar sehat di sini..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark rounded-pill px-4 btn-sm fw-semibold">Kirim Komentar</button>
                </form>
            </div>
        </div>

    </div>
</div>

<!-- Script Kecil untuk Fitur Salin Link -->
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            const copyTextSpan = document.getElementById('copyText');
            copyTextSpan.innerText = 'Berhasil Disalin! ✨';

            setTimeout(function() {
                copyTextSpan.innerText = 'Salin Link';
            }, 2000);
        }, function(err) {
            alert('Gagal menyalin link.');
        });
    }
</script>
@endsection