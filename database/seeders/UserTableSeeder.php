<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@mediplus.com',
            'password' => bcrypt('password'),
        ]);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@mediplus.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('user');

        $admin->assignRole('admin');
    }
}
