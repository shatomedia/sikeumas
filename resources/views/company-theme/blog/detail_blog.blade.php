@extends('layouts.company_master')

@section('company-content')
    <section>
        <div class="container py-5">
            <div class="row">
                <div class="col-md-9">
                    <h1 class="fw-bold">{{ $article->judul }}</h1>
                    <h5>{{ $article->publish_date->format('d F Y') }} . {{ ucwords($article->CategoryArtikel->nama) }}</h5>
                    <div>
                        <img src="{{ asset('blogs/' . $article->gambar) }}" class="card-img-top" alt="...">
                        <div class="mt-3">
                            {!! $article->konten !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-4">
                        <div>
                            <h1 class="fw-bold" style="border-bottom: 1px solid #000;">Lates Post</h1>
                        </div>
                        @foreach ($latestArticles as $latest)
                            <div class="row mb-2 lh-1">
                                <div class="col-4">
                                    <img src="{{ asset('blogs/' . $latest->gambar) }}" class="card-img-top" alt="">
                                </div>
                                <div class="col-8">
                                    <p class="fw-bold">{{ $latest->judul }}a</p>
                                    <p>{{ $latest->publish_date->format('d F Y') }}</p>
                                </div>
                            </div>
                        @endforeach

                        <div class="row mb-2">
                            <div class="col-4">
                                <img src="/assets/img/png/arduino-2.jpg" class="card-img-top" alt="">
                            </div>
                            <div class="col-8 lh-1">
                                <p class="fw-bold">Membuat Proyek Robot Mini dengan Arduino</p>
                                <p>20 Januari 2022</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
