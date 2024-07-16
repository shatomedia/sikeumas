@extends('layouts.master')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row mb-3">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Resellers</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Resellers</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('resellers.create') }}" class="btn btn-primary float-end">Tambah Resellers</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table display nowrap" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>No Hp</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resellers as $reseller)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $reseller->name }}</td>
                                        <td>{{ $reseller->alamat }}</td>
                                        <td>{{ $reseller->email }}</td>
                                        <td>{{ $reseller->telp }}</td>
                                        <td>{{ $reseller->status }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('resellers.edit', $reseller->id) }}"
                                                class="btn btn-sm btn-primary" style="margin-right: 5px">Edit</a>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal{{ $reseller->id }}">
                                                Hapus
                                            </button>
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="confirmDeleteModal{{ $reseller->id }}"
                                                tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi
                                                                Hapus</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus data ini?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tidak</button>
                                                            <form action="{{ route('resellers.destroy', $reseller->id) }}"
                                                                method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-primary">
                                                                    (Ya)
                                                                    Hapus
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
