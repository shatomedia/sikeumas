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
                            <div class="col-md-12">
                                <label for="foto">Gambar ( Maximal 2mb / 2048kb )</label>
                            </div>
                            <div class="col-12 col-md-8 form-group">
                                <input type="file" name="gambar" class="image-resize-filepond">
                                @error('gambar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="judul">Judul</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" id="judul" class="form-control mb-3" name="judul"
                                    placeholder="Judul" value="{{ old('judul') }}">
                                @error('judul')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="kategori">Kategori</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <select id="kategori" class="form-control" name="category_id">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->nama }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="konten">Isi Artikel</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea id="ckeditor" cols="30" name="konten" rows="10">{{ old('konten') }}</textarea>
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
@section('js')
    <script src="{{ asset('js/ckeditor.js') }}"></script>
@endsection
