<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumen_lamaran', function (Blueprint $table) {
            $table->id('id_dokumen');
            $table->foreignId('id_lamaran')->constrained('lamaran', 'id_lamaran')->onDelete('cascade');
            $table->string('jenis_dokumen'); // CV, Ijazah, Transkrip, dll
            $table->string('nama_file');
            $table->string('path_file');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_lamaran');
    }
};
