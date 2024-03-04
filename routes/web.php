<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingController::class, 'index']);

Route::group(['middleware' => ['web']], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login-proses', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});



Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('tenant', TenantController::class);
    Route::resource('produk', ProductController::class);
    Route::resource('users', UserController::class);
    Route::resource('resellers', ResellerController::class);
    Route::resource('profile', UserProfileController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('roles', RolesController::class);
    Route::get('roles/{roleId}/assign-permission', [RolesController::class, 'addPermissionToRole'])->name('roles.assign-permission');
    Route::put('roles/{roleId}/assign-permission', [RolesController::class, 'givePermissionToRole'])->name('roles.give-permission');
});
