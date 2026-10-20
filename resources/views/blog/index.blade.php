@extends('blog.app')

@section('content')
<style>
    /* Styling Tambahan Modern Blog */
    .blog-card {
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05) !important;
        background: #ffffff;
    }

    .blog-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.08) !important;
    }

    .blog-card-img {
        transition: transform 0.5s ease;
    }

    .blog-card:hover .blog-card-img {
        transform: scale(1.06);
    }

    .blog-title a {
        transition: color 0.2s ease;
    }

    .blog-card:hover .blog-title a {
        color: #0d6efd !important;
    }

    .read-more-link {
        transition: transform 0.2s ease;
    }

    .blog-card:hover .read-more-link {
        transform: translateX(4px);
    }

    .badge-blur {
        backdrop-filter: blur(8px);
        background: rgba(15, 23, 42, 0.65);
    }
</style>

<!-- Header Blog Modern -->
<div class="row mb-5 py-3 text-center text-md-start align-items-center">
    <div class="col-md-8">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-light border text-muted small fw-semibold mb-3">
            <span>🚀 Personal Thoughts & Notes</span>
        </div>
        <h1 class="fw-extrabold display-5 mb-2 text-dark tracking-tight" style="letter-spacing: -1.5px;">
            Artikel Terbaru
        </h1>
        <p class="text-secondary lead mb-0 fs-5">
            Tempatku berbagi cerita, opini, dan perjalanan hidup sehari-hari.
        </p>
    </div>
    <div class="col-md-4 text-center text-md-end mt-4 mt-md-0">
        @auth
        <a href="{{ route('blog.create') }}" class="btn btn-dark rounded-pill px-4 py-2.5 shadow-sm fw-medium d-inline-flex align-items-center gap-2">
            <span>✨</span> Tulis Artikel Baru
        </a>
        @endauth
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm p-3 mb-5" role="alert">
    <span class="fw-medium">🎉 {{ session('success') }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Grid Artikel Modern -->
<div class="row row-cols-1 row-cols-md-3 g-4">
    @forelse($posts as $post)
    <div class="col">
        <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden blog-card">

            <!-- Area Gambar dengan Hover Zoom & Dark Gradient Overlay -->
            <div class="position-relative overflow-hidden" style="height: 210px;">
                @if($post->image)
                <img src="{{ asset('images/' . $post->image) }}" class="card-img-top w-100 h-100 object-fit-cover blog-card-img" alt="{{ $post->title }}">
                @else
                <div class="bg-light text-muted d-flex flex-column align-items-center justify-content-center w-100 h-100">
                    <span class="fs-1 mb-1 opacity-50">🖼️</span>
                    <span class="small text-uppercase fw-semibold text-secondary tracking-wider" style="font-size: 0.75rem;">No Image</span>
                </div>
                @endif

                <!-- Badge Waktu Baca / Metrik di Atas Gambar -->
                <div class="position-absolute top-0 end-0 m-3">
                    <span class="badge badge-blur text-white rounded-pill px-3 py-1.5 fw-normal small shadow-sm">
                        👁️ {{ $post->views }}
                    </span>
                </div>
            </div>

            <!-- Isi Konten Card -->
            <div class="card-body d-flex flex-column p-4">
                <h5 class="card-title fw-bold text-dark mb-2 blog-title lh-sm" style="font-size: 1.2rem;">
                    <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none text-dark">
                        {{ $post->title }}
                    </a>
                </h5>

                <p class="card-text text-secondary mb-4 flex-grow-1 fs-6" style="line-height: 1.6; opacity: 0.85;">
                    {{ Str::limit(strip_tags($post->content), 100) }}
                </p>

                <!-- Informasi Footer Kartu -->
                <div class="d-flex align-items-center justify-content-between mt-auto pt-3 border-top border-light-subtle">
                    <span class="text-muted small fw-medium">
                        📅 {{ $post->created_at->diffForHumans() }}
                    </span>
                    <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-link text-dark fw-bold text-decoration-none p-0 read-more-link small">
                        Baca Artikel <span class="ms-1">→</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <div class="p-5 bg-light rounded-4 border border-dashed">
            <span class="display-3">📝</span>
            <h3 class="text-dark fw-bold mt-3">Belum ada artikel</h3>
            <p class="text-secondary mb-0">Silakan kembali lagi nanti saat artikel baru dipublikasikan.</p>
        </div>
    </div>
    @endforelse
</div>

<!-- Tombol Navigasi Halaman (Pagination) -->
<div class="d-flex justify-content-center mt-5 mb-5">
    <div class="laravel-pagination">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection