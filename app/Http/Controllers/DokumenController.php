<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DokumenController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $status = (string) $request->query('status', '');
        $jaminan = (string) $request->query('jaminan', '');

        $ringkasan = [
            'total' => Dokumen::count(),
            'masuk' => Dokumen::where('status_terakhir', 'Masuk')->count(),
            'keluar' => Dokumen::where('status_terakhir', 'Keluar')->count(),
            'jaminan' => Dokumen::where('jaminan', 'Ya')->count(),
        ];

        $dokumenList = Dokumen::query()
            ->leftJoin('petugas', 'petugas.id_petugas', '=', 'dokumen.id_petugas')
            ->leftJoin('riwayat_dokumen', 'riwayat_dokumen.id_dokumen', '=', 'dokumen.id_dokumen')
            ->select([
                'dokumen.*',
                DB::raw("COALESCE(petugas.nama_petugas, '-') AS nama_petugas"),
                DB::raw('MAX(riwayat_dokumen.tanggal_status) AS aktivitas_terakhir'),
            ])
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('dokumen.no_registrasi', 'like', "%{$q}%")
                        ->orWhere('dokumen.cif', 'like', "%{$q}%")
                        ->orWhere('dokumen.nama_debitur', 'like', "%{$q}%")
                        ->orWhere('dokumen.nomor_rekening', 'like', "%{$q}%");
                });
            })
            ->when(in_array($status, ['Masuk', 'Keluar'], true), fn ($query) => $query->where('dokumen.status_terakhir', $status))
            ->when(in_array($jaminan, ['Ya', 'Tidak'], true), fn ($query) => $query->where('dokumen.jaminan', $jaminan))
            ->groupBy(
                'dokumen.id_dokumen', 'dokumen.no_registrasi', 'dokumen.cif', 'dokumen.nama_debitur',
                'dokumen.nomor_rekening', 'dokumen.nama_pengambil', 'dokumen.unit_pengambil',
                'dokumen.jaminan', 'dokumen.keterangan_jaminan', 'dokumen.ruangan', 'dokumen.lemari',
                'dokumen.rak', 'dokumen.baris', 'dokumen.status_terakhir', 'dokumen.id_petugas',
                'petugas.nama_petugas'
            )
            ->orderByDesc('aktivitas_terakhir')
            ->orderByDesc('dokumen.id_dokumen')
            ->get();

        return view('dokumen.index', compact('q', 'status', 'jaminan', 'ringkasan', 'dokumenList'));
    }
}
