@extends('layouts.app')

@section('title', 'Data Dokumen')
@section('subtitle', 'Kelola dan pantau status seluruh dokumen')

@section('content')
<section class="stat-grid compact-stat-grid">
    <article class="stat-card stat-blue"><div><span>Total Dokumen</span><strong>{{ number_format($ringkasan['total']) }}</strong><small>Semua dokumen tercatat</small></div></article>
    <article class="stat-card stat-green"><div><span>Status Masuk</span><strong>{{ number_format($ringkasan['masuk']) }}</strong><small>Dokumen berada di arsip</small></div></article>
    <article class="stat-card stat-orange"><div><span>Status Keluar</span><strong>{{ number_format($ringkasan['keluar']) }}</strong><small>Dokumen sedang keluar</small></div></article>
    <article class="stat-card stat-purple"><div><span>Ada Jaminan</span><strong>{{ number_format($ringkasan['jaminan']) }}</strong><small>Dokumen dengan jaminan</small></div></article>
</section>

<section class="latest-panel">
    <div class="panel-heading"><div><h2>Daftar Dokumen</h2><p>Cari berdasarkan no. registrasi, CIF, nama debitur, atau nomor rekening</p></div><a href="{{ route('registrasi.index') }}">Registrasi Baru</a></div>
    <form class="filter-panel" method="GET">
        <div class="field-group"><label for="q">Pencarian</label><input id="q" name="q" value="{{ $q }}" placeholder="Contoh: CIF / REG / Nama"></div>
        <div class="field-group"><label for="status">Status</label><select id="status" name="status"><option value="">Semua Status</option><option value="Masuk" @selected($status==='Masuk')>Masuk</option><option value="Keluar" @selected($status==='Keluar')>Keluar</option></select></div>
        <div class="field-group"><label for="jaminan">Jaminan</label><select id="jaminan" name="jaminan"><option value="">Semua</option><option value="Ya" @selected($jaminan==='Ya')>Ya</option><option value="Tidak" @selected($jaminan==='Tidak')>Tidak</option></select></div>
        <div class="filter-actions"><button type="submit">Tampilkan</button><a href="{{ route('dokumen.index') }}">Reset</a></div>
    </form>
    <div class="table-wrap">
        <table>
            <thead><tr><th>No. Reg</th><th>CIF</th><th>Nama Debitur</th><th>No. Rekening</th><th>Status</th><th>Jaminan</th><th>Lokasi</th><th>Petugas</th><th>Aktivitas Terakhir</th><th>Aksi</th></tr></thead>
            <tbody>
            @forelse ($dokumenList as $dokumen)
                @php
                    $lokasi = collect([
                        $dokumen->ruangan ? 'Ruang '.$dokumen->ruangan : null,
                        $dokumen->lemari ? 'Lemari '.$dokumen->lemari : null,
                        $dokumen->rak ? 'Rak '.$dokumen->rak : null,
                        $dokumen->baris ? 'No. '.$dokumen->baris : null,
                    ])->filter()->implode(' / ');
                @endphp
                <tr>
                    <td><strong>{{ $dokumen->no_registrasi }}</strong></td><td>{{ $dokumen->cif }}</td><td>{{ $dokumen->nama_debitur }}</td><td>{{ $dokumen->nomor_rekening ?: '-' }}</td>
                    <td><span class="status status-{{ strtolower($dokumen->status_terakhir) }}">{{ $dokumen->status_terakhir }}</span></td>
                    <td><span class="mini-badge {{ $dokumen->jaminan === 'Ya' ? 'badge-warning' : 'badge-muted' }}">{{ $dokumen->jaminan ?: 'Tidak' }}</span></td>
                    <td>{{ $lokasi ?: '-' }}</td><td>{{ $dokumen->nama_petugas }}</td><td>{{ $dokumen->aktivitas_terakhir ? date('d/m/Y H:i', strtotime($dokumen->aktivitas_terakhir)) : '-' }}</td>
                    <td>
                        <div class="table-actions">
                            <a class="action-button edit-button" href="{{ route('dokumen.edit', $dokumen->id_dokumen) }}">Edit</a>
                            <form method="POST" action="{{ route('dokumen.destroy', $dokumen->id_dokumen) }}" onsubmit="return confirm('Yakin hapus dokumen {{ $dokumen->no_registrasi }}? Riwayat dokumen ini juga akan ikut terhapus.');">
                                @csrf
                                @method('DELETE')
                                <button class="action-button delete-button" type="submit">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td class="empty-table" colspan="10">Belum ada dokumen yang sesuai filter.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
