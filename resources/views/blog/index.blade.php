@extends('blog.app')

@section('content')
<style>
    /* Hero Banner Styling */
    .hero-pill {
        background-color: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #065f46;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.02em;
    }

    .hero-title-highlight {
        background: linear-gradient(135deg, #064e3b 0%, #059669 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .btn-create-hero {
        background-color: #064e3b;
        color: #ffffff;
        border: 1px solid #047857;
        transition: all 0.25s ease;
    }

    .btn-create-hero:hover {
        background-color: #047857;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px -5px rgba(6, 78, 59, 0.25);
    }

    /* ==========================================
       COMPACT FEED LIST STYLING (Solusi 1)
       ========================================== */
    .feed-card {
        background: #ffffff;
        border: 1px solid #e2e8f0 !important;
        border-radius: 20px !important;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .feed-card:hover {
        transform: translateY(-4px);
        border-color: rgba(16, 185, 129, 0.4) !important;
        box-shadow: 0 16px 32px -8px rgba(6, 78, 59, 0.1) !important;
    }

    /* Thumbnail Kotak di Kiri */
    .feed-img-wrapper {
        width: 100%;
        height: 190px;
        border-radius: 14px;
        overflow: hidden;
        position: relative;
        background-color: #f1f5f9;
    }

    @media (min-width: 768px) {
        .feed-img-wrapper {
            width: 240px;
            height: 100%;
            min-height: 160px;
        }
    }

    .feed-img {
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .feed-card:hover .feed-img {
        transform: scale(1.06);
    }

    /* Placeholder jika Tanpa Gambar */
    .feed-placeholder {
        background: radial-gradient(circle at top right, rgba(251, 191, 36, 0.18), transparent 60%),
            linear-gradient(135deg, #064e3b 0%, #022c22 100%);
        color: #ffffff;
    }

    .placeholder-monogram-sm {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: rgba(251, 191, 36, 0.15);
        border: 1px solid rgba(251, 191, 36, 0.4);
        color: #fbbf24;
        font-weight: 800;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Badge & Info */
    .badge-glass-dark {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        background: rgba(15, 23, 42, 0.72);
        color: #ffffff;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 0.28rem 0.65rem;
        border-radius: 9999px;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .badge-new-amber {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: #064e3b;
        font-size: 0.65rem;
        font-weight: 800;
        letter-spacing: 0.04em;
        padding: 0.28rem 0.65rem;
        border-radius: 9999px;
        box-shadow: 0 3px 10px rgba(245, 158, 11, 0.3);
    }

    .feed-title {
        font-size: 1.15rem;
        font-weight: 800;
        line-height: 1.4;
        letter-spacing: -0.02em;
    }

    .feed-title a {
        color: #0f172a;
        transition: color 0.2s ease;
    }

    .feed-card:hover .feed-title a {
        color: #047857 !important;
    }

    .feed-excerpt {
        font-size: 0.9rem;
        line-height: 1.6;
        color: #64748b;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Author Avatar Mini */
    .author-avatar-sm {
        width: 26px;
        height: 26px;
        border-radius: 7px;
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: #064e3b;
        font-weight: 800;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* Tombol Panah Kecil */
    .btn-arrow-sm {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: #f1f5f9;
        color: #0f172a;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease;
    }

    .feed-card:hover .btn-arrow-sm {
        background-color: #fbbf24;
        color: #064e3b;
        transform: rotate(45deg);
    }
</style>

<!-- Header Blog Modern -->
<div class="row mb-5 py-3 text-center text-md-start align-items-center">
    <div class="col-md-8">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill hero-pill mb-3 shadow-sm">
            <span>🚀</span>
            <span>Personal Thoughts & Tech Notes</span>
        </div>
        <h1 class="fw-extrabold display-5 mb-2 text-dark" style="letter-spacing: -1.5px;">
            Eksplorasi & <span class="hero-title-highlight">Artikel Terbaru</span>
        </h1>
        <p class="text-secondary lead mb-0" style="font-size: 1.05rem; max-width: 580px;">
            Tempatku berbagi cerita, catatan eksperimen server, opini, dan perjalanan hidup sehari-hari.
        </p>
    </div>
    <div class="col-md-4 text-center text-md-end mt-4 mt-md-0">
        @auth
        <a href="{{ route('blog.create') }}" class="btn btn-create-hero rounded-pill px-4 py-2.5 fw-semibold d-inline-flex align-items-center gap-2 text-decoration-none">
            <span>✨</span> Tulis Artikel Baru
        </a>
        @endauth
    </div>
</div>

<!-- Flash Message Sukses -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm p-3 mb-4 d-flex align-items-center gap-2" style="background-color: #ecfdf5; color: #065f46;" role="alert">
    <span class="fs-5">🎉</span>
    <span class="fw-semibold">{{ session('success') }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Feed List Container (Menyamping ke bawah yang rapi) -->
<div class="d-flex flex-column gap-3 mb-5">
    @forelse($posts as $post)
    <article class="feed-card p-3 p-md-3">
        <div class="row g-3 align-items-center">

            <!-- Kolom Kiri: Thumbnail Gambar -->
            <div class="col-12 col-md-4 col-lg-3">
                <div class="feed-img-wrapper">
                    <a href="{{ route('blog.show', $post->slug) }}" class="d-block w-100 h-100 text-decoration-none">
                        @if($post->image)
                        <img src="{{ asset('images/' . $post->image) }}" class="w-100 h-100 object-fit-cover feed-img" alt="{{ $post->title }}">
                        @else
                        <div class="feed-placeholder d-flex flex-column align-items-center justify-content-center w-100 h-100 feed-img">
                            <div class="placeholder-monogram-sm mb-1">T.</div>
                            <span class="small text-uppercase fw-bold text-white-50" style="font-size: 0.6rem; letter-spacing: 0.08em;">TedzBlog</span>
                        </div>
                        @endif
                    </a>

                    <!-- Badge Baru / Views -->
                    <div class="position-absolute top-0 start-0 m-2 d-flex gap-1">
                        @if($post->created_at->gt(now()->subDays(7)))
                        <span class="badge-new-amber">✨ BARU</span>
                        @endif
                    </div>
                    <div class="position-absolute top-0 end-0 m-2">
                        <span class="badge-glass-dark">👁️ {{ number_format($post->views) }}</span>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Konten Judul, Cuplikan, & Metadata -->
            <div class="col-12 col-md-8 col-lg-9 d-flex flex-column justify-content-between">
                <div>
                    <!-- Meta Info (Tanggal & Waktu Baca) -->
                    <div class="d-flex align-items-center gap-2 text-muted small fw-medium mb-1.5" style="font-size: 0.78rem;">
                        <span>📅 {{ $post->created_at->diffForHumans() }}</span>
                        <span>•</span>
                        <span>⏱️ {{ max(1, ceil(str_word_count(strip_tags($post->content)) / 200)) }} min baca</span>
                        <span>•</span>
                        <span>💬 {{ $post->comments->count() }} komentar</span>
                    </div>

                    <!-- Judul -->
                    <h2 class="feed-title mb-2">
                        <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
                            {{ $post->title }}
                        </a>
                    </h2>

                    <!-- Cuplikan -->
                    <p class="feed-excerpt mb-3">
                        {{ Str::limit(strip_tags($post->content), 150) }}
                    </p>
                </div>

                <!-- Footer Card: Author & Aksi Baca/Edit -->
                <div class="d-flex align-items-center justify-content-between pt-2 border-top border-light-subtle mt-auto">
                    <div class="d-flex align-items-center gap-2">
                        <span class="author-avatar-sm">T.</span>
                        <span class="fw-bold text-dark" style="font-size: 0.8rem;">Irvan Teddy</span>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        @auth
                        <a href="{{ route('blog.edit', $post->slug) }}" class="btn btn-sm btn-light rounded-circle d-inline-flex align-items-center justify-content-center border" style="width: 30px; height: 30px;" title="Edit Artikel">
                            ✏️
                        </a>
                        @endauth

                        <a href="{{ route('blog.show', $post->slug) }}" class="btn-arrow-sm text-decoration-none" title="Baca Artikel">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
                            </svg>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </article>
    @empty
    <div class="text-center py-5">
        <div class="p-5 bg-white rounded-4 border shadow-sm mx-auto" style="max-width: 520px;">
            <span class="display-4 d-block mb-3">📝</span>
            <h4 class="text-dark fw-extrabold">Belum Ada Artikel</h4>
            <p class="text-secondary mb-4">Saat ini belum ada tulisan yang dipublikasikan.</p>
            @auth
            <a href="{{ route('blog.create') }}" class="btn btn-create-hero rounded-pill px-4 py-2 fw-semibold text-decoration-none">
                + Buat Artikel Pertama
            </a>
            @endauth
        </div>
    </div>
    @endforelse
</div>

<!-- Tombol Navigasi Halaman (Pagination) -->
<div class="d-flex justify-content-center mb-5">
    <div class="laravel-pagination">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection