<div class="table-wrap">
    <table class="report-table">
        <thead>
            <tr>
                <th>No</th><th>Tanggal</th><th>No. Registrasi</th><th>CIF</th><th>Nama Debitur</th><th>No. Rekening</th><th>Status</th><th>Pengambil</th><th>Unit</th><th>Jaminan</th><th>Petugas</th><th>Keterangan Riwayat</th>
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
                <td>{{ $laporan->dokumen->nama_pengambil ?? '-' }}</td>
                <td>{{ $laporan->dokumen->unit_pengambil ?? '-' }}</td>
                <td>{{ $laporan->dokumen->jaminan ?? 'Tidak' }}</td>
                <td>{{ $laporan->petugas->nama_petugas ?? '-' }}</td>
                <td class="wide-cell">{{ $laporan->keterangan }}</td>
            </tr>
        @empty
            <tr><td class="empty-table" colspan="12">Belum ada data riwayat sesuai filter.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
