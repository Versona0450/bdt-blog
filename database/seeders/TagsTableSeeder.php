<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'name' => 'book'
        ]);
        Tag::create([
            'name' => 'food'
        ]);
        Tag::create([
            'name' => 'drink'
        ]);
        Tag::create([
            'name' => 'soccer'
        ]);
        Tag::create([
            'name' => 'fiction'
        ]);
        Tag::create([
            'name' => 'dota'
        ]);
        Tag::create([
            'name' => 'brawlhalla'
        ]);
        Tag::create([
            'name' => 'money'
        ]);
        Tag::create([
            'name' => 'indonesia'
        ]);
        Tag::create([
            'name' => 'bandung'
        ]);
        Tag::create([
            'name' => 'korean'
        ]);

        $satu = Article::where('id', 1)->first();
        $satu->tags()->attach([1,2,3]);
        
        $dua = Article::where('id', 2)->first();
        $dua->tags()->attach([4,2,1]);

        $tiga = Article::where('id', 3)->first();
        $tiga->tags()->attach([5,3]);

        $empat = Article::where('id', 4)->first();
        $empat->tags()->attach([2,4,6]);
    }
}
