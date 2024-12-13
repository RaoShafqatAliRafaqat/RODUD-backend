<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'shafqatalirafaqat@gmail.com',
            'password' => Hash::make('password'), // Default password
            'is_admin' => true,
        ]);

        // Create some regular users
        User::factory(10)->create();
    }
}
