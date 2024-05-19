<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\detail_peminjaman;
use App\Models\peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::latest()->where('status', '!=', 0)->get();
        $users = User::all();

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
    public function pinjam(peminjaman $id)
    {
        $id->update([
            'petugas_pinjam' => auth()->user()->id,
            'status' => 2
        ]);
        return redirect()->route('transaksi.sedang')->with('success', 'buki berhasil dipinjam');
    }
    public function kembali(peminjaman $id)
    {
        //dd($id);
        $data = [
            'status' => 3,
            'petugas_kembali' => auth()->user()->id,
            'tanggal_pengembalian' => today(),
            'denda' => 0
        ];

        if (Carbon::create($id->tanggal_kembali)->lessThan(today())) {
            $denda = Carbon::create($id->tanggal_kembali)->diffInDays(today());
            $denda *= 10000;
            $data['denda'] = $denda;
            $data['status'] = 4;
        }

        $id->update($data);
        dd($id);
        //return redirect()->route('transaksi.selesai')->with('success', 'buki berhasil dipinjam');
    }
}
