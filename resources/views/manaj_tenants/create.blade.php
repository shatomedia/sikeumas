@extends('layouts.master')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row mb-3">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Form Tambah Pengguna</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form Tambah Pengguna</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Vertical form layout section start -->
        <section id="basic-vertical-layouts">
            <div class="row match-height justify-content-center">
                <div class="col-md-7 col-12">
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
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical" action="{{ route('tenant.store') }}" method="POST">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="nama" class="form-label">Nama Lengkap (Pengurus atau
                                                        perwakilan
                                                        masjid)</label>
                                                    <input type="text" id="nama" class="form-control"
                                                        placeholder="Nama" name="nama" data-parsley-required="true" />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <input type="text" id="alamat" class="form-control"
                                                        placeholder="Alamat" name="alamat" data-parsley-required="true" />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="nama_masjid" class="form-label">Nama Masjid</label>
                                                    <input type="text" id="nama_masjid" class="form-control"
                                                        placeholder="Masjid" name="nama_masjid"
                                                        data-parsley-required="true" />
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" id="email" class="form-control" name="email"
                                                        placeholder="Email" data-parsley-required="true" />
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="telp" class="form-label">No Hp</label>
                                                    <input type="text" id="telp" class="form-control" name="telp"
                                                        placeholder="No Hp" data-parsley-required="true" />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <label for="domain" class="col-form-label col-sm-3">Domain</label>
                                                    <div class="col-sm-10 input-group">
                                                        <input type="text" id="domain" class="form-control"
                                                            name="domain" placeholder="Domain"
                                                            data-parsley-required="true" />
                                                        <span class="input-group-text">.shatomedia.com</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" id="password" class="form-control"
                                                        name="password" placeholder="Password"
                                                        data-parsley-required="true" />
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- // Basic Vertical form layout section end -->
    </div>
@endsection
