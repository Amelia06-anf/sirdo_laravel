@extends('layouts.app')

@section('title', 'Dashboard')
@section('subtitle', 'Ringkasan aktivitas dokumen')

@section('content')
<section class="stat-grid">
    <article class="stat-card stat-blue"><div><span>Total Dokumen Keluar</span><strong>{{ number_format($ringkasan['total_keluar']) }}</strong><small>Dokumen berstatus keluar</small></div></article>
    <article class="stat-card stat-green"><div><span>Total Dokumen Masuk</span><strong>{{ number_format($ringkasan['total_masuk']) }}</strong><small>Dokumen berstatus masuk</small></div></article>
    <article class="stat-card stat-orange today-card"><div class="today-title">Dokumen Hari Ini</div><div class="today-stats"><div><strong>{{ number_format($ringkasan['hari_keluar']) }}</strong><span>Keluar</span></div><div><strong>{{ number_format($ringkasan['hari_masuk']) }}</strong><span>Masuk</span></div></div></article>
    <article class="stat-card stat-purple"><div><span>Total Debitur</span><strong>{{ number_format($ringkasan['total_debitur']) }}</strong><small>Total debitur/dokumen tercatat</small></div></article>
</section>

<section class="latest-panel">
    <div class="panel-heading"><div><h2>Aktivitas Dokumen Terbaru</h2><p>Aktivitas dokumen terbaru yang tercatat</p></div><a href="{{ route('dokumen.index') }}">Lihat Semua</a></div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>No. Reg</th><th>CIF</th><th>Nama Debitur</th><th>Petugas</th><th>Status</th><th>Tanggal Keluar</th><th>Tanggal Masuk</th></tr></thead>
            <tbody>
            @forelse ($dokumenTerbaru as $dokumen)
                <tr>
                    <td><strong>{{ $dokumen->no_registrasi }}</strong></td><td>{{ $dokumen->cif }}</td><td>{{ $dokumen->nama_debitur }}</td><td>{{ $dokumen->nama_petugas }}</td>
                    <td><span class="status status-{{ strtolower($dokumen->status_terakhir) }}">{{ $dokumen->status_terakhir }}</span></td>
                    <td>{{ $dokumen->tanggal_keluar ? date('Y-m-d', strtotime($dokumen->tanggal_keluar)) : '-' }}</td>
                    <td>{{ $dokumen->tanggal_masuk ? date('Y-m-d', strtotime($dokumen->tanggal_masuk)) : '-' }}</td>
                </tr>
            @empty
                <tr><td class="empty-table" colspan="7">Belum ada aktivitas dokumen.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
