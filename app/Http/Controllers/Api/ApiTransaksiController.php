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
use Illuminate\Support\Facades\DB;

class ApiTransaksiController extends Controller
{
    public function allTransaksi()
    {
        try {
            $keranjang = peminjaman::with(['detail_peminjaman', 'buku'])->where('peminjam_id', auth()->user()->id)->where('status', '<', 4)->latest()->get();
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
            $keranjang = Peminjaman::with('detail_peminjaman')->where('peminjam_id', auth()->user()->id)->where('status', '<', 3)->latest()->get();
            $detail_peminjaman = detail_peminjaman::with('buku')->whereIn('peminjaman_id', $keranjang->pluck('id'))->get();

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
            $detail_peminjaman = detail_peminjaman::with('buku')->whereIn('peminjaman_id', $keranjang->pluck('id'))->get();

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
            $detail_peminjaman = detail_peminjaman::with('buku')->whereIn('peminjaman_id', $keranjang->pluck('id'))->get();

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
            $detail_peminjaman = detail_peminjaman::with('buku')->whereIn('peminjaman_id', $keranjang->pluck('id'))->get();

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


    public function pinjamBook($id)
    {
        try {
            $bukus = buku::find($id);
            //dd($bukus);
            $peminjaman_lama = DB::table('peminjaman')
                ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
                ->where('peminjam_id', auth()->user()->id)
                ->where('status', '<', 3)
                ->get();

            $menunggak = DB::table('peminjaman')
                ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
                ->where('peminjam_id', auth()->user()->id)
                ->where('status', 4)
                ->get();

            if (!$menunggak->isEmpty()) {
                return response([
                    'message' => 'gagal meminjam buku, bayar denda terlebih dahulu',
                    'data' =>  $menunggak
                ], 200);
            }

            // jumlah maksimal 3
            if ($peminjaman_lama->count() >= 3) {
                return response([
                    'message' => 'gagal meminjam buku, maks 3 buku',
                    'data' =>  $peminjaman_lama
                ], 200);
            } else {

                foreach ($peminjaman_lama as $peminjaman) {
                    if ($peminjaman->bukus_id == $bukus->id) {
                        return response([
                            'message' => 'buku tidak boleh sama',
                            'data' => ['data buku peminjaman' => $peminjaman->bukus_id, 'buku ingin dipinjam' => $bukus->id]
                        ], 200);
                    }
                }

                $peminjaman_baru = peminjaman::create([
                    'tanggal_pinjam' => today(),
                    // 'tanggal_kembali' =>today()->addDay(),
                    'kode_pinjam' => random_int(100000000, 999999999),
                    'peminjam_id' => auth()->user()->id,
                    'status' => 1,
                ]);

                detail_peminjaman::create([
                    'peminjaman_id' => $peminjaman_baru->id,
                    'bukus_id' => $bukus->id
                ]);

                // $bukus->stok -= 1;
                // $bukus->save();

                return response([
                    'message' => 'berhasil pinjam buku',
                    'data' => ['peminjaman' => $peminjaman_baru, 'list peminjaman' => $peminjaman_lama]
                ], 200);
            }
        } catch (Exception $e) {
            return response([
                'message' => 'error apa hayo',
                'data' => $e->getMessage()
            ], 500);
        }
    }
    public function ratingBook(Request $request, $id)
    {
        try {
            $keranjang = Peminjaman::where('peminjam_id', auth()->user()->id)
                ->where('status', 3)
                ->latest()
                ->get();
            $detail_peminjaman = detail_peminjaman::whereIn('peminjaman_id', $keranjang->pluck('id'))->get();
            $dipinjam = $detail_peminjaman->contains('bukus_id', $id);

            if (!$dipinjam) {
                return response([
                    'message' => 'pinjam dan selesaikan buku terlebihdahulu',
                    'data' => $dipinjam
                ], 200);
            }

            $ratingCount = rating::where(['users_id' => auth()->user()->id, 'bukus_id' => $id])->count();

            if ($ratingCount > 0) {
                return response([
                    'message' => 'gagal, kamu telah memberi rating dibuku ini',
                    'data' => $ratingCount
                ], 200);
            } else {

                try {
                    $request->validate([
                        'rating' => 'required|integer|min:1|max:5',
                        'review' => 'required|max:1000',
                    ]);

                    $rating = new rating;
                    $rating->users_id = auth()->user()->id;
                    $rating->bukus_id = $id;
                    $rating->rating = $request->rating;
                    $rating->review = $request->review;
                    $rating->status = 1;
                    //dd($rating);

                    $rating->save();

                    $averageRating = rating::where('bukus_id', $id)->avg('rating');
                    $buku = Buku::find($id);
                    $buku->avg_rating = $averageRating;
                    $buku->save();


                    return response([
                        'message' => 'kamu telah memberi rating dibuku ini',
                        'data' => ['rating & review' => $rating, 'buku' => $buku]
                    ], 200);
                } catch (Exception $e) {
                    return response([
                        'message' => 'gagal',
                        'data' => $e->getMessage()
                    ], 500);
                }
            }
        } catch (Exception $e) {
            return response([
                'message' => 'gagallll',
                'data' => $e->getMessage()
            ], 500);
        }
    }
}
