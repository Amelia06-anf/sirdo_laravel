@extends('layouts.app')

@section('title', 'Registrasi Masuk')
@section('subtitle', 'Catat pengembalian dokumen ke ruang arsip')

@section('content')
<div class="form-toolbar"><a href="{{ route('registrasi.index') }}">← Kembali</a><span>Dokumen Masuk</span></div>

<form class="registration-form" action="{{ route('registrasi.masuk.store') }}" method="POST">
    @csrf
    <section class="form-section">
        <div class="form-section-title"><span>1</span><div><h2>Sumber Dokumen</h2><p>Pilih kondisi dokumen yang akan dicatat masuk</p></div></div>
        <div class="source-options">
            <label class="source-option {{ $daftarDokumen->count() ? 'selected' : '' }}"><input type="radio" name="sumber_dokumen" value="tercatat" {{ $daftarDokumen->count() ? 'checked' : 'disabled' }}><span class="source-icon">↩</span><span><strong>Sudah tercatat keluar</strong><small>Pilih dari dokumen yang sedang berada di luar arsip.</small></span></label>
            <label class="source-option {{ $daftarDokumen->count() ? '' : 'selected' }}"><input type="radio" name="sumber_dokumen" value="baru" {{ $daftarDokumen->count() ? '' : 'checked' }}><span class="source-icon">＋</span><span><strong>Dokumen lama belum tercatat</strong><small>Input dokumen manual untuk pertama kali ke sistem.</small></span></label>
        </div>
    </section>

    <section class="form-section conditional-section" id="existing-document" {{ $daftarDokumen->count() ? '' : 'hidden' }}>
        <div class="form-section-title"><span>2</span><div><h2>Pilih Dokumen</h2><p>Cari berdasarkan no. registrasi, CIF, atau nama debitur</p></div></div>
        <div class="field-group"><label for="filter_dokumen">Cari Dokumen</label><input id="filter_dokumen" type="search" placeholder="Ketik CIF, no. registrasi, atau nama debitur"></div>
        <div class="field-group">
            <label for="no_registrasi_existing">No. Registrasi / CIF / Debitur <b>*</b></label>
            <select id="no_registrasi_existing" name="no_registrasi_existing" {{ $daftarDokumen->count() ? 'required' : '' }}>
                <option value="">Pilih dokumen yang dikembalikan</option>
                @foreach ($daftarDokumen as $dokumen)
                    <option value="{{ $dokumen->no_registrasi }}">{{ $dokumen->no_registrasi }} — {{ $dokumen->cif }} — {{ $dokumen->nama_debitur }}</option>
                @endforeach
            </select>
        </div>
    </section>

    <section class="form-section conditional-section" id="new-document" {{ $daftarDokumen->count() ? 'hidden' : '' }}>
        <div class="form-section-title"><span>2</span><div><h2>Data Dokumen Lama</h2><p>Dokumen yang baru pertama kali dimasukkan ke sistem</p></div></div>
        <div class="form-grid">
            <div class="field-group"><label for="no_registrasi_baru">No. Registrasi</label><input id="no_registrasi_baru" name="no_registrasi_baru" value="{{ $noRegistrasiBaru }}" readonly></div>
            <div class="field-group"><label for="cif_baru">CIF <b>*</b></label><input id="cif_baru" name="cif_baru" maxlength="30" {{ $daftarDokumen->count() ? '' : 'required' }}></div>
            <div class="field-group"><label for="nomor_rekening_baru">Nomor Rekening</label><input id="nomor_rekening_baru" name="nomor_rekening_baru" maxlength="30"></div>
            <div class="field-group"><label for="nama_debitur_baru">Nama Debitur <b>*</b></label><input id="nama_debitur_baru" name="nama_debitur_baru" maxlength="100" {{ $daftarDokumen->count() ? '' : 'required' }}></div>
        </div>
        <div class="form-grid four-fields nested-fields">
            <div class="field-group"><label for="ruangan_baru">Ruangan</label><input id="ruangan_baru" name="ruangan_baru" maxlength="10"></div>
            <div class="field-group"><label for="lemari_baru">Lemari</label><input id="lemari_baru" name="lemari_baru" maxlength="10"></div>
            <div class="field-group"><label for="rak_baru">Rak</label><input id="rak_baru" name="rak_baru" maxlength="10"></div>
            <div class="field-group"><label for="baris_baru">Nomor</label><input id="baris_baru" name="baris_baru" maxlength="10"></div>
        </div>
    </section>

    <section class="form-section">
        <div class="form-section-title"><span>3</span><div><h2>Data Jaminan</h2><p>Status jaminan yang ikut masuk bersama dokumen</p></div></div>
        <div class="form-grid">
            <div class="field-group">
                <label>Apakah membawa jaminan?</label>
                <div class="radio-row">
                    <label><input type="radio" name="jaminan" value="Ya"> Ya</label>
                    <label><input type="radio" name="jaminan" value="Tidak" checked> Tidak</label>
                </div>
            </div>
            <div class="field-group">
                <label for="keterangan_jaminan">Keterangan Jaminan</label>
                <textarea id="keterangan_jaminan" name="keterangan_jaminan" rows="3" placeholder="Contoh: Sertifikat / BPKB / AJB / lainnya"></textarea>
            </div>
        </div>
    </section>

    <section class="form-section">
        <div class="form-section-title"><span>4</span><div><h2>Data Pengembalian</h2><p>Identitas pihak yang mengembalikan</p></div></div>
        <div class="form-grid">
            <div class="field-group"><label for="nama_pengembali">Nama Pengembali <b>*</b></label><input id="nama_pengembali" name="nama_pengembali" maxlength="100" required></div>
            <div class="field-group"><label for="unit_pengembali">Jabatan / Unit <b>*</b></label><input id="unit_pengembali" name="unit_pengembali" maxlength="100" required></div>
            <div class="field-group full-field"><label for="keterangan">Keterangan</label><textarea id="keterangan" name="keterangan" rows="3"></textarea></div>
        </div>
    </section>

    <div class="form-actions"><a href="{{ route('registrasi.index') }}">Batal</a><button type="submit">Simpan Dokumen Masuk</button></div>
</form>
@endsection

@push('scripts')
<script>
    const sourceInputs = document.querySelectorAll('input[name="sumber_dokumen"]');
    const existingSection = document.getElementById('existing-document');
    const newSection = document.getElementById('new-document');
    const existingSelect = document.getElementById('no_registrasi_existing');
    const documentFilter = document.getElementById('filter_dokumen');
    const newRequired = [document.getElementById('cif_baru'), document.getElementById('nama_debitur_baru')];
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
