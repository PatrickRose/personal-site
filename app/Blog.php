<?php

namespace PatrickRose;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use PatrickRose\Presenters\BlogPresenter;

class Blog extends Model
{

    use PresentableTrait;
    
    protected $presenter = BlogPresenter::class;
    
    protected $fillable = ['title', 'content'];

    public function makeSlug()
    {
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($this->title));
        $count = Blog::where("slug", "LIKE", $slug)->count();
        if ($count != 0) {
            $count += 1;
            $slug .= "-{$count}";
        }
        return $slug;
    }

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
}

