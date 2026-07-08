<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatDokumen extends Model
{
    protected $table = 'riwayat_dokumen';
    protected $primaryKey = 'id_riwayat';
    public $timestamps = false;

    protected $fillable = [
        'id_dokumen',
        'id_petugas',
        'status',
        'tanggal_status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_status' => 'datetime',
    ];

    public function dokumen()
    {
        return $this->belongsTo(Dokumen::class, 'id_dokumen', 'id_dokumen');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id_petugas');
    }
}
