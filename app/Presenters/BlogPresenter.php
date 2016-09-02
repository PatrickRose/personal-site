<?php

namespace PatrickRose\Presenters;

use Laracasts\Presenter\Presenter;
use PatrickRose\MarkdownExtender\MarkdownExtender;

class BlogPresenter extends Presenter
{

    private $extender;

    /**
     * @return string The blog post when compiled
     */
    public function compile()
    {
        return app()->make(MarkdownExtender::class)->compile($this->content);
    }

    /**
     * @return string Get the first paragraph of the blog post
     */
    public function getFirstParagraph()
    {
        $content = $this->compile();
        return substr($content, 0, strpos($content, "\n")) ? : $content;
    }

    public function getDate()
    {
        return $this->created_at->format('d F, Y');
    }
}
