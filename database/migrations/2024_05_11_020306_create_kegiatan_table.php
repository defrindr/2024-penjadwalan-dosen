<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('kegiatan', function (Blueprint $table) {
        $table->id();
        $table->foreignId('NIP')->references('NIP')->on('dosen')->onDelete('cascade'); // Kolom untuk menghubungkan ke tabel dosen
        $table->string('tugas', 100);
        $table->string('nama_kegiatan', 100);
        $table->date('tanggal');
        $table->time('waktu_mulai'); 
        $table->time('waktu_selesai'); 
        $table->string('surat_tugas'); // Sesuaikan dengan tipe data yang sesuai
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
