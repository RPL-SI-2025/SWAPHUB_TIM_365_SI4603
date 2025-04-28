<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKategoriTableChangeDeskripsiToJenis extends Migration
{
    public function up()
    {
        Schema::table('kategori', function (Blueprint $table) {
            $table->dropColumn('deskripsi'); // Hapus kolom deskripsi
            $table->string('jenis')->after('nama'); // Tambahkan kolom jenis setelah nama
        });
    }

    public function down()
    {
        Schema::table('kategori', function (Blueprint $table) {
            $table->dropColumn('jenis'); // Kalau rollback, hapus kolom jenis
            $table->text('deskripsi')->nullable(); // Tambahkan kembali deskripsi
        });
    }
}
