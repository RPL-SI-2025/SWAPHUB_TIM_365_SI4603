<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create([
            'jenis_kategori' => 'barang',
            'nama_kategori' => 'Gadget',
        ]);
        Kategori::create([
            'jenis_kategori' => 'barang',
            'nama_kategori' => 'Otomotif',
        ]);
        Kategori::create([
            'jenis_kategori' => 'barang',
            'nama_kategori' => 'Administrasi',
        ]);
        Kategori::create([
            'jenis_kategori' => 'barang',
            'nama_kategori' => 'Pakaian',
        ]);
        Kategori::create([
            'jenis_kategori' => 'barang',
            'nama_kategori' => 'Mainan',
        ]);
        Kategori::create([
            'jenis_kategori' => 'barang',
            'nama_kategori' => 'Olahraga',
        ]);
        Kategori::create([
            'jenis_kategori' => 'barang',
            'nama_kategori' => 'Furniture',
        ]);
        Kategori::create([
            'jenis_kategori' => 'barang',
            'nama_kategori' => 'Aksesoris',
        ]);
    }
}
