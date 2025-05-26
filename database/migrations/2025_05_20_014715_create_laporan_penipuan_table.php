<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laporan_penipuan', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->foreignId('id_kategori')->constrained('kategori','id_kategori')->onDelete('cascade');
            $table->foreignId('id_pelapor')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_dilapor')->constrained('users')->onDelete('cascade');
            $table->text('pesan_laporan');
            $table->string('foto_bukti')->nullable();
            $table->enum('status_laporan', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_penipuan');
    }
};