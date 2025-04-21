<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->enum('kategori', [
                'Fashion',
                'Outfits',
                'Automotive',
                'Accessories',
                'Stationery',
                'Books',
                'Furniture',
                'Decoration'
            ])->nullable()->after('is_gift');
        });
    }

    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
};