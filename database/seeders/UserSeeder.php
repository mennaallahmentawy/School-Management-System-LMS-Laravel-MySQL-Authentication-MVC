<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->updateOrInsert(
            ['email' => 'marwan@gmail.com'], // Matching condition
            [
                'name' => 'Marwan Mohamed',
                'password' => Hash::make('12345678'),
            ]
        );
        
    }
}