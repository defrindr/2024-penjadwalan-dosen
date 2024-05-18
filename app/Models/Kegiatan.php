<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nip', 'tugas', 'nama_kegiatan', 'tanggal', 'waktu_mulai', 'waktu_selesai', 'surat_tugas',
    ];

    const PemberiTugas = [
        'Direktur',
        'Pudir 1',
        'Pudir 2',
        'Pudir 3',
        'Jurusan',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nip', 'nip');
    }
}
