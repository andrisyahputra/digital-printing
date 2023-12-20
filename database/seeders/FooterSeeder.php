<?php

namespace Database\Seeders;

use App\Models\Footer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Footer::create([
            'fot_tentang' => '<h3><b>Tentang Kami</b></h3><p>Digital Printing Online melayani : digital printing , seperti cetak spanduk, sticker, banner, poster, baliho, dan produk-produk lainnya.</p>',
            'fot_alamat' => '<h3><b>Alamat</b></h3><p>Toko Sekitaran Kota Binjai</p>',
            'fot_kontak' => '<h3><b>Kontak</b></h3><p>(021) 22730858 - (021) 22704353</p><p><span style="font-size: 1rem;">Whats-app = 0813-7859-0777</span><br></p>',
            'fot_jambuka' => '<h3><b>Jam Buka</b></h3><p>Senin<span style="white-space:pre">	</span>:<span style="white-space:pre">	</span>08.00 – 18.00</p><p>Selasa<span style="white-space:pre">	</span>:<span style="white-space:pre">	</span>08.00 – 18.00</p><p>Rabu<span style="white-space:pre">	</span>:<span style="white-space:pre">	</span>08.00 – 18.00</p><p>Kamis<span style="white-space:pre">	</span>:<span style="white-space:pre">	</span>08.00 – 18.00</p><p>Jumat<span style="white-space:pre">	</span>:<span style="white-space:pre">	</span>08.00 – 18.00</p><p>Sabtu<span style="white-space:pre">	</span>:<span style="white-space:pre">	</span>08.00 – 18.00</p>'
        ]);
    }
}
