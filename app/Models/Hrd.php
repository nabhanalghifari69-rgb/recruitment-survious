<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Hrd extends Authenticatable
{
    use Notifiable;

    protected $table = 'hrd';
    protected $primaryKey = 'id_hrd';

    protected $fillable = [
        'id_admin',
        'nama_hrd',
        'email',
        'password',
        'no_hp',
        'jabatan',
    ];

    protected $hidden = ['password'];

    /**
     * HRD dimiliki oleh satu Admin
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    /**
     * HRD membuat banyak Lowongan
     */
    public function lowongans()
    {
        return $this->hasMany(Lowongan::class, 'id_hrd', 'id_hrd');
    }
}
