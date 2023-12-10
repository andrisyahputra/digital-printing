<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i = 1; $i < 10; $i++) {
            Produk::create([
                'foto' => 'produk/example.jpg',
                'nama' => 'Example ' . $i,
                'harga' => 10000,
                'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat suscipit facere, recusandae omnis nihil sint culpa. Cumque consequatur maxime mollitia nisi porro delectus commodi hic!',
                'stok' => 200,
                'weight' => 1000,
                'kategori_id' => $i
            ]);
        }
        // $table->string('foto');
        // $table->string('nama');
        // $table->bigInteger('harga');
        // $table->text('deskripsi');
        // $table->foreignId('kategori_id')->constrained();
    }
}
