<?php

namespace App\Http\Controllers;

use App\Models\detail_peminjaman;
use App\Models\peminjaman;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;


class KeranjangController extends Controller
{

    public $tanggal_pinjam;

    public function show(peminjaman $keranjang)
    {
      
        return view('user_view.keranjang', [
            'keranjang' => peminjaman::latest()->where('peminjam_id', auth()->user()->id)->first()
        ]);
        // return view('user_view.keranjang', [
        //     'keranjang' => peminjaman::latest()->where('peminjam_id', auth()->user()->id)->where('status', '!=', 3)->first()
        // ]);
    }

    public function delete($id)
    {
        // $item = peminjaman::find($id);
        // if ($item) {
        //     $item->delete();
        //     return response()->json(['status' => 'success', 'message' => 'Item deleted successfully.']);
        // } else {
        //     return response()->json(['status' => 'error', 'message' => 'Item not found.']);
        // }
        // if ($peminjaman->detail_peminjaman->count() == 1) {
        //     $detail_peminjaman->delete();
        //     $peminjaman->delete();
        //     session()->flash('sukses', 'Data berhasil dihapus');
        //     redirect('/');
        // } else {
        //     $detail_peminjaman->delete();
        //     session()->flash('sukses', 'Data berhasil dihapus');
        //     //$this->emit('kurangiKeranjang');
        // }
        // //delete post by ID
        // peminjaman::where('id', $id)->delete();

        // //return response
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Data Post Berhasil Dihapus!.',
        // ]);
        // dd('hello');

        // try {

        //     $item = peminjaman::destroy($id);

        //     if ($item) {
        //         //    return  "buku berhasil dihapus";
        //         return redirect()->route('show.keranjang')->with('success', 'buku berhasil dihapus');
        //     } else {
        //         // throw new Exception("tidak ada buku denga id {$id}");
        //         dd($id);
        //     }
        // } catch (\Exception $e) {
        //     throw $e;
        // }
    }

    public static function pinjam(peminjaman $id, Request $request)
    {
        try {
            // dd($request->all());
            $validatedData = $request->validate([
                'tanggal_pinjam' => 'required|date|after_or_equal:today'

            ]);


            // Menambahkan data tambahan ke array $keranjang
            $keranjang = [
                'tanggal_pinjam' => $validatedData['tanggal_pinjam'],
                'status' => 1,
                'tanggal_kembali' => Carbon::create($validatedData['tanggal_pinjam'])->addDays(10)
            ];

            // Menemukan objek peminjaman berdasarkan ID
            $find = peminjaman::find($id)->first()->fill($keranjang);

            $find->save();

            //dd($find);

            return redirect()->route('show.keranjang')->with('success', 'buki berhasil dipinjam');
        } catch (Exception $e) {
            //dd($e);
            // return response()->json([
            //     'message' => 'Gagallllllllllllllllllllllllll ' . $e->getMessage()
            // ], 500);

            return redirect()->route('show.keranjang')->with('error', 'tanggal harus setelah hari ini atau hari ini');
        }
    }
    // public static function pinjam1(peminjaman $id, Request $request)
    // {
    //     try {
    //         dd($request->all());


    //         // Menambahkan data tambahan ke array $keranjang
    //         $keranjang = [
    //             'tanggal_pinjam' => today(),
    //             'status' => 1,
    //             'tanggal_kembali' => Carbon::create(['tanggal_pinjam'])->addDays(10)
    //         ];

    //         // Menemukan objek peminjaman berdasarkan ID
    //         $find = peminjaman::find($id)->first()->fill($keranjang);

    //         $find->save();

    //         //dd($find);

    //         return redirect()->back()->with('success', 'buki berhasil dipinjam');
    //     } catch (Exception $e) {
    //         //dd($e);
    //         // return response()->json([
    //         //     'message' => 'Gagallllllllllllllllllllllllll ' . $e->getMessage()
    //         // ], 500);

    //         return redirect()->route('show.keranjang')->with('error', 'tanggal harus setelah hari ini atau hari ini');
    //     }
    // }
}
