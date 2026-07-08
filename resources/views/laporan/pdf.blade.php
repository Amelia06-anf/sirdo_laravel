<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Laporan Riwayat Dokumen</title>
    <style>
        @page{size:landscape;margin:14mm}body{font-family:Arial,Helvetica,sans-serif;color:#111827}.toolbar{margin-bottom:18px;display:flex;justify-content:flex-end;gap:10px}.toolbar button,.toolbar a{padding:10px 14px;border:0;border-radius:6px;background:#0751bd;color:#fff;font-size:12px;font-weight:700;text-decoration:none;cursor:pointer}.toolbar a{background:#667085}.letterhead{text-align:center;margin-bottom:14px}.letterhead h1{margin:0 0 5px;font-size:18px;text-transform:uppercase}.letterhead p{margin:2px 0;font-size:12px}.meta{margin:10px 0 14px;font-size:11px}table{width:100%;border-collapse:collapse;font-size:9px}th,td{padding:6px;border:1px solid #9ca3af;vertical-align:top}th{background:#e8f0fb;text-transform:uppercase}.status{font-weight:700}@media print{.toolbar{display:none}body{margin:0}}
    </style>
</head>
<body>
<div class="toolbar"><a href="{{ route('laporan.index', request()->query()) }}">Kembali</a><button type="button" onclick="window.print()">Simpan / Cetak PDF</button></div>
<div class="letterhead"><h1>Laporan Riwayat Dokumen</h1><p>Sistem Registrasi Dokumen Keluar - BRI Unit Pusakaratu</p><p>Periode: {{ $tanggalMulai ?: 'Semua' }} s/d {{ $tanggalSelesai ?: 'Semua' }}</p></div>
<div class="meta">Status: {{ $status ?: 'Semua' }} | Pencarian: {{ $q ?: '-' }} | Dicetak: {{ now()->format('d/m/Y H:i') }}</div>
@include('laporan.partials.table', ['laporanList' => $laporanList])
<script>window.addEventListener('load',()=>setTimeout(()=>window.print(),400));</script>
</body>
</html>
