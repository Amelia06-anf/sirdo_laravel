<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Petugas::updateOrCreate(
            ['username' => 'admin'],
            [
                'nama_petugas' => 'Staff Arsip',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
