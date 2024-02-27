@extends('layouts.app_master')

@section('content-tenant')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3> Agenda / Acara Masjid</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Agenda Masjid</li>
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
                <a href="{{ route('informasi.create') }}" class="btn btn-primary float-end">Tambah Acara</a>
            </div>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table display nowrap" id="table2">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Gambar</th>
                                <th class="text-center">Diinput Oleh</th>
                                <th class="text-center">Tanggal</th>
                                {{-- <th class="text-center">Kategori</th> --}}
                                <th class="text-center">Judul</th>
                                <th class="text-center">Konten</th>
                                <th class="text-center">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agendas as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('uploads/' . $item->gambar) }}" alt="Gambar"
                                            style="max-width: 100px; max-height: 100px;">
                                    </td>
                                    <td class="text-center">{{ $item->createdBy->name }}</td>
                                    <td class="text-center">{{ $item->tanggal->translatedFormat('d-m-Y') }}</td>
                                    {{-- <td class="text-center">{{ $item->kategori_id }}</td> --}}
                                    <td class="text-center">{{ $item->judul }}</td>
                                    <td class="text-center">{{ strip_tags($item->konten) }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('informasi.edit', $item->id) }}" class="btn btn-sm btn-primary"
                                            style="margin-right: 5px">Edit</a>
                                        {{-- <a href="{{ route('profile-masjid.show', $item->id) }}"
                                            class="btn btn-sm btn-primary" style="margin-right: 5px">Detail</a> --}}
                                        <form action="{{ route('informasi.destroy', $item->id) }}" method="POST">
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
