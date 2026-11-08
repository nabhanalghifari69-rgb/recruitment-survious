<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pelamar extends Authenticatable
{
    use Notifiable;

    protected $table = 'pelamar';
    protected $primaryKey = 'id_pelamar';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_hp',
        'alamat',
        'pendidikan',
        'cv',
    ];

    protected $hidden = ['password'];

    /**
     * Pelamar mengajukan banyak Lamaran
     */
    public function lamarans()
    {
        return $this->hasMany(Lamaran::class, 'id_pelamar', 'id_pelamar');
    }
}
