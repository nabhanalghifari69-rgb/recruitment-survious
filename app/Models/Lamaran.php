<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    protected $table = 'lamaran';
    protected $primaryKey = 'id_lamaran';

    protected $fillable = [
        'id_pelamar',
        'id_lowongan',
        'tgl_lamar',
        'status_lamaran',
        'catatan_hrd',
    ];

    protected $casts = [
        'tgl_lamar' => 'date',
    ];

    /**
     * Lamaran dimiliki satu Pelamar
     */
    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
    }

    /**
     * Lamaran ditujukan ke satu Lowongan
     */
    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'id_lowongan', 'id_lowongan');
    }

    /**
     * Lamaran memiliki banyak Dokumen
     */
    public function dokumens()
    {
        return $this->hasMany(DokumenLamaran::class, 'id_lamaran', 'id_lamaran');
    }

    /**
     * Lamaran memiliki banyak Jadwal Wawancara
     */
    public function wawancaras()
    {
        return $this->hasMany(Wawancara::class, 'id_lamaran', 'id_lamaran');
    }
}
