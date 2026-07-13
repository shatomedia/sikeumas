@extends('layouts.company_master')

@section('title', $article->judul . '| Shatomedia')
@push('meta-seo')
    <meta name="description"
        content="{{ Str::limit(strip_tags($article->konten), 200, '...') ?? 'Baca artikel lengkap tentang ' . $article->judul . ' dari Shatomedia. Temukan informasi mendalam dan panduan terbaru tentang teknologi dan produk.' }}">
    <meta name="keywords"
        content="{{ implode(', ', $article->keywords ?? ['artikel teknologi', 'Shatomedia', $article->judul]) }}">
    <meta name="author" content="Shatomedia" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $article->judul }} - Shatomedia" />
    <meta property="og:description"
        content="{{ $article->meta_description ?? 'Baca artikel lengkap tentang ' . $article->judul . ' dan temukan informasi mendalam dan panduan terbaru.' }}" />
    <meta property="og:image" content="{{ asset('blogs/' . $article->gambar) }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="Shatomedia" />
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:title" content="{{ $article->judul }} - Shatomedia" />
    <meta property="twitter:description"
        content="{{ Str::limit(strip_tags($article->konten), 200, '...') ?? 'Baca artikel lengkap tentang ' . $article->judul . ' dan temukan informasi mendalam dan panduan terbaru.' }}" />
    <meta property="twitter:image" content="{{ asset('blogs/' . $article->gambar) }}" />
@endpush
@push('styles')
<style>
    :root {
        --primary-orange: #FF8C00;
        --text-dark: #2d3436;
        --text-muted: #636e72;
        --bg-light: #f8f9fa;
    }

    .article-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1.2;
        margin-bottom: 1.5rem;
    }

    .article-meta {
        display: flex;
        align-items: center;
        gap: 15px;
        color: var(--text-muted);
        font-weight: 500;
        margin-bottom: 2rem;
    }

    .badge-category {
        background-color: rgba(255, 140, 0, 0.1);
        color: var(--primary-orange);
        padding: 5px 15px;
        border-radius: 50px;
        font-size: 0.85rem;
        text-transform: uppercase;
        font-weight: 700;
    }

    .main-image-wrapper {
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 2.5rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .article-content {
        font-size: 1.15rem;
        line-height: 1.8;
        color: #444;
    }

    .article-content img {
        max-width: 100%;
        border-radius: 15px;
        margin: 20px 0;
    }

    /* Sidebar Styling */
    .sidebar-title {
        font-size: 1.25rem;
        font-weight: 700;
        position: relative;
        padding-bottom: 10px;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid #eee;
    }

    .sidebar-title::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 50px;
        height: 2px;
        background: var(--primary-orange);
    }

    .latest-card {
        display: flex;
        gap: 12px;
        text-decoration: none !important;
        margin-bottom: 1.2rem;
        transition: transform 0.2s ease;
    }

    .latest-card:hover {
        transform: translateX(5px);
    }

    .latest-img {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
    }

    .latest-info-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 2px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .latest-info-date {
        font-size: 0.8rem;
        color: var(--text-muted);
    }
    .ck-content p {
    margin-bottom: 1.5rem;
    line-height: 1.8;
    }
    .ck-content img {
      max-width: 100%;
      height: auto;
      border-radius: 10px;
    }
</style>
@endpush

@section('company-content')
    <section class="bg-white">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('blog') }}" class="text-decoration-none text-orange" style="color: var(--primary-orange)">Blog</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>

                    <h1 class="article-title">{{ $article->judul }}</h1>
                    
                    <div class="article-meta">
                        <span class="badge-category">{{ optional($article->CategoryArtikel)->nama ?? 'General' }}</span>
                        <span>•</span>
                        <span><i class="bi bi-calendar3 me-1"></i> {{ $article->publish_date->format('d F Y') }}</span>
                    </div>

                    <div class="main-image-wrapper">
                        <img src="{{ asset('blogs/' . $article->gambar) }}" class="w-100" alt="{{ $article->judul }}">
                    </div>

                    <div class="article-content ck-content">
                        {!! $article->konten !!}
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 100px;">
                        <h4 class="sidebar-title">Latest Posts</h4>
                        
                        @foreach ($latestArticles as $latest)
                            <a href="{{ route('article-detail', $latest->slug) }}" class="latest-card">
                                <img src="{{ asset('blogs/' . $latest->gambar) }}" class="latest-img" alt="{{ $latest->judul }}">
                                <div class="latest-info">
                                    <div class="latest-info-title">{{ $latest->judul }}</div>
                                    <div class="latest-info-date">{{ $latest->publish_date->format('d M Y') }}</div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
