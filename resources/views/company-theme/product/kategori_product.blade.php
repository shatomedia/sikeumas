@extends('layouts.company_master')

@section('company-content')
    <!-- heroes section start -->
    <section class="hero-container" id="first-container">
        <div class="container align-items-center px-4 py-5">
            <div class="row flex-lg-row-reverse justify-content-center align-items-center g-5 py-lg-5">
                <div class="col-10 col-sm-5 col-lg-6 mx-auto">
                    <img src="/assets/img/png/jws-hero.jpg" class="d-block mx-lg-auto img-fluid" alt="Shatomedia" width="700"
                        height="500" loading="lazy" />
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold text-body-emphasis lh-2 mb-3" id="tittle-heroes">
                        Jadwal Waktu Sholat
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <!-- heroes section end -->

    <!-- list product section start -->
    <section class="best-container" id="bestContainer">
        <div class="container align-items-center text-center px-4 py-lg-5">
            <div class="row gy-4">
                <div class="collection col-lg-4 h-100">
                    <div class="card h-100">
                        <img src="/assets/img/png/WhatsApp-Image-2022-03-15-at-14.28.15.jpeg-1536x1152.jpg"
                            alt="" />
                        <div class="card-body">
                            <h5 class="fw-bold text-body-emphasis" id="tittle">Jam Sholat Digital JWS-M3</h5>
                            <p class="text-description" id="description">
                                Tampilan jadwal waktu sholat ( Shubuh, Dhuhur, Ashar, Maghrib,
                                Isya ). Ditambah dengan waktu syuruq/imsyak dan tampilan
                                tanggal, bulan, tahun, beserta jam dan menit secara Real Time
                                ,serta terdapat tambahan Running teks sebagai papan informasi.
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="/pages/jws-category/jws-product-1.html" class="btn" id="btn-buyNow">Beli
                                Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="collection col-lg-4">
                    <div class="card h-100">
                        <img src="/assets/img/png/WhatsApp-Image-2022-03-15-at-14.28.15.jpeg-1536x1152.jpg"
                            alt="" />
                        <div class="card-body">
                            <h5 class="fw-bold text-body-emphasis" id="tittle">Jam Sholat Digital JWS-M3</h5>
                            <p class="text-description" id="description">
                                Tampilan jadwal waktu sholat ( Shubuh, Dhuhur, Ashar, Maghrib,
                                Isya ). Ditambah dengan waktu syuruq/imsyak dan tampilan
                                tanggal, bulan, tahun, beserta jam dan menit secara Real Time
                                ,serta terdapat tambahan Running teks sebagai papan informasi.
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="/pages/jws-category/jws-product-1.html" class="btn" id="btn-buyNow">Beli
                                Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="collection col-lg-4">
                    <div class="card h-100">
                        <img src="/assets/img/png/WhatsApp-Image-2022-03-15-at-14.28.15.jpeg-1536x1152.jpg"
                            alt="" />
                        <div class="card-body">
                            <h5 class="fw-bold text-body-emphasis" id="tittle">Jam Sholat Digital JWS-M3</h5>
                            <p class="text-description" id="description">
                                Tampilan jadwal waktu sholat ( Shubuh, Dhuhur, Ashar, Maghrib,
                                Isya ). Ditambah dengan waktu syuruq/imsyak dan tampilan
                                tanggal, bulan, tahun, beserta jam dan menit secara Real Time
                                ,serta terdapat tambahan Running teks sebagai papan informasi.
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="/pages/jws-category/jws-product-1.html" class="btn" id="btn-buyNow">Beli
                                Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- best section end -->


    <!-- help and contact section start -->
    <section class="help-container">
        <div class="container mb-4 px-4 py-5">
            <div class="card px-4" id="card">
                <div class="row flex-row-reverse align-items-center mb-4">
                    <div class="col-10 col-lg-6 mx-auto">
                        <img src="/assets/img/png/jws-contact.png" class="d-block mx-lg-auto img-fluid" alt="Shatomedia"
                            width="500" height="500" loading="lazy" />
                    </div>
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
