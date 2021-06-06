<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Super Admin',
        ]);
        
        Role::create([
            'name' => 'Writer',
        ]);

        Role::create([
            'name' => 'Publisher',
        ]);

        Role::create([
            'name' => 'Guest',
        ]);
    }
}
