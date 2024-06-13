<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\detail_peminjaman;
use App\Models\peminjaman;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;


class KeranjangController extends Controller
{

    public $tanggal_pinjam;

    public function show(peminjaman $keranjang)
    {


        $keranjang = Peminjaman::with('detail_peminjaman')->where('peminjam_id', auth()->user()->id)->where('status', '<', 4)->latest()->get();
        //return $keranjang;
        // dd($keranjang);
        $buku = buku::all();
        $detail_peminjaman = detail_peminjaman::with('buku')->whereIn('peminjaman_id', $keranjang->pluck('id'))->whereIn('bukus_id', $buku->pluck('id'))->latest()->get();



        return view('user_view.keranjang', compact('keranjang', 'detail_peminjaman'));
    }
    public function showPeminjaman(peminjaman $keranjang)
    {


        $keranjang = Peminjaman::where('peminjam_id', auth()->user()->id)->where('status', '<', 3)->latest()->get();
        //return $keranjang;
        $detail_peminjaman = detail_peminjaman::whereIn('peminjaman_id', $keranjang->pluck('id'))->get();


        return view('user_view.keranjang', compact('keranjang', 'detail_peminjaman'));
    }
    public function showDenda(peminjaman $keranjang)
    {


        $keranjang = Peminjaman::where('peminjam_id', auth()->user()->id)->where('status', 4)->latest()->get();
        //return $keranjang;
        $detail_peminjaman = detail_peminjaman::whereIn('peminjaman_id', $keranjang->pluck('id'))->get();


        return view('user_view.keranjang', compact('keranjang', 'detail_peminjaman'));
    }
    public function showHistory(peminjaman $keranjang)
    {


        $keranjang = Peminjaman::where('peminjam_id', auth()->user()->id)->where('status', 3)->latest()->get();
        //return $keranjang;
        $detail_peminjaman = detail_peminjaman::whereIn('peminjaman_id', $keranjang->pluck('id'))->get();


        return view('user_view.keranjang', compact('keranjang', 'detail_peminjaman'));
    }
    public function showPenolakan(peminjaman $keranjang)
    {


        $keranjang = Peminjaman::where('peminjam_id', auth()->user()->id)->where('status', 5)->latest()->get();
        //return $keranjang;
        $detail_peminjaman = detail_peminjaman::whereIn('peminjaman_id', $keranjang->pluck('id'))->get();


        return view('user_view.keranjang', compact('keranjang', 'detail_peminjaman'));
    }

    public function delete($id)
    {
        try {
            $keranjang = peminjaman::find($id)->first();
            dd($keranjang);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public static function pinjam(peminjaman $id, Request $request)
    {
        try {
            $keranjang = [
                'tanggal_pinjam' => today(),
                'status' => 1,
                'tanggal_kembali' => Carbon::today()->addDays(10)
            ];

            $find = peminjaman::find($id)->first()->fill($keranjang);

            $find->save();

            return redirect()->route('show.keranjang')->with('success', 'buki berhasil dipinjam');
        } catch (Exception $e) {

            return redirect()->route('show.keranjang')->with('error', 'tanggal harus setelah hari ini atau hari ini');
        }
    }
}
