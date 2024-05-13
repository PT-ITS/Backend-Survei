<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        // pengurus
        User::create([
            'name' => 'pusat',
            'email' => 'pusat@gmail.com',
            'password' => Hash::make('12345'),
            'alamat' => 'test',
            'noHP' => '0000000'
        ]);
    }
}
