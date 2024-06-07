<?php

namespace App\Exports;

use App\Models\peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransaksiDataExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
       // return Peminjaman::latest()->where('status', 4)->get();
    }
}
