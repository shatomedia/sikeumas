@extends('layouts.app_master')

@section('content-tenant')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Data</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
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
                <form class="form form-horizontal" action="{{ route('infaq.store') }}" method="post">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="created_at">Tanggal Infaq</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="date" id="created_at" class="form-control mb-3" name="created_at"
                                    placeholder="Pilih Tanggal" value="{{ now()->format('Y-m-d') }}">
                                <span class="text-danger">{{ $errors->first('created_at') }}</span>
                            </div>

                            <div class="col-md-4">
                                <label for="sumber">Sumber</label>
                            </div>
                            <fieldset class="col-md-8 form-group">
                                <select class="form-control form-select mb-3" id="sumber" name="sumber">
                                    @foreach ($listSumberInfaq as $sumberInfaq)
                                        <option>{{ $sumberInfaq }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->first('sumber') }}</span>
                            </fieldset>

                            <div class="col-md-4">
                                <label for="atas_nama">Keterangan(boleh dikosongkan)</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="atas_nama" class="form-control mb-3" name="atas_nama"
                                    placeholder="Keterangan">
                                <span class="text-danger">{{ $errors->first('atas_nama') }}</span>
                            </div>

                            <div class="col-md-4">
                                <label for="jenis">Jenis Infaq</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <div class="form-check mb-2 mt-3">
                                    <input class="form-check-input" type="radio" name="jenis" id="uang"
                                        value="uang" checked>
                                    <label class="form-check-label" for="uang">
                                        Uang Tunai
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis" id="barang"
                                        value="barang">
                                    <label class="form-check-label" for="barang">
                                        Barang
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="jumlah">Jumlah Infaq</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <div class="input-group">
                                    <input type="text" id="jumlah" class="form-control" name="jumlah"
                                        placeholder="Jumlah">
                                </div>
                                <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="satuan">Satuan Jumlah (Kg,Rupiah,Sak,dll)</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="satuan" class="form-control mb-3 mt-3" name="satuan"
                                    placeholder="Satuan">
                                <span class="text-danger">{{ $errors->first('satuan') }}</span>
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
