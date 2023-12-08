<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSender extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //buat akun
        $user = User::create([
            'name' => 'Andrimc',
            'email' => 'andrimc1999@gmail.com',
            'notelp' => '081278391690',
            'nowa' => '081278391690',
            'foto' => 'andri.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),

        ]);
        $user->assignRole('Admin');
    }
}
