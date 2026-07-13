@extends('layouts.company_master')

@section('title', 'Artikel Terbaru dan Inovasi dalam Internet of Things (IoT) | Shatomedia')

@push('meta-seo')
    <meta name="description" content="Temukan artikel dan panduan terbaru tentang Internet of Things (IoT). Jelajahi teknologi IoT yang mengubah cara kita berinteraksi dengan perangkat dan sistem di sekitar kita.">
    <meta name="keywords" content="Internet of Things, IoT, teknologi IoT, panduan IoT, artikel IoT, perangkat pintar, teknologi masa depan, smart devices">
    <meta name="author" content="Shatomedia" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ asset('company/img/png/hero-3.png') }}" />
    <meta property="og:title" content="Artikel dan Panduan Terbaru tentang Internet of Things (IoT) - Shatomedia" />
    <meta property="og:site_name" content="Shatomedia" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:description" content="Jelajahi dunia Internet of Things (IoT) dengan artikel dan panduan terbaru dari Shatomedia. Pelajari tentang perangkat pintar dan teknologi yang mengubah kehidupan sehari-hari." />
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:title" content="Artikel dan Panduan Terbaru tentang Internet of Things (IoT) - Shatomedia" />
    <meta property="twitter:description" content="Jelajahi dunia Internet of Things (IoT) dengan artikel dan panduan terbaru dari Shatomedia. Pelajari tentang perangkat pintar dan teknologi yang mengubah kehidupan sehari-hari." />
    <meta property="twitter:image" content="{{ asset('company/img/png/hero-3.png') }}" />
@endpush

@push('styles')
<style>
    :root {
        --primary-orange: #FF8C00; 
        --text-dark: #1a1a1a;
        --text-gray: #64748b;
    }

    .blog-container {
        background: #ffffff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        padding-top: 80px;
    }

    /* Memperbaiki Header Utama */
    .section-header {
        margin-bottom: 4rem;
    }

    .section-title {
        font-size: clamp(2.2rem, 5vw, 3.5rem);
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1.2 !important;
        letter-spacing: -0.02em;
        margin-bottom: 1.5rem;
    }

    .section-subtitle {
        line-height: 1.8;
        color: var(--text-gray);
        max-width: 700px;
        margin: 0 auto;
    }

    /* Memperbaiki Gambar & Badge */
    .img-wrapper {
        position: relative; 
        overflow: hidden;
    }

    .category-badge {
        position: absolute;
        top: 20px; /* Jarak dari atas ditambahkan */
        left: 20px; /* Jarak dari kiri ditambahkan */
        z-index: 10;
        background: rgba(255, 255, 255, 0.95);
        color: var(--primary-orange) !important; 
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    /* Memperbaiki Judul Artikel */
    .card-body {
        padding: 1.5rem !important; /* Memberikan ruang agar teks tidak mepet ke pinggir */
    }

    .card-title {
        font-size: 1.15rem; /* Sedikit dikecilkan agar lebih pas di card */
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1.5 !important;
        margin-bottom: 0;
        display: -webkit-box;
        -webkit-line-clamp: 3; 
        -webkit-box-orient: vertical;
        overflow: hidden;
        
        /* INI KUNCI UNTUK MEMPERBAIKI SPASI KATA YANG JAUH */
        text-align: left !important; 
        word-spacing: normal !important;
        letter-spacing: normal !important;
    }

    .features-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 20px !important;
        background: #fff;
    }

    .features-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08) !important;
    }
</style>
@endpush

@section('company-content')
<section class="blog-container">
    <div class="container py-5">
        
        <div class="section-header text-center">
            <h1 class="section-title">Wawasan & Inovasi IoT Terbaru</h1>
            <p class="section-subtitle">
                Temukan panduan mendalam dan artikel strategis mengenai masa depan teknologi pintar dan bagaimana ia mengubah dunia di sekitar kita.
            </p>
        </div>

        <div class="row g-4 mb-5">
            @forelse ($articles as $article)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('article-detail', $article->slug) }}" class="text-decoration-none">
                        <div class="card features-card h-100 border-0 shadow-sm">
                            
                            <div class="img-wrapper p-2"> 
                                @if($article->CategoryArtikel)
                                    <div class="category-badge">
                                        {{ $article->CategoryArtikel->nama }}
                                    </div>
                                @endif
                                
                                <img src="{{ asset('blogs/' . $article->gambar) }}" 
                                     class="rounded-4 w-100 object-fit-cover" 
                                     style="height: 240px;"
                                     alt="{{ $article->judul }}" />
                            </div>
                            
                            <div class="card-body">
                                <h5 class="card-title">{{ $article->judul }}</h5>
                            </div>
                            
                            <div class="card-footer bg-white border-0 px-4 pb-4 d-flex justify-content-between align-items-center">
                                <div class="date-wrapper d-flex align-items-center text-muted" style="font-size: 0.85rem;">
                                    <i class="bi bi-calendar-event me-2"></i>
                                    <span>{{ $article->publish_date->format('d M Y') }}</span>
                                </div>
                                <i class="bi bi-arrow-right fs-5" style="color: var(--primary-orange)"></i>
                            </div>
                            
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada artikel yang dipublikasikan.</p>
                </div>
            @endforelse
        </div>
        
    </div>
</section>
@endsection
