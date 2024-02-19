@extends('layouts.app_master')

@section('content-tenant')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Bank Masjid</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Bank Masjid</li>
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
                <a href="{{ route('masjid-bank.create') }}" class="btn btn-primary float-end">Tambah Bank Masjid</a>
            </div>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table" id="table2">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Bank</th>
                                <th class="text-center">Kode Bank</th>
                                <th class="text-center">AN. Rekening</th>
                                <th class="text-center">No Rekening</th>
                                <th class="text-center">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banks as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->nama_bank }}</td>
                                    <td class="text-center">{{ $item->kode_bank }}</td>
                                    <td class="text-center">{{ $item->nama_rekening }}</td>
                                    <td class="text-center">{{ $item->nomor_rekening }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('masjid-bank.edit', $item->id) }}" class="btn btn-sm btn-primary"
                                            style="margin-right: 5px">Edit</a>
                                        <form action="{{ route('masjid-bank.destroy', $item->id) }}" method="POST">
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
