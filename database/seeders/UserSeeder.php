<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'user_level' => UserLevel::SUPERADMIN,
            'password' => 'password',
        ]);
    }
}
