<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Economy'
        ]);
        Category::create([
            'name' => 'Entertainment'
        ]);
        Category::create([
            'name' => 'Technology'
        ]);
        Category::create([
            'name' => 'School'
        ]);
        Category::create([
            'name' => 'Sport'
        ]);
        
    }
}
