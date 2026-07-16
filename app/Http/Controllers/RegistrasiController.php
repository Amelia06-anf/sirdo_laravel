<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\RiwayatDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RegistrasiController extends Controller
{
    public function index()
    {
        return view('registrasi.index');
    }

    public function masuk()
    {
        return view('registrasi.masuk', [
            'daftarDokumen' => Dokumen::where('status_terakhir', 'Keluar')->latest('id_dokumen')->get(),
            'noRegistrasiBaru' => $this->nomorRegistrasiBerikutnya(),
        ]);
    }

    public function keluar()
    {
        return view('registrasi.keluar', [
            'daftarDokumen' => Dokumen::where('status_terakhir', 'Masuk')->latest('id_dokumen')->get(),
            'noRegistrasiBaru' => $this->nomorRegistrasiBerikutnya(),
        ]);
    }

    public function storeKeluar(Request $request)
    {
        $data = $request->validate([
            'sumber_dokumen' => ['required', 'in:tercatat,baru'],
            'no_registrasi_existing' => ['nullable', 'string'],
            'no_registrasi' => ['nullable', 'string', 'max:30'],
            'cif' => ['nullable', 'string', 'max:30'],
            'nama_debitur' => ['nullable', 'string', 'max:100'],
            'nomor_rekening' => ['nullable', 'string', 'max:30'],
            'nama_pengambil' => ['required', 'string', 'max:100'],
            'unit_pengambil' => ['required', 'string', 'max:100'],
            'jaminan' => ['nullable', 'in:Ya,Tidak'],
            'keterangan_jaminan' => ['nullable', 'string'],
            'ruangan' => ['nullable', 'string', 'max:10'],
            'lemari' => ['nullable', 'string', 'max:10'],
            'rak' => ['nullable', 'string', 'max:10'],
            'baris' => ['nullable', 'string', 'max:10'],
        ]);

        DB::transaction(function () use ($data, &$dokumen) {
            if ($data['sumber_dokumen'] === 'tercatat') {
                $dokumen = Dokumen::where('no_registrasi', $data['no_registrasi_existing'])
                    ->where('status_terakhir', 'Masuk')
                    ->lockForUpdate()
                    ->firstOrFail();
            } else {
                if (empty($data['no_registrasi']) || empty($data['cif']) || empty($data['nama_debitur'])) {
                    abort(422, 'No registrasi, CIF, dan nama debitur wajib diisi.');
                }

                if (Dokumen::where('cif', $data['cif'])->exists()) {
                    throw ValidationException::withMessages([
                        'cif' => 'CIF '.$data['cif'].' sudah terdaftar. Gunakan opsi "Dokumen sudah terdaftar", bukan input dokumen baru.',
                    ]);
                }

                $dokumen = Dokumen::create([
                    'no_registrasi' => $data['no_registrasi'],
                    'cif' => $data['cif'],
                    'nama_debitur' => $data['nama_debitur'],
                    'nomor_rekening' => $data['nomor_rekening'] ?: null,
                    'ruangan' => $data['ruangan'] ?: null,
                    'lemari' => $data['lemari'] ?: null,
                    'rak' => $data['rak'] ?: null,
                    'baris' => $data['baris'] ?: null,
                ]);
            }

            $dokumen->fill([
                'nama_pengambil' => $data['nama_pengambil'],
                'unit_pengambil' => $data['unit_pengambil'],
                'jaminan' => $data['jaminan'] ?? 'Tidak',
                'keterangan_jaminan' => $data['keterangan_jaminan'] ?: null,
                'status_terakhir' => 'Keluar',
                'id_petugas' => Auth::id(),
            ])->save();

            $keterangan = 'Diambil oleh '.$data['nama_pengambil'].' ('.$data['unit_pengambil'].')';
            if (($data['jaminan'] ?? 'Tidak') === 'Ya') {
                $keterangan .= '. Membawa jaminan';
                if (!empty($data['keterangan_jaminan'])) {
                    $keterangan .= ': '.$data['keterangan_jaminan'];
                }
            }

            RiwayatDokumen::create([
                'id_dokumen' => $dokumen->id_dokumen,
                'id_petugas' => Auth::id(),
                'status' => 'Keluar',
                'tanggal_status' => now(),
                'keterangan' => $keterangan,
            ]);
        });

        return redirect()->route('registrasi.index')->with('success', 'Dokumen berhasil diregistrasikan keluar.');
    }

    public function storeMasuk(Request $request)
    {
        $data = $request->validate([
            'sumber_dokumen' => ['required', 'in:tercatat,baru'],
            'no_registrasi_existing' => ['nullable', 'string'],
            'no_registrasi_baru' => ['nullable', 'string', 'max:30'],
            'cif_baru' => ['nullable', 'string', 'max:30'],
            'nama_debitur_baru' => ['nullable', 'string', 'max:100'],
            'nomor_rekening_baru' => ['nullable', 'string', 'max:30'],
            'nama_pengembali' => ['required', 'string', 'max:100'],
            'unit_pengembali' => ['required', 'string', 'max:100'],
            'jaminan' => ['nullable', 'in:Ya,Tidak'],
            'keterangan_jaminan' => ['nullable', 'string'],
            'keterangan' => ['nullable', 'string'],
            'ruangan_baru' => ['nullable', 'string', 'max:10'],
            'lemari_baru' => ['nullable', 'string', 'max:10'],
            'rak_baru' => ['nullable', 'string', 'max:10'],
            'baris_baru' => ['nullable', 'string', 'max:10'],
        ]);

        DB::transaction(function () use ($data, &$dokumen) {
            if ($data['sumber_dokumen'] === 'tercatat') {
                $dokumen = Dokumen::where('no_registrasi', $data['no_registrasi_existing'])
                    ->where('status_terakhir', 'Keluar')
                    ->lockForUpdate()
                    ->firstOrFail();
            } else {
                if (empty($data['no_registrasi_baru']) || empty($data['cif_baru']) || empty($data['nama_debitur_baru'])) {
                    abort(422, 'No registrasi, CIF, dan nama debitur wajib diisi.');
                }

                if (Dokumen::where('cif', $data['cif_baru'])->exists()) {
                    throw ValidationException::withMessages([
                        'cif_baru' => 'CIF '.$data['cif_baru'].' sudah terdaftar. Gunakan opsi "Sudah tercatat keluar" bila dokumen sedang keluar, atau cari di Data Dokumen.',
                    ]);
                }

                $dokumen = Dokumen::create([
                    'no_registrasi' => $data['no_registrasi_baru'],
                    'cif' => $data['cif_baru'],
                    'nama_debitur' => $data['nama_debitur_baru'],
                    'nomor_rekening' => $data['nomor_rekening_baru'] ?: null,
                    'ruangan' => $data['ruangan_baru'] ?: null,
                    'lemari' => $data['lemari_baru'] ?: null,
                    'rak' => $data['rak_baru'] ?: null,
                    'baris' => $data['baris_baru'] ?: null,
                    'jaminan' => $data['jaminan'] ?? 'Tidak',
                    'keterangan_jaminan' => $data['keterangan_jaminan'] ?: null,
                ]);
            }

            $dokumen->fill([
                'jaminan' => $data['jaminan'] ?? 'Tidak',
                'keterangan_jaminan' => $data['keterangan_jaminan'] ?: null,
                'status_terakhir' => 'Masuk',
                'id_petugas' => Auth::id(),
            ])->save();

            $keterangan = 'Dikembalikan oleh '.$data['nama_pengembali'].' ('.$data['unit_pengembali'].')';
            if (($data['jaminan'] ?? 'Tidak') === 'Ya') {
                $keterangan .= '. Membawa jaminan';
                if (!empty($data['keterangan_jaminan'])) {
                    $keterangan .= ': '.$data['keterangan_jaminan'];
                }
            } elseif (!empty($data['keterangan_jaminan'])) {
                $keterangan .= '. Keterangan jaminan: '.$data['keterangan_jaminan'];
            }
            if (!empty($data['keterangan'])) {
                $keterangan .= '. '.$data['keterangan'];
            }

            RiwayatDokumen::create([
                'id_dokumen' => $dokumen->id_dokumen,
                'id_petugas' => Auth::id(),
                'status' => 'Masuk',
                'tanggal_status' => now(),
                'keterangan' => $keterangan,
            ]);
        });

        return redirect()->route('registrasi.index')->with('success', 'Dokumen berhasil diregistrasikan masuk.');
    }

    private function nomorRegistrasiBerikutnya(): string
    {
        $prefix = 'REG-'.date('y').'-';
        $max = Dokumen::where('no_registrasi', 'like', $prefix.'%')
            ->selectRaw('COALESCE(MAX(CAST(RIGHT(no_registrasi, 4) AS UNSIGNED)), 0) + 1 AS nomor')
            ->value('nomor');

        return $prefix.str_pad((string) $max, 4, '0', STR_PAD_LEFT);
    }
}
