<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\buku;
use App\Models\detail_peminjaman;
use App\Models\kategori_buku;
use App\Models\peminjaman;
use App\Models\rating;
use App\Models\saved;
use Exception;
use Illuminate\Http\Request;

class PerpusController extends Controller
{
    public function allBook()
    {
        try {
            $bukus = buku::with(['kategori_bukus', 'rating'])->get();

            return response([
                'message' => 'success get allBook',
                'data' => $bukus
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'error get allBook',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getByCategories($id)
    {
        try {
            // return $id;

            $kategoris = kategori_buku::all();
            $bukus = buku::with(['kategori_bukus', 'rating'])->orderBy('avg_rating', 'DESC')->where('kategori_bukus_id', $id)->get();


            return response([
                'message' => 'success get allBook',
                'data' => ['kategoris' => $kategoris, 'bukus' => $bukus]
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'error get allBook',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getDetailBook($id)
    {
        try {
            $bukus = buku::findOrFail($id);
            $keranjang = peminjaman::where('peminjam_id', auth()->user()->id)->where('status', '<', 3)->latest()->get();
            $detail_peminjaman = detail_peminjaman::whereIn('peminjaman_id', $keranjang->pluck('id'))->get();
            $ratings = rating::with('user')->where('bukus_id', $id)->where('status', 1)->latest()->get();
            $saved = saved::with('bukus')->where('bukus_id', $id)->where('users_id', auth()->user()->id)->get();

            return response([
                'message' => 'success get detail book',
                'data' =>  ['keranjang' => $keranjang, 'detail_peminjaman' => $detail_peminjaman, 'bukus' => $bukus, 'ratings' => $ratings, 'saved' => $saved]
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'error get detail book',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function saveBook(Request $request)
    {
        try {

            $save = new saved();
            $save->users_id = auth()->user()->id;
            $save->bukus_id = $request->id;
            //dd($save);

            $save->save();
            return response([
                'message' => 'success save book',
                'data' => $save
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'error save book',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function showSaveBook()
    {
        try {
            $saveList = saved::where('users_id', auth()->user()->id)->latest()->get();

            return response([
                'message' => 'saved book',
                'data' => $saveList
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'error get data save book',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getPopularBook()
    {
        try {
            $bukus = buku::with(['kategori_bukus', 'rating'])->orderBy('avg_rating', 'DESC')->get();
            $kategoris = kategori_buku::all();


            return response([
                'message' => 'saved book',
                'data' =>['data bukus' => $bukus, 'kategori' => $kategoris]
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'error getpipular book',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
