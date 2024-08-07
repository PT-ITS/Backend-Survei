<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
            'name' => 'disparekrafdki',
            'email' => 'disparekrafdki@surveiwisatadki.com',
            'password' => Hash::make('W1547a!&$1k'),
            'alamat' => 'test',
            'level' => '1',
            'status' => '1',
            'noHP' => '0812345',
            'created_at' => Carbon::create(2024, 4, 24, 12, 0, 0) // Format: (year, month, day, hour, minute, second)
        ]);
        User::create([
            'name' => 'surveyor',
            'email' => 'survey@gmail.com',
            'password' => Hash::make('12345'),
            'alamat' => 'test',
            'level' => '0',
            'status' => '1',
            'noHP' => '0812345'
        ]);
        User::create([
            'name' => 'pengelola',
            'email' => 'pengelola@gmail.com',
            'password' => Hash::make('12345'),
            'alamat' => 'test',
            'level' => '2',
            'status' => '1',
            'noHP' => '0812345'
        ]);
    }
}
