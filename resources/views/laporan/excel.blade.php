{!! "\xEF\xBB\xBF" !!}
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><style>table{border-collapse:collapse;width:100%}th,td{border:1px solid #999;padding:6px;vertical-align:top}th{background:#d9eaf7;font-weight:bold}.text{mso-number-format:"\@"}</style></head>
<body>
<h2>Laporan Riwayat Dokumen</h2>
<p>Periode: {{ $tanggalMulai ?: 'Semua' }} s/d {{ $tanggalSelesai ?: 'Semua' }}</p>
@include('laporan.partials.table', ['laporanList' => $laporanList])
</body>
</html>
