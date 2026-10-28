@extends('blog.app')

@section('content')
<div class="row justify-content-center my-5">
    <div class="col-md-5">
        <div class="card shadow p-4 rounded-4 bg-white">
            <h3 class="fw-bold text-center mb-4">🔒 Login Admin</h3>

            <form action="{{ url('/login') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" id="email" class="form-control rounded-3 @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="Enter Email mu bro...">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input type="password" name="password" id="password" class="form-control rounded-3" required placeholder="Password ? YTTA ">
                </div>

                <!-- Cloudflare Turnstile Widget -->
                <div class="mb-3">
                    <div class="cf-turnstile" data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}"></div>
                    @error('captcha')
                    <div class="text-danger small mt-1" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 fw-semibold">Masuk Mas Bro</button>
            </form>
        </div>
    </div>
</div>

<!-- Script Cloudflare Turnstile -->
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
@endsection