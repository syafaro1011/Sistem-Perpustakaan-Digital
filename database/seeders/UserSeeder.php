<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@perpustakaan.com'],
            [
                'name'     => 'Admin Perpustakaan',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'petugas@perpustakaan.com'],
            [
                'name'     => 'Petugas Satu',
                'password' => Hash::make('password'),
                'role'     => 'petugas',
            ]
        );
    }
}