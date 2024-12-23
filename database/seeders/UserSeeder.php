<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data user admin
        User::create([
            'username' => 'admin',
            'password' => Hash::make('zxcvb321'),
            'role' => 'admin',
        ]);

        // Data user produksi
        User::create([
            'username' => 'produksi',
            'password' => Hash::make('qwerty123'),
            'role' => 'produksi',
        ]);
    }
}
