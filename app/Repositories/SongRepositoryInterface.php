<?php

namespace PatrickRose\Repositories;

use PatrickRose\Http\Requests\CreateSong;
use PatrickRose\Http\Requests\UpdateSong;

interface SongRepositoryInterface
{

    public function find($slug);

    public function all();

    public function create(CreateSong $input);
    
    public function update($slug, UpdateSong $input);
}
