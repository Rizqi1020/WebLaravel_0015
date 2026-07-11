<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BERITAKU | Portal Berita Terkini')</title>
    
    <!-- CSS Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts: Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Roboto', sans-serif; 
            background-color: #f8f9fa;
            color: #333333;
        }

        /* Top Bar */
        .top-bar {
            background-color: #222222;
            color: #aaaaaa;
            font-size: 0.8rem;
            padding: 5px 0;
        }
        
        .top-bar a {
            color: #dddddd;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .top-bar a:hover {
            color: #ffffff;
        }

        /* Main Header */
        .main-header {
            background-color: #ffffff;
            padding: 20px 0;
            border-bottom: 1px solid #eeeeee;
        }
        
        .logo-text {
            font-weight: 900;
            font-size: 2.5rem;
            color: #dc3545; /* Red color for news */
            text-decoration: none;
            letter-spacing: -1px;
        }
        .logo-text span {
            color: #222222;
        }

        /* Navigation Menu */
        .news-navbar {
            background-color: #ffffff;
            border-bottom: 3px solid #dc3545;
            position: sticky;
            top: 0;
            z-index: 1020;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .nav-item-news {
            color: #333333;
            font-weight: 700;
            font-size: 0.95rem;
            padding: 12px 15px;
            text-transform: uppercase;
            text-decoration: none;
            transition: color 0.2s, background-color 0.2s;
        }

        .nav-item-news:hover, .nav-item-news.active {
            color: #dc3545;
            background-color: #f8f9fa;
        }

        .search-box {
            position: relative;
        }
        .search-box input {
            border-radius: 20px;
            padding-right: 35px;
            border: 1px solid #cccccc;
            font-size: 0.9rem;
        }
        .search-box .bi-search {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #888888;
        }

        /* Container Padding */
        .main-content {
            padding-top: 25px;
            padding-bottom: 60px;
            background-color: #ffffff;
            min-height: 80vh;
        }
    </style>
</head>
<body>

    <!-- Top Bar (Date & Small Links) -->
    <div class="top-bar d-none d-md-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <span class="me-3"><i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                <a href="#" class="me-3">Tentang Kami</a>
                <a href="#">Redaksi</a>
            </div>
            <div>
                @if(Auth::check())
                    <span class="me-3">Halo, <strong>{{ Auth::user()->name }}</strong></span>
                    <form action="{{ url('/logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 text-white text-decoration-none" style="font-size: 0.8rem;">Logout</button>
                    </form>
                @else
                    <a href="{{ url('/login') }}" class="me-3"><i class="bi bi-person-circle me-1"></i> Login</a>
                    <a href="{{ url('/register') }}">Daftar</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Header (Logo) -->
    <header class="main-header text-center text-md-start">
        <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
            <a href="/" class="logo-text">BERITA<span>KU</span></a>
        </div>
    </header>

    <!-- Sticky Navigation Bar -->
    <nav class="news-navbar navbar-expand-lg navbar-light">
        <div class="container d-flex align-items-center justify-content-between">
            
            <!-- Mobile Toggle -->
            <button class="navbar-toggler d-lg-none my-2 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#newsNav" aria-controls="newsNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-2"></i>
            </button>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="newsNav">
                <div class="d-flex flex-column flex-lg-row w-100 align-items-lg-center justify-content-between">
                    <div class="d-flex flex-column flex-lg-row">
                        <a href="/" class="nav-item-news active"><i class="bi bi-house-door-fill me-1 d-lg-none"></i>Home</a>
                        <a href="#" class="nav-item-news">Nasional</a>
                        <a href="#" class="nav-item-news">Megapolitan</a>
                        <a href="#" class="nav-item-news">Teknologi</a>
                        <a href="#" class="nav-item-news">Ekbis</a>
                        <a href="#" class="nav-item-news">Olahraga</a>
                        <a href="#" class="nav-item-news">Otomotif</a>
                        <a href="#" class="nav-item-news">Health</a>
                    </div>
                    
                    <!-- Search -->
                    <div class="search-box py-2 py-lg-0 my-2 my-lg-0">
                        <input type="text" class="form-control form-control-sm" placeholder="Cari berita...">
                        <i class="bi bi-search"></i>
                    </div>
                </div>
                
                <!-- Auth for mobile -->
                <div class="d-lg-none border-top pt-2 pb-3 mt-2">
                    @if(!Auth::check())
                        <a href="{{ url('/login') }}" class="btn btn-outline-danger btn-sm w-100 mb-2">Login</a>
                        <a href="{{ url('/register') }}" class="btn btn-danger btn-sm w-100">Daftar</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="container main-content shadow-sm">
        @yield('body')
    </div>
    
    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-4">
        <div class="container text-center text-md-start">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h4 class="fw-bold text-danger">BERITA<span class="text-white">KU</span></h4>
                    <p class="text-white-50 small mt-3" style="line-height: 1.6;"><strong>BeritaKu Network</strong> adalah jaringan portal digital terdepan di Indonesia. Kami berdedikasi untuk menyajikan jurnalisme yang independen, akurat, dan berimbang. Melalui perpaduan teknologi terkini dan laporan mendalam, kami memastikan Anda tidak pernah tertinggal dari arus informasi global maupun lokal.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="text-uppercase fw-bold">Kategori</h6>
                    <div class="row small">
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white-50 text-decoration-none hover-white">Nasional</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none hover-white">Teknologi</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none hover-white">Olahraga</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white-50 text-decoration-none hover-white">Ekbis</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none hover-white">Otomotif</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none hover-white">Health</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="text-uppercase fw-bold">Ikuti Kami</h6>
                    <div class="d-flex gap-3 fs-5">
                        <a href="#" class="text-white-50"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white-50"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="text-white-50"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white-50"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary border-opacity-50">
            <div class="text-center small text-white-50">
                &copy; {{ date('Y') }} BERITAKU. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>