<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@paletsepila.com'], // criterio único
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'),
                'rol' => 'administrador',
            ]
        );
    }
}
