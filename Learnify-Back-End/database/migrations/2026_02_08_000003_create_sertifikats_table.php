<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sertifikats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();
            $table->string('nomor_sertifikat')->unique();
            $table->date('tanggal_terbit');
            $table->timestamps();

            $table->unique(['user_id', 'kelas_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sertifikats');
    }
};
