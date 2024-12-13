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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // 'no' sebagai primary key
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('nip')->unique(); // NIP
            $table->string('level'); // Level (e.g., 'admin', 'user', etc.)
            $table->string('status')->default('aktif'); // Status aktif/non-aktif
            $table->string('password');
            $table->string('jabatan')->nullable();
            $table->bigInteger('notel')->nullable();
            $table->date('birthday')->nullable();
            $table->string('profile_picture')->nullable();
            $table->date('deadline')->nullable();
            $table->timestamp('tanggal_registrasi')->useCurrent(); // Default waktu saat registrasi
            $table->timestamps(); // Untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
