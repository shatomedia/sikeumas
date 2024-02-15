@extends('layouts.auth_master')

@section('auth-content')
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <h2 class="text-center">Sistem Manajemen Keuangan Masjid</h2>
            <p class="mb-5 text-center">Silahkan masuk untuk mengelola data masjid</p>

            <form action="{{ route('login.authenticate') }}" method="POST">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="email" name="email" class="form-control form-control-xl" placeholder="Email">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                    @error('email')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" name="password" class="form-control form-control-xl" placeholder="Password">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    @error('password')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-check form-check-lg d-flex align-items-end">
                    <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label text-gray-600" for="flexCheckDefault">
                        Keep me logged in
                    </label>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
            </form>
            <div class="text-center mt-5 text-lg fs-5">
                {{-- <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a></p> --}}
            </div>
        </div>
    </div>
@endsection
