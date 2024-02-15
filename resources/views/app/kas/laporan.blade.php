@extends('layouts.app_laporan')
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
    <nav class="navbar navbar-light">
        <div class="container d-block">
            <h3 class="text-center">Laporan Kas {{ $masjid->nama }}</h3>
            <h6 class="text-center">Laporan Kas {{ $masjid->alamat }}</h6>
        </div>
    </nav>


    <div class="container">
        <!-- Minimal jQuery Datatable start -->
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width=1%>No</th>
                        <th class="text-center">Diinput Oleh</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Pemasukan</th>
                        <th class="text-center">Pengeluaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kasList as $kas)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $kas->createdBy->name }}</td>
                            <td class="text-center">{{ $kas->tanggal->translatedFormat('d-m-Y') }}</td>
                            <td>{{ $kas->keterangan }}</td>
                            <td class="text-center">
                                {{ $kas->jenis == 'masuk' ? formatRupiah($kas->jumlah, true) : '-' }}</td>
                            <td class="text-center">
                                {{ $kas->jenis == 'keluar' ? formatRupiah($kas->jumlah, true) : '-' }}</td>
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
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- Minimal jQuery Datatable end -->
    </div>
@endsection
