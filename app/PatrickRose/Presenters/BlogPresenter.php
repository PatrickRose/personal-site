<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 27/04/14
 * Time: 14:02
 */

namespace PatrickRose\Presenters;

use Laracasts\Presenter\Presenter;
use MarkdownExtender;

class BlogPresenter extends Presenter {

    /**
     * @return string The blog post when compiled
     */
    public function compile()
    {
        return MarkdownExtender::compile($this->content);
    }

    /**
     * @return string Get the first paragraph of the blog post
     */
    public function getFirstParagraph() {
        $content = $this->compile();
        return substr($content, 0, strpos($content, "\n")) ? : $content;
    }

} 