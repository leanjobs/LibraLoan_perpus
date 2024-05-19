<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_peminjaman extends Model
{
    use HasFactory;
    // protected $guarded = [];
    protected $fillable = ['peminjaman_id', 'buku_id'];

    protected $table = 'detail_peminjaman';
    public function peminjaman()
    {
        return $this->hasMany(peminjaman::class);
    }
    public function buku()
    {
        return $this->belongsTo(buku::class);
    }
}
