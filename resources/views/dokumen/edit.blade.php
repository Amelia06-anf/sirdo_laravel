@extends('layouts.app')

@section('title', 'Edit Dokumen')
@section('subtitle', 'Perbaiki data dokumen yang salah input')

@section('content')
<div class="form-toolbar">
    <a href="{{ route('dokumen.index') }}">← Kembali</a>
    <span>Edit Data</span>
</div>

<form class="registration-form" action="{{ route('dokumen.update', $dokumen->id_dokumen) }}" method="POST">
    @csrf
    @method('PUT')

    <section class="form-section">
        <div class="form-section-title">
            <span>1</span>
            <div>
                <h2>Identitas Dokumen</h2>
                <p>CIF harus unik. Satu CIF hanya boleh untuk satu berkas/dokumen.</p>
            </div>
        </div>
        <div class="form-grid">
            <div class="field-group">
                <label for="no_registrasi">No. Registrasi <b>*</b></label>
                <input id="no_registrasi" name="no_registrasi" value="{{ old('no_registrasi', $dokumen->no_registrasi) }}" maxlength="30" required>
            </div>
            <div class="field-group">
                <label for="cif">CIF <b>*</b></label>
                <input id="cif" name="cif" value="{{ old('cif', $dokumen->cif) }}" maxlength="30" required>
            </div>
            <div class="field-group">
                <label for="nama_debitur">Nama Debitur <b>*</b></label>
                <input id="nama_debitur" name="nama_debitur" value="{{ old('nama_debitur', $dokumen->nama_debitur) }}" maxlength="100" required>
            </div>
            <div class="field-group">
                <label for="nomor_rekening">Nomor Rekening</label>
                <input id="nomor_rekening" name="nomor_rekening" value="{{ old('nomor_rekening', $dokumen->nomor_rekening) }}" maxlength="30">
            </div>
            <div class="field-group">
                <label for="status_terakhir">Status Terakhir <b>*</b></label>
                <select id="status_terakhir" name="status_terakhir" required>
                    <option value="Masuk" @selected(old('status_terakhir', $dokumen->status_terakhir) === 'Masuk')>Masuk</option>
                    <option value="Keluar" @selected(old('status_terakhir', $dokumen->status_terakhir) === 'Keluar')>Keluar</option>
                </select>
            </div>
        </div>
    </section>

    <section class="form-section">
        <div class="form-section-title">
            <span>2</span>
            <div>
                <h2>Data Pengambil & Jaminan</h2>
                <p>Isi bila dokumen sedang/pernah keluar atau membawa jaminan.</p>
            </div>
        </div>
        <div class="form-grid">
            <div class="field-group">
                <label for="nama_pengambil">Nama Pengambil</label>
                <input id="nama_pengambil" name="nama_pengambil" value="{{ old('nama_pengambil', $dokumen->nama_pengambil) }}" maxlength="100">
            </div>
            <div class="field-group">
                <label for="unit_pengambil">Jabatan / Unit</label>
                <input id="unit_pengambil" name="unit_pengambil" value="{{ old('unit_pengambil', $dokumen->unit_pengambil) }}" maxlength="100">
            </div>
            <div class="field-group">
                <label>Apakah membawa jaminan?</label>
                <div class="radio-row">
                    <label><input type="radio" name="jaminan" value="Ya" @checked(old('jaminan', $dokumen->jaminan) === 'Ya')> Ya</label>
                    <label><input type="radio" name="jaminan" value="Tidak" @checked(old('jaminan', $dokumen->jaminan ?: 'Tidak') === 'Tidak')> Tidak</label>
                </div>
            </div>
            <div class="field-group">
                <label for="keterangan_jaminan">Keterangan Jaminan</label>
                <textarea id="keterangan_jaminan" name="keterangan_jaminan" rows="3">{{ old('keterangan_jaminan', $dokumen->keterangan_jaminan) }}</textarea>
            </div>
        </div>
    </section>

    <section class="form-section">
        <div class="form-section-title">
            <span>3</span>
            <div>
                <h2>Lokasi Berkas</h2>
                <p>Posisi penyimpanan dokumen di ruang arsip.</p>
            </div>
        </div>
        <div class="form-grid four-fields">
            <div class="field-group"><label for="ruangan">Ruangan</label><input id="ruangan" name="ruangan" value="{{ old('ruangan', $dokumen->ruangan) }}" maxlength="10"></div>
            <div class="field-group"><label for="lemari">Lemari</label><input id="lemari" name="lemari" value="{{ old('lemari', $dokumen->lemari) }}" maxlength="10"></div>
            <div class="field-group"><label for="rak">Rak</label><input id="rak" name="rak" value="{{ old('rak', $dokumen->rak) }}" maxlength="10"></div>
            <div class="field-group"><label for="baris">Nomor</label><input id="baris" name="baris" value="{{ old('baris', $dokumen->baris) }}" maxlength="10"></div>
        </div>
    </section>

    <div class="form-actions">
        <a href="{{ route('dokumen.index') }}">Batal</a>
        <button type="submit">Simpan Perubahan</button>
    </div>
</form>
@endsection
