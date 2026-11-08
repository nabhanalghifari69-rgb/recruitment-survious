<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wawancara extends Model
{
    protected $table = 'wawancara';
    protected $primaryKey = 'id_wawancara';

    protected $fillable = [
        'id_lamaran',
        'tgl_wawancara',
        'jam',
        'tempat',
        'hasil',
    ];

    protected $casts = [
        'tgl_wawancara' => 'date',
    ];

    /**
     * Wawancara dijadwalkan untuk satu Lamaran
     */
    public function lamaran()
    {
        return $this->belongsTo(Lamaran::class, 'id_lamaran', 'id_lamaran');
    }
}
