<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Creating Admin User
        $admin = User::create([
            'name' => 'Abdou Lahi DIALLO',
            'email' => 'abdoulahidiallo52@gmail.com',
            'password' => Hash::make('1234')
        ]);
        $admin->assignRole('Admin');

        // Creating Product Manager User
        $user = User::create([
            'name' => ' Pape Birame SEMBENE',
            'email' => 'sembene@gmail.com',
            'password' => Hash::make('1234')
        ]);
        $user->assignRole('User');
    }
}
