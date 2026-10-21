<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Pribadi Irvan - TedzBlog</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --emerald-950: #022c22;
            --emerald-900: #064e3b;
            --emerald-800: #065f46;
            --emerald-700: #047857;
            --emerald-600: #059669;
            --emerald-400: #34d399;
            --amber-400: #fbbf24;
        }

        body {
            background-color: #f8fafc;
            background-image:
                radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.06) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(251, 191, 36, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
            color: #0f172a;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .fw-extrabold {
            font-weight: 800;
        }

        /* Navbar Modern Tech Glassmorphism */
        .navbar-modern {
            background: rgba(6, 78, 59, 0.90) !important;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.06);
        }

        /* Brand Logo dengan Monogram T. Kuning/Amber */
        .brand-logo {
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #ffffff !important;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }

        .brand-logo:hover {
            opacity: 0.95;
            transform: translateY(-1px);
        }

        .brand-monogram {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: #064e3b;
            font-weight: 800;
            font-size: 1rem;
            box-shadow: 0 2px 10px rgba(251, 191, 36, 0.3);
        }

        /* Tombol Login & Action */
        .btn-login-modern {
            border: 1px solid rgba(52, 211, 153, 0.4);
            background: rgba(6, 95, 70, 0.8);
            color: #ffffff;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 0.45rem 1.35rem;
            border-radius: 9999px;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .btn-login-modern:hover {
            background-color: var(--amber-400);
            color: var(--emerald-950);
            border-color: var(--amber-400);
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(251, 191, 36, 0.35);
        }

        .btn-write-nav {
            background: linear-gradient(135deg, #10b981 0%, #047857 100%);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #ffffff;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 0.4rem 1.1rem;
            border-radius: 9999px;
            transition: all 0.2s ease;
        }

        .btn-write-nav:hover {
            background: linear-gradient(135deg, #34d399 0%, #059669 100%);
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        /* User Profile Badge */
        .user-badge {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ecfdf5;
            font-weight: 600;
            font-size: 0.825rem;
            padding: 0.4rem 0.95rem;
            border-radius: 9999px;
            border: 1px solid rgba(255, 255, 255, 0.14);
        }

        /* Card Blog Global Styling */
        .blog-card {
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            background-color: #ffffff;
            border: 1px solid #e2e8f0 !important;
        }

        .blog-card:hover {
            transform: translateY(-7px);
            border-color: rgba(16, 185, 129, 0.4) !important;
            box-shadow: 0 22px 40px -12px rgba(6, 78, 59, 0.12) !important;
        }

        .blog-card-img {
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .blog-card:hover .blog-card-img {
            transform: scale(1.07);
        }

        .blog-title {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-size: 1.2rem;
            letter-spacing: -0.02em;
        }

        .blog-title a {
            color: #0f172a;
            transition: color 0.2s ease;
        }

        .blog-card:hover .blog-title a {
            color: var(--emerald-700) !important;
        }

        .read-more-link {
            color: var(--emerald-800);
            transition: transform 0.2s ease, color 0.2s ease;
        }

        .blog-card:hover .read-more-link {
            transform: translateX(4px);
            color: var(--emerald-600) !important;
        }

        .text-hover-emerald {
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .text-hover-emerald:hover {
            color: var(--emerald-700) !important;
            transform: translateY(-2px);
        }

        /* Pagination Custom */
        .laravel-pagination .small.text-muted,
        .laravel-pagination p.text-muted {
            display: none !important;
        }

        .laravel-pagination nav {
            display: flex;
            justify-content: center;
        }

        .laravel-pagination .pagination {
            gap: 6px;
        }

        .laravel-pagination .page-link {
            border-radius: 10px !important;
            border: 1px solid #e2e8f0;
            color: var(--emerald-900);
            font-weight: 600;
            padding: 0.45rem 0.9rem;
            transition: all 0.2s ease;
        }

        .laravel-pagination .page-link:hover {
            background-color: #ecfdf5;
            border-color: #a7f3d0;
            color: var(--emerald-800);
        }

        .laravel-pagination .page-item.active .page-link {
            background-color: var(--emerald-900) !important;
            border-color: var(--emerald-900) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 10px rgba(6, 78, 59, 0.25);
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar Modern Tech Glassmorphism -->
    <nav class="navbar navbar-expand-lg navbar-modern sticky-top py-2">
        <div class="container py-1">

            <!-- Brand / Logo -->
            <a class="navbar-brand brand-logo d-flex align-items-center gap-2" href="{{ route('blog.index') }}">
                <span class="brand-monogram">T.</span>
                <span class="fs-5">Tedz<span style="color: #fbbf24;">Blog</span></span>
            </a>

            <!-- Toggle Mobile -->
            <button class="navbar-toggler border-0 shadow-none p-1 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>

            <!-- Right Area (Login / Auth User Actions) -->
            <div class="collapse navbar-collapse justify-content-end mt-3 mt-lg-0" id="navbarContent">
                <div class="d-flex flex-wrap align-items-center gap-2">
                    @auth
                    <a href="{{ route('blog.create') }}" class="btn btn-write-nav text-decoration-none">
                        ✨ Tulis Artikel
                    </a>
                    <span class="user-badge ms-lg-1">
                        👤 {{ Auth::user()->name }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm rounded-pill px-3 fw-medium" style="font-size: 0.825rem;">
                            Logout
                        </button>
                    </form>
                    @endauth

                    @guest
                    <a href="{{ route('login') }}" class="btn btn-login-modern text-decoration-none">
                        Login Admin
                    </a>
                    @endguest
                </div>
            </div>

        </div>
    </nav>

    <!-- Konten Dinamis Halaman -->
    <main class="container my-4 my-md-5 flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer Minimalis -->
    <footer class="bg-white border-top py-4 mt-auto">
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 text-center text-md-start">

                <!-- Branding & Tech Stack -->
                <div class="d-flex flex-column flex-sm-row align-items-center gap-1 gap-sm-2">
                    <a href="{{ route('blog.index') }}" class="text-decoration-none text-dark fw-extrabold small">
                        Irvan Teddy<span style="color: #f59e0b;">.</span>
                    </a>
                    <span class="text-muted d-none d-sm-inline">•</span>
                    <span class="text-secondary" style="font-size: 0.825rem;">
                        © {{ date('Y') }} Built with <strong class="text-dark">Laravel 12</strong>
                    </span>
                </div>

                <!-- Ikon Sosial Media SVG Inline -->
                <div class="d-flex align-items-center gap-3">
                    <!-- Instagram -->
                    <a href="https://instagram.com/_irvanst" target="_blank" class="text-secondary text-hover-emerald" title="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                        </svg>
                    </a>
                    <!-- Email -->
                    <a href="mailto:irvanteddy1@gmail.com" class="text-secondary text-hover-emerald" title="Email">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-.5a.5.5 0 0 0-.5.5v.217l7 4.2 7-4.2V4a.5.5 0 0 0-.5-.5zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.883z" />
                        </svg>
                    </a>
                    <!-- GitHub -->
                    <a href="https://github.com/irvanTeddy" target="_blank" class="text-secondary text-hover-emerald" title="GitHub">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.28.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8" />
                        </svg>
                    </a>
                </div>

            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>