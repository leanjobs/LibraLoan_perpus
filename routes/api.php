<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PerpusController;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Models\kategori_buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);
Route::get('/profile', [AuthController::class, 'profile'])->middleware(['auth:sanctum']);



Route::get('/all-book', [PerpusController::class, 'allBook'])->middleware(['auth:sanctum']);
Route::get('/show-transaksi', [TransaksiController::class, 'allTransaksi'])->middleware(['auth:sanctum']);
Route::get('/show-peminjaman', [TransaksiController::class, 'getPeminjaman'])->middleware(['auth:sanctum']);
Route::get('/show-denda', [TransaksiController::class, 'getDenda'])->middleware(['auth:sanctum']);
Route::get('/show-penolakan', [TransaksiController::class, 'getPenolakan'])->middleware(['auth:sanctum']);
Route::get('/show-history', [TransaksiController::class, 'getHistory'])->middleware(['auth:sanctum']);
Route::get('/detail-book/{id}', [PerpusController::class, 'getDetailBook'])->middleware(['auth:sanctum']);
Route::get('/categories-book/{id}', [PerpusController::class, 'getByCategories'])->middleware(['auth:sanctum']);
Route::get('/show-popular-book', [PerpusController::class, 'getPopularBook'])->middleware(['auth:sanctum']);


Route::post('/pinjam/{id}', [TransaksiController::class, 'pinjamBook'])->middleware(['auth:sanctum']);
Route::post('/rating/{id}', [TransaksiController::class, 'ratingBook'])->middleware(['auth:sanctum']);
Route::post('/save-book/{id}', [PerpusController::class, 'saveBook'])->middleware(['auth:sanctum']);
Route::get('/save-book', [PerpusController::class, 'showSaveBook'])->middleware(['auth:sanctum']);
Route::put('/update-user/{id}', [AuthController::class, 'updateUser'])->middleware(['auth:sanctum']);
