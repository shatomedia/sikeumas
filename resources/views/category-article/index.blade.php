{{-- @extends('layouts.master')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Kategori Artikel</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kategori Artikel</li>
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
                <a href="{{ route('category-article.create') }}" class="btn btn-primary float-end">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table display nowrap" id="table2">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 1%">No</th>
                                <th class="text-center">Slug</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categoryArticles as $item)
                                <tr>
                                    <td class="text-center" style="width: 1%">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->slug }}</td>
                                    <td class="text-center">{{ ucfirst($item->nama) }}</td>
                                    <td class="text-center">{{ $item->created_at->translatedFormat('d-m-Y') }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('category-article.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary" style="margin-right: 5px">Edit</a>
                                        <form action="{{ route('category-article.destroy', $item->id) }}" method="POST">
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
@endsection --}}

{{-- @extends('layouts.master')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Kategori Artikel</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kategori Artikel</li>
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
                <a href="{{ route('category-article.create') }}" class="btn btn-primary float-end">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table display nowrap" id="table2">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 1%">No</th>
                                <th class="text-center">Slug</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categoryArticles as $item)
                                <tr>
                                    <td class="text-center" style="width: 1%">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->slug }}</td>
                                    <td class="text-center">{{ ucfirst($item->nama) }}</td>
                                    <td class="text-center">{{ $item->created_at->translatedFormat('d F Y') }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('category-article.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary" style="margin-right: 5px">Edit</a>
                                        <button class="btn btn-sm btn-secondary"
                                            onclick="confirmDelete('{{ route('category-article.destroy', $item->id) }}')">Hapus</button>
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

    <!-- Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">Peringatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <form id="deleteForm" action="" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-primary">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(url) {
            document.getElementById('deleteForm').action = url;
            var myModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'), {
                keyboard: false
            });
            myModal.show();
        }
    </script>
@endsection --}}

@extends('layouts.master')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Kategori Artikel</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kategori Artikel</li>
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
                <button class="btn btn-primary float-end" onclick="openCreateModal()">Tambah Data</button>
            </div>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table display nowrap" id="table2">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 1%">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categoryArticles as $item)
                                <tr>
                                    <td class="text-center" style="width: 1%">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ ucfirst($item->nama) }}</td>
                                    <td class="text-center">{{ $item->created_at->format('d F Y') }}</td>
                                    <td class="d-flex justify-content-center">
                                        <button class="btn btn-sm btn-primary" style="margin-right: 5px"
                                            onclick="openEditModal('{{ $item->id }}', '{{ $item->nama }}')">Edit</button>
                                        <button class="btn btn-sm btn-secondary"
                                            onclick="confirmDelete('{{ route('category-article.destroy', $item->id) }}')">Hapus</button>
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

    <!-- Create/Edit Modal -->
    <div class="modal fade" id="createEditModal" tabindex="-1" aria-labelledby="createEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createEditModalLabel">Tambah/Edit Kategori Artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createEditForm" method="POST">
                    @csrf
                    <div id="editMethod"></div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">Peringatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <form id="deleteForm" action="" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-primary">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openCreateModal() {
            document.getElementById('createEditForm').action = '{{ route('category-article.store') }}';
            document.getElementById('editMethod').innerHTML = '';
            document.getElementById('createEditModalLabel').innerText = 'Tambah Kategori Artikel';
            document.getElementById('nama').value = '';
            var myModal = new bootstrap.Modal(document.getElementById('createEditModal'), {
                keyboard: false
            });
            myModal.show();
        }

        function openEditModal(id, nama) {
            document.getElementById('createEditForm').action = '/category-article/' + id;
            document.getElementById('editMethod').innerHTML = '@method('PUT')';
            document.getElementById('createEditModalLabel').innerText = 'Edit Kategori Artikel';
            document.getElementById('nama').value = nama;
            var myModal = new bootstrap.Modal(document.getElementById('createEditModal'), {
                keyboard: false
            });
            myModal.show();
        }

        function confirmDelete(url) {
            document.getElementById('deleteForm').action = url;
            var myModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'), {
                keyboard: false
            });
            myModal.show();
        }
    </script>
@endsection
