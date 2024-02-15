@extends('layouts.app_master')
@section('js')
    <script>
        var options = {
            series: [{
                name: "Total Infaq",
                data: @json($dataTotalInfaq)
            }],
            chart: {
                height: 280,
                type: 'bar',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Total Infaq Perbulan',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: @json($dataBulan),
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toLocaleString("id-ID", {
                            style: "currency",
                            currency: "IDR"
                        });
                    }
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>

    {{-- <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }} --}}
@endsection
@section('content-tenant')
    <div class="page-heading">
        <section class="section">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <i class="iconly-boldWallet"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Total Saldo Akhir</h6>
                                        <h6 class="font-extrabold mb-0">{{ formatRupiah($saldoAkhir, true) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldChart"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Total Infaq Hari ini</h6>
                                        <h6 class="font-extrabold mb-0">{{ formatRupiah($totalInfaq, true) }}</h6>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon green mb-2">
                                            <i class="iconly-boldGraph"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Pemasukan Hari ini</h6>
                                        <h6 class="font-extrabold mb-0">{{ formatRupiah($totalPemasukan, true) }}</h6>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon red mb-2">
                                            <i class="iconly-boldLogout"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Pengeluaran Hari ini</h6>
                                        <h6 class="font-extrabold mb-0">{{ formatRupiah($totalPengeluaran, true) }}</h6>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Striped rows start -->
        <section class="section">
            <div class="row" id="table-striped">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Transaksi Terbaru</h4>
                        </div>
                        <div class="card-content">
                            <!-- table striped -->
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Keterangan</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Jenis</th>
                                            <th class="text-start">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($kas as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-bold-500">{{ $item->keterangan }}</td>
                                                <td class="text-center">{{ $item->tanggal->translatedFormat('d-m-y') }}</td>
                                                <td class="text-center">
                                                    @if (strtolower($item->jenis) === 'masuk')
                                                        <span class="badge bg-primary">Masuk</span>
                                                    @elseif(strtolower($item->jenis) === 'keluar')
                                                        <span class="badge bg-warning">Keluar</span>
                                                    @endif
                                                </td>
                                                <td class="text-start">{{ formatRupiah($item->jumlah, true) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Data tidak ada</td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Striped rows end -->

        <section class="row">
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <h4>Profile Visit</h4>
                    </div> --}}
                    <div class="card-body">
                        {{-- {!! $chart->container() !!} --}}
                        <div id="chart"></div>
                        {{-- <div id="chart-profile-visit"></div> --}}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
