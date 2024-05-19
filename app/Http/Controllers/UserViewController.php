<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\detail_peminjaman;
use App\Models\kategori_buku;
use App\Models\peminjaman;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use function Laravel\Prompts\alert;

class UserViewController extends Controller
{
    // public function userview()
    // {
    //     return view('user_view.index');
    // }

    public function showBook()
    {
        $bukus = buku::with('kategori_bukus')->get();
        $kategoris = kategori_buku::all();
        return view('user_view.index', compact('bukus', 'kategoris'));
    }

    public function detailBook(Request $request, $id)
    {
        $bukus = buku::findOrFail($id);
        $kategoris = kategori_buku::all();

        //dd($bukus);

        return view('user_view.detail_buku', compact('bukus', 'kategoris'));
    }
    public function keranjang($id)
    {
        $bukus = buku::findOrFail($id);
        $peminjaman_lama = DB::table('peminjaman')
            ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
            ->where('peminjam_id', auth()->user()->id)
            ->where('status', '!=', 3)
            ->get();

        // jumlah maksimal 2
        if ($peminjaman_lama->count() == 2) {
            return response()->json(['status' => 'error', 'message' => 'maks buku 2']);
        } else {

            // peminjaman belum ada isinya
            if ($peminjaman_lama->count() == 0) {
                $peminjaman_baru = peminjaman::create([

                    'kode_pinjam' => random_int(100000000, 999999999),
                    'peminjam_id' => auth()->user()->id,
                    'status' => 0
                ]);

                detail_peminjaman::create([
                    'peminjaman_id' => $peminjaman_baru->id,
                    'buku_id' => $bukus->id
                ]);

                //$this->emit('tambahKeranjang');
                return response()->json(['status' => 'success', 'message' => 'Book added to cart successfully!mmnmnm']);
            } else {

                // buku tidak boleh sama
                if ($peminjaman_lama[0]->buku_id == $bukus->id) {
                    return response()->json(['status' => 'error', 'message' => 'buku tidak boleh sama']);
                } else {

                    detail_peminjaman::create([
                        'peminjaman_id' => $peminjaman_lama[0]->peminjaman_id,
                        'buku_id' => $bukus->id
                    ]);

                    //$this->emit('tambahKeranjang');
                    return response()->json(['status' => 'success', 'message' => 'Book added to cart successfully!']);
                }
            }
        }
    }
    // public $count;
    // public function mount()
    // {
    //     $this->count = DB::table('peminjaman')
    //         ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
    //         ->where('peminjam_id', auth()->user()->id)
    //         ->where('status', '!=', 3)
    //         ->count();
    //     dd($this->count);
    // }
    // public function tambahKeranjang()
    // {
    //     // $this->count += 1;
    // }
}
