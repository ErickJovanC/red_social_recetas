<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UsuarioSeeder;
use Database\Seeders\CategoriasSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this -> call(CategoriasSeeder::class);
        $this -> call(UsuarioSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
