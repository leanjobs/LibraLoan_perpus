<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasApiTokens, Notifiable;
    use SoftDeletes;
    public $count;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'email',
        'password',
        'role_status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    protected $table = 'users';
    public function peminjaman()
    {
        return $this->hasMany(peminjaman::class, 'peminjaman_id');
    }
    public function detail_peminjaman()
    {
        $this->count = DB::table('peminjaman')
            ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.peminjaman_id')
            ->where('peminjam_id', auth()->user()->id)
            ->where('status', '!=', 3)
            ->count();

        return ($this->count);
        //dd($this->count);
    }
    /**
     * Define the relationship with peminjaman.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function peminjamans()
    // {
    //     return $this->hasMany(Peminjaman::class, 'user_id');
    // }
    public function rating()
    {
        return $this->hasMany(Rating::class);
    }
}
