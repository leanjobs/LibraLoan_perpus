<?php

namespace App\Http\Controllers;

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

        $bukus = buku::with(['kategori_bukus', 'rating'])->get();
        $kategoris = kategori_buku::all();

        return view('user_view.index', compact('bukus', 'kategoris'));
    }

    public function detailBook($id)
    {
        // dd($saveds_id);
        $bukus = buku::findOrFail($id);
        // $kategoris = kategori_buku::all();
        $keranjang = peminjaman::where('peminjam_id', auth()->user()->id)->where('status', '<', 3)->latest()->get();
        // $detail_peminjaman = detail_peminjaman::where('peminjaman_id', $keranjang->id)->latest()->get();
        $detail_peminjaman = detail_peminjaman::whereIn('peminjaman_id', $keranjang->pluck('id'))->get();
        $ratings = rating::with('user')->where('bukus_id', $id)->where('status', 1)->latest()->get();
        $saved = saved::with('bukus')->where('bukus_id', $id)->where('users_id', auth()->user()->id)->get();

        // $avg_rating = $ratings->avg('rating');
        // dd($avg_rating);
        //dd($bukus);

        return view('user_view.detail_buku', compact('bukus', 'keranjang', 'detail_peminjaman', 'ratings', 'saved'));
    }
    public function keranjang($id)
    {

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

        //jika masih ada yang menunggak
        if (!$menunggak->isEmpty()) {
            return redirect()->back()->with('error', 'tidak dapat meminjam, bayar denda terlebih dahulu');
        }

        // jumlah maksimal 2
        if ($peminjaman_lama->count() >= 2) {
            return redirect()->back()->with('error', 'max 2 books!');
            // return response()->json(['status' => 'error', 'message' => 'maks buku 2']);
        } else {

            foreach ($peminjaman_lama as $peminjaman) {
                if ($peminjaman->bukus_id == $bukus->id) {
                    // dd($peminjaman->bukus_id == $bukus->id);
                    return redirect()->back()->with('error', 'buku tidak boleh samasssss');
                }
            }

            // peminjaman belum ada isinya
            if ($peminjaman_lama->count() == 0) {

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

                $bukus->stok -= 1;
                $bukus->save();

                //    $buku = buku::latest()->get();
                //    dd($buku);

                //$this->emit('tambahKeranjang');
                return redirect()->back()->with('success', 'Book borrowed successfully!');
            } else {
                $peminjaman_baru = peminjaman::create([
                    'tanggal_pinjam' => today(),
                    //'tanggal_kembali' => Carbon::create(['tanggal_pinjam'])->addDays(10),
                    'kode_pinjam' => random_int(100000000, 999999999),
                    'peminjam_id' => auth()->user()->id,
                    'status' => 1,
                ]);

                detail_peminjaman::create([
                    'peminjaman_id' => $peminjaman_baru->id,
                    'bukus_id' => $bukus->id
                ]);

                $bukus->stok -= 1;
                $bukus->save();

                //$this->emit('tambahKeranjang');
                return redirect()->back()->with('success', 'Book borrowed successfully!');
            }
        }
    }

    public function addRating(Request $request, $id)
    {

        $keranjang = Peminjaman::where('peminjam_id', auth()->user()->id)
            ->where('status', 3)
            ->latest()
            ->get();
        $detail_peminjaman = detail_peminjaman::whereIn('peminjaman_id', $keranjang->pluck('id'))->get();
        $dipinjam = $detail_peminjaman->contains('bukus_id', $id);

        if (!$dipinjam) {
            return redirect()->back()->with('error', 'You need to borrow and finish the book before you can rate it!');
        }

        $ratingCount = rating::where(['users_id' => auth()->user()->id, 'bukus_id' => $id])->count();

        if ($ratingCount > 0) {
            return redirect()->back()->with('error', 'You have already rated this book!');
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


                return redirect()->back()->with('success', 'thanks for the rating');
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'failed add rating' . $e->getMessage());
            }
        }

        //dd($data);
    }

    public function savedBook(Request $request)
    {
        try {

            $save = new saved();
            $save->users_id = auth()->user()->id;
            $save->bukus_id = $request->id;
            //dd($save);

            $save->save();

            return redirect()->back()->with('success', 'book saved');
        } catch (Exception $e) {
        }
    }
    public function deleteSave($id, Request $request)
    {
        try {
            $bukus_id = $request->input('save');
            $saved = saved::destroy($id);
            //dd($saved);
            if ($saved) {
                return redirect()->back()->with('success', 'buku berhasil dihapus');
            } else {
                throw new Exception("tidak ada buku denga id $id");
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
