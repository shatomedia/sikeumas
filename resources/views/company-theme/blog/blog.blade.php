@extends('layouts.company_master')

@section('company-content')
    <section class="blog-container">
        <div class="container align-items-center py-5 px-4 py-lg-5">

            <div class="row d-flex gy-4 mb-5">
                <h3 class="fw-bold mt-2">Recent Post</h3>
                @foreach ($articles as $article)
                    <div class="collection col-lg-3">
                        <a href="{{ route('article-detail', $article->slug) }}" class="card-link"
                            style="text-decoration: none;">
                            <div class="card features-card h-100">
                                <img src="{{ asset('blogs/' . $article->gambar) }}" class="card-img-top" alt="" />
                                <div class="card-body">
                                    <h5 class="card-title">{{ $article->judul }}</h5>
                                </div>
                                <div class="card-footer">
                                    <p id="date-blog">{{ $article->publish_date->format('d F Y') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
