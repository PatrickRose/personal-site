<?php

namespace PatrickRose;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use PatrickRose\Presenters\SongPresenter;
use PatrickRose\Repositories\SluggableInterface;
use PatrickRose\Repositories\SluggableTrait;

class Song extends Model implements SluggableInterface
{
    use PresentableTrait;
    use SluggableTrait;
    
    protected $presenter = SongPresenter::class;

    const RECORDED = [
        null => [
            "Title" => 'Not recorded',
        ],
        'ParadiseSquare' => [
            'Title' => 'Paradise Square',
            'Link' => 'https://patrickrose.bandcamp.com/album/paradise-square'
        ]
    ];
    
    protected $fillable = [
        "title",
        "composer",
        "lyrics",
        "info",
        "recorded",
        "video"
    ];

    protected function getSluggableField()
    {
        return 'title';
    }

    public static function GetSelectOptions()
    {
        return array_map(function($contents) { return $contents['Title']; }, static::RECORDED);
    }
}
