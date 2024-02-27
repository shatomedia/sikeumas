<?php

use App\Http\Controllers\API\DomainController;
use App\Http\Controllers\API\KasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/domains', [DomainController::class, 'index']);
Route::get('/domains/{id}', [DomainController::class, 'show']);
