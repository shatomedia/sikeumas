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
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Infaq</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Infaq</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </div>
    <!-- Minimal jQuery Datatable start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex bd-highlight mb-3 align-items-center">
                    <div class="me-auto bd-highlight">
                        <a href="{{ route('infaq.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                    <div class="bd-highlight mx-1">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" id="tanggal_mulai" class="form-control" name="tanggal_mulai"
                            placeholder="Pilih Tanggal" value="{{ \Carbon\Carbon::now()->toDateString() }}">
                    </div>
                    <div class="bd-highlight mx-1">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" id="tanggal_selesai" class="form-control" name="tanggal_selesai"
                            placeholder="Pilih Tanggal" value="{{ \Carbon\Carbon::now()->toDateString() }}">
                    </div>
                    <div class="bd-highlight">
                        <a href="#" target="blank" id="cetak" class="btn icon icon-left btn-primary mt-4"><i
                                data-feather="printer"></i> Cetak
                            Laporan</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table" id="table2">
                        <thead>
                            <tr>
                                <th class="text-center" width="1%">No</th>
                                <th>Diinput Oleh</th>
                                <th class="text-center">Tanggal</th>
                                <th>Sumber</th>
                                <th>Keterangan</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($query as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->createdBy->name }}</td>
                                    <td>{{ $item->created_at->translatedFormat('d-m-y') }}</td>
                                    <td>{{ $item->sumber }}</td>
                                    <td>{{ $item->atas_nama }}</td>
                                    <td class="text-center">{{ $item->jenis }}</td>
                                    <td class="text-center">
                                        @if ($item->jenis == 'uang')
                                            {{ formatRupiah($item->jumlah, true) }}
                                        @else
                                            {{ $item->jumlah }} {{ $item->satuan }}
                                        @endif
                                    </td>
                                    <td class="d-flex text-center">
                                        <a href="{{ route('infaq.edit', $item->id) }}" class="btn btn-sm btn-primary"
                                            style="margin-right: 5px">Edit</a>
                                        <form action="{{ route('infaq.destroy', $item->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" class="btn btn-sm btn-secondary" value="Hapus">

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Minimal jQuery Datatable end -->
@endsection
