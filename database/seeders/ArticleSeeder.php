<?php

namespace Database\Seeders;

use App\Models\Article;
use Carbon\Factory;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();
        for ($i = 1; $i < 21; $i++) {
            Article::create([
                'title' => $faker->text(15),
                'slug' => $faker->text(15),
                'article_code' => Str::random(4) . time(),
                'description' => $faker->text(200),
                'tag' => 'dlkbs,askjbd,asdeu,edskdn,wakdsjnd,qesdw',
                'user_id' => rand(1, 2),
                'cover' => 'default/avatar.png'
            ]);
        }
    }
}
