<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/aspirasi', [App\Http\Controllers\ApiController::class, 'tambahAspirasi'])->name('tambahAspirasi');
Route::post('/daftar', [App\Http\Controllers\ApiController::class, 'daftarPemilihan'])->name('daftarPemilihan');
Route::post('/login', [\App\Http\Controllers\ApiController::class, 'login']);
Route::post('/cakahim', [\App\Http\Controllers\ApiController::class, 'showCakahim']);
Route::post('/cakahim-id', [\App\Http\Controllers\ApiController::class, 'showCakahimID']);
Route::post('/aspirasi-id', [\App\Http\Controllers\ApiController::class, 'showAspirasiID']);
Route::post('/users', [\App\Http\Controllers\ApiController::class, 'users']);
Route::get('/artikel/', [App\Http\Controllers\ApiController::class, 'allArtikel'])->name('mobileArtikel');
Route::get('/artikel/{artikel_slug}', [App\Http\Controllers\ApiController::class, 'detailArtikel'])->name('mobiledetail');
