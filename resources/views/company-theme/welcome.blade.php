@extends('layouts.company_master')
@section('title', 'Shatomedia | Technology Inspiration')
@push('meta-seo')
    <meta name="description"
        content="Shatomedia adalah produsen elektronik yang menyediakan bahan baku berkualitas, tahan lama, dan teknologi terkini dengan desain elegan. Kami memberikan garansi perlindungan hingga 3 tahun untuk kepuasan pelanggan.">
    <meta name="keywords"
        content="jam sholat digital, jam digital, jam waktu sholat otomatis, jam adzan digital, jam adzan elektronik, jam digital untuk masjid, jam masjid, technology inspiration ">
    <meta name="author" content="Shatomedia" />
    <meta property="og:type" content="article" />
    <meta property="og:image" content="{{ asset('company/img/png/hero-3.png') }}" />
    <meta property="og:title" content="Shatomedia | Technology Inspiration" />
    <meta property="og:site_name" content="Shatomedia" />
    <meta property="og:url" content="https://shatomedia.com" />
    <meta property="og:description"
        content="Shatomedia adalah produsen elektronik yang menyediakan bahan baku berkualitas, tahan lama, dan teknologi terkini dengan desain elegan. Kami memberikan garansi perlindungan hingga 3 tahun untuk kepuasan pelanggan." />
@endpush

