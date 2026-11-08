<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id('id_lowongan');
            $table->foreignId('id_hrd')->constrained('hrd', 'id_hrd')->onDelete('cascade');
            $table->foreignId('id_departemen')->constrained('departemen', 'id_departemen')->onDelete('cascade');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('lokasi');
            $table->string('kategori'); // Full Time, Part Time, Kontrak, Magang
            $table->string('gaji')->nullable(); // rentang gaji
            $table->date('tgl_tutup');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lowongan');
    }
};
