@extends('layouts.app')

@section('title', 'Laporan Riwayat Dokumen')
@section('subtitle', 'Tabel seluruh aktivitas dokumen masuk dan keluar')

@section('content')
<section class="latest-panel report-filter-panel">
    <div class="panel-heading"><div><h2>Filter Laporan</h2><p>Kosongkan tanggal jika ingin menampilkan seluruh riwayat</p></div></div>
    <form class="filter-panel report-filter-grid" method="GET">
        <div class="field-group"><label for="tanggal_mulai">Tanggal Mulai</label><input id="tanggal_mulai" type="date" name="tanggal_mulai" value="{{ $tanggalMulai }}"></div>
        <div class="field-group"><label for="tanggal_selesai">Tanggal Selesai</label><input id="tanggal_selesai" type="date" name="tanggal_selesai" value="{{ $tanggalSelesai }}"></div>
        <div class="field-group"><label for="status">Status</label><select id="status" name="status"><option value="">Semua Status</option><option value="Masuk" @selected($status==='Masuk')>Masuk</option><option value="Keluar" @selected($status==='Keluar')>Keluar</option></select></div>
        <div class="field-group"><label for="q">Cari Dokumen</label><input id="q" name="q" value="{{ $q }}" placeholder="CIF / No. Reg / Nama / Rekening"></div>
        <div class="filter-actions"><button type="submit">Tampilkan</button><a href="{{ route('laporan.index') }}">Reset</a></div>
    </form>
</section>

<section class="latest-panel report-table-panel">
    <div class="panel-heading report-heading">
        <div><h2>Tabel Riwayat Dokumen</h2><p>{{ number_format($laporanList->count()) }} data riwayat ditampilkan</p></div>
        <div class="export-actions">
            <a class="export-button excel-button" href="{{ route('laporan.excel', request()->query()) }}">Export Excel</a>
            <a class="export-button pdf-button" href="{{ route('laporan.pdf', request()->query()) }}" target="_blank">Export PDF</a>
        </div>
    </div>
    @include('laporan.partials.table', ['laporanList' => $laporanList])
</section>
@endsection
