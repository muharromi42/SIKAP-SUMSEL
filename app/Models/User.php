<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "users";

    protected $fillable = [
        'nama',
        'email',
        'nip',
        'level',
        'status',
        'password',
        'kabupaten',
        'nama_instansi',
        'notel',
        'jabatan',
        'birthday',
        'profile_picture',
        'tanggal_registrasi',
    ];

    public $timestamps = false;

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_registrasi' => 'datetime',
        // 'password' => 'hashed',
    ];

    public function berkas()
    {
        return $this->hasMany(BerkasModel::class);
    }
}
