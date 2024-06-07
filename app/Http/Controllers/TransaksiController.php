<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiDataExport;
use App\Models\buku;
use App\Models\detail_peminjaman;
use App\Models\peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Mpdf\Mpdf;

class TransaksiController extends Controller
{
    public function index()
    {
        // $peminjaman = Peminjaman::with(['user', 'buku'])->latest()->where('status', '!=', 0)->get();
        // $detail_peminjaman = detail_peminjaman::whereIn('peminjaman_id', $peminjaman->pluck('id'))->get();
        // $users = User::all();
        $peminjaman = Peminjaman::latest()->where('status', '!=', 0)->get();
        $detail_peminjaman = detail_peminjaman::with('buku')->whereIn('peminjaman_id', $peminjaman->pluck('id'))->latest()->get();
        $users = User::all();

        //dd($peminjaman);

        //dd($peminjaman->first(), $peminjaman->first()->user);
        return view('transaksi.index', compact('peminjaman', 'users'));
    }
    public function belumDipinjam()
    {
        $peminjaman = Peminjaman::latest()->where('status', 1)->get();
        $users = User::all();

        //dd($peminjaman->first(), $peminjaman->first()->user);
        return view('transaksi.index', compact('peminjaman', 'users'));
    }
    public function sedangDipinjam()
    {
        $peminjaman = Peminjaman::latest()->where('status', 2)->get();
        $users = User::all();

        //dd($peminjaman->first(), $peminjaman->first()->user);
        return view('transaksi.index', compact('peminjaman', 'users'));
    }
    public function selesaiDipinjam()
    {
        $peminjaman = Peminjaman::latest()->where('status', 3)->get();
        $users = User::all();

        //dd($peminjaman->first(), $peminjaman->first()->user);
        return view('transaksi.index', compact('peminjaman', 'users'));
    }
    public function denda()
    {
        $peminjaman = Peminjaman::latest()->where('status', 4)->get();
        $users = User::all();

        //dd($peminjaman->first(), $peminjaman->first()->user);
        return view('transaksi.index', compact('peminjaman', 'users'));
    }
    public function tolakPeminjaman()
    {
        $peminjaman = Peminjaman::latest()->where('status', 5)->get();
        $users = User::all();

        //dd($peminjaman->first(), $peminjaman->first()->user);
        return view('transaksi.index', compact('peminjaman', 'users'));
    }
    public function pinjam(peminjaman $id)
    {
        $id->update([
            'tanggal_kembali' => today()->addDay(10),
            'petugas_pinjam' => auth()->user()->id,
            'status' => 2
        ]);
        return redirect()->route('transaksi.sedang');
    }
    public function tolak(peminjaman $id)
    {
        $id->update([
            // 'tanggal_kembali' => today()->addDay(10),
            'petugas_pinjam' => auth()->user()->id,
            'status' => 5
        ]);
        return redirect()->route('transaksi.sedang');
    }
    public function kembali(Request $request, peminjaman $id)
    {
        $kondisi = $request->input('kondisi.' . $id->id);;
        //dd($kondisi);
        $totalDenda = 0;
        //$data['denda'] = $totalDenda;

        //dd($kondisi);
        $details = detail_peminjaman::where('peminjaman_id', $id->id)->get();
        foreach ($details as $detail) {
            $buku = buku::find($detail->bukus_id);
            if ($buku) {
                if ($kondisi == 'hilang') {
                    //dd($buku->harga_buku);
                    $denda = $buku->harga_buku;
                    $totalDenda += $denda;
                    // $data['denda'] = $denda;
                    $data['status'] = 4;
                    $id->kondisi = 'hilang';
                    $data['kondisi'] = 'hilang';

                    $id->update($data);

                    //  dd($id);
                } elseif ($kondisi === 'rusak') {
                    $denda = $buku->harga_buku * 0.5;
                    $totalDenda += $denda;
                    //$data['denda'] = $denda;
                    $data['status'] = 4;
                    //$data['kondisi'] = 'rusak';
                    $id->kondisi = 'rusak';
                    // $buku->stok += 1;

                    $id->update($data); // Ganti setengah harga buku jika rusak
                    //dd($kondisi);
                } else {
                    // dd($kondisi);
                    $buku->stok += 1;
                    $data['status'] = 3;
                    $id->update($data);
                    // Tambah stok buku jika tidak rusak atau hilang
                }
                $buku->save();
            }
        }
      

        if (Carbon::create($id->tanggal_kembali)->lessThan(today())) {
            $denda = Carbon::create($id->tanggal_kembali)->diffInDays(today()) * 10000;
            //$denda *= 10000;
            $totalDenda += $denda;
            // $data['denda'] = $denda;
            $data['status'] = 4;

            //$id->update($data);
            //return redirect()->route('transaksi.denda');
        }

        $data = [
            'status' => $data['status'] ?? 3, // Default to 3 if not set
            'petugas_kembali' => auth()->user()->id,
            'tanggal_pengembalian' => today(),
            'denda' => $totalDenda
        ];


        $id->update($data);
        // dd($id);
        if ($id->status == 4) {
            return redirect()->route('transaksi.denda');
        } else {
            return redirect()->route('transaksi.selesai');
        }
    }

