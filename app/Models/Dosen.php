<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';

    protected $primaryKey = 'nip';

    protected $fillable = [
        'nip', 'nama_dosen', 'telp', 'alamat'];
}
