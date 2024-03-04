@extends('layouts.app_front')

@section('content')
    <!-- Hero Start -->
    <div class="container-fluid hero-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero-header-inner animated zoomIn">
                        <p class="fs-4 text-dark">{{ $masjids->nama }}</p>
                        <h1 class="display-3 mb-5 text-dark">Kesejukan Iman, Menuju Kebahagiaan
                            Abadi.</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- saldo Start -->
    <div id="donate" class="container py-5">
        <div class="container py-3 wow fadeIn" data-wow-delay="0.1s">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card bg-light text-dark">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Pemasukan</th>
                                            <th scope="col">Pengeluaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($kas as $item)
                                            <tr>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>{{ $item->tanggal->translatedFormat('d-m-y') }}</td>
                                                <td>
                                                    {{ $item->jenis == 'masuk' ? formatRupiah($item->jumlah) : '-' }}</td>
                                                <td>
                                                    {{ $item->jenis == 'keluar' ? formatRupiah($item->jumlah) : '-' }}
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Data tidak ada</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h5 class="fs-4 text-dark">Saldo: <span
                            class="text-primary">{{ formatRupiah($saldoAkhir, true) }}</span>
                    </h5>
                    <div class="card bg-light text-dark">
                        <div class="card-body">
                            <h6>Rekening Masjid: <span>{{ $banks ? $banks->nama_bank : 'belum disetting' }}</span></h6>
                            <h6>Kode Bank: <span>{{ $banks ? $banks->kode_bank : 'belum disetting' }}</span></h6>
                            <h6>Atas Nama: <span>{{ $banks ? $banks->nama_rekening : 'belum disetting' }}</span></h6>
                            <h6>No. Rekening: <span>{{ $banks ? $banks->nomor_rekening : 'belum disetting' }}</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- saldo end -->

    <!-- About Satrt -->
    <div id="about" class="container-fluid about py-5">
        <div class="container py-5">
            <div class="row g-5 mb-5">
                <div class="col-xl-6">
                    <div class="row g-4">
                        <div class="col-6">
                            <img src="{{ asset('landing/img/about-1.jpg') }}" class="img-fluid h-100 wow zoomIn"
                                data-wow-delay="0.1s" alt="">
                        </div>
                        <div class="col-6">
                            <img src="{{ asset('landing/img/about-2.jpg') }}" class="img-fluid pb-3 wow zoomIn"
                                data-wow-delay="0.1s" alt="">
                            <img src="{{ asset('landing/img/about-3.jpg') }}" class="img-fluid pt-3 wow zoomIn"
                                data-wow-delay="0.1s" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 wow fadeIn" data-wow-delay="0.5s">
                    <p class="fs-5 text-uppercase text-primary">Tentang {{ $masjids->nama }}</p>
                    <h1 class="display-5 pb-4 m-0">Allah Menolong Mereka yang Menolong Dirinya Sendiri</h1>
                    {{-- <p class="pb-4">Lorem ipsum dolor sit amet elit. Donec tempus eros vel dolor mattis
                        aliquam.
                        Etiam quis mauris justo. Vivamus purus nulla, rutrum ac risus in.</p> --}}
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="ps-3 d-flex align-items-center justify-content-start">
                                <span class="bg-primary btn-md-square rounded-circle mt-4 me-2"><i
                                        class="fa fa-eye text-dark fa-4x mb-5 pb-2"></i></span>
                                <div class="ms-4">
                                    <h5>Visi</h5>
                                    <p>{{ strip_tags($visi->konten ?? 'Peran penting masjid dalam masyarakat Indonesia sebagai pusat kegiatan keagamaan, sosial, dan budaya') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="ps-3 d-flex align-items-center justify-content-start">
                                <span class="bg-primary btn-md-square rounded-circle mt-4 me-2"><i
                                        class="fa fa-flag text-dark fa-4x mb-5 pb-2"></i></span>
                                <div class="ms-4">
                                    <h5>Misi</h5>
                                    <p>{{ strip_tags($misi->konten ?? 'Memberdayakan agama, pendidikan Islam, kesejahteraan, toleransi, kebudayaan, seni, dan konservasi lingkungan.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-6">
                            <p class="mb-2"><i class="fa fa-check text-primary me-3"></i>Amal & Donasi</p>
                            <p class="mb-0"><i class="fa fa-check text-primary me-3"></i>Pendidikan Orang Tua
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><i class="fa fa-check text-primary me-3"></i>Hadits & Sunnah</p>
                            <p class="mb-0"><i class="fa fa-check text-primary me-3"></i>Pembangunan Masjid
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container text-center bg-primary py-5 wow fadeIn" data-wow-delay="0.1s">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-2">
                        <i class="fa fa-mosque fa-5x text-white"></i>
                    </div>
                    <div class="col-lg-10 text-center text-lg-center">
                        <h1 class="mb-0">Setiap Muslim Perlu Menyadari Pentingnya “Rukun” Islam</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Activities Start -->
    <div id="activities" class="container-fluid activities py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                <p class="fs-5 text-uppercase text-primary">Kegiatan</p>
                <h1 class="display-3">Kegiatan Kami</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.1s">
                        <i class="fa fa-mosque fa-4x text-dark"></i>
                        <div class="ms-4">
                            <h4>Pembangunan Masjid</h4>
                            <p class="mb-4">Membangun masjid memberi manfaat sebagai pusat ibadah, pembelajaran, dan
                                pelayanan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.3s">
                        <i class="fa fa-donate fa-4x text-dark"></i>
                        <div class="ms-4">
                            <h4>Amal & Donasi</h4>
                            <p class="mb-4">
                                Mari bersama-sama beramal dan berdonasi untuk memberi manfaat kepada sesama.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.5s">
                        <i class="fa fa-quran fa-4x text-dark"></i>
                        <div class="ms-4">
                            <h4>Pendidikan Alquran</h4>
                            <p class="mb-4">Pendidikan Alquran adalah kunci kesuksesan spiritual dan moral.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.1s">
                        <i class="fa fa-book fa-4x text-dark"></i>
                        <div class="ms-4">
                            <h4>Hadits & Sunnah</h4>
                            <p class="mb-4">Studi Hadits & Sunnah menghidupkan ajaran Rasulullah dalam kehidupan
                                sehari-hari.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.3s">
                        <i class="fa fa-book-open fa-4x text-dark"></i>
                        <div class="ms-4">
                            <h4>Pendidikan Orang Tua</h4>
                            <p class="mb-4">Pendidikan orang tua adalah pondasi kuat bagi perkembangan anak-anak.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.5s">
                        <i class="fa fa-hands fa-4x text-dark"></i>
                        <div class="ms-4">
                            <h4>Bantuan Anak Yatim</h4>
                            <p class="mb-4">Bantu anak yatim untuk masa depan yang lebih baik.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Activities Start -->


    <!-- Events Start -->
    <div id="events" class="container-fluid event py-5">
        <div class="container py-5">
            <h1 class="display-3 mb-5 wow fadeIn" data-wow-delay="0.1s">Acara <span class="text-primary">Mendatang</span>
            </h1>
            @if ($acara->isNotEmpty())
                @foreach ($acara as $event)
                    <div class="row g-4 event-item wow fadeIn" data-wow-delay="0.1s">
                        <div class="col-3 col-lg-2 pe-0">
                            <div class="text-center border-bottom border-dark py-3 px-2">
                                <h6>{{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}</h6>
                            </div>
                        </div>
                        <div class="col-9 col-lg-6 border-start border-dark pb-5">
                            <div class="ms-3">
                                <h4 class="mb-3">{{ $event->judul }}</h4>
                                <p class="mb-4">{{ $event->konten }}</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="overflow-hidden mb-5">
                                <img src="{{ asset('uploads/' . $event->gambar) }}" class="img-fluid w-100"
                                    alt="">
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-primary">Tidak ada acara yang tersedia saat ini.</p>
            @endif
        </div>
    </div>

    <!-- Events End -->

    <!-- Team Start -->
    <div class="container-fluid team py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                <p class="fs-5 text-uppercase text-primary">Our Team</p>
                <h1 class="display-3">Meet Our Organizer</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4 col-xl-5">
                    <div class="team-img wow zoomIn" data-wow-delay="0.1s">
                        <img src="{{ asset('landing/img/team-1.jpg') }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-8 col-xl-7">
                    <div class="team-item wow fadeIn" data-wow-delay="0.1s">
                        <h1>Anamul Hasan</h1>
                        <h5 class="fw-normal fst-italic text-primary mb-4">President</h5>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. aliquip ex ea
                            commodo
                            consequat.</p>
                        <div class="team-icon d-flex pb-4 mb-4 border-bottom border-primary">
                            <a class="btn btn-primary btn-lg-square me-2" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-lg-square me-2" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a href="#" class="btn btn-primary btn-lg-square me-2"><i
                                    class="fab fa-instagram"></i></a>
                            <a href="#" class="btn btn-primary btn-lg-square"><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="team-item wow zoomIn" data-wow-delay="0.2s">
                                <img src="{{ asset('landing/img/team-2.jpg') }}" class="img-fluid w-100" alt="">
                                <div class="team-content text-dark text-center py-3">
                                    <div class="team-content-inner">
                                        <h5 class="mb-0">Mustafa Kamal</h5>
                                        <p class="text-dark">Imam</p>
                                        <div class="team-icon d-flex align-items-center justify-content-center">
                                            <a class="btn btn-primary btn-sm-square me-2" href=""><i
                                                    class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-primary btn-sm-square me-2" href=""><i
                                                    class="fab fa-twitter"></i></a>
                                            <a href="#" class="btn btn-primary btn-sm-square me-2"><i
                                                    class="fab fa-instagram"></i></a>
                                            <a href="#" class="btn btn-primary btn-sm-square"><i
                                                    class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="team-item wow zoomIn" data-wow-delay="0.4s">
                                <img src="{{ asset('landing/img/team-3.jpg') }}" class="img-fluid w-100" alt="">
                                <div class="team-content text-dark text-center py-3">
                                    <div class="team-content-inner">
                                        <h5 class="mb-0">Nahiyan Momen</h5>
                                        <p class="text-dark">Teacher</p>
                                        <div class="team-icon d-flex align-items-center justify-content-center">
                                            <a class="btn btn-primary btn-sm-square me-2" href=""><i
                                                    class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-primary btn-sm-square me-2" href=""><i
                                                    class="fab fa-twitter"></i></a>
                                            <a href="#" class="btn btn-primary btn-sm-square me-2"><i
                                                    class="fab fa-instagram"></i></a>
                                            <a href="#" class="btn btn-primary btn-sm-square"><i
                                                    class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="team-item wow zoomIn" data-wow-delay="0.6s">
                                <img src="{{ asset('landing/img/team-4.jpg') }}" class="img-fluid w-100" alt="">
                                <div class="team-content text-dark text-center py-3">
                                    <div class="team-content-inner">
                                        <h5 class="mb-0">Asfaque Ali</h5>
                                        <p class="text-dark">Volunteer</p>
                                        <div class="team-icon d-flex align-items-center justify-content-center">
                                            <a class="btn btn-primary btn-sm-square me-2" href=""><i
                                                    class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-primary btn-sm-square me-2" href=""><i
                                                    class="fab fa-twitter"></i></a>
                                            <a href="#" class="btn btn-primary btn-sm-square me-2"><i
                                                    class="fab fa-instagram"></i></a>
                                            <a href="#" class="btn btn-primary btn-sm-square"><i
                                                    class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                <p class="fs-5 text-uppercase text-primary">Galery</p>
                <h1 class="display-3">Dokumentasi Kegiatan</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row gallery" data-bs-toggle="modal" data-bs-target="#galleryModal">
                        <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                            <a href="#">
                                <img class="w-100 active"
                                    src="https://images.unsplash.com/photo-1512632578888-169bbbc64f33?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    data-bs-target="#Gallerycarousel" data-bs-slide-to="0">
                            </a>
                        </div>
                        <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                            <a href="#">
                                <img class="w-100"
                                    src="https://images.unsplash.com/photo-1629273229664-11fabc0becc0?q=80&w=1631&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    data-bs-target="#Gallerycarousel" data-bs-slide-to="1">
                            </a>
                        </div>
                        <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                            <a href="#">
                                <img class="w-100"
                                    src="https://images.unsplash.com/photo-1620119852054-dcb7744b7c8a?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    data-bs-target="#Gallerycarousel" data-bs-slide-to="2">
                            </a>
                        </div>
                        <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                            <a href="#">
                                <img class="w-100"
                                    src="https://images.unsplash.com/photo-1620119853784-3989c24b85ed?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    data-bs-target="#Gallerycarousel" data-bs-slide-to="3">
                            </a>
                        </div>
                    </div>

                    <div class="row mt-2 mt-md-4 gallery" data-bs-toggle="modal" data-bs-target="#galleryModal">
                        <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                            <a href="#">
                                <img class="w-100 active"
                                    src="https://images.unsplash.com/photo-1559735445-64ad1b195fcb?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    data-bs-target="#Gallerycarousel" data-bs-slide-to="0">
                            </a>
                        </div>
                        <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                            <a href="#">
                                <img class="w-100"
                                    src="https://images.unsplash.com/photo-1643214686769-b24b39046991?q=80&w=1472&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    data-bs-target="#Gallerycarousel" data-bs-slide-to="1">
                            </a>
                        </div>
                        <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                            <a href="#">
                                <img class="w-100"
                                    src="https://images.unsplash.com/photo-1679293707793-e5cd37734354?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    data-bs-target="#Gallerycarousel" data-bs-slide-to="2">
                            </a>
                        </div>
                        <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                            <a href="#">
                                <img class="w-100"
                                    src="https://images.unsplash.com/photo-1654860687488-119a90eafa86?q=80&w=1625&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    data-bs-target="#Gallerycarousel" data-bs-slide-to="3">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
