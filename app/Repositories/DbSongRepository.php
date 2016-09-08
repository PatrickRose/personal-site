<?php

namespace PatrickRose\Repositories;

use PatrickRose\Song;
use PatrickRose\Http\Requests\CreateSong;
use PatrickRose\Http\Requests\UpdateSong;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DbSongRepository implements SongRepositoryInterface
{

    public function find($slug) {
        $song = Song::whereSlug($slug)->first();

        if (!$song) {
            throw new ModelNotFoundException();
        }
        
        return $song;
    }

    public function all() {
        return Song::orderBy('title')->get();
    }
    
    public function create(CreateSong $input)
    {
        $song = new Song($input->except('_token'));
        $song->makeSlug();
        $song->save();

        return $song;
    }

    public function update($slug, UpdateSong $input)
    {
        $song = $this->find($slug);

        if (!$song->update($input->except('_token'))) {
            if ($song->isDirty()) {
                throw new DatabaseConnectionException();
            }
        };

        return $song;
    }
}
