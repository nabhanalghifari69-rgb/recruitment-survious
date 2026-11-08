<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wawancara', function (Blueprint $table) {
            $table->id('id_wawancara');
            $table->foreignId('id_lamaran')->constrained('lamaran', 'id_lamaran')->onDelete('cascade');
            $table->date('tgl_wawancara');
            $table->time('jam');
            $table->string('tempat');
            $table->text('hasil')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wawancara');
    }
};
