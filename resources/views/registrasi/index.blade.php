@extends('layouts.app')

@section('title', 'Registrasi Berkas')
@section('subtitle', 'Pilih jenis aktivitas dokumen')

@section('content')
<section class="registration-choice">
    <div class="section-heading">
        <h2>Registrasi Dokumen</h2>
        <p>Catat dokumen yang masuk atau keluar dari ruang arsip.</p>
    </div>
    <div class="choice-grid">
        <a class="choice-card choice-in" href="{{ route('registrasi.masuk') }}">
            <div class="choice-icon">↙</div><span>Dokumen Masuk</span>
            <h3>Registrasi Masuk</h3><p>Catat dokumen yang dikembalikan ke arsip atau dokumen lama yang baru dicatat.</p><strong>Mulai Registrasi</strong>
        </a>
        <a class="choice-card choice-out" href="{{ route('registrasi.keluar') }}">
            <div class="choice-icon">↗</div><span>Dokumen Keluar</span>
            <h3>Registrasi Keluar</h3><p>Catat dokumen yang keluar dari arsip, baik data baru maupun data yang sudah terdaftar.</p><strong>Mulai Registrasi</strong>
        </a>
    </div>
</section>
@endsection
