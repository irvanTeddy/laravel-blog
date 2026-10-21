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

    /* Floating Badge di Atas Gambar */
    .badge-glass {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        background: rgba(15, 23, 42, 0.72);
        color: #ffffff;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.35rem 0.75rem;
        border-radius: 9999px;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    /* Placeholder Gambar Kosong yang Estetik */
    .empty-img-placeholder {
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        position: relative;
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
        <p class="text-secondary lead mb-0" style="font-size: 1.1rem; max-width: 600px;">
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
<div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm p-3 mb-5 d-flex align-items-center gap-2" style="background-color: #ecfdf5; color: #065f46;" role="alert">
    <span class="fs-5">🎉</span>
    <span class="fw-semibold">{{ session('success') }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Grid Artikel Modern -->
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @forelse($posts as $post)
    <div class="col">
        <article class="card h-100 rounded-4 shadow-sm overflow-hidden blog-card">

            <!-- Area Gambar dengan Floating Views Badge -->
            <div class="position-relative overflow-hidden" style="height: 215px;">
                <a href="{{ route('blog.show', $post->slug) }}" class="d-block w-100 h-100 text-decoration-none">
                    @if($post->image)
                    <img src="{{ asset('images/' . $post->image) }}" class="card-img-top w-100 h-100 object-fit-cover blog-card-img" alt="{{ $post->title }}">
                    @else
                    <div class="empty-img-placeholder d-flex flex-column align-items-center justify-content-center w-100 h-100 blog-card-img">
                        <span class="fs-1 mb-1 opacity-50">📄</span>
                        <span class="small text-uppercase fw-bold text-secondary" style="font-size: 0.7rem; letter-spacing: 0.08em;">TedzBlog Note</span>
                    </div>
                    @endif
                </a>

                <!-- Badge Jumlah Pembaca di Atas Gambar -->
                <div class="position-absolute top-0 end-0 m-3 badge-glass d-flex align-items-center gap-1">
                    <span>👁️</span>
                    <span>{{ number_format($post->views) }}</span>
                </div>
            </div>

            <!-- Isi Konten Card -->
            <div class="card-body d-flex flex-column p-4">
                <!-- Tanggal Rilis & Estimasi Waktu Baca -->
                <div class="d-flex align-items-center gap-2 text-muted small fw-medium mb-2" style="font-size: 0.8rem;">
                    <span>📅 {{ $post->created_at->diffForHumans() }}</span>
                    <span>•</span>
                    <span>⏱️ {{ max(1, ceil(str_word_count(strip_tags($post->content)) / 200)) }} min baca</span>
                </div>

                <!-- Judul Artikel -->
                <h5 class="card-title fw-bold mb-2 blog-title lh-sm">
                    <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
                        {{ $post->title }}
                    </a>
                </h5>

                <!-- Cuplikan Isi -->
                <p class="card-text text-secondary mb-4 flex-grow-1" style="font-size: 0.925rem; line-height: 1.65;">
                    {{ Str::limit(strip_tags($post->content), 105) }}
                </p>

                <!-- Footer Kartu -->
                <div class="d-flex align-items-center justify-content-between mt-auto pt-3 border-top border-light-subtle">
                    <span class="small fw-semibold text-secondary" style="font-size: 0.8rem;">
                        ✍️ Irvan Teddy
                    </span>
                    <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-link fw-bold text-decoration-none p-0 read-more-link small">
                        Baca Selengkapnya <span class="ms-1">→</span>
                    </a>
                </div>
            </div>

        </article>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <div class="p-5 bg-white rounded-4 border shadow-sm mx-auto" style="max-width: 520px;">
            <span class="display-4 d-block mb-3">📝</span>
            <h4 class="text-dark fw-extrabold">Belum Ada Artikel</h4>
            <p class="text-secondary mb-4">Saat ini belum ada tulisan yang dipublikasikan. Nantikan cerita dan catatan menarik berikutnya!</p>
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
<div class="d-flex justify-content-center mt-5 mb-4">
    <div class="laravel-pagination">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection