<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Pribadi Irvan</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Gaya Huruf Ekstra Tebal untuk Header */
        .fw-extrabold {
            font-weight: 800;
        }

        /* Efek Modern pada Card Blog */
        .blog-card {
            transition: transform 0.3s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.3s ease;
            background-color: #ffffff;
        }

        /* Animasi Mengangkat Card saat Kursor Lewat */
        .blog-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.08) !important;
        }

        /* Animasi Zoom Halus pada Gambar */
        .blog-card-img {
            transition: transform 0.5s ease;
        }

        .blog-card:hover .blog-card-img {
            transform: scale(1.06);
        }

        /* Animasi Link Baca */
        .read-more-link {
            transition: transform 0.2s ease, color 0.2s ease;
        }

        .blog-card:hover .read-more-link {
            transform: translateX(4px);
            color: #0d6efd !important;
        }

        /* Merapikan Judul Blog */
        .blog-title {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-size: 1.25rem;
        }

        /* Menyembunyikan teks info pagination dan menyisakan tombol angkanya saja */
        .laravel-pagination .small.text-muted,
        .laravel-pagination p.text-muted {
            display: none !important;
        }

        .laravel-pagination nav {
            display: flex;
            justify-content: center;
        }

        /* Biar tombol halaman warna hitam serasi dengan navbar */
        .laravel-pagination .page-item.active .page-link {
            background-color: #212529 !important;
            border-color: #212529 !important;
            color: white !important;
        }

        .laravel-pagination .page-link {
            color: #212529;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-brand {
            font-weight: 700;
        }

        .card {
            border: none;
            border-radius: 12px;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-4px);
        }
    </style>
</head>

<body>

    <!-- Navbar Bersih & Terproteksi -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm py-3">
        <div class="container">
            <!-- Nama Blog Kerenmu -->
            <a class="navbar-brand fs-4" href="{{ route('blog.index') }}">🚀 TedzBlog</a>

            <div class="d-flex gap-2 align-items-center">
                @auth
                <!-- Muncul HANYA kalau sudah Login -->
                <a href="{{ route('blog.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">+ Tulis Artikel</a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm rounded-pill px-3">Logout</button>
                </form>
                @endauth

                @guest
                <!-- Muncul KALAU BELUM Login -->
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">Login</a>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Konten Dinamis Halaman -->
    <div class="container my-5">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-white text-center text-muted py-4 mt-5 border-top">
        <p class="mb-0">&copy; {{ date('Y') }} TedzBlog. Crafted with Laravel.</p>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>