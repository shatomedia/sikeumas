@extends('layouts.master')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Artikel</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Artikel</li>
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
                <a href="{{ route('article.create') }}" class="btn btn-primary float-end">Tambah Artikel</a>
            </div>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table display nowrap" id="table2">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Gambar</th>
                                <th class="text-center">Kategori</th>
                                <th>Judul</th>
                                <th class="text-center">Tanggal Publish</th>
                                <th class="text-center">Penulis</th>
                                <th class="text-center">Views</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('blogs/' . $item->gambar) }}" alt="Gambar"
                                            style="max-width: 100px; max-height: 100px;">
                                    </td>
                                    <td class="text-center">{{ ucwords($item->CategoryArtikel->nama) }}</td>
                                    <td>{{ ucfirst($item->judul) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->publish_date)->translatedFormat('d F Y') }}</td>
                                    <td class="text-center">{{ $item->createdBy->name }}</td>
                                    <td class="text-center">{{ $item->views }}</td>
                                    @if ($item->status == '0')
                                        <td class="text-center">
                                            <span class="badge bg-danger">Draft</span>
                                        </td>
                                    @else
                                        <td class="text-center">
                                            <span class="badge bg-success">Published</span>
                                        </td>
                                    @endif
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('article.show', $item->id) }}" class="btn btn-sm btn-info"
                                            style="margin-right: 5px">Detail</a>

                                        <a href="{{ route('article.edit', $item->id) }}" class="btn btn-sm btn-primary"
                                            style="margin-right: 5px">Edit</a>
                                        <form action="{{ route('article.destroy', $item->id) }}" method="POST">
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
