<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class buku extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'bukus';
    protected $guarded = [];

    public function kategori_bukus()
    {
        return $this->belongsTo(kategori_buku::class, 'kategori_bukus_id');
    }
}
