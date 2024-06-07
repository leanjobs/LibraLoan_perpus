<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    use HasFactory;

    public function bukus()
    {
        return $this->belongsTo(buku::class, 'bukus_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
