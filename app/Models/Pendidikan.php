<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'jenjang', 'institusi', 'lulusan', 'gelar',
        'bidang_ilmu', 'jurusan', 'alamat_institusi', 'no_ijazah',
        'tanggal_masuk', 'tanggal_lulus', 'ijazah', 'file_pendamping', 'transkrip',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
