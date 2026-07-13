@extends('layouts.app_master')

@section('content-tenant')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Acara / Agenda</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-masjid') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Acara</li>
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
                <form class="form form-horizontal" action="{{ route('informasi.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="kategori_id">Kategori</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <select class="form-select" id="kategori_id" name="kategori_id">
                                    @foreach ($data['listKategori'] as $key => $value)
                                        <option value="{{ $key }}">{{ ucwords($value) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="judul">Judul</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" id="judul" class="form-control mb-3" name="judul"
                                    placeholder="Judul">
                            </div>
                            <div class="col-md-3">
                                <label for="tanggal">Tanggal ( boleh dikosongkan )</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="date" id="tanggal" class="form-control mb-3" name="tanggal"
                                    placeholder="Pilih Tanggal" value="{{ now()->format('Y-m-d') }}">
                            </div>
                            <div class="col-md-12">
                                <label for="konten">Konten</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea class="form-control" id="konten" name="konten" rows="3"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="gambar">Gambar ( boleh dikosongkan )</label>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <input type="file" id="gambar" name="gambar" class="image-preview-filepond">
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
