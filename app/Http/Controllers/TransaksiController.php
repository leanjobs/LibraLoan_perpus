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

        //stok buku aru berkurang klo di acc
        return redirect()->route('transaksi.sedang');
    }
    public function tolak(peminjaman $id)
    {
        $details = detail_peminjaman::where('peminjaman_id', $id->id)->get();
        // foreach ($details as $detail) {
        //     $buku = buku::find($detail->bukus_id);
        //     $buku->stok += 1;
        //     $buku->save();
        // }
        $id->update([
            'petugas_pinjam' => auth()->user()->id,
            'status' => 5

        ]);
        return redirect()->route('transaksi.sedang');
    }
    public function kembali(Request $request, peminjaman $id)
    {
        $kondisi = $request->input('kondisi.' . $id->id);;
        $totalDenda = 0;

        $data['petugas_kembali'] = auth()->user()->id;
        $data['tanggal_pengembalian'] = today();
        $data['denda'] = $totalDenda;

        //pengkondisian stok dan status dan kondisi
        $details = detail_peminjaman::where('peminjaman_id', $id->id)->get();
        foreach ($details as $detail) {
            $buku = buku::find($detail->bukus_id);

            if (Carbon::create($id->tanggal_kembali)->lessThan(today())) {
                $denda = Carbon::create($id->tanggal_kembali)->diffInDays(today()) * 10000;
                //$denda *= 10000;
                $totalDenda += $denda;
                //$data['status'] = 4;
            }

            if ($kondisi == 'hilang') {
                $denda = $buku->harga_buku;
                $totalDenda += $denda;
                $data['denda'] = $denda;
                $data['status'] = 4;
                $id->kondisi = 'hilang';

                $id->update($data);


                return redirect()->route('transaksi.denda');
                //dd($id);
            } elseif ($kondisi === 'rusak') {
                $denda = $buku->harga_buku * 0.5;
                $totalDenda += $denda;
                $data['denda'] = $denda;
                $data['status'] = 4;
                $id->kondisi = 'rusak';


                $id->update($data);


                return redirect()->route('transaksi.denda');
            } else {
                // $buku->stok += 1;
                $id->kondisi = 'normal';
                //dd($data, $buku);
            }
            //$buku->update();


        }
        if ($totalDenda > 0) {
            $data['status'] = 4;
        } else {
            $data['status'] = 3;
        }

        $data['denda'] = $totalDenda;
        $id->update($data);
        //dd($id, $buku);
        // Redirect based on the final status
        if ($id->status == 4) {
            return redirect()->route('transaksi.denda');
        } else {
            return redirect()->route('transaksi.selesai');
        }

        // if (Carbon::create($id->tanggal_kembali)->lessThan(today())) {
        //     $denda = Carbon::create($id->tanggal_kembali)->diffInDays(today()) * 10000;
        //     //$denda *= 10000;
        //     $totalDenda += $denda;
        //     $data['status'] = 4;
        // }

        // $data = [
        //     //'status' => $id->status ?? 3,
        //     'petugas_kembali' => auth()->user()->id,
        //     'tanggal_pengembalian' => today(),
        //     'denda' => $totalDenda
        // ];
        // $data['petugas_kembali'] = auth()->user()->id;
        // $data['tanggal_pengembalian'] = today();
        // $data['denda'] = $totalDenda;

        // $id->update($data);

        //dd($id, $buku);

        // if ($id->status == 4) {
        //     return redirect()->route('transaksi.denda');
        // } else {
        //     return redirect()->route('transaksi.selesai');
        // }
    }

    public function showDetail($id)
    {
       // dd($id);
        //$peminjaman = Peminjaman::latest()->where('status', 4)->get();
        //$users = User::all();
        $peminjaman = peminjaman::latest()->where('id', $id)->first();
        //$detail_peminjaman = detail_peminjaman::whereIn('peminjaman_id', $data->pluck('id'))->get();
        $detail_peminjaman = detail_peminjaman::where('peminjaman_id', $peminjaman->id)->with('buku')->first();


        //$user = User::whereIn('id', $peminjaman->pluck('peminjam_id'))->get();
        $user = User::find($peminjaman->peminjam_id);

        return view('transaksi.detail', compact('peminjaman', 'detail_peminjaman', 'user'));
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
        $tgl_awal = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        $query = Peminjaman::latest();

        if ($status !== 'beragam') {
            $query->where('status', $status);
        } else {
            $query->where('status', '!=', 0);
        }

        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $query->whereBetween('tanggal_pinjam', [$tgl_awal, $tgl_akhir]);
        } else {
            $tgl_awal = $query->min('tanggal_pinjam');
            $tgl_akhir = $query->max('tanggal_pinjam');
            $query->whereBetween('tanggal_pinjam', [$tgl_awal, $tgl_akhir]);
        }

        $peminjaman = $query->get();
        $detail_peminjaman = detail_peminjaman::whereIn('peminjaman_id', $peminjaman->pluck('id'))->get();
        $users = User::all();

        return view('transaksi.pdf.exportTransaksi', compact('peminjaman', 'users', 'status', 'tgl_awal', 'tgl_akhir'));
    }
}
