@extends('layouts.company_master')

@section('company-content')
    <!-- heroes section start -->
    <section class="hero-container" id="first-container">
        <div class="container align-items-center px-4 py-5">
            <div class="row flex-lg-row-reverse justify-content-center align-items-center g-5 py-lg-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-5 fw-bold text-body-emphasis lh-2 mb-3" id="tittle-heroes">
                        Produk Shatomedia
                    </h1>
                    <p class="lead">
                        Solusi digital untuk masjid, rumah sakit, dan kebutuhan teknologi Anda.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- heroes section end -->

    <!-- list product section start -->
    <section class="best-container" id="bestContainer">
        <div class="container align-items-center text-center px-4 py-lg-5">
            <div class="row gy-4">
                @forelse ($products as $item)
                    <div class="collection col-lg-4 col-md-6 h-100">
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
                @empty
                    <p class="text-center">Belum ada produk yang ditampilkan.</p>
                @endforelse
            </div>
        </div>
    </section>
    <!-- best section end -->

    <!-- help and contact section start -->
    <section class="help-container">
        <div class="container mb-4 px-4 py-5">
            <div class="card px-4" id="card">
                <div class="row flex-row-reverse align-items-center mb-4">
                    <div class="col-lg-6 mt-4">
                        <h1 class="display-5 fw-bold text-body-emphasis lh-2 mb-4 mb-sm-4">
                            Bantuan & Kontak
                        </h1>
                        <p class="lead mb-4">
                            Team kami dengan senang hati membantu anda, silahkan hubungi kami dengan tombol dibawah
                            ini.
                        </p>
                        <a href="https://wa.me/6285743909116" target="_blank" class="btn" type="button"
                            id="btn-consultation">Konsultasi Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- help and contact section end -->
@endsection
