@extends('layouts.app')

@section('title', 'Registrasi Keluar')
@section('subtitle', 'Catat dokumen yang keluar dari ruang arsip')

@section('content')
<div class="form-toolbar">
    <a href="{{ route('registrasi.index') }}">← Kembali</a>
    <span>Dokumen Keluar</span>
</div>

<form class="registration-form" action="{{ route('registrasi.keluar.store') }}" method="POST">
    @csrf
    <section class="form-section">
        <div class="form-section-title"><span>1</span><div><h2>Sumber Dokumen</h2><p>Pilih dokumen yang sudah tercatat atau input dokumen baru</p></div></div>
        <div class="source-options">
            <label class="source-option {{ $daftarDokumen->count() ? 'selected' : '' }}">
                <input type="radio" name="sumber_dokumen" value="tercatat" {{ $daftarDokumen->count() ? 'checked' : 'disabled' }}>
                <span class="source-icon">↗</span>
                <span><strong>Dokumen sudah terdaftar</strong><small>Pilih dari dokumen yang sedang berstatus masuk.</small></span>
            </label>
            <label class="source-option {{ $daftarDokumen->count() ? '' : 'selected' }}">
                <input type="radio" name="sumber_dokumen" value="baru" {{ $daftarDokumen->count() ? '' : 'checked' }}>
                <span class="source-icon">＋</span>
                <span><strong>Dokumen baru</strong><small>Input data dokumen yang belum pernah tercatat.</small></span>
            </label>
        </div>
    </section>

    <section class="form-section conditional-section" id="existing-document" {{ $daftarDokumen->count() ? '' : 'hidden' }}>
        <div class="form-section-title"><span>2</span><div><h2>Pilih Dokumen</h2><p>Cari berdasarkan no. registrasi, CIF, atau nama debitur</p></div></div>
        <div class="field-group">
            <label for="filter_dokumen">Cari Dokumen</label>
            <input id="filter_dokumen" type="search" placeholder="Ketik CIF, no. registrasi, atau nama debitur">
        </div>
        <div class="field-group">
            <label for="no_registrasi_existing">No. Registrasi / CIF / Debitur <b>*</b></label>
            <select id="no_registrasi_existing" name="no_registrasi_existing" {{ $daftarDokumen->count() ? 'required' : '' }}>
                <option value="">Pilih dokumen yang akan keluar</option>
                @foreach ($daftarDokumen as $dokumen)
                    <option value="{{ $dokumen->no_registrasi }}">{{ $dokumen->no_registrasi }} — {{ $dokumen->cif }} — {{ $dokumen->nama_debitur }}</option>
                @endforeach
            </select>
        </div>
    </section>

    <section class="form-section conditional-section" id="new-document" {{ $daftarDokumen->count() ? 'hidden' : '' }}>
        <div class="form-section-title"><span>2</span><div><h2>Data Dokumen Baru</h2><p>Identitas pemilik dokumen</p></div></div>
        <div class="form-grid">
            <div class="field-group"><label for="no_registrasi">No. Registrasi</label><input id="no_registrasi" name="no_registrasi" value="{{ $noRegistrasiBaru }}" readonly></div>
            <div class="field-group"><label for="cif">CIF <b>*</b></label><input id="cif" name="cif" maxlength="30" placeholder="Masukkan CIF" {{ $daftarDokumen->count() ? '' : 'required' }}></div>
            <div class="field-group"><label for="nomor_rekening">Nomor Rekening</label><input id="nomor_rekening" name="nomor_rekening" maxlength="30" placeholder="Opsional"></div>
            <div class="field-group"><label for="nama_debitur">Nama Debitur <b>*</b></label><input id="nama_debitur" name="nama_debitur" maxlength="100" placeholder="Masukkan nama debitur" {{ $daftarDokumen->count() ? '' : 'required' }}></div>
        </div>
        <div class="form-grid four-fields nested-fields">
            <div class="field-group"><label for="ruangan">Ruangan</label><input id="ruangan" name="ruangan" maxlength="10"></div>
            <div class="field-group"><label for="lemari">Lemari</label><input id="lemari" name="lemari" maxlength="10"></div>
            <div class="field-group"><label for="rak">Rak</label><input id="rak" name="rak" maxlength="10"></div>
            <div class="field-group"><label for="baris">Nomor</label><input id="baris" name="baris" maxlength="10"></div>
        </div>
    </section>

    <section class="form-section">
        <div class="form-section-title"><span>3</span><div><h2>Data Pengambil</h2><p>Petugas atau unit yang mengambil dokumen</p></div></div>
        <div class="form-grid">
            <div class="field-group"><label for="nama_pengambil">Nama Pengambil <b>*</b></label><input id="nama_pengambil" name="nama_pengambil" maxlength="100" required></div>
            <div class="field-group"><label for="unit_pengambil">Jabatan / Unit <b>*</b></label><input id="unit_pengambil" name="unit_pengambil" maxlength="100" required></div>
        </div>
    </section>

    <section class="form-section">
        <div class="form-section-title"><span>4</span><div><h2>Data Jaminan</h2><p>Status jaminan yang dibawa keluar</p></div></div>
        <div class="form-grid">
            <div class="field-group"><label>Apakah membawa jaminan?</label><div class="radio-row"><label><input type="radio" name="jaminan" value="Ya"> Ya</label><label><input type="radio" name="jaminan" value="Tidak" checked> Tidak</label></div></div>
            <div class="field-group"><label for="keterangan_jaminan">Keterangan Jaminan</label><textarea id="keterangan_jaminan" name="keterangan_jaminan" rows="3"></textarea></div>
        </div>
    </section>

    <div class="form-actions"><a href="{{ route('registrasi.index') }}">Batal</a><button type="submit">Simpan Dokumen Keluar</button></div>
</form>
@endsection

@push('scripts')
<script>
    const sourceInputs = document.querySelectorAll('input[name="sumber_dokumen"]');
    const existingSection = document.getElementById('existing-document');
    const newSection = document.getElementById('new-document');
    const existingSelect = document.getElementById('no_registrasi_existing');
    const documentFilter = document.getElementById('filter_dokumen');
    const newRequired = [document.getElementById('cif'), document.getElementById('nama_debitur')];
    function updateSource() {
        const selected = document.querySelector('input[name="sumber_dokumen"]:checked')?.value || 'baru';
        const useExisting = selected === 'tercatat';
        existingSection.hidden = !useExisting;
        newSection.hidden = useExisting;
        existingSelect.required = useExisting;
        newRequired.forEach(input => input.required = !useExisting);
        document.querySelectorAll('.source-option').forEach(option => option.classList.toggle('selected', option.querySelector('input').checked));
    }
    documentFilter?.addEventListener('input', () => {
        const keyword = documentFilter.value.toLowerCase().trim();
        existingSelect.querySelectorAll('option').forEach(option => option.hidden = option.value !== '' && !option.textContent.toLowerCase().includes(keyword));
        if (existingSelect.selectedOptions[0]?.hidden) existingSelect.value = '';
    });
    sourceInputs.forEach(input => input.addEventListener('change', updateSource));
    updateSource();
</script>
@endpush
