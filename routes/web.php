<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryArticleController;
use App\Http\Controllers\CkeditorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductCategoryController;
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

Route::get('/', [LandingController::class, 'index'])->name('beranda');
Route::get('/tentang-kami', [LandingController::class, 'aboutUs'])->name('about-us');
Route::get('/taqwa-hub', [LandingController::class, 'taqwaHub'])->name('taqwa-hub-landing');
Route::get('/surgery-time', [LandingController::class, 'surgeryTime'])->name('surgery-time-landing');
Route::get('/jws-m3', [LandingController::class, 'jwsM3'])->name('jws-m3-landing');
Route::get('/buku-teknologi', [LandingController::class, 'bukuTeknologi'])->name('buku-teknologi-landing');
Route::redirect('/buku-teknologi/', '/buku-teknologi');
Route::get('/produk', [LandingController::class, 'product'])->name('product');
Route::get('/produk/{slug}', [LandingController::class, 'productDetail'])->name('product-detail');
Route::get('/artikel', [LandingController::class, 'article'])->name('blog');
Route::get('/artikel/{slug}', [LandingController::class, 'articleDetail'])->name('article-detail');
Route::get('/kontak', [LandingController::class, 'contact'])->name('contact');

Route::group(['middleware' => ['web']], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login-proses', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});



Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('tenant', TenantController::class);
    Route::resource('category-product', ProductCategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('category-article', CategoryArticleController::class);
    Route::resource('article', ArticleController::class);
    Route::patch('/article/{id}/toggle-status', [ArticleController::class, 'toggleStatus'])->name('article.toggleStatus');
    Route::post('upload-image', [CkeditorController::class, 'store'])->name('ckeditor.upload');
    Route::resource('users', UserController::class);
    Route::resource('resellers', ResellerController::class);
    Route::resource('profile', UserProfileController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('roles', RolesController::class);
    Route::get('roles/{roleId}/assign-permission', [RolesController::class, 'addPermissionToRole'])->name('roles.assign-permission');
    Route::put('roles/{roleId}/assign-permission', [RolesController::class, 'givePermissionToRole'])->name('roles.give-permission');
});
