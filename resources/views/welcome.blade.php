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
        <div class="container col-xxl-8">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('company/img/png/navbar-logo.png') }}" width="159" height="43"
                    alt="Shatomedia" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">Kontak Kami</a>
                    </li>
                </ul>
                <div class="btn-help mx-2 d-none d-lg-block">
                    <button class="btn btn-outline-warning" style="color: black">
                        Hubungi Kami: 081821290098
                    </button>
                </div>
                <div class="btn-help">
                    <a href="{{ route('login') }}" type="button" class="btn btn-outline-warning" style="color: black">
                        Masuk
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- main start -->
    <main>
        <!-- first section start -->
        <div class="container first-container col-xxl-8 mb-xxl-5 px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <div class="col-10 col-sm-5 col-lg-6 mx-auto">
                    <img src="{{ asset('company/img/png/hero-img.png') }}" class="d-block mx-lg-auto img-fluid"
                        alt="Shatomedia" width="700" height="500" loading="lazy" />
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold text-body-emphasis lh-2 mb-4">
                        Koneksi Spiritual yang Lebih Kuat dengan Jadwal Sholat Digital
                        Terkini
                    </h1>
                    <p class="lead mb-4">
                        Mengacu pada Metode Hisab Ephemeris yang dikeluarkan oleh
                        Kementrian Agama Republik Indonesia
                    </p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <button type="button" class="btn btn-warning btn-lg px-4 me-md-2">
                            Dapatkan Sekarang
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-lg px-4">
                            10.000+ Pelanggan
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- firts section end -->

        <!-- best section start -->
        <div class="container best-container align-items-center text-center mb-xxl-8">
            <h2 class="fw-bold mb-4">Koleksi Terbaik</h2>
            <div class="row justify-content-md-center gy-md-4">
                <div class="col-lg-4">
                    <div m class="card" style="width: 360; height: 250">
                        <img src="{{ asset('company/img/png/WhatsApp-Image-2022-03-15-at-14.28.15.jpeg-1536x1152.jpg') }}"
                            alt="" />
                        <div class="card-body">
                            <h4>Jam Sholat Digital JWS-M3</h4>
                            <p class="text-description">
                                Tampilan jadwal waktu sholat ( Shubuh, Dhuhur, Ashar, Maghrib,
                                Isya ). Ditambah dengan waktu syuruq/imsyak dan tampilan
                                tanggal, bulan, tahun, beserta jam dan menit secara Real Time
                                ,serta terdapat tambahan Running teks sebagai papan informasi.
                            </p>
                            <a href="#" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card" style="width: 360; height: 250">
                        <img src="{{ asset('company/img/png/WhatsApp-Image-2022-03-15-at-14.28.15.jpeg-1536x1152.jpg') }}"
                            alt="" />
                        <div class="card-body">
                            <h4>Module KIT-JS01</h4>
                            <p class="text-description">
                                Tampilan jadwal waktu sholat ( Shubuh, Dhuhur, Ashar, Maghrib,
                                Isya ). Ditambah dengan waktu syuruq/imsyak dan tampilan
                                tanggal, bulan, tahun, beserta jam dan menit secara Real Time
                                ,serta terdapat tambahan Running teks sebagai papan informasi.
                            </p>
                            <a href="#" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card" style="width: 360; height: 250">
                        <img src="{{ asset('company/img/png/WhatsApp-Image-2022-03-15-at-14.28.15.jpeg-1536x1152.jpg') }}"
                            alt="" />
                        <div class="card-body">
                            <h4>Taqwa Media Player</h4>
                            <p class="text-description">
                                Tampilan jadwal waktu sholat ( Shubuh, Dhuhur, Ashar, Maghrib,
                                Isya ). Ditambah dengan waktu syuruq/imsyak dan tampilan
                                tanggal, bulan, tahun, beserta jam dan menit secara Real Time
                                ,serta terdapat tambahan Running teks sebagai papan informasi.
                            </p>
                            <a href="#" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- best section end -->

        <!-- intro section start -->
        <div class="container intro-container px-4 py-5">
            <div class="row flex-lg-row align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6 mx-auto">
                    <img src="{{ asset('company/img/png/Galaxy-Note-20-Ultra-768x576.png') }}"
                        class="d-block mx-lg-auto img-fluid" alt="Shatomedia" width="700" height="500"
                        loading="lazy" />
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold text-body-emphasis lh-2 mb-4">
                        Kenalin, Taqwa Digital Prayer Time.
                    </h1>
                    <p class="lead mb-4">
                        Pengelolaan jam digital menggunakan smartphone telah menghadirkan
                        kemudahan dan keterhubungan yang belum pernah terjadi sebelumnya.
                    </p>
                    <p class="lead mb-4">
                        Digital Prayer Time adalah Aplikasi yang dapat melakukan
                        perhitungan awal masuk Waktu Sholat dengan mengacu pada metode
                        Ephemeris yang dikeluarkan oleh Kementrian Agama Republik
                        Indonesia.
                    </p>
                    <div class="col-lg-6">
                        <button class="btn btn-secondary">Download App</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- intro section end -->

        <!-- manage time section end -->
        <div class="container time-container mb-4">
            <div class="card px-4" style="width: 1350; height: 426; background-color: orange">
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
        <!-- manage time section end -->

        <!-- gallery section start -->
        <div class="container gallery-container px-4 py-5">
            < div class="title justify-content-md-center text-center">
                <h1 class="fw-bold" style="font-size: 40px">
                    Tata Ruang Anda dengan Keindahan Kaligrafi dan Keterampilan Jam
                    Digital
                </h1>
            </>
            <div class="row">
                <div class="image col-md-4 col-sm-6 mb-4">
                    <img src="{{ asset('company/img/png/2.jpg') }}" class="img-fluid" alt="jam" />
                </div>
                <div class="image col-md-4 col-sm-6 mb-4">
                    <img src="{{ asset('company/img/png/3.jpg') }}" class="img-fluid" alt="jam" />
                </div>
                <div class="image col-md-4 col-sm-6 mb-4">
                    <img src="{{ asset('company/img/png/3.jpg') }}" class="img-fluid" alt="jam" />
                </div>
            </div>
            <div class="d-flex justify-content-center button-gallery">
                <button class="btn btn-outline-secondary">Dapatkan</button>
            </div>
        </div>
        <!-- gallery section end -->

        <!-- quality container start -->
        <div class="container px-4 py-5">
            <div class="row flex-lg-row align-items-center" style="width: 1350; height: 426">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="{{ asset('company/img/png/ketelitian.png') }}" class="d-block mx-lg-auto img-fluid"
                        alt="Bootstrap Themes" width="700" height="500" loading="lazy" />
                </div>
                <div class="col-lg-6">
                    <h1 class="fw-bold lh-1 mb-3">
                        Ketelitian dalam Kerajinan, Kualitas yang Eksklusif.
                    </h1>
                    <p class="lead">
                        Setiap langkah dalam proses dilakukan dengan teliti dan penuh
                        perhatian terhadap detail, sehingga produk akhir memiliki estetika
                        yang mengagumkan. Kualitas eksklusif ini menciptakan daya tarik
                        dan nilai tambah yang tinggi bagi konsumen yang mencari produk
                        yang istimewa dan berbeda.
                    </p>
                </div>
            </div>
        </div>
        <!-- quality container start -->

        <!-- support container start -->
        <section class="container support-container">
            <div class="flex justify-content-center align-items-center py-5 px-4 text-lg-center">
                <h1 class="fw-bold lh-1 mb-3">
                    Dukungan teknis perawatan jadwal waktu sholat digital.
                </h1>
                <p class="lead">
                    Setiap langkah dalam proses dilakukan dengan teliti dan penuh
                    perhatian terhadap detail, sehingga produk akhir memiliki estetika
                    yang mengagumkan. Kualitas eksklusif ini menciptakan daya tarik dan
                    nilai tambah yang tinggi bagi konsumen yang mencari produk yang
                    istimewa dan berbeda.
                </p>
                <button class="btn btn-primary">Konsultasi Sekarang</button>
            </div>
        </section>
        <!-- support container end -->

        <!-- start experience section -->
        <section class="experience-container">
            <div class="container px-4 py-5">
                <div class="flex justify-content-center text-center align-items-center">
                    <h1 class="tittle lh-1 fw-bold">Sebagian Pengalaman Kami</h1>
                    <div class="row">
                        <div class="image col-md-4 col-sm-6 mb-4">
                            <img src="{{ asset('company/img/png/2.jpg') }}" class="img-fluid" alt="jam" />
                        </div>
                        <div class="image col-md-4 col-sm-6 mb-4">
                            <img src="{{ asset('company/img/png/2.jpg') }}" class="img-fluid" alt="jam" />
                        </div>
                        <div class="image col-md-4 col-sm-6 mb-4">
                            <img src="{{ asset('company/img/png/2.jpg') }}" class="img-fluid" alt="jam" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end experience section -->

        <!-- star footer section -->
        <section class="footer-container">
            <div class="container">
                <footer class="py-5">
                    <div class="row">
                        <div class="col-6 col-md-2 mb-3">
                            <h5>Section</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">Home</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">Features</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">Pricing</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">FAQs</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">About</a></li>
                            </ul>
                        </div>

                        <div class="col-6 col-md-2 mb-3">
                            <h5>Section</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">Home</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">Features</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">Pricing</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">FAQs</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">About</a></li>
                            </ul>
                        </div>

                        <div class="col-6 col-md-2 mb-3">
                            <h5>Section</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">Home</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">Features</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">Pricing</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">FAQs</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">About</a></li>
                            </ul>
                        </div>

                        <div class="col-md-5 offset-md-1 mb-3">
                            <form>
                                <h5>Subscribe to our newsletter</h5>
                                <p>Monthly digest of what's new and exciting from us.</p>
                                <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                                    <label for="newsletter1" class="visually-hidden">Email address</label>
                                    <input id="newsletter1" type="text" class="form-control"
                                        placeholder="Email address">
                                    <button class="btn btn-primary" type="button">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </footer>
            </div>
        </section>
        <!-- end footer section -->
    </main>
    <!-- main end -->
    <script src="{{ asset('company/dist/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
