<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPekerjaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'pangkat', 'jabatan', 'unit_kerja', 'sub_bagian',
        'nip', 'nomor_sk', 'tanggal_sk', 'tmt_sk', 'mutasi', 'file_sk'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
