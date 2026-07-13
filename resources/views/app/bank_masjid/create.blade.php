@extends('layouts.app_master')

@section('content-tenant')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Bank Masjid </h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-masjid') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Bank Masjid</li>
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
                <form class="form form-horizontal" action="{{ route('masjid-bank.store') }}" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="bank_id">Nama Bank</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <select class="form-select" name="bank_id" id="bank_id">
                                    <option value="">Pilih Bank</option>
                                    @foreach ($listBank as $id => $namaBank)
                                        <option value="{{ $id }}">{{ $namaBank }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="nama_rekening">Nama Pemilik</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" id="nama_rekening" class="form-control mb-3" name="nama_rekening"
                                    placeholder="Atas Nama">
                            </div>
                            <div class="col-md-3">
                                <label for="nomor_rekening">Nomor Rekening</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" id="nomor_rekening" class="form-control mb-3" name="nomor_rekening"
                                    placeholder="Nomor Rekening">
                            </div>

                            <div class="col-sm-12 d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
