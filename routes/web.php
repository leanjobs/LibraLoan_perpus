
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthController as ControllersAuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserViewController;
use App\Models\KategoriBuku;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/regis', function () {
    return view('register');
})->name('regis');



//login action

Route::post('/login', [AuthController::class, 'login'])->name('login_user');

// //register action

Route::post(('/register'), [AuthController::class, 'register'])->name('register_user');

// //logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/perpus', [BukuController::class, 'perpus']);

// Route::prefix('user')->middleware('auth:user')->group(function () {
//     Route::get('/dashboard', function () {
//         return view('user.index');
//     })->name('dashboard.user');
// });

// Route::prefix('perpus')->group(function () {
//     Route::get('/', [BukuController::class, 'buku'])->name('daftar_buku');
//     Route::delete('buku/delete/{id}', [BukuController::class, 'deleteBuku'])->name('buku.delete');
//     Route::post('buku/createbuku', [BukuController::class, 'createBuku'])->name('buku.create');
//     Route::put('buku/update/{id}', [BukuController::class, 'updateBuku'])->name('buku.update');

//     Route::get('/kategori', [KategoriController::class, 'kategori'])->name('kategori_buku');
//     Route::delete('/kategori/delete/{id}', [KategoriController::class, 'deleteKategori'])->name('kategori.delete');
//     Route::post('/kategori/create', [KategoriController::class, 'createKategori'])->name('kategori.create');
//     Route::put('/kategori/update/{id}', [KategoriController::class, 'updateKategori'])->name('kategori.update');


//     // Route::get('/kelas', [KelasController::class, 'index'])->name('kelas_user');
//     // Route::post('/kelas/create', [KelasController::class, 'createKelas'])->name('kelas.create');
//     // Route::delete('/kelas/{id}', [KelasController::class, 'deleteKelas'])->name('kelas.delete');
//     // Route::put('/kelas/update/{id}', [KelasController::class, 'updateKelas'])->name('kelas.update');


//     Route::get('/user', [UserController::class, 'user'])->name('daftar_user');
//     Route::post('/user/create', [UserController::class, 'createUser'])->name('user.create');
//     Route::delete('/user/{id}', [UserController::class, 'deleteUser'])->name('user.delete');
//     Route::put('/user/update/{id}', [UserController::class, 'updateUser'])->name('user.update');
// });

// Route::group(['middleware' => ['auth', 'CekRole:admin']], function () {

//     Route::get('/perpus', [BukuController::class, 'perpus'])->name('daftar_buku');
//     Route::get('/dashboard', [UserViewController::class, 'index']);
// });

Route::group(['middleware' => ['auth', 'CekRole:user']], function () {
    //Route::get('/perpus', [BukuController::class, 'perpus'])->name('daftar_buku');
    Route::get('/dashboard', [UserViewController::class, 'userview'])->name('userview');
});

Route::group(['middleware' => ['auth', 'CekRole:petugas,admin']], function () {
    Route::get('/perpus', [BukuController::class, 'buku'])->name('daftar_buku');
    Route::delete('buku/delete/{id}', [BukuController::class, 'deleteBuku'])->name('buku.delete');
    Route::post('buku/createbuku', [BukuController::class, 'createBuku'])->name('buku.create');
    Route::put('buku/update/{id}', [BukuController::class, 'updateBuku'])->name('buku.update');

    Route::get('perpus/kategori', [KategoriController::class, 'kategori'])->name('kategori_buku');
    Route::delete('perpus/kategori/delete/{id}', [KategoriController::class, 'deleteKategori'])->name('kategori.delete');
    Route::post('perpus/kategori/create', [KategoriController::class, 'createKategori'])->name('kategori.create');
    Route::put('perpus/kategori/update/{id}', [KategoriController::class, 'updateKategori'])->name('kategori.update');
});
Route::group(['middleware' => ['auth', 'CekRole:admin']], function () {
    Route::get('perpus/user', [UserController::class, 'user'])->name('daftar_user');
    Route::post('perpus/user/create', [UserController::class, 'createUser'])->name('user.create');
    Route::delete('perpus/user/{id}', [UserController::class, 'deleteUser'])->name('user.delete');
    Route::put('perpus/user/update/{id}', [UserController::class, 'updateUser'])->name('user.update');

    Route::get('perpus/petugas', [UserController::class, 'petugas'])->name('daftar_petugas');
    Route::post('perpus/petugas/create', [UserController::class, 'createPetugas'])->name('petugas.create');
    Route::delete('perpus/petugas/{id}', [UserController::class, 'deletePetugas'])->name('petugas.delete');
    Route::put('perpus/petugas/update/{id}', [UserController::class, 'updatePetugas'])->name('petugas.update');
});
