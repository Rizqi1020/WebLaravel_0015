@extends('master')

@section('body')
<div class="row pt-4 pb-5">
    <div class="col-lg-8 mx-auto">
        
        <!-- Breadcrumb / Back button -->
        <div class="mb-4">
            <a href="{{ route('posts.index') }}" class="text-decoration-none text-muted">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
            </a>
        </div>

        <!-- News Header -->
        <div class="mb-4">
            <span class="badge bg-danger mb-2 rounded-1 px-2 py-1" style="font-size: 0.75rem;">{{ $post->category ?? 'NASIONAL' }}</span>
            <h1 class="fw-bold mb-3" style="font-size: 2.5rem; line-height: 1.2;">{{ $post->title }}</h1>
            
            <div class="text-muted d-flex align-items-center gap-3" style="font-size: 0.9rem;">
                <div><i class="bi bi-person me-1"></i> {{ $post->publisher ?? 'Redaksi' }}</div>
                <div><i class="bi bi-calendar3 me-1"></i> {{ $post->created_at ? $post->created_at->translatedFormat('d F Y') : 'Tanggal tidak diketahui' }}</div>
                <div><i class="bi bi-clock me-1"></i> {{ $post->created_at ? $post->created_at->diffForHumans() : '' }}</div>
            </div>
        </div>

        <!-- News Image -->
        @if(!empty($post->image))
            <div class="mb-4">
                <img src="{{ $post->image }}" class="img-fluid rounded-1 w-100 shadow-sm" alt="{{ $post->title }}" style="max-height: 500px; object-fit: cover;">
            </div>
        @endif

        <!-- News Content -->
        <div class="news-content fs-5" style="line-height: 1.8; color: #333;">
            {!! nl2br(e($post->content)) !!}
        </div>

    </div>
</div>
@endsection
