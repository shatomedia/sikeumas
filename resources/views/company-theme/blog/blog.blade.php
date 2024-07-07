@extends('layouts.company_master')

@section('company-content')
    <section class="blog-container">
        <div class="container align-items-center py-5 px-4 py-lg-5">

            <div class="row d-flex gy-4 mb-5">
                <h3 class="fw-bold mt-2">Features Post</h3>
                <div class="collection col-lg-3">
                    <a href="#" class="card-link" style="text-decoration: none;">
                        <div class="card features-card h-100">
                            <img src="{{ asset('landing/img/blog-1.jpg') }}" class="card-img-top" alt="" />
                            <div class="card-body">
                                <h5 class="card-title">Membuat Proyek Robot Mini dengan Arduino</h5>
                            </div>
                            <div class="card-footer">
                                <p id="date-blog">20 September 2012</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="collection col-lg-3">
                    <div class="card features-card h-100">
                        <img src="{{ asset('landing/img/blog-2.jpg') }}" class="card-img-top" alt="" />
                        <div class="card-body">
                            <h5 class="card-title">Membuat Proyek Robot Mini dengan Arduino</h5>
                        </div>
                        <div class="card-footer">
                            <p id="date-blog">20 September 2012</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex gy-4 mb-5">
                <h3 class="fw-bold mt-2">Panduan Pengguna</h3>
                <div class="collection col-lg-3 ">
                    <div class="card features-card h-100">
                        <img src="{{ asset('landing/img/blog-3.jpg') }}" class="card-img-top" alt="" />
                        <div class="card-body">
                            <h5 class="card-title">Arduino vs. Raspberry Pi: Pilih yang Tepat untuk Proyek Anda</h5>
                        </div>
                        <div class="card-footer">
                            <p id="date-blog">20 September 2012</p>
                        </div>
                    </div>
                </div>
                <div class="collection col-lg-3">
                    <div class="card features-card h-100">
                        <img src="{{ asset('landing/img/blog-1.jpg') }}" class="card-img-top" alt="" />
                        <div class="card-body">
                            <h5 class="card-title">Membuat Proyek Robot Mini dengan Arduino</h5>
                        </div>
                        <div class="card-footer">
                            <p id="date-blog">20 September 2012</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex gy-4 mb-5">
                <h3 class="fw-bold mt-2">Lainnya</h3>
                <div class="collection col-lg-3">
                    <div class="card features-card h-100">
                        <img src="{{ asset('landing/img/blog-1.jpg') }}" class="card-img-top" alt="" />
                        <div class="card-body">
                            <h5 class="card-title">Arduino vs. Raspberry Pi: Pilih yang Tepat untuk Proyek Anda</h5>
                        </div>
                        <div class="card-footer">
                            <p id="date-blog">20 September 2012</p>
                        </div>
                    </div>
                </div>
                <div class="collection col-lg-3">
                    <div class="card features-card h-100">
                        <img src="{{ asset('landing/img/blog-1.jpg') }}" class="card-img-top" alt="" />
                        <div class="card-body">
                            <h5 class="card-title">Membuat Proyek Robot Mini dengan Arduino</h5>
                        </div>
                        <div class="card-footer">
                            <p id="date-blog">20 September 2012</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
