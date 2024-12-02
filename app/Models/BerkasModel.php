<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasModel extends Model
{
    use HasFactory;

    protected $table = 'berkas';

    protected $fillable = [
        'user_id',
        'nama_user',
        'nip',
        'tahun',
        'bulan',
        'kabupaten',
        'npsn_sekolah',
        'nama_instansi',
        'file_sptjm',
        'file_skp',
        'file_tpp',
        'file_dhbpo',
        'file_ekinerja',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
