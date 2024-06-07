<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class saved extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'saveds';

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function bukus()
    {
        return $this->belongsTo(Buku::class, 'bukus_id');
    }
}
