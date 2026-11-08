<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'nama_admin',
        'username',
        'password',
        'no_hp',
    ];

    protected $hidden = ['password'];

    /**
     * Admin mengelola banyak HRD
     */
    public function hrds()
    {
        return $this->hasMany(Hrd::class, 'id_admin', 'id_admin');
    }
}
