<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $table = 'lowongan';
    protected $primaryKey = 'id_lowongan';

    protected $fillable = [
        'id_hrd',
        'id_departemen',
        'judul',
        'deskripsi',
        'lokasi',
        'kategori',
        'gaji',
        'tgl_tutup',
        'status',
    ];

    protected $casts = [
        'tgl_tutup' => 'date',
    ];

    /**
     * Lowongan dibuat oleh satu HRD
     */
    public function hrd()
    {
        return $this->belongsTo(Hrd::class, 'id_hrd', 'id_hrd');
    }

    /**
     * Lowongan termasuk satu Departemen
     */
    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'id_departemen', 'id_departemen');
    }

    /**
     * Lowongan menerima banyak Lamaran
     */
    public function lamarans()
    {
        return $this->hasMany(Lamaran::class, 'id_lowongan', 'id_lowongan');
    }
}
