<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('petugas', function (Blueprint $table) {
            $table->id('id_petugas');
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->string('nama_petugas', 100);
        });

        Schema::create('dokumen', function (Blueprint $table) {
            $table->id('id_dokumen');
            $table->string('no_registrasi', 30)->unique();
            $table->string('cif', 30);
            $table->string('nama_debitur', 100);
            $table->string('nomor_rekening', 30)->nullable();
            $table->string('nama_pengambil', 100)->nullable();
            $table->string('unit_pengambil', 100)->nullable();
            $table->enum('jaminan', ['Ya', 'Tidak'])->default('Tidak');
            $table->text('keterangan_jaminan')->nullable();
            $table->string('ruangan', 10)->nullable();
            $table->string('lemari', 10)->nullable();
            $table->string('rak', 10)->nullable();
            $table->string('baris', 10)->nullable();
            $table->enum('status_terakhir', ['Masuk', 'Keluar'])->default('Masuk');
            $table->foreignId('id_petugas')->nullable()->constrained('petugas', 'id_petugas')->nullOnDelete();
        });

        Schema::create('riwayat_dokumen', function (Blueprint $table) {
            $table->id('id_riwayat');
            $table->foreignId('id_dokumen')->constrained('dokumen', 'id_dokumen')->cascadeOnDelete();
            $table->foreignId('id_petugas')->nullable()->constrained('petugas', 'id_petugas')->nullOnDelete();
            $table->enum('status', ['Masuk', 'Keluar']);
            $table->dateTime('tanggal_status');
            $table->text('keterangan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_dokumen');
        Schema::dropIfExists('dokumen');
        Schema::dropIfExists('petugas');
    }
};
