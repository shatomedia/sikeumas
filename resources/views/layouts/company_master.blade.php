<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shatomedia | Technology Inspiration</title>
    <meta name="description"
        content="Shatomedia adalah produsen elektronik yang menyediakan bahan baku berkualitas, tahan lama, dan teknologi terkini dengan desain elegan. Kami memberikan garansi perlindungan hingga 3 tahun untuk kepuasan pelanggan.">
    <meta name="keywords"
        content="Jam Sholat Digital, Jam Waktu Sholat Otomatis, Jam Azan Digital, Jam Adzan Elektronik, Jam Digital untuk Masjid">
    <meta name="author" content="Shatomedia" />
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('company/dist/css/bootstrap.cs') }}s" />
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
            <a class="navbar-brand" href="/index.html">
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
                        <a class="nav-link active" aria-current="page" href="/index.html">Beranda</a>
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
                            <li><a class="dropdown-item" href="pages/jws-category/jws-category.html">Jadwal Waktu
                                    Sholat</a></li>
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
                    <a href="https://wa.me/085743909116" target="_blank" class="btn" id="btn-contact">
                        Hubungi Kami: 085743909116
                    </a>
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
        @yield('company-content')

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
                                        class="nav-link p-0 text-body-secondary">Jadwal
                                        Waktu Sholat</a></li>
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Kit
                                        Modul</a></li>
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Jam
                                        Digital</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">Bell
                                        Otomatis</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-body-secondary">Buku</a>
                                </li>
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
                                    <a href="https://www.instagram.com/shato_media/" target="_blank"
                                        class="nav-link p-0 text-body-secondary">
                                        <img src="{{ asset('company/img/svg/icon-instagram.svg') }}" alt=""
                                            width="30" height="30">
                                    </a>
                                </li>
                                <li class="nav-item mb-2 p-1" id="icon-social">
                                    <a href="https://www.youtube.com/shatomedia/" target="_blank"
                                        class="nav-link p-0 text-body-secondary">
                                        <img src="{{ asset('company/img/svg/icon-youtube.svg') }}" alt=""
                                            width="30" height="30">
                                    </a>
                                </li>
                                <li class="nav-item mb-2 p-1" id="icon-social">
                                    <a href="https://facebook.com/shatomedia/" target="_blank"
                                        class="nav-link p-0 text-body-secondary">
                                        <img src="{{ asset('company/img/svg/icon-facebook.svg') }}" alt=""
                                            width="30" height="30">
                                    </a>
                                </li>
                                <li class="nav-item mb-2 p-1" id="icon-social">
                                    <a href="https://www.tiktok.com/@shatomedia/" target="_blank"
                                        class="nav-link p-0 text-body-secondary">
                                        <img src="{{ asset('company/img/svg/icon-tiktok.svg') }}" alt=""
                                            width="30" height="30">
                                    </a>
                                </li>
                            </ul>
                            <h5 class="fw-bold" id="Download">Unduh Aplikasi:</h5>
                            <a href="https://play.google.com/store/apps/details?id=com.shatomedia.taqwa&pcampaignid=web_share"
                                target="_blank" class="nav-link">
                                <img src="{{ asset('company/img/svg/icon-google.svg') }}" id="google"
                                    alt="playstore">
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
    <script src="{{ asset('company/dist/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
