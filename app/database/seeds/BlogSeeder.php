<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 06/05/14
 * Time: 19:02
 */

class BlogSeeder extends Seeder {

    public function run() {
//        Tag::truncate();
//        Blog::truncate();

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