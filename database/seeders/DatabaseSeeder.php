<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Creamos el usuario Administrador del gimnasio
User::updateOrCreate(
    ['username' => 'admin'], // Ahora buscamos por username
    [
        'name' => 'Administrador',
        'email' => 'admin@gymcore.com',
        'password' => Hash::make('password123'),
    ]
);
    }
}