    public function showDenda($id)
    {
        //$peminjaman = Peminjaman::latest()->where('status', 4)->get();
        //$users = User::all();
        $peminjaman = peminjaman::latest()->where('status', 4)->where('id', $id)->first();
        //$detail_peminjaman = detail_peminjaman::whereIn('peminjaman_id', $data->pluck('id'))->get();
        $detail_peminjaman = detail_peminjaman::where('peminjaman_id', $peminjaman->id)->with('buku')->first();


        //$user = User::whereIn('id', $peminjaman->pluck('peminjam_id'))->get();
        $user = User::find($peminjaman->peminjam_id);

        return view('transaksi.denda', compact('peminjaman', 'detail_peminjaman', 'user'));
    }

    public function bayardenda(peminjaman $id)
    {
        $id->update([
            // 'tanggal_kembali' => today()->addDay(10),
            // 'petugas_pinjam' => auth()->user()->id,
            'status' => 3
        ]);
        return redirect()->route('transaksi.selesai');
    }

    public function exportExcel()
    {
        return Excel::download(new TransaksiDataExport, 'transaksi.xlsx');
    }

    public function exportPdf(Request $request)
    {

        $status = $request->input('status');

        if ($status === 'beragam') {
            $peminjaman = Peminjaman::latest()->where('status', '!=', 0)->get();
            $detail_peminjaman = detail_peminjaman::whereIn('peminjaman_id', $peminjaman->pluck('id'))->get();
            $users = User::all();
        } else {
            $peminjaman = Peminjaman::latest()->where('status', $status)->get();
            $detail_peminjaman = detail_peminjaman::whereIn('peminjaman_id', $peminjaman->pluck('id'))->get();
            $users = User::all();
        }


        //dd($request->status);

        $mpdf = new Mpdf();
        $mpdf->WriteHTML('<h1>Transaksi</h1>');
        $mpdf->WriteHTML('<h5>Tanggal : ' . today()->format('d-m-Y') . '</h5>');

        if ($status == 1) {
            $mpdf->WriteHTML('<h5>Status : Waiting</h5>');
        } elseif ($status == 2) {
            $mpdf->WriteHTML('<h5>Status : Sedang Dipinjam</h5>');
        } elseif ($status == 3) {
            $mpdf->WriteHTML('<h5>Status : Selesai Dipinjam</h5>');
        } elseif ($status == 4) {
            $mpdf->WriteHTML('<h5>Status : Denda</h5>');
        } elseif ($status == 5) {
            $mpdf->WriteHTML('<h5>Status : Tolak</h5>');
        } else {
            $mpdf->WriteHTML('<h5>Status : Semua</h5>');
        }


        $mpdf->WriteHTML(view('transaksi.pdf.exportTransaksi', compact('peminjaman', 'users')));
        //$mpdf->output();
        $mpdf->Output('transaksi.pdf', 'D');
    }
}
