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

        $laporanList = [
            'Barang Tidak Sesuai Deskripsi',
            'Penukar Tidak Datang',
            'Barang Rusak / Tidak Layak Pakai',
            'Akun Palsu / Identitas Tidak Valid',
            'Pemaksaan atau Ancaman',
            'Spam atau Penawaran Tidak Relevan',
            'Manipulasi Rating/Review',
            'Penipuan Komunikasi di Luar Aplikasi',
            'Perilaku Tidak Sopan / Pelecehan',
        ];

        foreach ($laporanList as $laporan) {
            Kategori::create([
                'jenis_kategori' => 'laporan',
                'nama_kategori' => $laporan,
            ]);
        }
    }
}
