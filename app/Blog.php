<?php

namespace PatrickRose;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use PatrickRose\Presenters\BlogPresenter;
use PatrickRose\Repositories\SluggableInterface;
use PatrickRose\Repositories\SluggableTrait;

class Blog extends Model implements SluggableInterface
{

    use PresentableTrait;
    use SluggableTrait;
    
    protected $presenter = BlogPresenter::class;
    
    protected $fillable = ['title', 'content'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getTags()
    {
        $temp = [];
        foreach ($this->tags as $tag) {
            $temp[] = $tag->tag;
        };
        return implode(", ", $temp);
    }

    protected function getSluggableField()
    {
        return 'title';
    }
}

