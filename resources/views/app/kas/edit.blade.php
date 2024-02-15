@extends('layouts.app_master')

@section('content-tenant')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Data</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Saldo Akhir Saat ini: {{ formatRupiah($saldoAkhir, true) }}
                </h5>
            </div>
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
                <form class="form form-horizontal" action="{{ route('kas.update', $kas->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="tanggal">Tanggal Transaksi</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="date" id="tanggal" class="form-control mb-3" name="tanggal"
                                    placeholder="Pilih Tanggal" value="{{ old('tanggal', now()->format('Y-m-d')) }}"
                                    disabled>
                            </div>

                            <div class="col-md-4">
                                <label for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="keterangan" class="form-control mb-3" name="keterangan"
                                    placeholder="Keterangan" value="{{ $kas->keterangan }}">
                            </div>

                            <div class="col-md-4">
                                <label for="jenis">Jenis Transaksi</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="jenis" id="masuk"
                                        value="masuk" {{ $kas->jenis == 'masuk' ? 'checked' : '' }} disabled>
                                    <label class="form-check-label" for="masuk">
                                        Pemasukan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis" id="keluar"
                                        value="keluar" {{ $kas->jenis == 'keluar' ? 'checked' : '' }} disabled>
                                    <label class="form-check-label" for="keluar">
                                        Pengeluaran
                                    </label>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="nominal">Jumlah Transaksi</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" id="nominal" class="form-control" name="jumlah"
                                        placeholder="Jumlah" value="{{ $kas->jumlah }}">
                                </div>
                            </div>

                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
