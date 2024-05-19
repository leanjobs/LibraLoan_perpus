<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kategori_buku extends Model
{
    use SoftDeletes;
    protected $table = 'kategori_bukus';
    protected $guarded = [];

    use HasFactory;

    public function bukus()
    {
        return $this->belongsTo(Buku::class, 'bukus_id');
    }

    
}
