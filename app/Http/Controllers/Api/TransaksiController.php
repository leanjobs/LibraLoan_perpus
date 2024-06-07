<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\buku;
use App\Models\detail_peminjaman;
use App\Models\kategori_buku;
use App\Models\peminjaman;
use App\Models\rating;
use App\Models\saved;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function allTransaksi()
    {
        try {
            $keranjang = peminjaman::with('detail_peminjaman')->where('peminjam_id', auth()->user()->id)->where('status', '<', 4)->latest()->get();
            $buku = buku::all();
            $detail_peminjaman = detail_peminjaman::with('buku')->whereIn('peminjaman_id', $keranjang->pluck('id'))->whereIn('bukus_id', $buku->pluck('id'))->latest()->get();


            return response([
                'message' => 'success get allTransaksi',
                'data' =>  ['keranjang' => $keranjang, 'detail_peminjaman' => $detail_peminjaman]
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'error get allTransaksi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getPeminjaman()
    {
        try {
            $keranjang = Peminjaman::where('peminjam_id', auth()->user()->id)->where('status', '<', 3)->latest()->get();
            $detail_peminjaman = detail_peminjaman::whereIn('peminjaman_id', $keranjang->pluck('id'))->get();

            return response([
                'message' => 'success get peminjaman',
                'data' =>  ['keranjang' => $keranjang, 'detail_peminjaman' => $detail_peminjaman]
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'error get peminjaman',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getDenda()
    {
        try {
            $keranjang = Peminjaman::where('peminjam_id', auth()->user()->id)->where('status', 4)->latest()->get();
            $detail_peminjaman = detail_peminjaman::whereIn('peminjaman_id', $keranjang->pluck('id'))->get();

            return response([
                'message' => 'success get denda',
                'data' => ['keranjang' => $keranjang, 'detail_peminjaman' => $detail_peminjaman]
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'error get denda',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getPenolakan()
    {
        try {
            $keranjang = Peminjaman::where('peminjam_id', auth()->user()->id)->where('status', 5)->latest()->get();
            $detail_peminjaman = detail_peminjaman::whereIn('peminjaman_id', $keranjang->pluck('id'))->get();

            return response([
                'message' => 'success get penolakan',
                'data' => ['keranjang' => $keranjang, 'detail_peminjaman' => $detail_peminjaman]
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'error get penolakan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getHistory()
    {
        try {
            $keranjang = Peminjaman::where('peminjam_id', auth()->user()->id)->where('status', 3)->latest()->get();
            $detail_peminjaman = detail_peminjaman::whereIn('peminjaman_id', $keranjang->pluck('id'))->get();

            return response([
                'message' => 'success get denda',
                'data' =>  ['keranjang' => $keranjang, 'detail_peminjaman' => $detail_peminjaman]
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'error get denda',
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
    public function pinjamBook(Request $request, peminjaman $id)
    {
        try {
            $keranjang = [
                'tanggal_pinjam' => today(),
                'status' => 1,
                'tanggal_kembali' => Carbon::today()->addDays(10)
            ];

            $find = peminjaman::find($id)->first()->fill($keranjang);
            $find->save();

            return response([
                'message' => 'success pinjam book',
                'data' =>  $find
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'error pinjam book',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function ratingBook(Request $request, $id)
    {
        try {
        } catch (Exception $e) {
        }
    }
}
