@extends('master')

@section('body')
<style>
    .news-title-link {
        color: #222222;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .news-title-link:hover {
        color: #dc3545;
    }
    
    .news-category-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #dc3545;
        letter-spacing: 0.5px;
    }

    .news-meta {
        font-size: 0.8rem;
        color: #888888;
    }

    /* Headline Styles */
    .headline-card {
        position: relative;
        overflow: hidden;
        border-radius: 4px;
        margin-bottom: 25px;
    }
    .headline-card img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .headline-card:hover img {
        transform: scale(1.05);
    }
    .headline-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0) 100%);
        padding: 60px 20px 20px 20px;
    }
    .headline-title {
        color: #ffffff;
        font-size: 2rem;
        font-weight: 900;
        line-height: 1.2;
        margin-bottom: 10px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }

    /* List Berita Styles */
    .news-list-item {
        border-bottom: 1px solid #eeeeee;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }
    .news-list-item:last-child {
        border-bottom: none;
    }
    .news-thumbnail {
        width: 100%;
        height: 140px;
        object-fit: cover;
        border-radius: 4px;
    }

    /* Sidebar Styles */
    .sidebar-title {
        font-weight: 900;
        text-transform: uppercase;
        font-size: 1.2rem;
        border-bottom: 3px solid #222222;
        padding-bottom: 10px;
        margin-bottom: 20px;
        position: relative;
    }
    .sidebar-title::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 60px;
        height: 3px;
        background-color: #dc3545;
    }

    .popular-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px dashed #dddddd;
    }
    .popular-number {
        font-size: 2.5rem;
        font-weight: 900;
        color: #e9ecef;
        line-height: 0.8;
        font-style: italic;
    }
    .popular-title {
        font-size: 0.95rem;
        font-weight: 700;
        line-height: 1.4;
    }
</style>

