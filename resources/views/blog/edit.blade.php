@extends('blog.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm p-4 rounded-4 bg-white">
            <h2 class="fw-bold mb-4">✏️ Edit Artikel</h2>

            <form action="{{ route('blog.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Judul Artikel</label>
                    <input type="text" name="title" id="title" class="form-control rounded-3 @error('title') is-invalid @enderror" value="{{ old('title', $post->title) }}">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label fw-semibold">Ganti Gambar (Biarkan kosong jika tidak ingin diubah)</label>
                    <input type="file" name="image" id="image" class="form-control rounded-3 @error('image') is-invalid @enderror">
                    @if($post->image)
                    <div class="mt-2">
                        <small class="text-muted d-block">Gambar saat ini:</small>
                        <img src="{{ asset('images/' . $post->image) }}" class="rounded-3 mt-1" style="height: 100px; object-fit: cover;">
                    </div>
                    @endif
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="content" class="form-label fw-semibold">Isi Artikel</label>
                    <textarea name="content" id="content" rows="8" class="form-control rounded-3 @error('content') is-invalid @enderror">{{ old('content', $post->content) }}</textarea>
                    @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('blog.index') }}" class="btn btn-light rounded-pill px-4">Batal</a>
                    <button type="submit" class="btn btn-dark rounded-pill px-4">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection