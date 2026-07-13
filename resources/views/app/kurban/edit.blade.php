@extends('layouts.app_master')

@section('content-tenant')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Informasi Kurban</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-masjid') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Informasi Kurban</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
                <form class="form form-horizontal" action="{{ route('kurban.update', $kurban->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <div class="row">

                            <div class="col-md-3">
                                <label for="tahun_hijriah">Tahun Hijriah</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <select class="form-select" name="tahun_hijriah" id="tahun_hijriah">
                                    <?php
                                    $tahun_sekarang = intval(date('Y'));
                                    $tahun_hijriah_awal = $tahun_sekarang - 579;
                                    $tahun_hijriah_akhir = $tahun_hijriah_awal + 20;
                                    for ($tahun = $tahun_hijriah_awal; $tahun <= $tahun_hijriah_akhir; $tahun++) {
                                        echo "<option value=\"$tahun\">$tahun</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="tahun_masehi">Tahun Masehi</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <select class="form-select" name="tahun_masehi" id="tahun_masehi">
                                    <?php
                                    $tahun_sekarang = intval(date('Y'));
                                    echo "<option value=\"$tahun_sekarang\">$tahun_sekarang</option>";
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="tanggal_akhir_pendaftaran">Tanggal Akhir Pendaftaran</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="date" id="tanggal_akhir_pendaftaran" class="form-control mb-3"
                                    name="tanggal_akhir_pendaftaran" placeholder="Pilih Tanggal"
                                    value="{{ now()->format('Y-m-d') }}">
                            </div>


                            <div class="col-md-4">
                                <label for="konten">Informasi / Pengumuman Kurban</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea class="form-control mb-3" id="summernote" name="konten">{{ $kurban->konten }}</textarea>
                            </div>

                            <div class="col-sm-12 d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
