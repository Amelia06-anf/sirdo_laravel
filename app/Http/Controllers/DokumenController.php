<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\RiwayatDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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

    public function edit(Dokumen $dokumen)
    {
        return view('dokumen.edit', compact('dokumen'));
    }

    public function update(Request $request, Dokumen $dokumen)
    {
        $data = $request->validate([
            'no_registrasi' => [
                'required',
                'string',
                'max:30',
                Rule::unique('dokumen', 'no_registrasi')->ignore($dokumen->id_dokumen, 'id_dokumen'),
            ],
            'cif' => [
                'required',
                'string',
                'max:30',
                Rule::unique('dokumen', 'cif')->ignore($dokumen->id_dokumen, 'id_dokumen'),
            ],
            'nama_debitur' => ['required', 'string', 'max:100'],
            'nomor_rekening' => ['nullable', 'string', 'max:30'],
            'nama_pengambil' => ['nullable', 'string', 'max:100'],
            'unit_pengambil' => ['nullable', 'string', 'max:100'],
            'jaminan' => ['required', 'in:Ya,Tidak'],
            'keterangan_jaminan' => ['nullable', 'string'],
            'ruangan' => ['nullable', 'string', 'max:10'],
            'lemari' => ['nullable', 'string', 'max:10'],
            'rak' => ['nullable', 'string', 'max:10'],
            'baris' => ['nullable', 'string', 'max:10'],
            'status_terakhir' => ['required', 'in:Masuk,Keluar'],
        ], [
            'cif.unique' => 'CIF ini sudah terdaftar pada dokumen lain. Satu CIF hanya boleh untuk satu berkas/dokumen.',
            'no_registrasi.unique' => 'Nomor registrasi ini sudah digunakan pada dokumen lain.',
        ]);

        $dokumen->update([
            'no_registrasi' => $data['no_registrasi'],
            'cif' => $data['cif'],
            'nama_debitur' => $data['nama_debitur'],
            'nomor_rekening' => $data['nomor_rekening'] ?: null,
            'nama_pengambil' => $data['nama_pengambil'] ?: null,
            'unit_pengambil' => $data['unit_pengambil'] ?: null,
            'jaminan' => $data['jaminan'],
            'keterangan_jaminan' => $data['keterangan_jaminan'] ?: null,
            'ruangan' => $data['ruangan'] ?: null,
            'lemari' => $data['lemari'] ?: null,
            'rak' => $data['rak'] ?: null,
            'baris' => $data['baris'] ?: null,
            'status_terakhir' => $data['status_terakhir'],
        ]);

        return redirect()->route('dokumen.index')->with('success', 'Data dokumen berhasil diperbarui.');
    }

    public function destroy(Dokumen $dokumen)
    {
        DB::transaction(function () use ($dokumen) {
            RiwayatDokumen::where('id_dokumen', $dokumen->id_dokumen)->delete();
            $dokumen->delete();
        });

        return redirect()->route('dokumen.index')->with('success', 'Data dokumen dan riwayatnya berhasil dihapus.');
    }
}
