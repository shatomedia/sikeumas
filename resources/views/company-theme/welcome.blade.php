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

    <!-- flagship products section start -->
    <section class="py-5" style="background:#f8f9fb;">
        <div class="container px-4 py-lg-4">
            <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                <p class="fw-bold text-uppercase mb-1" style="color:#1f6b4d; letter-spacing:1px;">Produk Unggulan</p>
                <h1 class="fw-bold">Teknologi yang Sudah Terbukti, Bukan Sekadar Janji</h1>
            </div>

            <!-- TAQWA-Hub spotlight -->
            <div class="row align-items-center g-5 mb-5 pb-4">
                <div class="col-lg-6">
                    <img src="{{ asset('products/taqwa-hub.png') }}" class="img-fluid rounded-4 shadow" alt="TAQWA-Hub">
                </div>
                <div class="col-lg-6">
                    <span class="badge rounded-pill mb-3 px-3 py-2" style="background:#1f6b4d; color:#fff;">Sistem Digital Masjid</span>
                    <h2 class="fw-bold mb-3">TAQWA-Hub</h2>
                    <p class="lead mb-4">Satu perangkat yang menyatukan jadwal sholat, kontrol audio, tampilan TV masjid, dan notifikasi pengurus — bekerja penuh tanpa internet.</p>
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6 d-flex align-items-start">
                            <i class="bi bi-soundwave fs-4 me-2" style="color:#1f6b4d;"></i>
                            <span>Audio 8 kanal dengan DSP per kanal</span>
                        </div>
                        <div class="col-sm-6 d-flex align-items-start">
                            <i class="bi bi-wifi-off fs-4 me-2" style="color:#1f6b4d;"></i>
                            <span>Offline-first, tanpa internet</span>
                        </div>
                        <div class="col-sm-6 d-flex align-items-start">
                            <i class="bi bi-tv fs-4 me-2" style="color:#1f6b4d;"></i>
                            <span>TV masjid & overlay iqomah otomatis</span>
                        </div>
                        <div class="col-sm-6 d-flex align-items-start">
                            <i class="bi bi-whatsapp fs-4 me-2" style="color:#1f6b4d;"></i>
                            <span>Notifikasi WhatsApp ke pengurus</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-4 p-3 rounded-3" style="background:#eaf4ee;">
                        <i class="bi bi-patch-check-fill fs-4" style="color:#1f6b4d;"></i>
                        <span class="fw-semibold">458/458 test case lulus &middot; aktif di masjid produksi sejak Juni 2026</span>
                    </div>
                    <a href="{{ route('product-detail', 'taqwa-hub') }}" class="btn" id="btn-buyNow">Selengkapnya</a>
                </div>
            </div>

            <!-- Surgery Time spotlight -->
            <div class="row align-items-center g-5 mb-5 pb-4 flex-lg-row-reverse">
                <div class="col-lg-6">
                    <img src="{{ asset('products/surgery-time.png') }}" class="img-fluid rounded-4 shadow" alt="Surgery Time">
                </div>
                <div class="col-lg-6">
                    <span class="badge rounded-pill mb-3 px-3 py-2" style="background:#1e40af; color:#fff;">Sistem Manajemen Rumah Sakit</span>
                    <h2 class="fw-bold mb-3">Surgery Time</h2>
                    <p class="lead mb-4">Pantau, jadwalkan, dan laporkan seluruh kamar operasi dari satu layar — tanpa perlu staf IT.</p>
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6 d-flex align-items-start">
                            <i class="bi bi-stopwatch fs-4 me-2" style="color:#1e40af;"></i>
                            <span>Timer real-time per fase operasi</span>
                        </div>
                        <div class="col-sm-6 d-flex align-items-start">
                            <i class="bi bi-grid-1x2 fs-4 me-2" style="color:#1e40af;"></i>
                            <span>Monitor semua kamar OK sekaligus</span>
                        </div>
                        <div class="col-sm-6 d-flex align-items-start">
                            <i class="bi bi-file-earmark-pdf fs-4 me-2" style="color:#1e40af;"></i>
                            <span>Laporan PDF siap cetak instan</span>
                        </div>
                        <div class="col-sm-6 d-flex align-items-start">
                            <i class="bi bi-qr-code fs-4 me-2" style="color:#1e40af;"></i>
                            <span>Akses dari tablet/HP via QR code</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-4 p-3 rounded-3" style="background:#eaf0fb;">
                        <i class="bi bi-gift-fill fs-4" style="color:#1e40af;"></i>
                        <span class="fw-semibold">Mode DEMO gratis tersedia &middot; paket lengkap mulai Rp 4 juta/tahun</span>
                    </div>
                    <a href="{{ route('product-detail', 'surgery-time') }}" class="btn" id="btn-buyNow">Selengkapnya</a>
                </div>
            </div>

            <!-- JWS-M3 spotlight -->
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <img src="{{ asset('products/1709590121148.jpg') }}" class="img-fluid rounded-4 shadow" alt="Jadwal Waktu Sholat JWS-M3">
                </div>
                <div class="col-lg-6">
                    <span class="badge rounded-pill mb-3 px-3 py-2" style="background:#a16207; color:#fff;">Jadwal Waktu Sholat 7-Segment</span>
                    <h2 class="fw-bold mb-3">Jadwal Waktu Sholat JWS-M3</h2>
                    <p class="lead mb-4">Tampilan digital 7-segment untuk 5 waktu sholat, imsak, dan syuruq — dilengkapi tanggal, jam real-time, dan running text pengumuman.</p>
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6 d-flex align-items-start">
                            <i class="bi bi-bell fs-4 me-2" style="color:#a16207;"></i>
                            <span>Alarm adzan otomatis, bisa di-on/off-kan</span>
                        </div>
                        <div class="col-sm-6 d-flex align-items-start">
                            <i class="bi bi-hourglass-split fs-4 me-2" style="color:#a16207;"></i>
                            <span>Jeda iqomah bisa diatur tiap waktu</span>
                        </div>
                        <div class="col-sm-6 d-flex align-items-start">
                            <i class="bi bi-mic fs-4 me-2" style="color:#a16207;"></i>
                            <span>Pilihan tilawah sebelum masuk waktu</span>
                        </div>
                        <div class="col-sm-6 d-flex align-items-start">
                            <i class="bi bi-badge-3d fs-4 me-2" style="color:#a16207;"></i>
                            <span>Angka 7-segment terang, terbaca dari jauh</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-4 p-3 rounded-3" style="background:#fdf3e3;">
                        <i class="bi bi-people-fill fs-4" style="color:#a16207;"></i>
                        <span class="fw-semibold">Dipercaya 10.000+ pelanggan di seluruh Indonesia</span>
                    </div>
                    <a href="{{ route('product-detail', '9bbb9dfa-e8eb-4bf0-b011-99afc14b6c1d') }}" class="btn" id="btn-buyNow">Selengkapnya</a>
                </div>
            </div>
        </div>
    </section>
    <!-- flagship products section end -->

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
                                <a href="{{ route('product-detail', $item->slug) }}" type="button" class="btn btn-primery" id="btn-buyNow">
                                    Lihat Detail
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

