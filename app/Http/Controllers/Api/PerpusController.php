<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\buku;
use App\Models\kategori_buku;
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
}
