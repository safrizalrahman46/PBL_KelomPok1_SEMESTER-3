<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => Hash::make('admin123'), // Pastikan menggunakan bcrypt atau hashing lainnya untuk password
        ]);
        User::create([
            'name' => '2341760151',
            'email' => '2341760151@gmail.com',
            'password' => Hash::make('2341760151'), // Pastikan menggunakan bcrypt atau hashing lainnya untuk password
        ]);
        User::create([
            'name' => '2341760178',
            'email' => '2341760178@gmail.com',
            'password' => Hash::make('2341760178'), // Pastikan menggunakan bcrypt atau hashing lainnya untuk password
        ]);
    }
}
