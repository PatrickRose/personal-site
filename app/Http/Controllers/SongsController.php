<?php

namespace PatrickRose\Http\Controllers;

use Illuminate\Http\Request;

use PatrickRose\Http\FlashMessage;
use PatrickRose\Http\Requests;
use PatrickRose\Http\Requests\CreateSong;
use PatrickRose\Http\Requests\UpdateSong;
use PatrickRose\Song;
use PatrickRose\Repositories\SongRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use View;

class SongsController extends Controller
{

    /**
     * @var FlashMessage
     */
    private $flash;

    /**
     * @var SongsRepositoryInterface
     */
    private $songs;

    public function __construct(
        FlashMessage $flash,
        SongRepositoryInterface $songs
    ) {
        
        $this->middleware('admin', ['except' => ['index', 'show']]);
        $this->flash = $flash;
        $this->songs = $songs;
    }

    public function index() {
        return View::make('songs.index', ['songs' => $this->songs->all()]);
    }

    public function create() {
        return View::make('songs/create', ['options' => Song::GetSelectOptions()]);
    }

    public function store(CreateSong $request) {
        $song = $this->songs->create($request);

        $this->flash->message("Song created");
        return redirect()->route('songs.show', $song->slug);
    }

    public function show($slug) {
        try {
            $song = $this->songs->find($slug);
        } catch (ModelNotFoundException $e) {
            $this->flash->message("That song does not exist");
            return redirect()->route('songs.index');
        }

        return View::make('songs.show', ['song' => $song]);
    }

    public function edit($slug) {
        try {
            $song = $this->songs->find($slug);
        } catch (ModelNotFoundException $e) {
            $this->flash->message("That song does not exist");
            return redirect()->route('songs.index');
        }

        return View::make('songs.edit', ['song' => $song, 'options' => Song::GetSelectOptions()]);
    }

    public function update($slug, UpdateSong $request) {
        $song = $this->songs->update($slug, $request);

        $this->flash->message("Song created");
        return redirect()->route('songs.show', $song->slug);
    }
    
}
