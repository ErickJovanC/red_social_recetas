<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Erick',
            'email' => 'erickjovan106@gmail.com',
            'password' => Hash::make('palmz22A'),
            'url' => 'https://erickjovan.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        
        DB::table('users')->insert([
            'name' => 'Jovan',
            'email' => 'jovan@mail.com',
            'password' => Hash::make('palmz22A'),
            'url' => 'https://erickjovan.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
