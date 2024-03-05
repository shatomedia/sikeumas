@extends('layouts.master')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Artikel</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Artikel</li>
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
                <form class="form form-horizontal" action="{{ route('article.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="judul">Judul</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" id="judul" class="form-control mb-3" name="judul"
                                    placeholder="Judul">
                            </div>
                            <div class="col-md-3">
                                <label for="judul">Kategori</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" id="judul" class="form-control mb-3" name="judul"
                                    placeholder="Judul">
                            </div>
                            <div class="col-md-12">
                                <label for="konten">Isi Artikel</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea class="form-control" id="konten" name="konten" rows="3"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="foto">Gambar</label>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <input type="file" id="foto" name="foto" class="image-preview-filepond">
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
