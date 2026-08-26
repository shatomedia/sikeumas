@extends('layouts.company_master')

@section('title', 'Tentang Kami | Shatomedia')
@push('meta-seo')
    <meta name="description"
        content="Shatomedia menyediakan layanan pengembalian/perbaikan komponen dan elektronik rakitan sebagai Original Equiment Manufacturer (OEM).">
    <meta name="keywords"
        content="jam sholat digital, jam digital, jam waktu sholat otomatis, jam adzan digital, jam adzan elektronik, jam digital untuk masjid, jam masjid, technology inspiration ">
    <meta name="author" content="Shatomedia" />
    <meta property="og:type" content="article" />
    <meta property="og:image" content="{{ asset('company/img/png/hero-about-1.png') }}" />
    <meta property="og:title" content="Tentang Kami | Shatomedia" />
    <meta property="og:site_name" content="Shatomedia" />
    <meta property="og:url" content="https://shatomedia.com" />
    <meta property="og:description"
        content="Shatomedia adalah produsen elektronik yang menyediakan bahan baku berkualitas, tahan lama, dan teknologi terkini dengan desain elegan. Kami memberikan garansi perlindungan hingga 3 tahun untuk kepuasan pelanggan." />
@endpush
@section('company-content')
<div class="site-tech">
    <!-- about section start -->
    <section class="about-hero mb-lg-5">
        <div class="container align-items-center px-4 py-lg-5">
            <div class="row flex-lg-row-reverse justify-content-center align-items-center g-5 py-lg-5">
                <div class="col-lg-5 col-md-8 mx-auto">
                    <img src="{{ asset('company/img/png/hero-about-1.png') }}" class="d-block mx-lg-auto img-fluid"
                        alt="Shatomedia" width="700" height="500" loading="lazy" />
                </div>
                <div class="col-lg-7 col-md-12">

                    <h1 class="fw-bold lh-2 mb-3" id="tittle-heroes">
                        About Us
                    </h1>
                    <p class="text-description lh-2" style="font-size: 18px; text-align:justify;">
                        SHATOMEDIA adalah perusahaan yang bergerak dalam bidang fabrikasi perangkat keras dan
                        perangkat lunak.Jangkauan produktifitas SHATOMEDIA meliputi perancangan, memproduksi,
                        menguji, mendistribusikan,
                        serta menyediakan layanan pengembalian/perbaikan komponen dan elektronik rakitan sebagai
                        Original Equiment
                        Manufacturer (OEM).
                        SHATOMEDIA berkomitmen untuk bergerak maju dengan kuat sejalan dengan tren teknologi
                        industri elektronik yang telah
                        memberikan reputasi pasar yang diakui sebagai penyedia bagi pangsa pasar diindonesia.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- about section start -->

    <section class="vision-mission mt-xxl-3">
        <div class="container align-items-center px-4 py-5 py-lg-5">
            <div class="row flex-lg-row justify-content-center align-items-center g-5 py-lg-5">
                <div class="col-12 col-sm-5 col-lg-4 col-md-8 mx-auto">
                    <img src="{{ asset('company/img/png/image.png') }}" class="d-block mx-lg-auto img-fluid"
                        alt="Shatomedia" width="700" height="500" loading="lazy" />
                </div>
                <div class="col-lg-6 col-md-12">
                    <h1 class="fw-bold lh-2" style="color: #d9a441;">Visi</h1>
                    <p class="lh-2 text-description" style="font-size: 18px; text-align: justify;">Menerapkan semua
                        keahlian yang ada serta berkomitmen tanpa kompromi terhadap kualitas, kehandalan dan layanan
                        pelanggan maupun kemaslahatan hidup bersama didalam lingkungan umat islam.
                    </p>
                    <h1 class="fw-bold lh-2" style="color: #d9a441;">Misi</h1>
                    <ul class="text-description" style="font-size: 18px;">
                        <li>Memanfaatkan strategi peningkatan proses berkelanjutan untuk memastikan produk dan
                            layanan berkualitas tinggi.</li>
                        <li>Menerapkan sistem produksi yang hemat biaya dan perencanaan iskal yang baik.</li>
                        <li>Menjalin kerjasama dengan pusat penelitian perguruan tinggi guna mencapai teknologi
                            terkini yang sedang berkembang</li>
                        <li>Memberikan pelayanan publik dalam beribadah khususnya lingkungan masjid pada layanan
                            teknologi yang ada.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="history-time">
        <div class="container py-5">
            <div class="main-timeline">
                <div class="timeline left">
                    <div class="card">
                        <div class="card-body p-4">
                            <h3>2008</h3>
                            <p class="mb-0">Sejarah berdirinya SHATOMEDIA diprakarsai oleh tiga orang yaitu Safiq,
                                Topaz dan riyanto. Ketiga orang tersebut Kemudian membuat
                                badan usaha yang diberi nama CV. SHATO MEDIA INOVATION.
                                Kata SHATO adalah penggabungan dari ketiga nama tersebut,
                                dalam produk pertamanya adalah Bel Sekolah Otomatis.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="timeline right">
                    <div class="card">
                        <div class="card-body p-4">
                            <h3>2010</h3>
                            <p class="mb-0">Topaz dan Riyanto menyerahkan sepenuhnya perusahaan dikelola oleh Safiq
                                yang kemudian berganti nama dengan SHATOMEDIA.
                                Seiring dengan perubahan nama menjadi SHATOMEDIA,
                                customisasi perangkat elektronika menjadi trend dalam layanan
                                di perusahaan kepada konsumen, sehingga semakin mempermudah
                                dalam membaca trend kebutuhan teknologi elektronika
                                di tengah-tengah masyarakat.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="timeline left">
                    <div class="card">
                        <div class="card-body p-4">
                            <h3>2012</h3>
                            <p class="mb-0">SHATOMEDIA berfokus pada fabrikasi
                                produksi secara massal yang diambil dari salah satu trend teknologi
                                elektronika yaitu Jadwal Waktu Sholat Digital.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

