<?php

namespace App\Http\Controllers;

use App\Models\kategori_buku;
use Exception;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function kategori()
    {
        $kategoris = kategori_buku::all();
        return view('perpus.kategori.index', compact('kategoris'));
    }
    public function createKategori(Request $request)
    {
        try {
            $kategori = $request->validate([
                'nama_kategori' => 'required|string',

            ]);



            $kategori = kategori_buku::create($kategori);
            // return response()->json([
            //     'message' => 'berhasil tambah buku',
            //     'data' => $kategori
            // ]);
             return redirect()->route('kategori_buku')->with('success', 'kategori buku berhasil ditambahkan');
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal menambah kategori bukuuu ' . $e->getMessage()
            ], 500);
        }
    }
    public function showKategori()
    {
        return kategori_buku::all();
    }

    public function showKategoriById($id)
    {
        return kategori_buku::find($id);
    }
    public function updateKategori(Request $request, $id)
    {
        try {
            $kategori = $request->validate([
                'nama_kategori' => 'required|string',

            ]);


            $find = kategori_buku::findOrFail($id);
            $find->update($kategori);
            // return response()->json([
            //     'message' => 'berhasil tambah buku',
            //     'data' => $kategori
            // ]);
            return redirect()->route('kategori_buku')->with('success', 'kategori buku berhasil ditambahkan');
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal menambah kategori bukuuu ' . $e->getMessage()
            ], 500);
        }
    }
    public function deleteKategori($id)
    {
        try {
            $kategori = kategori_buku::destroy($id);

            if ($kategori) {
                //return "kategori berhasil dihapus";
                return redirect()->route('kategori_buku')->with('success', 'buku berhasil dihapus');
            } else {
                throw new Exception("tidak ada kategori denga id $id");
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
