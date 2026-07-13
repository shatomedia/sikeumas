@extends('layouts.app_master')

@section('content-tenant')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Kurban</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-masjid') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Kurban</li>
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
                <a href="{{ route('kurban.create') }}" class="btn btn-primary float-end">Tambah Data Kurban</a>
            </div>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table" id="table2">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Diinput Oleh</th>
                                <th class="text-center">Tahun Kurban</th>
                                <th class="text-center">Konten</th>
                                <th class="text-center">Tgl Akhir Pendaftaran</th>
                                <th class="text-center">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kurbans as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->createdBy->name }}</td>
                                    <td class="text-center">{{ $item->tahun_hijriah }}H / {{ $item->tahun_masehi }}M</td>
                                    <td class="text-center">{{ strip_tags($item->konten) }}</td>
                                    <td class="text-center">
                                        {{ $item->tanggal_akhir_pendaftaran->translatedFormat('d-m-Y') }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('kurban.edit', $item->id) }}" class="btn btn-sm btn-primary"
                                            style="margin-right: 5px">Edit</a>
                                        <a href="{{ route('kurban.show', $item->id) }}" class="btn btn-sm btn-primary"
                                            style="margin-right: 5px">Detail</a>
                                        <form action="{{ route('kurban.destroy', $item->id) }}" method="POST">
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
