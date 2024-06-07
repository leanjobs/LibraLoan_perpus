<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    // protected $guarded = [];
    protected $fillable = ['kode_pinjam', 'peminjam_id', 'petugas_pinjam', 'petugas_kembali', 'status', 'denda', 'tanggal_pinjam', 'tanggal_kembali', 'tanggal_pengembalian'];


    public function detail_peminjaman()
    {
        return $this->hasMany(detail_peminjaman::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'peminjam_id');
    }
    public function buku()
    {
        return $this->belongsTo(buku::class, 'bukus_id');
    }
}
