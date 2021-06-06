<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Muhamad Ridwan',
            'email' => 'admin@blog.com',
            'password' => bcrypt('admin'),
            'role_id' => 1
        ]);
     
        User::create([
                'name' => 'Penulis',
                'email' => 'writer@blog.com',
                'password' => bcrypt('writer'),
                'role_id' => 2
        ]);
        
        User::create([
                'name' => 'Penerbit',
                'email' => 'publisher@blog.com',
                'password' => bcrypt('publisher'),
                'role_id' => 3
        ]);     
    }
}
