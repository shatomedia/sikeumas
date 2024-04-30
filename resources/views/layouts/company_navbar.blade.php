{{-- <nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/index.html">
            <img src="{{ asset('company/img/png/navbar-logo.png') }}" width="159" height="43" alt="Shatomedia" />
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
</nav> --}}


<!-- navbar start -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('beranda') }}">
            <img src="{{ asset('company/img/png/navbar-logo.png') }}" width="159" height="43" alt="Shatomedia" />
        </a>
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('beranda') }}">Beranda</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('about-us') }}">Tentang Kami</a>
                </li>
                <li class="nav-item mx-2 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Produk
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Jadwal Waktu
                                Sholat</a></li>
                        <li><a class="dropdown-item" href="#">Kit Modul</a></li>
                        <li><a class="dropdown-item" href="#">Jam Digital</a></li>
                        <li><a class="dropdown-item" href="#">Bell Otomatis</a></li>
                    </ul>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('blog') }}">Blog</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('contact') }}">Kontak Kami</a>
                </li>
            </ul>
            <div class="btn-help d-none d-lg-block">
                <a href="https://wa.me/6285743909116" target="_blank" class="btn" id="btn-contact">
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
