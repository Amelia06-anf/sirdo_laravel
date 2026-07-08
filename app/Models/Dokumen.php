<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumen';
    protected $primaryKey = 'id_dokumen';
    public $timestamps = false;

    protected $fillable = [
        'no_registrasi',
        'cif',
        'nama_debitur',
        'nomor_rekening',
        'nama_pengambil',
        'unit_pengambil',
        'jaminan',
        'keterangan_jaminan',
        'ruangan',
        'lemari',
        'rak',
        'baris',
        'status_terakhir',
        'id_petugas',
    ];

    public function riwayat()
    {
        return $this->hasMany(RiwayatDokumen::class, 'id_dokumen', 'id_dokumen');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id_petugas');
    }
}
