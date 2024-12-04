<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('berkas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Referensi ke user
            $table->string('nama_user'); // Nama user (diambil dari user)
            $table->string('nip'); // NIP (diambil dari user)
            $table->year('tahun'); // Tahun dipilih user
            $table->string('bulan'); // Bulan dipilih user
            $table->string('kabupaten'); // Dropdown pilihan kabupaten
            $table->string('npsn_sekolah')->nullable(); // Tidak wajib
            $table->string('nama_instansi'); // Nama instansi
            $table->string('file_sptjm'); // Path file SPTJM
            $table->string('file_skp'); // Path file SKP
            $table->string('file_tpp'); // Path file TPP
            $table->string('file_dhbpo'); // Path file DHBPO
            $table->string('file_ekinerja'); // Path file E-Kinerja
            $table->string('status')->default('pending'); // Status validasi ('pending', 'approved', 'rejected')
            $table->date('deadline')->nullable(); // Menambahkan kolom deadline
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas');
    }
};
