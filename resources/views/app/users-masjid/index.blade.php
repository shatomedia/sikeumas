@extends('layouts.app_master')

@section('content-tenant')
    <div class="page-heading">
        <div class="page-title">
            <div class="row mb-3">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Users</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Users</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('user-masjid.create') }}" class="btn btn-primary float-end">Tambah User</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Role (Peran)</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No Hp</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucfirst($user->roles->first()->name) }}</td>
                                        <td>{{ ucfirst($user->name) }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->telp }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('user-masjid.edit', $user->id) }}"
                                                class="btn btn-sm btn-primary" style="margin-right: 5px">Edit</a>
                                            @if (auth()->user()->id != $user->id)
                                                <form action="{{ route('user-masjid.destroy', $user->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="submit" class="btn btn-sm btn-secondary" value="Hapus">

                                                </form>
                                            @endif
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
