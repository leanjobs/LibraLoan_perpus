<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Models\kategori_buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//kategori
Route::post('kategori/create', [KategoriController::class, 'createKategori']);
Route::get('kategori/show', [KategoriController::class, 'showKategori']);
Route::get('kategori/show/{id}', [KategoriController::class, 'showKategoriById']);
Route::put('kategori/update/{id}', [KategoriController::class, 'updateKategori']);
Route::delete('kategori/delete/{id}', [KategoriController::class, 'deleteKategori']);

//buku
Route::post('buku/create', [BukuController::class, 'createBuku']);
Route::get('buku/show', [BukuController::class, 'showBuku']);
Route::get('buku/show/{id}', [BukuController::class, 'showBukuById']);
Route::put('buku/update/{id}', [BukuController::class, 'updateBuku']);
Route::delete('buku/delete/{id}', [BukuController::class, 'deleteBuku']);



//user
Route::post('user/create', [UserController::class, 'createUser']);
Route::get('user/show', [UserController::class, 'showUser']);
Route::get('user/show/{id}', [UserController::class, 'showUserById']);
Route::put('user/update/{id}', [UserController::class, 'updateUser']);
Route::delete('user/delete/{is}', [UserController::class, 'deleteUser']);
