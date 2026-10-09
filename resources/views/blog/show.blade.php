@extends('blog.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <a href="{{ route('blog.index') }}" class="btn btn-light btn-sm rounded-pill px-3 mb-4">&larr; Kembali ke Beranda</a>

        <article>


            <h1 class="fw-bold display-5 mb-3">{{ $post->title }}</h1>
            <p class="text-muted mb-4">Diterbitkan pada: {{ $post->created_at->format('d M Y') }}</p>

            <!-- Tombol Aksi CRUD -->
            @auth
            <!-- Tombol Aksi CRUD -->
            <div class="d-flex gap-2 mb-4">
                <a href="{{ route('blog.edit', $post->slug) }}" class="btn btn-warning btn-sm rounded-pill px-3 text-white">✏️ Edit</a>
                <form action="{{ route('blog.destroy', $post->slug) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus artikel ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3">🗑️ Hapus</button>
                </form>
            </div>
            @endauth

            @if($post->image)
            <img src="{{ asset('images/' . $post->image) }}" class="img-fluid rounded-4 w-100 mb-4 shadow-sm" style="max-height: 400px; object-fit: cover;" alt="{{ $post->title }}">
            @endif

            <div class="fs-5 lh-base text-secondary" style="white-space: pre-line;">
                {{ $post->content }}
            </div>
        </article>

        <hr class="my-5">

        <!-- Bagian Menampilkan Komentar -->
        <div class="mb-5">
            <h4 class="fw-bold mb-4">💬 Komentar ({{ $post->comments->count() }})</h4>

            @forelse($post->comments as $comment)
            <div class="card p-3 mb-3 bg-white shadow-sm border-0 rounded-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="fw-bold mb-0">👤 {{ $comment->name }}</h6>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
                <p class="text-secondary mb-0" style="white-space: pre-line;">{{ $comment->body }}</p>
            </div>
            @empty
            <p class="text-muted italic">Belum ada komentar. Jadilah yang pertama berkomentar! ✨</p>
            @endforelse
        </div>

        <!-- Bagian Form Tulis Komentar -->
        <div class="card p-4 rounded-4 bg-white shadow-sm mb-5">
            <h5 class="fw-bold mb-3">Tinggalkan Komentar</h5>

            <form action="{{ route('comment.store', $post->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label small fw-semibold">Nama Kamu</label>
                    <input type="text" name="name" id="name" class="form-control rounded-3" placeholder="Masukkan nama..." required>
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label small fw-semibold">Isi Komentar</label>
                    <textarea name="body" id="body" rows="4" class="form-control rounded-3" placeholder="Tulis komentar sehat di sini..." required></textarea>
                </div>
                <button type="submit" class="btn btn-dark rounded-pill px-4 btn-sm">Kirim Komentar</button>
            </form>
        </div>

    </div>
</div>
@endsection