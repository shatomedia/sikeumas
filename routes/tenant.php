<?php

declare(strict_types=1);

use App\Http\Controllers\API\GetInformasiController;
use App\Http\Controllers\API\GetKasController;
use App\Http\Controllers\API\GetKategoriInformasiController;
use App\Http\Controllers\API\SummaryController;
use App\Http\Controllers\Tenant\CategoryController;
use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\Tenant\InfaqController;
use App\Http\Controllers\Tenant\InformasiController;
use App\Http\Controllers\Tenant\KasController;
use App\Http\Controllers\Tenant\KurbanController;
use App\Http\Controllers\Tenant\LoginController;
use App\Http\Controllers\Tenant\MasjidBankController;
use App\Http\Controllers\Tenant\MasjidController;
use App\Http\Controllers\Tenant\PermissionController;
use App\Http\Controllers\Tenant\ProfilMasjidController;
use App\Http\Controllers\Tenant\RolesController;
use App\Http\Controllers\Tenant\UserProfilController;
use App\Http\Controllers\Tenant\UsersMasjidController;
use App\Http\Controllers\Tenant\WelcomeController;
use App\Http\Controllers\Tenant\SummaryPageController;
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
    Route::get('/ringkasan', [SummaryPageController::class, 'index'])
        ->name('ringkasan');


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
        Route::resource('kurban', KurbanController::class);
        Route::resource('masjid-bank', MasjidBankController::class);
        Route::resource('kategori', CategoryController::class);
        Route::resource('informasi', InformasiController::class);
        Route::resource('permission-masjid', PermissionController::class);
        Route::resource('roles-masjid', RolesController::class);
        Route::resource('user-masjid', UsersMasjidController::class);
        Route::resource('profile', UserProfilController::class);
        Route::get('roles/{roleId}/assign-permission', [RolesController::class, 'addPermissionToRole'])->name('roles.assign-permission');
        Route::put('roles/{roleId}/assign-permission', [RolesController::class, 'givePermissionToRole'])->name('roles.give-permission');
    });
});

Route::middleware([
    'api',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/get-kas', [GetKasController::class, 'index'])->name('get-kas');
    Route::get('/get-kategori-informasi', [GetKategoriInformasiController::class, 'index'])->name('get-kategori-informasi');
    Route::get('/get-informasi', [GetInformasiController::class, 'index'])->name('get-informasi');
    Route::get('/get-informasi-terakhir', [GetInformasiController::class, 'latest'])->name('get-informasi-terakhir');
    Route::get('/saldo', [GetKasController::class, 'saldo'])->name('get-saldo');
    Route::get('/summary', [SummaryController::class, 'index'])
        ->name('api-summary');
});
