@extends('blog.app')

@section('content')
<!-- Header Blog Modern -->
<div class="row mb-5 py-4 text-center text-md-start align-items-center">
    <div class="col-md-8">
        <h1 class="fw-extrabold display-5 mb-2 text-dark" style="letter-spacing: -1px;">Artikel Terbaru</h1>
        <p class="text-secondary lead mb-0">Tempatku berbagi cerita, opini, dan perjalanan hidup sehari-hari.</p>
    </div>
    <div class="col-md-4 text-center text-md-end mt-3 mt-md-0">
        @auth
        <a href="{{ route('blog.create') }}" class="btn btn-dark rounded-pill px-4 py-2 shadow-sm fw-medium">
            ✨ Tulis Artikel Baru
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

            <!-- Area Gambar dengan Hover Zoom -->
            <div class="position-relative overflow-hidden" style="height: 220px;">
                @if($post->image)
                <img src="{{ asset('images/' . $post->image) }}" class="card-img-top w-100 h-100 object-fit-cover blog-card-img" alt="{{ $post->title }}">
                @else
                <div class="bg-light text-muted d-flex flex-column align-items-center justify-content-center w-100 h-100">
                    <span class="fs-1 mb-1">🖼️</span>
                    <span class="small text-uppercase fw-semibold tracking-wider">No Image</span>
                </div>
                @endif
            </div>

            <!-- Isi Konten Card -->
            <div class="card-body d-flex flex-column p-4">
                <h4 class="card-title fw-bold text-dark mb-3 blog-title">
                    <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none text-dark link-primary">
                        {{ $post->title }}
                    </a>
                </h4>
                <p class="card-text text-secondary mb-4 flex-grow-1" style="line-height: 1.6;">
                    {{ Str::limit($post->content, 110) }}
                </p>

                <!-- Informasi Footer Kartu & Jumlah Pembaca -->
                <div class="d-flex align-items-center justify-content-between mt-auto pt-3 border-top border-light">
                    <span class="text-muted small fw-medium">
                        📅 {{ $post->created_at->diffForHumans() }} &nbsp;•&nbsp; 👁️ {{ $post->views }} dilihat
                    </span>
                    <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-link text-dark fw-bold text-decoration-none p-0 read-more-link">
                        Baca →
                    </a>
                </div>
            </div>

        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <div class="p-5 bg-light rounded-4">
            <span class="display-3">📝</span>
            <h3 class="text-dark fw-bold mt-3">Belum ada artikel</h3>
            <p class="text-secondary">Silakan kembali lagi nanti.</p>
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