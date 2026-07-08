<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\RiwayatDokumen;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $ringkasan = [
            'total_keluar' => RiwayatDokumen::where('status', 'Keluar')->count(),
            'total_masuk' => RiwayatDokumen::where('status', 'Masuk')->count(),
            'hari_keluar' => RiwayatDokumen::where('status', 'Keluar')->whereDate('tanggal_status', today())->count(),
            'hari_masuk' => RiwayatDokumen::where('status', 'Masuk')->whereDate('tanggal_status', today())->count(),
            'total_debitur' => Dokumen::whereNotNull('cif')->where('cif', '<>', '')->distinct('cif')->count('cif'),
        ];

        $dokumenTerbaru = Dokumen::query()
            ->leftJoin('petugas', 'petugas.id_petugas', '=', 'dokumen.id_petugas')
            ->leftJoin('riwayat_dokumen', 'riwayat_dokumen.id_dokumen', '=', 'dokumen.id_dokumen')
            ->select([
                'dokumen.no_registrasi',
                'dokumen.cif',
                'dokumen.nama_debitur',
                'dokumen.status_terakhir',
                DB::raw("COALESCE(petugas.nama_petugas, '-') AS nama_petugas"),
                DB::raw("MAX(CASE WHEN riwayat_dokumen.status = 'Keluar' THEN riwayat_dokumen.tanggal_status END) AS tanggal_keluar"),
                DB::raw("MAX(CASE WHEN riwayat_dokumen.status = 'Masuk' THEN riwayat_dokumen.tanggal_status END) AS tanggal_masuk"),
                DB::raw('MAX(riwayat_dokumen.tanggal_status) AS aktivitas_terakhir'),
            ])
            ->groupBy('dokumen.id_dokumen', 'dokumen.no_registrasi', 'dokumen.cif', 'dokumen.nama_debitur', 'dokumen.status_terakhir', 'petugas.nama_petugas')
            ->orderByDesc('aktivitas_terakhir')
            ->orderByDesc('dokumen.id_dokumen')
            ->limit(6)
            ->get();

        return view('dashboard.index', compact('ringkasan', 'dokumenTerbaru'));
    }
}
