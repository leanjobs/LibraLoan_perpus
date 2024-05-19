<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\kategori_buku;
use Exception;
use Illuminate\Http\Request;


class BukuController extends Controller
{
    public function buku()
    {
        $bukus = buku::with('kategori_bukus')->get();
        $kategoris = kategori_buku::all();
        return view('perpus.buku.index', compact('bukus', 'kategoris'));
    }
    public function createBuku(Request $request)
    {
        try {
            $buku = $request->validate([
                'judul' => 'required|string',
                'pengarang' => 'required|string',
                'stok' => 'required|integer',
                'tahun_terbit' => 'required',
                'deskripsi' => 'required',
                'kategori_bukus_id' => 'required',

            ]);

            if ($request->file('image')) {
                $buku['image'] = $request->file('image')->store('cover-images');
            };


            $buku = buku::create($buku);
            // return response()->json([
            //     'message' => 'berhasil tambah buku',
            //     'data' => $buku
            // ]);
            return redirect()->route('daftar_buku')->with('success', 'buku berhasil ditambahkan');
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal menambah bukuuu ' . $e->getMessage()
            ], 500);
        }
    }
    // public function showBuku()
    // {
    //     return buku::all();
    // }
    // public function showCreateBuku()
    // {

    //     $kategoris = kategori_buku::all();
    //     return view('perpus.buku.createBuku', compact('kategoris'));
    // }

    public function showCreate()
    {
        $kategoris = kategori_buku::all();
        return view('perpus.buku.createBuku',  compact('kategoris'));
    }

    public function showEdit($id)
    {
        $buku = buku::find($id);
        $kategoris = kategori_buku::all();
        return view('perpus.buku.updateBuku', compact('buku', 'kategoris'));
    }

    // public function showBukuById($id)
    // {
    //     return buku::find($id);
    // }
    public function updateBuku(Request $request, $id)
    {
        try {
            $buku = $request->validate([
                'judul' => 'required|string',
                'pengarang' => 'required|string',
                'stok' => 'required|integer',
                'tahun_terbit' => 'required',
                'deskripsi' => 'required',
                'kategori_bukus_id' => 'required',

            ]);

            if ($request->file('image')) {
                $buku['image'] = $request->file('image')->store('cover-images');
            };

            // dd($buku);

            $find = buku::findOrFail($id);
            $find->update($buku);
            // return response()->json([
            //     'message' => 'berhasil tambah buku',
            //     'data' => $buku
            // ]);
            return redirect()->route('daftar_buku')->with('success', 'buku berhasil diupdate');
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal update bukuuu ' . $e->getMessage()
            ], 500);
        }
    }
    public function deleteBuku($id)
    {
        try {
            $buku = Buku::destroy($id);

            if ($buku) {
                //    return  "buku berhasil dihapus";
                return redirect()->route('daftar_buku')->with('success', 'buku berhasil dihapus');
            } else {
                throw new Exception("tidak ada buku denga id $id");
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
