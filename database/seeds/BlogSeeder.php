<?php

use Illuminate\Database\Seeder;
use PatrickRose\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $factory = \Faker\Factory::create();
        for($i = 0; $i < 10; $i++) {
            $title = implode(" ", $factory->words(5));
            $content = implode("\n\n", $factory->paragraphs(5));
            $blog = new Blog();
            $blog->title = $title;
            $blog->content = $content;
            $blog->slug = $blog->makeSlug();
            $blog->save();
        }        
    }
}
