<?php

namespace App\Http\Controllers;

use App\Models\RiwayatDokumen;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        return view('laporan.index', $this->dataLaporan($request));
    }

    public function exportExcel(Request $request)
    {
        $data = $this->dataLaporan($request);
        $namaFile = 'laporan-riwayat-dokumen-'.now()->format('Ymd-His').'.xls';

        return response()
            ->view('laporan.excel', $data)
            ->header('Content-Type', 'application/vnd.ms-excel; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$namaFile.'"');
    }

    public function exportPdf(Request $request)
    {
        return view('laporan.pdf', $this->dataLaporan($request));
    }

    private function dataLaporan(Request $request): array
    {
        $tanggalMulai = trim((string) $request->query('tanggal_mulai', ''));
        $tanggalSelesai = trim((string) $request->query('tanggal_selesai', ''));
        $status = (string) $request->query('status', '');
        $q = trim((string) $request->query('q', ''));

        $laporanList = RiwayatDokumen::query()
            ->with(['dokumen', 'petugas'])
            ->when($tanggalMulai !== '', fn ($query) => $query->whereDate('tanggal_status', '>=', $tanggalMulai))
            ->when($tanggalSelesai !== '', fn ($query) => $query->whereDate('tanggal_status', '<=', $tanggalSelesai))
            ->when(in_array($status, ['Masuk', 'Keluar'], true), fn ($query) => $query->where('status', $status))
            ->when($q !== '', function ($query) use ($q) {
                $query->whereHas('dokumen', function ($sub) use ($q) {
                    $sub->where('no_registrasi', 'like', "%{$q}%")
                        ->orWhere('cif', 'like', "%{$q}%")
                        ->orWhere('nama_debitur', 'like', "%{$q}%")
                        ->orWhere('nomor_rekening', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('tanggal_status')
            ->orderByDesc('id_riwayat')
            ->get();

        return compact('tanggalMulai', 'tanggalSelesai', 'status', 'q', 'laporanList');
    }
}
