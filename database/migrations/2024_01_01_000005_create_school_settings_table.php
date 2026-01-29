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
        Schema::create('school_settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah')->nullable();
            $table->text('visi_misi')->nullable();
            $table->string('logo')->nullable();
            $table->text('alamat')->nullable();
            $table->string('email_kontak')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('map_url')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_settings');
    }
};

