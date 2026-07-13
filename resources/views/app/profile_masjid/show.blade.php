@extends('layouts.app_master')

@section('content-tenant')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail {{ $data->judul }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-masjid') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail {{ $data->judul }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Borderless table start -->
        <section class="section mt-4">
            <div class="row" id="table-borderless">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <!-- table with no border -->
                            <div class="table-responsive">
                                <table class="table table-borderless mb-5 mt-2">
                                    <tr>
                                        <td width="15%">Judul</td>
                                        <td>: {{ $data->judul }}</td>
                                    </tr>
                                    <tr>
                                        <td>Konten</td>
                                        <td>{!! $data->konten !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Posting</td>
                                        <td>: {!! $data->created_at->translatedFormat('l, d F Y') !!}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Borderless table end -->
    </div>
@endsection
