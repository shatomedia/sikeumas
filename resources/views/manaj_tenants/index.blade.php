@extends('layouts.master')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row mb-3">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Pengguna</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Pengguna</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('tenant.create') }}" class="btn btn-primary float-end">Tambah Pengguna</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table display nowrap" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Masjid</th>
                                    <th>Email</th>
                                    <th>No Hp</th>
                                    <th>Domain</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listTenant as $tenant)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $tenant->createdBy->name }}</td>
                                        <td>{{ $tenant->nama }}</td>
                                        <td>{{ $tenant->alamat }}</td>
                                        <td>{{ $tenant->nama_masjid }}</td>
                                        <td>{{ $tenant->email }}</td>
                                        <td>{{ $tenant->telp }}</td>
                                        <td>
                                            @foreach ($tenant->domains as $domain)
                                                {{ $domain->domain }}{{ $loop->last ? '' : ', ' }}
                                            @endforeach
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('tenant.edit', $tenant->id) }}"
                                                class="btn btn-sm btn-primary" style="margin-right: 5px">Edit</a>
                                            <form action="{{ route('tenant.destroy', $tenant->id) }}" method="POST">
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
        <!-- Basic Tables end -->

    </div>
@endsection
