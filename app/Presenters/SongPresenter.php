<?php

namespace PatrickRose\Presenters;

use Laracasts\Presenter\Presenter;
use PatrickRose\Song;
use PatrickRose\MarkdownExtender\MarkdownExtender;

class SongPresenter extends Presenter
{

    /**
     * @return string The blog post when compiled
     */
    public function getInfo()
    {
        return app()->make(MarkdownExtender::class)->compile($this->info);
    }

    public function getLyrics()
    {
        $lyrics = explode("\n\n", str_replace("\r", "", $this->lyrics));

        $content = "";

        foreach($lyrics as $verse) {
            $class = "verse";
            if (strpos($verse, '{chorus}') === 0) {
                $verse = str_replace("{chorus}\n", "", $verse);
                $class = "chorus";
            }
            $content .= "<p class=\"song-{$class}\">" . nl2br($verse) . '</p>';
        }

        return $content;
    }

    public function showRecorded()
    {
        $recorded = $this->recorded;
        
        if ($recorded == null) {
            return;
        }

        $recordDetails = Song::RECORDED[$recorded];

        return "<p class=\"song-available-on\">Available on <a href=\"{$recordDetails['Link']}\">{$recordDetails['Title']}</a></p>";
    }

    public function getVideo()
    {
        $video = $this->video;

        if ($video == null) {
            return;
        }

        return "<div class=\"song-video\"><iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/{$video}\" frameborder=\"0\" allowfullscreen></iframe></div>";
    }
}
