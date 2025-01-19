<?php

namespace Database\Seeders;

use App\Models\User;
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
        $admin = User::create([
            'name'    => 'Admin admin',
            'email'   => 'admin@admin.com',
            'country' => 'Syria',
            'role'    => 'admin',
            'password'=>  Hash::make('12345678'),
        ]);
        $admin->assignRole('admin');

        $user1 = User::create([
            'name'    => 'Ali ali',
            'email'   => 'ali@gmail.com',
            'country' => 'Egypt',
            'role'    => 'freelancer',
            'password'=>  Hash::make('12345678'),
        ]);
        $user1->assignRole('freelancer');

        $user2 = User::create([
            'name'    => 'Sana sana',
            'email'   => 'sana@gmail.com',
            'country' => 'Syria',
            'role'    => 'freelancer',
            'password'=>  Hash::make('12345678'),
        ]);
        $user2->assignRole('freelancer');

        $user3 = User::create([
            'name'    => 'Ahmad ali',
            'email'   => 'ahmad@gmail.com',
            'country' => 'Egypt',
            'role'    => 'client',
            'password'=>  Hash::make('12345678'),
        ]);
        $user3->assignRole('client');

        $user4 = User::create([
            'name'    => 'Fatima ali',
            'email'   => 'fatima@gmail.com',
            'country' => 'Syria',
            'role'    => 'client',
            'password'=>  Hash::make('12345678'),
        ]);
        $user4->assignRole('client');
    }
}
