<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPerusahaan extends Model
{
    protected $table = 'profil_perusahaan';
    protected $primaryKey = 'id_profil';

    protected $fillable = [
        'nama_perusahaan',
        'logo',
        'alamat',
        'deskripsi',
        'email',
        'telepon',
        'website',
    ];
}
