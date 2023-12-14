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
        //
        // for ($i = 1; $i < 10; $i++) {
        //     Kategori::create([
        //         'nama' => 'Sepatu ' . $i,
        //     ]);
        // }
        Kategori::create(['nama' => 'Stiker']);
        Kategori::create(['nama' => 'Spanduk']);
        Kategori::create(['nama' => 'Kartu Nama']);
        Kategori::create(['nama' => 'Brosur']);
    }
}
