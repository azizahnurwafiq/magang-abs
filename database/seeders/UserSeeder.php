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
            'username' => 'ilham',
            'password' => Hash::make('ilham123'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'rizal',
            'password' => Hash::make('rizal321'),
            'role' => 'admin',
        ]);

        // Data user produksi
        User::create([
            'username' => 'produksi',
            'password' => Hash::make('produksi123'),
            'role' => 'produksi',
        ]);
        
        User::create([
            'username' => 'rina',
            'password' => Hash::make('rina321'),
            'role' => 'produksi',
        ]);

        // Data user produksi
        User::create([
            'username' => 'manager',
            'password' => Hash::make('zxcvbn99812'),
            'role' => 'manager',
        ]);

        User::create([
            'username' => 'karim',
            'password' => Hash::make('karim321'),
            'role' => 'manager',
        ]);
    }
}
