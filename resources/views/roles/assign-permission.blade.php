@extends('layouts.master')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row mb-3">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Hak Akses {{ $role->name }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Role</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Checkbox Glow start -->
        <section id="checkbox-glow">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" action="{{ route('roles.give-permission', $role->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    @foreach ($permissions as $permission)
                                        <div class="form-check">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox"
                                                    class="form-check-input form-check-secondary form-check-glow"
                                                    name="permission[]" value="{{ $permission->name }}"
                                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                    id="permission_{{ $role->id }}_{{ $permission->id }}">
                                                <label class="form-check-label"
                                                    for="permission_{{ $role->id }}_{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-12 d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Checkbox Glow end -->
    </div>
@endsection
