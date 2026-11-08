<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelamar', function (Blueprint $table) {
            $table->id('id_pelamar');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();
            $table->string('pendidikan')->nullable(); // S1, D3, SMA, dll
            $table->string('cv')->nullable(); // path file CV
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelamar');
    }
};
