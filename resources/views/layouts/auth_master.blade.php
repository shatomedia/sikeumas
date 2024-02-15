<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Dashboard</title>
    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon-1.svg') }}" type="image/x-icon">
    <link rel="stylesheet" crossorigin href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('assets/compiled/css/auth.css') }}">
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <div id="auth">
        <div class="row h-100">
            @yield('auth-content')

            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <img src="{{ asset('assets/static/images/bg/bg-2.jpg') }}" alt="background"
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
        </div>

    </div>
</body>

</html>
