<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sikeumas | {{ $masjids->nama }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/mosque-fav.svg') }}" type="image/x-icon">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="auhtor" name="Sistem Manajamen Masjid">
    <meta content="Sistem manajemen keuangan masjid" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Pacifico&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('landing/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('landing/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('landing/css/style.css') }}" rel="stylesheet">



</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar d-none d-lg-block">
            <div class="topbar-inner">
                <div class="row gx-0">
                    <div class="col-lg-7 text-start">
                        <div class="h-100 d-inline-flex align-items-center me-4">
                            <span class="fa fa-phone-alt me-2 text-dark"></span>
                            <a href="https://wa.me/{{ $masjids->telp }}" target="_blank"
                                class="text-dark"><span>{{ $masjids->telp }}</span></a>
                        </div>
                        <div class="h-100 d-inline-flex align-items-center">
                            <span class="far fa-envelope me-2 text-dark"></span>
                            <a href="mailto:{{ $masjids->email }}"
                                class="text-dark"><span>{{ $masjids->email }}</span></a>
                        </div>
                    </div>
                    <div class="col-lg-5 text-end">
                        <div class="h-100 d-inline-flex align-items-center">
                            <span class="text-body">Follow Us:</span>
                            <a class="text-dark px-2" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="text-dark px-2" href=""><i class="fab fa-twitter"></i></a>
                            <a class="text-dark px-2" href=""><i class="fab fa-linkedin-in"></i></a>
                            <a class="text-dark px-2" href=""><i class="fab fa-instagram"></i></a>
                            <a class="text-dark ps-4" href="{{ route('login-tenant') }}"><i
                                    class="fa fa-lock text-dark me-1"></i>
                                Masuk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <nav class="navbar navbar-light navbar-expand-lg py-3">
                <a href="{{ route('landing') }}" class="navbar-brand">
                    <h3 class="mb-0"><span class="text-primary">{{ $masjids->nama }}</span></h3>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav ms-lg-auto mx-xl-auto">
                        <a href="{{ route('landing') }}" class="nav-item nav-link active">Beranda</a>
                        <a href="#about" class="nav-item nav-link">Tentang</a>
                        <a href="#activities" class="nav-item nav-link">Kegiatan</a>
                        <a href="#events" class="nav-item nav-link">Acara</a>
                        <a href="" class="nav-item nav-link">Kontak</a>
                    </div>
                    <a href="" class="btn btn-primary py-2 px-4 d-none d-xl-inline-block">Donasi</a>
                </div>
            </nav>
        </div>
    </div>
    <!-- Topbar End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid footer pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            {{-- <div class="row py-5">
                <div class="col-lg-7">
                    <h1 class="text-light mb-0">Subscribe our newsletter</h1>
                    <p class="text-secondary">Get the latest news and other tips</p>
                </div>
                <div class="col-lg-5">
                    <div class="position-relative mx-auto">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Your email">
                        <button type="button"
                            class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">Subcribe</button>
                    </div>
                </div>
                <div class="col-12">
                    <div class="border-top border-secondary"></div>
                </div>
            </div> --}}
            <div class="row g-4 footer-inner">
                <div class="col-4">
                    <div class="footer-item mt-5">
                        <h4 class="text-light mb-4"><span class="text-primary">{{ $masjids->nama }}</span></h4>
                        <p class="mb-4 text-secondary">Nostrud exertation ullamco labor nisi aliquip ex ea commodo
                            consequat duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
                        <a href="" class="btn btn-primary py-2 px-4">Donate Now</a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="footer-item mt-5">
                        <h4 class="text-light mb-4">Our Mosque</h4>
                        <div class="d-flex flex-column">
                            <h6 class="text-secondary mb-0">Alamat</h6>
                            <div class="d-flex align-items-center border-bottom py-4">
                                <span class="flex-shrink-0 btn-square bg-primary me-3 p-4"><i
                                        class="fa fa-map-marker-alt text-dark"></i></span>
                                <a href="" class="text-body">{{ $masjids->alamat }}</a>
                            </div>
                            <h6 class="text-secondary mt-4 mb-0">Telp / No Hp</h6>
                            <div class="d-flex align-items-center py-4">
                                <span class="flex-shrink-0 btn-square bg-primary me-3 p-4"><i
                                        class="fa fa-phone-alt text-dark"></i></span>
                                <a href="" class="text-body">{{ $masjids->telp }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="footer-item mt-5">
                        <h4 class="text-light mb-4">Explore Link</h4>
                        <div class="d-flex flex-column align-items-start">
                            <a class="text-body mb-2" href=""><i
                                    class="fa fa-check text-primary me-2"></i>Beranda</a>
                            <a class="text-body mb-2" href=""><i
                                    class="fa fa-check text-primary me-2"></i>Tentang</a>
                            <a class="text-body mb-2" href=""><i
                                    class="fa fa-check text-primary me-2"></i>Kegiatan</a>
                            <a class="text-body mb-2" href=""><i
                                    class="fa fa-check text-primary me-2"></i>Acara</a>
                            <a class="text-body mb-2" href=""><i
                                    class="fa fa-check text-primary me-2"></i>Kontak</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="container py-4">
            <div class="border-top border-secondary pb-4"></div>
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">{{ $masjids->nama }}</a>, All Right Reserved.
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-light back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('landing/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('landing/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('landing/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('landing/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('landing/js/main.js') }}"></script>
</body>

</html>
