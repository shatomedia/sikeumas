@extends('layouts.master')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Produk</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Produk</li>
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
                <a href="{{ route('product.create') }}" class="btn btn-primary float-end">Tambah Produk</a>
            </div>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table display nowrap" id="table2">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Gambar</th>
                                <th class="text-center">Diinput Oleh</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Deskripsi</th>
                                <th class="text-center">Spesifikasi</th>
                                <th class="text-center">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('products/' . $item->foto) }}" alt="Gambar"
                                            style="max-width: 100px; max-height: 100px;">
                                    </td>
                                    <td class="text-center">{{ $item->createdBy->name }}</td>
                                    <td class="text-center">{{ $item->nama }}</td>
                                    <td class="text-center">{{ Str::limit($item->deskripsi, 30) }}</td>
                                    <td class="text-center">{{ Str::words(strip_tags($item->spesifikasi), 8, '...') }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('product.edit', $item->id) }}" class="btn btn-sm btn-primary"
                                            style="margin-right: 5px">Edit</a>
                                        <form action="{{ route('product.destroy', $item->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" class="btn btn-sm btn-secondary" value="Hapus">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Minimal jQuery Datatable end -->
@endsection
