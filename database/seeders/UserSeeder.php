<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);
        User::create([
            'id' => 2,
            'name' => 'Budi Hartono',
            'email' => 'budi@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);
        User::create([
            'id' => 3,
            'name' => 'Rani Astuti',
            'email' => 'rani@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);
        User::create([
            'id' => 4,
            'name' => 'Pimpinan',
            'email' => 'pimpinan@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'pimpinan'
        ]);
    }
}
