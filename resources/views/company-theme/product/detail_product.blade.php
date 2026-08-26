@extends('layouts.company_master')

@section('company-content')
<div class="site-tech">
    <!-- heroes section start -->
    <section class="product-hero">
        <div class="container px-4 py-5">
            <div class="row flex-lg-row align-items-center justify-content-center g-5 py-lg-5">
                <div class="col-lg-12">
                    <p class="lead" id="description">
                        {{ $product->category->name ?? '' }}
                    </p>
                    <h1 class="display-5 fw-bold lh-2 mb-3" id="tittle">
                        {{ $product->nama }}
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <!-- heroes section end -->

    <!-- product description start -->
    <section class="product-description">
        <div class="container mt-5 px-4 py-lg-5">
            <div class="row">
                <!-- Section 1: Detail Produk -->
                <div class="col-lg-8">
                    <div class="product-description">
                        <p style="text-align: justify;">
                            {{ $product->deskripsi }}
                        </p>

                        {!! $product->spesifikasi !!}
                    </div>
                </div>

                <div class="order col-lg-4">
                    <div class="card neumorphic-card px-4">
                        <img src="{{ asset('products/' . $product->foto) }}" class="card-img-top product-image"
                            alt="{{ $product->nama }}">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-3">{{ $product->nama }}</h5>
                            <div class="col-lg-12 d-flex flex-column px-4">
                                <a href="https://wa.me/6285743909116?text={{ urlencode('Halo, saya tertarik dengan ' . $product->nama) }}"
                                    target="_blank" class="btn btn-whatsapp mb-3 neumorphic-btn">
                                    <img src="/assets/img/svg/icon-whatsapp.svg" alt="" width="30" height="30">
                                    <span>Tanya via WhatsApp</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product description end -->

    <!-- Section 2: Produk Lainnya -->
    @if ($otherProducts->count())
        <section class="best-container" id="bestContainer">
            <div class="container align-items-center px-4 py-5">
                <h1 class="fw-bold mt-xl-3 mb-4">Produk Lainnya</h1>
                <div class="row gy-4 text-center">
                    @foreach ($otherProducts as $item)
                        <div class="collection col-lg-4">
                            <div class="card h-100">
                                <img src="{{ asset('products/' . $item->foto) }}" alt="{{ $item->nama }}" />
                                <div class="card-body">
                                    <h5 class="fw-bold text-body-emphasis" id="tittle">{{ $item->nama }}</h5>
                                    <p class="text-description" id="description">
                                        {{ $item->deskripsi }}
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('product-detail', $item->slug) }}" class="btn" id="btn-buyNow">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>
@endsection
