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
        //admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'address' => 'earth',
            'gender' => 'Male',
            'RoleId' => '1'
        ]);

        //user
        User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('password'),
            'address' => 'Jl. earth no 1',
            'gender' => 'Female',
            'RoleId' => '2'
        ]);
    }
}
