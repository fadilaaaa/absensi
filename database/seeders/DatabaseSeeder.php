<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Anisa Pohan',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);
        \App\Models\User::create([
            'name' => 'Rizky Pao',
            'username' => 'user',
            'password' => bcrypt('user'),
        ]);
    }
}
