<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::create([
            'title' => 'First Article',
            'category_id' => '1',
            'user_id' => '1',
            'content' => 'Artikel Pertama',
            'thumbnail' => 'satu.jpg',
            'status' => 1,
        ]);
        
        Article::create([
            'title' => 'Second Article',
            'category_id' => '3',
            'user_id' => '1',
            'content' => 'Artikel Kedua',
            'thumbnail' => 'dua.jpg',
            'status' => 0,
        ]);
        
        Article::create([
            'title' => 'Third Article',
            'category_id' => '2',
            'user_id' => '1',
            'content' => 'Artikel Ketiga',
            'thumbnail' => 'tiga.jpg',
            'status' => 1,
        ]);
        
        Article::create([
            'title' => 'Draft Article',
            'category_id' => '4',
            'user_id' => '1',
            'content' => 'Artikel Keempat',
            'thumbnail' => 'empat.jpg',
            'status' => 0,
        ]);

    }
}
