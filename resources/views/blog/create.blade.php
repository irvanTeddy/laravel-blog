@extends('blog.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm p-4 rounded-4 bg-white">
            <h2 class="fw-bold mb-4">📝 Tulis Artikel Baru</h2>

            <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Judul Artikel</label>
                    <input type="text" name="title" id="title" class="form-control rounded-3 @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Masukkan judul menarik...">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label fw-semibold">Foto / Gambar Sampul</label>
                    <input type="file" name="image" id="image" class="form-control rounded-3 @error('image') is-invalid @enderror">
                    <small class="text-muted">Format: JPG, JPEG, PNG (Maks. 2MB)</small>
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="content" class="form-label fw-semibold">Isi Artikel</label>
                    <textarea name="content" id="content" rows="8" class="form-control rounded-3 @error('content') is-invalid @enderror" placeholder="Tuliskan cerita atau tutorialmu di sini...">{{ old('content') }}</textarea>
                    @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('blog.index') }}" class="btn btn-light rounded-pill px-4">Batal</a>
                    <button type="submit" class="btn btn-dark rounded-pill px-4">Terbitkan Artikel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection