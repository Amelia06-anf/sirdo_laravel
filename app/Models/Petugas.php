<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Petugas extends Authenticatable
{
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'nama_petugas',
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthPassword(): string
    {
        return (string) $this->password;
    }
}
