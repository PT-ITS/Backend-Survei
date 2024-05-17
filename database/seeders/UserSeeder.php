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
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345'),
            'alamat' => 'test',
            'level' => '1',
            'noHP' => '0812345'
        ]);
        User::create([
            'name' => 'surveyor',
            'email' => 'survey@gmail.com',
            'password' => Hash::make('12345'),
            'alamat' => 'test',
            'level' => '0',
            'noHP' => '0812345'
        ]);
    }
}
