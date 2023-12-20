<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'gdepan_ket' => '<h3><b>Kenapa Memilih Produk Kami</b></h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque error facere totam magnam sequi minus.<span style="font-size: 1rem;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem, sed.</span><br></p>',
            'maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63709.55260437139!2d98.46000389159218!3d3.6224091779540846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3030d60114970f8d%3A0x3039d80b220cbd0!2sBinjai%2C%20Kota%20Binjai%2C%20Sumatera%20Utara!5e0!3m2!1sid!2sid!4v1691080784795!5m2!1sid!2sid',
            'produk_kami' => '<h3><span style="font-weight: bolder;">Produk Kami</span></h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque error facere totam magnam sequi minus.<span style="font-size: 1rem;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem, sed.</span></p>',
            'hub_kami' => '<h3><b>Hubungi Kami</b></h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque error facere totam magnam sequi minus.<span style="font-size: 1rem;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem, sed.</span></p>'
        ]);
    }
}
