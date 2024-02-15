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
                    <h3>Kas Masjid</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kas Masjid</li>
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
                        <a href="{{ route('kas.create') }}" class="btn btn-primary">Tambah Data</a>
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
                                <th class="text-center" width= "1%">No</th>
                                <th class="text-center">Diinput Oleh</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Pemasukan</th>
                                <th class="text-center">Pengeluaran</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kasList as $kas)
                                <tr>
                                    <td class="text-center" width= "1%">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $kas->createdBy->name }}</td>
                                    <td class="text-center">{{ $kas->tanggal->translatedFormat('d-m-Y') }}</td>
                                    <td>{{ $kas->keterangan }}</td>
                                    <td class="text-end">
                                        {{ $kas->jenis == 'masuk' ? formatRupiah($kas->jumlah, true) : '-' }}</td>
                                    <td class="text-end">
                                        {{ $kas->jenis == 'keluar' ? formatRupiah($kas->jumlah, true) : '-' }}</td>
                                    <td class="d-flex text-end">
                                        <a href="{{ route('kas.edit', $kas->id) }}" class="btn btn-sm btn-primary"
                                            style="margin-right: 5px">Edit</a>
                                        <form action="{{ route('kas.destroy', $kas->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" class="btn btn-sm btn-secondary" value="Hapus">

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-center fw-bold"><strong>TOTAL</strong></td>
                                <td class="text-center">
                                    <strong>{{ formatRupiah($totalPemasukan, true) }}</strong>
                                </td>
                                <td class="text-center">
                                    <strong>{{ formatRupiah($totalPengeluaran, true) }}</strong>
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
            <div class="card-header">
                <h5 class="card-title">
                    Saldo : {{ formatRupiah($saldoAkhir, true) }}
                </h5>
            </div>
        </div>

    </section>
    <!-- Minimal jQuery Datatable end -->
@endsection