<div class="row pt-3">
    
    <!-- Kolom Kiri: Main Content -->
    <div class="col-lg-8 pe-lg-4">
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="m-0 fw-bold">Berita Utama</h4>
            <a href="{{ route('posts.create') }}" class="btn btn-danger fw-bold rounded-1"><i class="bi bi-plus-circle me-1"></i> Tambah Berita Baru</a>
        </div>
        
        @if($posts->isEmpty())
            <div class="alert alert-warning rounded-0 border-start border-4 border-warning">
                <i class="bi bi-exclamation-triangle me-2"></i> Belum ada berita hari ini.
            </div>
        @else
            <!-- HIGHLIGHT / HEADLINE (Berita Pertama) -->
            @php $headline = $posts->first(); @endphp
            <div class="headline-card shadow-sm">
                <a href="{{ route('posts.show', $headline->id) }}" class="text-decoration-none">
                    @if(!empty($headline->image))
                        <img src="{{ $headline->image }}" alt="Headline">
                    @else
                        <div class="bg-secondary d-flex justify-content-center align-items-center" style="height: 400px; width: 100%;">
                            <i class="bi bi-camera text-white-50" style="font-size: 4rem;"></i>
                        </div>
                    @endif
                    <div class="headline-overlay">
                        <span class="badge bg-danger mb-2 rounded-1 px-2 py-1" style="font-size: 0.75rem;">{{ $headline->category ?? 'SOROTAN UTAMA' }}</span>
                        <h1 class="headline-title">{{ $headline->title }}</h1>
                        <div class="text-white-50 small">
                            <i class="bi bi-clock me-1"></i> {{ $headline->created_at ? $headline->created_at->diffForHumans() : 'Baru saja' }}
                            <span class="mx-2">•</span>
                            Oleh: {{ $headline->publisher ?? 'REDAKSI' }}
                        </div>
                    </div>
                </a>
            </div>

            <!-- TERKINI (List Berita) -->
            <h4 class="sidebar-title mt-5">Berita Terkini</h4>
            
            <div class="news-list mt-4">
                @foreach ($posts->skip(1) as $post)
                <div class="row news-list-item">
                    <div class="col-4 col-md-3">
                        <a href="{{ route('posts.show', $post->id) }}">
                            @if(!empty($post->image))
                                <img src="{{ $post->image }}" class="news-thumbnail" alt="Thumbnail">
                            @else
                                <div class="bg-light news-thumbnail d-flex align-items-center justify-content-center border">
                                    <i class="bi bi-image text-muted fs-3"></i>
                                </div>
                            @endif
                        </a>
                    </div>
                    <div class="col-8 col-md-9 d-flex flex-column justify-content-center">
                        <div class="news-category-label mb-1">{{ $post->category ?? 'NASIONAL' }}</div>
                        <a href="{{ route('posts.show', $post->id) }}" class="news-title-link">
                            <h3 class="fw-bold mb-2" style="font-size: 1.2rem; line-height: 1.4;">{{ $post->title }}</h3>
                        </a>
                        <p class="text-muted d-none d-md-block mb-2" style="font-size: 0.9rem; line-height: 1.5;">
                            {{ Str::limit($post->content ?? '', 120) }}
                        </p>
                        <div class="news-meta mt-auto">
                            {{ $post->created_at ? $post->created_at->diffForHumans() : 'Beberapa saat lalu' }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
        
        <!-- Tombol Load More / Indeks Berita -->
        @if($posts->count() > 1)
        <div class="text-center mt-4 mb-5">
            <a href="#" class="btn btn-outline-danger px-5 py-2 fw-bold rounded-1" style="border-width: 2px;">Lihat Berita Lainnya</a>
        </div>
        @endif
    </div>

    <!-- Kolom Kanan: Sidebar Terpopuler -->
    <div class="col-lg-4 border-start ps-lg-4 mt-5 mt-lg-0">
        
        <!-- Terpopuler -->
        <h4 class="sidebar-title">Terpopuler</h4>
        
        <div class="popular-list mt-4">
            <div class="popular-item">
                <div class="popular-number">1</div>
                <div>
                    <a href="#" class="news-title-link popular-title">Dosen Puji Tugas Desain Mahasiswa Informatika yang Dibuat dalam Semalam</a>
                    <div class="news-meta mt-1">1 Jam yang lalu</div>
                </div>
            </div>
            
            <div class="popular-item">
                <div class="popular-number">2</div>
                <div>
                    <a href="#" class="news-title-link popular-title">Rilis Terbaru: Fitur Canggih di Laravel 11 Sangat Memudahkan Developer</a>
                    <div class="news-meta mt-1">3 Jam yang lalu</div>
                </div>
            </div>
            
            <div class="popular-item">
                <div class="popular-number">3</div>
                <div>
                    <a href="#" class="news-title-link popular-title">Tips Mendapatkan Nilai A+ di Praktikum Pemrograman Web</a>
                    <div class="news-meta mt-1">5 Jam yang lalu</div>
                </div>
            </div>
            
            <div class="popular-item border-0">
                <div class="popular-number">4</div>
                <div>
                    <a href="#" class="news-title-link popular-title">Mahasiswa Ini Berhasil Ciptakan Aplikasi Pendeteksi Kantuk Saat Ngoding</a>
                    <div class="news-meta mt-1">10 Jam yang lalu</div>
                </div>
            </div>
        </div>

        <!-- Kategori / Tags -->
        <h4 class="sidebar-title mt-5">Kategori Pilihan</h4>
        <div class="d-flex flex-wrap gap-2 mt-4 mb-5">
            <a href="#" class="btn btn-outline-secondary btn-sm rounded-0 border-secondary-subtle text-dark fw-semibold px-3 py-2">NASIONAL</a>
            <a href="#" class="btn btn-outline-secondary btn-sm rounded-0 border-secondary-subtle text-dark fw-semibold px-3 py-2">TEKNOLOGI</a>
            <a href="#" class="btn btn-outline-secondary btn-sm rounded-0 border-secondary-subtle text-dark fw-semibold px-3 py-2">EKONOMI</a>
            <a href="#" class="btn btn-outline-secondary btn-sm rounded-0 border-secondary-subtle text-dark fw-semibold px-3 py-2">OLAHRAGA</a>
            <a href="#" class="btn btn-outline-secondary btn-sm rounded-0 border-secondary-subtle text-dark fw-semibold px-3 py-2">OTOMOTIF</a>
            <a href="#" class="btn btn-outline-secondary btn-sm rounded-0 border-secondary-subtle text-dark fw-semibold px-3 py-2">HIBURAN</a>
            <a href="#" class="btn btn-outline-secondary btn-sm rounded-0 border-secondary-subtle text-dark fw-semibold px-3 py-2">GAYA HIDUP</a>
            <a href="#" class="btn btn-outline-secondary btn-sm rounded-0 border-secondary-subtle text-dark fw-semibold px-3 py-2">POLITIK</a>
            <a href="#" class="btn btn-outline-secondary btn-sm rounded-0 border-secondary-subtle text-dark fw-semibold px-3 py-2">KESEHATAN</a>
        </div>

    </div>

</div>
@endsection