<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'group_id' => 1,
            'name' => 'Taro',
            'email' => 'test1@test.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'id' => 2,
            'group_id' => 1,
            'name' => 'Hanako',
            'email' => 'test2@test.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'id' => 3,
            'group_id' => 2,
            'name' => 'Rei',
            'email' => 'test3@test.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'id' => 4,
            'group_id' => 2,
            'name' => 'Reno',
            'email' => 'test4@test.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    }
}
