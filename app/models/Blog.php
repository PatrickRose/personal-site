<?php
use Laracasts\Presenter\PresentableTrait;

/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 18/04/14
 * Time: 22:14
 */

class Blog extends Eloquent {

    use PresentableTrait;

    protected $presenter = "PatrickRose\\Presenters\\BlogPresenter";

    protected $fillable = array("title", "content");

    public function makeSlug() {
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($this->title));
        $count = Blog::where("slug", "LIKE", $slug)->count();
        if ($count != 0) {
            $count += 1;
            $slug .= "-{$count}";
        }
        return $slug;
    }

    public function getFirstParagraph() {
        $content = $this->present()->content($this->content);
        return substr($content, 0, strpos($content, "\n")) ? : $content;
    }

    public function tags() {
        return $this->belongsToMany("Tag");
    }

    public function getTags() {
        $temp = [];
        foreach($this->tags as $tag) {
            $temp[] = $tag->tag;
        };
        return implode(", ", $temp);
    }

} 