<?php

declare(strict_types=1);

use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\Tenant\InfaqController;
use App\Http\Controllers\Tenant\KasController;
use App\Http\Controllers\Tenant\LoginController;
use App\Http\Controllers\Tenant\MasjidController;
use App\Http\Controllers\Tenant\ProfilMasjidController;
use App\Http\Controllers\Tenant\UserProfilController;
use App\Http\Controllers\Tenant\WelcomeController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', [WelcomeController::class, 'index'])->name('landing');


    Route::group(['middleware' => ['web']], function () {
        Route::get('login-tenant', [LoginController::class, 'index'])->name('login-tenant');
        Route::post('/login-proses', [LoginController::class, 'authenticate'])->name('login.authenticate');
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/dashboard-masjid', [DashboardController::class, 'index'])->name('dashboard-masjid');

        Route::resource('masjid', MasjidController::class);

        Route::resource('kas', KasController::class);

        Route::resource('infaq', InfaqController::class);

        Route::resource('profile-masjid', ProfilMasjidController::class);

        Route::resource('profile', UserProfilController::class);
    });
});
