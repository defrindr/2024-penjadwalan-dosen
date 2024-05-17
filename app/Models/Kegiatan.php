<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = "kegiatan";
    protected $primaryKey = "id";
    protected $fillable = [
        'NIP', 'tugas', 'nama_kegiatan', 'tanggal', 'waktu_mulai', 'waktu_selesai', 'surat_tugas'
    ];

    public function dosen()
{
    return $this->belongsTo(Dosen::class, 'NIP', 'NIP');
}
}