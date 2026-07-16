<div class="table-wrap">
    @php
        $petugasTransaksi = function ($laporan) {
            if ($laporan->status === 'Keluar') {
                $nama = trim((string) ($laporan->dokumen->nama_pengambil ?? ''));
                $unit = trim((string) ($laporan->dokumen->unit_pengambil ?? ''));

                if ($nama !== '' && $unit !== '') {
                    return $nama.' ('.$unit.')';
                }

                return $nama !== '' ? $nama : '-';
            }

            $keterangan = (string) ($laporan->keterangan ?? '');
            if (preg_match('/Dikembalikan oleh\s+(.+?)(?:\.\s|$)/i', $keterangan, $hasil)) {
                return trim($hasil[1]);
            }

            return '-';
        };

        $keteranganBersih = function ($laporan) {
            $keterangan = (string) ($laporan->keterangan ?? '');
            $keterangan = preg_replace('/Dokumen lama pertama kali dicatat saat masuk\.\s*/i', '', $keterangan);
            $keterangan = preg_replace('/Dikembalikan oleh\s+.+?(?:\.\s|$)/i', '', $keterangan);
            $keterangan = preg_replace('/Diambil oleh\s+.+?(?:\.\s|$)/i', '', $keterangan);
            $keterangan = trim((string) $keterangan);
            $keterangan = trim($keterangan, ". \t\n\r\0\x0B");

            return $keterangan !== '' ? $keterangan : '-';
        };
    @endphp
    <table class="report-table">
        <thead>
            <tr>
                <th>No</th><th>Tanggal</th><th>No. Registrasi</th><th>CIF</th><th>Nama Debitur</th><th>No. Rekening</th><th>Status</th><th>Jaminan</th><th>Petugas</th><th>Keterangan Riwayat</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($laporanList as $index => $laporan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ optional($laporan->tanggal_status)->format('d/m/Y H:i') }}</td>
                <td><strong>{{ $laporan->dokumen->no_registrasi ?? '-' }}</strong></td>
                <td>{{ $laporan->dokumen->cif ?? '-' }}</td>
                <td>{{ $laporan->dokumen->nama_debitur ?? '-' }}</td>
                <td>{{ $laporan->dokumen->nomor_rekening ?? '-' }}</td>
                <td><span class="status status-{{ strtolower($laporan->status) }}">{{ $laporan->status }}</span></td>
                <td>{{ $laporan->dokumen->jaminan ?? 'Tidak' }}</td>
                <td>{{ $petugasTransaksi($laporan) }}</td>
                <td class="wide-cell">{{ $keteranganBersih($laporan) }}</td>
            </tr>
        @empty
            <tr><td class="empty-table" colspan="10">Belum ada data riwayat sesuai filter.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
