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
        Schema::create('ppdb_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap'); // nama lengkap calon siswa
            $table->string('nisn')->unique()->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('email');
            $table->string('no_hp'); // nomor hp
            $table->enum('status', ['pending', 'proses', 'diterima'])->default('pending');
            $table->text('notes')->nullable(); // catatan tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_registrations');
    }
};

