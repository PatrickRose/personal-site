<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 27/04/14
 * Time: 14:02
 */

namespace PatrickRose\Presenters;

use Laracasts\Presenter\Presenter;
use Michelf\MarkdownExtra;

class BlogPresenter extends Presenter {

    public function compile()
    {
        return MarkdownExtra::defaultTransform($this->content);
    }

    public function getFirstParagraph() {
        $content = $this->compile();
        return substr($content, 0, strpos($content, "\n")) ? : $content;
    }

} 