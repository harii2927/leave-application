<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        
        // User::create([
        //     'name' => 'sathya',
        //     'email' => 'sathya@gmail.com',
        //     'password' => Hash::make('pass123456'),
        // ]);
        // User::create([
        //     'name' => 'harii',
        //     'email' => 'harii@gmail.com',
        //     'password' => Hash::make('pass1234'),
        // ]);
        User::create([
            'name' => 'mani',
            'email' => 'manii@gmail.com',
            'password' => Hash::make('pass12345'),
        ]);
    }
}
