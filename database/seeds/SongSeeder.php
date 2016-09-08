<?php

use Illuminate\Database\Seeder;
use PatrickRose\Song;

class SongSeeder extends Seeder
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
            $song = new Song();
            $song->title = $factory->sentence();
            $song->composer = $factory->name();
            $lyrics = [];
            foreach(array_chunk($factory->sentences(20), 4) as $index => $sentences) {
                if ($index == $i) {
                    array_unshift($sentences, "{chorus}");
                }
                
                $lyrics[] = implode("\n", $sentences);
            }
            $song->lyrics = implode("\n\n", $lyrics);
            $song->info = implode("\n\n", $factory->paragraphs(3));
            $song->makeSlug();
            $song->save();
        }
    }
}
