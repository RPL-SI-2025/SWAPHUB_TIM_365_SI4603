<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            ['nama_kategori' => 'Elektronik'],
            ['nama_kategori' => 'Buku'],
            ['nama_kategori' => 'Pakaian'],
            ['nama_kategori' => 'Alat Tulis'],
            ['nama_kategori' => 'Lainnya'],
        ];

        foreach ($kategori as $kat) {
            Kategori::create($kat);
        }
    }
}