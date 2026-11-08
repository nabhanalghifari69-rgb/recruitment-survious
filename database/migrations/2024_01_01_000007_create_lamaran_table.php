<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lamaran', function (Blueprint $table) {
            $table->id('id_lamaran');
            $table->foreignId('id_pelamar')->constrained('pelamar', 'id_pelamar')->onDelete('cascade');
            $table->foreignId('id_lowongan')->constrained('lowongan', 'id_lowongan')->onDelete('cascade');
            $table->date('tgl_lamar');
            $table->enum('status_lamaran', [
                'Menunggu',
                'Diterima Berkas',
                'Seleksi',
                'Wawancara',
                'Diterima',
                'Ditolak'
            ])->default('Menunggu');
            $table->text('catatan_hrd')->nullable();
            $table->timestamps();

            // Mencegah lamaran ganda pada lowongan yang sama
            $table->unique(['id_pelamar', 'id_lowongan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lamaran');
    }
};
