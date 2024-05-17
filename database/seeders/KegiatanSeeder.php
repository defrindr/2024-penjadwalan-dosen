<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kegiatan::create([
            'NIP' => '196201051990031002',
            'tugas' => 'Tugas Coba',
            'nama_kegiatan' => 'Kegiatan test',
            'tanggal' => '2023-01-04',
            'waktu_mulai' => '10:00:00',
            'waktu_selesai' => '14:00:00',
            'surat_tugas' => null,
        ]);
    }
}
