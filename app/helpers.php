<?php
use Carbon\Carbon;

/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 06/05/14
 * Time: 19:16
 */

function blog_tag_uri(Blog $blog)
{
    $parsedUrl = parse_url(URL::route('blog.show', $blog->slug));

    $output[] = "tag:";
    $output[] = $parsedUrl["host"] . ",";
    $output[] = $blog->updated_at->format("Y-m-d") . ":";
    $output[] = $parsedUrl["path"];

    return implode("", $output);
}

function rss_tag()
{
    $parsedUrl = parse_url(URL::route('rss'));

    $output[] = "tag:";
    $output[] = $parsedUrl["host"] . ",";
    $output[] = Carbon::now()->format("Y-m-d") . ":";
    $output[] = $parsedUrl["path"];

    return implode("", $output);
}