@section('company-content')
    <!-- heroes section start -->
    <section class="first-container" id="first-container">
        <div class="container align-items-center px-4 py-4">
            <div class="row flex-lg-row-reverse justify-content-center align-items-center g-5 py-5">
                <div class="col-10 col-sm-5 col-lg-6 mx-auto">
                    <img src="{{ asset('company/img/png/hero-3.png') }}" class="d-block mx-lg-auto img-fluid"
                        alt="Shatomedia" width="700" height="500" loading="lazy" />
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold text-body-emphasis lh-2 mb-3" id="tittle-heroes">
                        Koneksi Spiritual yang Lebih Kuat dengan Jadwal Sholat Digital
                        Terkini
                    </h1>
                    <p class="lead">
                        Mengacu pada Metode Hisab Ephemeris yang dikeluarkan oleh
                        Kementerian Agama Republik Indonesia
                    </p>
                    <div class="d-grid gap-4 d-flex justify-content-md-start align-items-center">
                        <a href="#bestContainer" type="button" id="btn-getNow" class="btn fw-bold">
                            Dapatkan Sekarang
                        </a>
                        <label class="fw-bold" id="label">
                            10.000+ Pelanggan
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- heroes section end -->

    <!-- best section start -->
    <section class="best-container" id="bestContainer">
        <div class="container align-items-center text-center px-4 py-lg-5">
            <h1 class="fw-bold mt-xl-3 mb-4">Koleksi Terbaik</h1>
            <div class="row gy-4">
                @foreach ($bestProducts as $item)
                    <div class="collection col-lg-4 col-md-6">
                        <div class="card h-100">
                            <img src="{{ asset('products/' . $item->foto) }}" alt="" />
                            <div class="card-body">
                                <h5 class="fw-bold text-body-emphasis" id="tittle">
                                    {{ $item->nama }}
                                </h5>
                                <p class="text-description" id="description">
                                    {{ $item->deskripsi }}
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="#" type="button" class="btn btn-primery" id="btn-buyNow">
                                    Beli Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- best section end -->

    <!-- intro section start -->
    <section class="intro-container" id="intro-container">
        <div class="container px-4 py-5">
            <div class="row flex-lg-row align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6 mx-auto">
                    <img src="{{ asset('company/img/png/Galaxy-Note-20-Ultra-768x576.png') }}"
                        class="d-block mx-lg-auto img-fluid" alt="Shatomedia" width="700" height="500"
                        loading="lazy" />
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold text-body-emphasis py-2">
                        Kenalin, Taqwa Digital Prayer Time.
                    </h1>
                    <p class="lead py-2" id="description">
                        Pengelolaan jam digital menggunakan smartphone telah menghadirkan
                        kemudahan dan keterhubungan yang belum pernah terjadi sebelumnya.
                    </p>
                    <p class="lead py-2" id="description">
                        Digital Prayer Time adalah Aplikasi yang dapat melakukan
                        perhitungan awal masuk Waktu Sholat dengan mengacu pada metode
                        Ephemeris yang dikeluarkan oleh Kementrian Agama Republik
                        Indonesia.
                    </p>
                    <div class="col-lg-6">
                        <a href="https://play.google.com/store/apps/details?id=com.shatomedia.taqwa&pcampaignid=web_share"
                            target="_blank" type="button" class="btn" id="btn-download">
                            Download App
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- intro section end -->

    <!-- manage time section end -->
    <section class="time-container">
        <div class="container mb-4 px-4 py-5">
            <div class="card px-4" id="card">
                <div class="row flex-row-reverse align-items-center mb-4">
                    <div class="col-10 col-lg-6 mx-auto">
                        <img src="{{ asset('company/img/png/Group-1000011745-2.png') }}"
                            class="d-block mx-lg-auto img-fluid" alt="Shatomedia" width="700" height="500"
                            loading="lazy" />
                    </div>
                    <div class="col-lg-6 mt-4">
                        <h1 class="display-5 fw-bold text-body-emphasis lh-2 mb-4 mb-sm-4">
                            Kemampuan Mengatur Waktu dengan Mudah.
                        </h1>
                        <p class="lead mb-4">
                            Kendalikan Waktu dengan Lebih Mudah. Jam yang Terkoneksi dengan
                            Smartphone dan Laptop Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- manage time section end -->

    <!-- gallery section start -->
    <section class="gallery-container">
        <div class="container px-4 py-5">
            <div class="title text-center mb-4">
                <h1 class="display-5 fw-bold lh-1 px-lg-5">
                    Tata Ruang Anda dengan Keindahan Kaligrafi dan Keterampilan Jam
                    Digital
                </h1>
            </div>
            <div class="row">
                <div class="image col-md-4 col-sm-6 mb-4">
                    <img src="{{ asset('company/img/png/1.jpg') }}" class="img-fluid" alt="jam" />
                </div>
                <div class="image col-md-4 col-sm-6 mb-4">
                    <img src="{{ asset('company/img/png/1.jpg') }}" class="img-fluid" alt="jam" />
                </div>
                <div class="image col-md-4 col-sm-6 mb-4">
                    <img src="{{ asset('company/img/png/3.jpg') }}" class="img-fluid" alt="jam" />
                </div>
            </div>
            <div class="d-flex justify-content-center button-gallery">
                <a href="#bestContainer" class="btn" id="btn-getNow">Dapatkan Sekarang</a>
            </div>
        </div>
    </section>
    <!-- gallery section end -->

    <!-- quality container start -->
    <section class="quality-container">
        <div class="container px-4 py-5">
            <div class="row flex-lg-row justify-content-center align-items-center">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="{{ asset('company/img/png/ketelitian.png') }}" class="d-block mx-lg-auto img-fluid"
                        alt="Bootstrap Themes" width="700" height="500" loading="lazy" />
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold lh-1 mb-3">
                        Ketelitian dalam Kerajinan, Kualitas yang Eksklusif.
                    </h1>
                    <p class="lead" id="description">
                        Setiap langkah dalam proses dilakukan dengan teliti dan penuh
                        perhatian terhadap detail, sehingga produk akhir memiliki estetika
                        yang mengagumkan. Kualitas eksklusif ini menciptakan daya tarik
                        dan nilai tambah yang tinggi bagi konsumen yang mencari produk
                        yang istimewa dan berbeda.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- quality container start -->

    <!-- support container start -->
    <section class="support-container">
        <div class="container py-5 px-4">
            <div class="flex justify-content-center align-items-center text-lg-center">
                <h1 class="display-5 fw-bold lh-2 mb-3">
                    Dukungan teknis perawatan jadwal waktu sholat digital.
                </h1>
                <p class="lead" id="description">
                    Setiap langkah dalam proses dilakukan dengan teliti dan penuh
                    perhatian terhadap detail, sehingga produk akhir memiliki estetika
                    yang mengagumkan. Kualitas eksklusif ini menciptakan daya tarik dan
                    nilai tambah yang tinggi bagi konsumen yang mencari produk yang
                    istimewa dan berbeda.
                </p>
                <a href="https://wa.me/6285743909116" target="_blank" class="btn" type="button"
                    id="btn-consultation">Konsultasi Sekarang</a>
            </div>
        </div>
    </section>
    <!-- support container end -->

    <!-- start experience section -->
    <section class="experience-container">
        <div class="container px-4 py-5">
            <div class="flex justify-content-center text-center align-items-center">
                <h1 class="tittle lh-1 fw-bold mb-3">Sebagian Pengalaman Kami</h1>
                <div class="row">
                    <div class="image col-md-4 col-sm-6 mb-4">
                        <img src="{{ asset('company/img/jpg/experience-1.jpg') }}" class="img-fluid rounded"
                            alt="jam" />
                    </div>
                    <div class="image col-md-4 col-sm-6 mb-4">
                        <img src="{{ asset('company/img/jpg/experience-3.jpg') }}" class="img-fluid rounded"
                            alt="jam" />
                    </div>
                    <div class="image col-md-4 col-sm-6 mb-4">
                        <img src="{{ asset('company/img/jpg/experience-4.jpg') }}" class="img-fluid rounded"
                            alt="jam" />
                    </div>
                    <div class="image col-md-4 col-sm-6 mb-4">
                        <img src="{{ asset('company/img/jpg/experience-5.jpg') }}" class="img-fluid rounded"
                            alt="jam" />
                    </div>
                    <div class="image col-md-4 col-sm-6 mb-4">
                        <img src="{{ asset('company/img/jpg/experience-6.jpg') }}" class="img-fluid rounded"
                            alt="jam" />
                    </div>
                    <div class="image col-md-4 col-sm-6 mb-4">
                        <img src="{{ asset('company/img/jpg/experience-7.jpg') }}" class="img-fluid rounded"
                            alt="jam" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end experience section -->
@endsection

