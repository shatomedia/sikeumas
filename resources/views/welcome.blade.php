<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shatomedia - Technology Inspiration</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('company/dist/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('company/css/styles.css') }}" />

    <!-- Font Nunito -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet" />
</head>

<body>
    <!-- navbar start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('company/img/png/navbar-logo.png') }}" width="159" height="43"
                    alt="Shatomedia" />
            </a>
            <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-2">
                        <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">Tentang Kami</a>
                    </li>
                    <li class="nav-item mx-2 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Produk
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Jadwal Waktu Sholat</a></li>
                            <li><a class="dropdown-item" href="#">Kit Modul</a></li>
                            <li><a class="dropdown-item" href="#">Jam Digital</a></li>
                            <li><a class="dropdown-item" href="#">Bell Otomatis</a></li>
                        </ul>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">Kontak Kami</a>
                    </li>
                </ul>
                <div class="btn-help d-none d-lg-block">
                    <button class="btn" id="btn-contact">
                        Hubungi Kami: 081821290098
                    </button>
                </div>
                <div class="btn-login mx-2">
                    <a href="{{ route('login') }}" class="btn w-100" id="btn-login">
                        Masuk
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- main start -->
    <main>
        <!-- heroes section start -->
        <section class="first-container" id="first-container">
            <div class="container align-items-center px-4 py-5">
                <div class="row flex-lg-row-reverse justify-content-center align-items-center g-5 py-5">
                    <div class="col-10 col-sm-5 col-lg-6 mx-auto">
                        <img src="{{ asset('company/img/png/hero-img.png') }}" class="d-block mx-lg-auto img-fluid"
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
            <div class="container align-items-center text-center px-4 py-5">
                <h2 class="display-5 fw-bold mt-xl-3 mb-4">Koleksi Terbaik</h2>
                <div class="row gy-4">
                    <div class="collection col-lg-4">
                        <div class="card" style="width: 360; height: 250">
                            <img src="{{ asset('company/img/png/WhatsApp-Image-2022-03-15-at-14.28.15.jpeg-1536x1152.jpg') }}"
                                alt="" />
                            <div class="card-body">
                                <h5 class="fw-bold text-body-emphasis" id="tittle">Jam Sholat Digital JWS-M3</h5>
                                <p class="text-description" id="description">
                                    Tampilan jadwal waktu sholat ( Shubuh, Dhuhur, Ashar, Maghrib,
                                    Isya ). Ditambah dengan waktu syuruq/imsyak dan tampilan
                                    tanggal, bulan, tahun, beserta jam dan menit secara Real Time
                                    ,serta terdapat tambahan Running teks sebagai papan informasi.
                                </p>
                                <a href="#" class="btn" id="btn-buyNow">Beli Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <div class="collection col-lg-4">
                        <div class="card" style="width: 360; height: 250">
                            <img src="{{ asset('company/img/png/WhatsApp-Image-2022-03-15-at-14.28.15.jpeg-1536x1152.jpg') }}"
                                alt="" />
                            <div class="card-body">
                                <h5 class="fw-bold text-body-emphasis" id="tittle">Jam Sholat Digital JWS-M3</h5>
                                <p class="text-description" id="description">
                                    Tampilan jadwal waktu sholat ( Shubuh, Dhuhur, Ashar, Maghrib,
                                    Isya ). Ditambah dengan waktu syuruq/imsyak dan tampilan
                                    tanggal, bulan, tahun, beserta jam dan menit secara Real Time
                                    ,serta terdapat tambahan Running teks sebagai papan informasi.
                                </p>
                                <a href="#" class="btn" id="btn-buyNow">Beli Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <div class="collection col-lg-4">
                        <div class="card" style="width: 360; height: 250">
                            <img src="{{ asset('company/img/png/WhatsApp-Image-2022-03-15-at-14.28.15.jpeg-1536x1152.jpg') }}"
                                alt="" />
                            <div class="card-body">
                                <h5 class="fw-bold text-body-emphasis" id="tittle">Jam Sholat Digital JWS-M3</h5>
                                <p class="text-description" id="description">
                                    Tampilan jadwal waktu sholat ( Shubuh, Dhuhur, Ashar, Maghrib,
                                    Isya ). Ditambah dengan waktu syuruq/imsyak dan tampilan
                                    tanggal, bulan, tahun, beserta jam dan menit secara Real Time
                                    ,serta terdapat tambahan Running teks sebagai papan informasi.
                                </p>
                                <a href="#" class="btn" id="btn-buyNow">Beli Sekarang</a>
                            </div>
                        </div>
                    </div>
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
                        <!-- <div class="image col-md-4 col-sm-6 mb-4">
                            <img src="/company/img/jpg/experience-2.jpg" class="img-fluid rounded" alt="jam" />
                        </div>                 -->
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

        <!-- star footer section -->
        <section class="footer-container bg-body-tertiary">
            <div class="container d-flex flex-column justify-content-between px-4 py-5">
                <footer>
                    <div class="row justify-content-between row-cols-1 row-cols-sm-2 row-cols-md-5 py-2 my-2">
                        <div class="col mb-3">
                            <h5 class="fw-bold mb-2">Kantor Pusat:</h5>
                            <ul class="nav flex-column mb-2">
                                <li class="nav-item mb-2">
                                    <p class="nav-link p-0 text-body-secondary" style="text-align:left;">
                                        Jl. Wates KM.11 Perum GKP Blok BC.2/11, Sedayu, Kabupaten Bantul,Daerah Istimewa
                                        Yogyakarta, 55752
                                    </p>
                                </li>
                            </ul>
                            <h5 class="fw-bold mb-2">Kantor Cilacap:</h5>
                            <p class="nav-link p-0 text-body-secondary" style="text-align:left;">
                                Jl. Kemerdekaan Timur No. 2, Kesugihan, Kabupaten Cilacap, Jawa Tengah 53272
                            </p>
                        </div>

                        <div class="col mb-3">
                            <h5 class="fw-bold">Produk:</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">Jadwal Waktu Sholat</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">Kit Modul</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">Jam Digital</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">Bell Otomatis</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">Buku</a></li>
                            </ul>
                        </div>

                        <div class="col mb-3">
                            <h5 class="fw-bold">Bantuan:</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2">
                                    <a href="#" class="nav-link p-0 text-body-secondary">Cara Pembelian</a>
                                </li>
                            </ul>
                            <h5 class="fw-bold">Perusahaan:</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2">
                                    <a href="#" class="nav-link p-0 text-body-secondary">Tentang Kami</a>
                                </li>
                                <li class="nav-item mb-2">
                                    <a href="#" class="nav-link p-0 text-body-secondary">Syarat & Ketentuan</a>
                                </li>
                                <li class="nav-item mb-2">
                                    <a href="#" class="nav-link p-0 text-body-secondary">Kebijakan Privasi</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col mb-3">
                            <h5 class="fw-bold">Sosial Media:</h5>
                            <ul class="nav flex gap-2" id="icons">
                                <li class="nav-item mb-2 p-1" id="icon-social">
                                    <a href="#" class="nav-link p-0 text-body-secondary">
                                        <img src="{{ asset('company/img/svg/icon-instagram.svg') }}" alt=""
                                            width="30" height="30">
                                    </a>
                                </li>
                                <li class="nav-item mb-2 p-1" id="icon-social">
                                    <a href="#" class="nav-link p-0 text-body-secondary">
                                        <img src="{{ asset('company/img/svg/icon-youtube.svg') }}" alt=""
                                            width="30" height="30">
                                    </a>
                                </li>
                                <li class="nav-item mb-2 p-1" id="icon-social">
                                    <a href="#" class="nav-link p-0 text-body-secondary">
                                        <img src="{{ asset('company/img/svg/icon-facebook.svg') }}" alt=""
                                            width="30" height="30">
                                    </a>
                                </li>
                                <li class="nav-item mb-2 p-1" id="icon-social">
                                    <a href="#" class="nav-link p-0 text-body-secondary">
                                        <img src="{{ asset('company/img/svg/icon-tiktok.svg') }}" alt=""
                                            width="30" height="30">
                                    </a>
                                </li>
                            </ul>
                            <h5 class="fw-bold" id="Download">Unduh Aplikasi:</h5>
                            <a href="https://play.google.com/store/apps/details?id=com.shatomedia.taqwa&pcampaignid=web_share" target="_blank" class="nav-link">
                                <img src="{{ asset('company/img/svg/icon-google.svg') }}" id="google"
                                    alt="">
                            </a>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-between mt-2 border-top">
                        <p>&copy; 2024 Company, Inc. All rights reserved.</p>

                    </div>
                </footer>
            </div>

        </section>
        <!-- end footer section -->
    </main>
    <!-- main end -->
    </script>
    <script src="{{ asset('company/dist/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
