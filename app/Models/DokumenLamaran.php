<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenLamaran extends Model
{
    protected $table = 'dokumen_lamaran';
    protected $primaryKey = 'id_dokumen';

    protected $fillable = [
        'id_lamaran',
        'jenis_dokumen',
        'nama_file',
        'path_file',
    ];

    /**
     * Dokumen dimiliki satu Lamaran
     */
    public function lamaran()
    {
        return $this->belongsTo(Lamaran::class, 'id_lamaran', 'id_lamaran');
    }
}
