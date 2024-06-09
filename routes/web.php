
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthController as ControllersAuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserViewController;
use App\Models\KategoriBuku;
use Illuminate\Support\Facades\Route;

Route::get('/signIn', function () {
    return view('new_login');
})->name('login');

Route::get('/signUp', function () {
    return view('register');
})->name('regis');

Route::get('/', function () {
    return view('landing_page');
})->name('landingPage');

Route::get('/test', function () {
    return view('test');
});

//login action

Route::post('/postLogin', [AuthController::class, 'login'])->name('login_user');

// //register action

Route::post(('/register'), [AuthController::class, 'register'])->name('register_user');

// //logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['middleware' => ['auth', 'CekRole:user']], function () {
    //Route::get('/perpus', [BukuController::class, 'perpus'])->name('daftar_buku');
    Route::get('/dashboard', [UserViewController::class, 'showBook'])->name('userview');
    Route::post('/keranjang/{id}', [UserViewController::class, 'keranjang'])->name('tambah.keranjang');
    Route::get('/show/keranjang', [KeranjangController::class, 'show'])->name('show.keranjang');
    Route::get('/show/peminjaman', [KeranjangController::class, 'showPeminjaman'])->name('show.peminjaman');
    Route::get('/show/denda', [KeranjangController::class, 'showDenda'])->name('show.denda');
    Route::get('/show/history', [KeranjangController::class, 'showHistory'])->name('show.history');
    Route::get('/show/penolakan', [KeranjangController::class, 'showPenolakan'])->name('show.penolakan');
    Route::get('/detailBuku/{id}', [UserViewController::class, 'detailBook'])->name('detailBook');
    Route::delete('/delete/keranjang/{id}', [KeranjangController::class, 'delete'])->name('delete.keranjang');
    Route::post('/pinjam/{id}', [KeranjangController::class, 'pinjam'])->name('pinjam.keranjang');
    Route::post('/rating/{id}', [UserViewController::class, 'addRating'])->name('add.rating');
    Route::post('/save/{id}', [UserViewController::class, 'savedBook'])->name('save.book');
    Route::delete('/detailBuku/delete/{id}', [UserViewController::class, 'deleteSave'])->name('delete.save');
    Route::get('/profile', [SaveController::class, 'showSaved'])->name('show.save');
    Route::put('update/user/{id}', [UserViewController::class, 'updateUser'])->name('update.profile');
    Route::get('/popular', [UserViewController::class, 'popular'])->name('popular.book');
    Route::get('/kategoriBuku/{id}', [UserViewController::class, 'kategoriBuku'])->name('popular.book');
});

Route::group(['middleware' => ['auth', 'CekRole:petugas,admin']], function () {
    Route::get('/perpus', [BukuController::class, 'buku'])->name('daftar_buku');
    Route::delete('buku/delete/{id}', [BukuController::class, 'deleteBuku'])->name('buku.delete');
    Route::post('buku/createbuku', [BukuController::class, 'createBuku'])->name('buku.create');
    //Route::get('show/buku/createbuku', [BukuController::class, 'showCreateBuku'])->name('show.createBuku');
    Route::put('buku/update/{id}', [BukuController::class, 'updateBuku'])->name('buku.update');
    Route::get('/show/createBuku', [BukuController::class, 'showCreate'])->name('test');
    //Route::get('/show/editBuku/{id}', [BukuController::class, 'showEdit'])->name('test2');
    Route::get('/update/{id}', [BukuController::class, 'showEdit'])->name('test');


    Route::get('perpus/kategori', [KategoriController::class, 'kategori'])->name('kategori_buku');
    Route::delete('perpus/kategori/delete/{id}', [KategoriController::class, 'deleteKategori'])->name('kategori.delete');
    Route::post('perpus/kategori/create', [KategoriController::class, 'createKategori'])->name('kategori.create');
    Route::put('perpus/kategori/update/{id}', [KategoriController::class, 'updateKategori'])->name('kategori.update');


    Route::get('/rating', [RatingController::class, 'showRating'])->name('show.rating');
    Route::post('/updateRating', [RatingController::class, 'updateRating'])->name('update.rating');
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

Route::group(['middleware' => ['auth', 'CekRole:petugas']], function () {
    Route::get('/transaksi/semua', [TransaksiController::class, 'index'])->name('transaksi.semua');
    Route::get('/transaksi/belumdipinjam', [TransaksiController::class, 'belumDipinjam'])->name('transaksi.belum');
    Route::get('/transaksi/sedangdipinjam', [TransaksiController::class, 'sedangDipinjam'])->name('transaksi.sedang');
    Route::get('/transaksi/selesaidipinjam', [TransaksiController::class, 'selesaiDipinjam'])->name('transaksi.selesai');
    Route::get('/transaksi/tolakPeminjaman', [TransaksiController::class, 'tolakPeminjaman'])->name('transaksi.tolak');
    Route::get('/transaksi/denda', [TransaksiController::class, 'denda'])->name('transaksi.denda');
    Route::get('/showDenda/{id}', [TransaksiController::class, 'showDenda'])->name('show.denda');
    Route::post('/transaksi/pinjam/{id}', [TransaksiController::class, 'pinjam'])->name('transaksi.pinjam');
    Route::post('/transaksi/tolak/{id}', [TransaksiController::class, 'tolak'])->name('transaksi.tolak');
    Route::post('/transaksi/kembali/{id}', [TransaksiController::class, 'kembali'])->name('transaksi.kembali');
    Route::post('/transaksi/bayarDenda/{id}', [TransaksiController::class, 'bayarDenda'])->name('transaksi.bayar');
    Route::get('/transaksi/exportExcel', [TransaksiController::class, 'exportExcel'])->name('transaksi.excel');
    Route::get('/test-view', function () {
        $peminjaman = \App\Models\peminjaman::all();
        return view('transaksi.index', compact('peminjaman'));
    });
    Route::get('/export-pdf', [TransaksiController::class, 'exportPdf'])->name('transaksi.pdf');
});
