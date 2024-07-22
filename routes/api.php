<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiPerpusController;
use App\Http\Controllers\Api\ApiTransaksiController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Models\kategori_buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/register', [ApiAuthController::class, 'register']);
Route::get('/logout', [ApiAuthController::class, 'logout'])->middleware(['auth:sanctum']);
Route::get('/profile', [ApiAuthController::class, 'profile'])->middleware(['auth:sanctum']);



Route::get('/all-book', [ApiPerpusController::class, 'allBook']);
Route::get('/show-transaksi', [ApiTransaksiController::class, 'allTransaksi'])->middleware(['auth:sanctum']);
Route::get('/show-peminjaman', [ApiTransaksiController::class, 'getPeminjaman'])->middleware(['auth:sanctum']);
Route::get('/show-denda', [ApiTransaksiController::class, 'getDenda'])->middleware(['auth:sanctum']);
Route::get('/show-penolakan', [ApiTransaksiController::class, 'getPenolakan'])->middleware(['auth:sanctum']);
Route::get('/show-history', [ApiTransaksiController::class, 'getHistory'])->middleware(['auth:sanctum']);
Route::get('/detail-book/{id}', [ApiPerpusController::class, 'getDetailBook'])->middleware(['auth:sanctum']);
Route::get('/categories-book/{id}', [ApiPerpusController::class, 'getByCategories'])->middleware(['auth:sanctum']);
Route::get('/show-popular-book', [ApiPerpusController::class, 'getPopularBook'])->middleware(['auth:sanctum']);


Route::post('/pinjam/{id}', [ApiTransaksiController::class, 'pinjamBook'])->middleware(['auth:sanctum']);
Route::post('/rating/{id}', [ApiTransaksiController::class, 'ratingBook'])->middleware(['auth:sanctum']);
Route::post('/save-book/{id}', [ApiPerpusController::class, 'saveBook'])->middleware(['auth:sanctum']);
Route::get('/save-book', [ApiPerpusController::class, 'showSaveBook'])->middleware(['auth:sanctum']);
Route::put('/update-user/{id}', [ApiAuthController::class, 'updateUser'])->middleware(['auth:sanctum']);
Route::get('/search-book/{name?}', [ApiPerpusController::class, 'searchBook'])->middleware(['auth:sanctum']);
