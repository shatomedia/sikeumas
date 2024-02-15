@extends('layouts.app_master')
@section('js')
    <script>
        $(document).ready(function() {
            $("#cetak").click(function(e) {
                var tanggalMulai = $("#tanggal_mulai").val();
                var tanggalSelesai = $("#tanggal_selesai").val();
                params = "?page=laporan&tanggal_mulai=" + tanggalMulai + "&tanggal_selesai=" +
                    tanggalSelesai;
                window.open("/kas" + params, "_blank");
            })
        });
    </script>
@endsection

@section('content-tenant')
    <div class="page-heading">
        <div class="page-title">
            <div class="row mb-3">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Masjid</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Masjid</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Bordered table start -->
        <section class="section">
            <div class="row" id="table-bordered">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-content">
                            <!-- table bordered -->
                            <div class="table-responsive">
                                <table class="table table-bordered mb-3">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width= "1%">No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Alamat</th>
                                            <th class="text-center">No Hp</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($masjid as $mas)
                                            <tr>
                                                <td class="text-center" width= "1%">{{ $loop->iteration }}</td>
                                                <td class="text-bold-500">{{ $mas->nama }}</td>
                                                <td>{{ $mas->alamat }}</td>
                                                <td class="text-bold-500">{{ $mas->telp }}</td>
                                                <td>{{ $mas->email }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('masjid.edit', $mas->id) }}"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Bordered table end -->

    </div>
@endsection
