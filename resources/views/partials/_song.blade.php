<article class="song">
    <header class="entry-header">
        <h1 class="entry-title song-title">{{ link_to_route("songs.show", ucwords($song->title), $song->slug, ['rel' => 'bookmark']) }}
        </h1>
    </header>
    <div class="entry-content">
        {!! $song->present()->getInfo() !!}
        <p class="text-center">
            {!! link_to_route(
                "songs.show",
                "Song details...",
                $song->slug,
                array('class' => 'btn btn-action btn-song')
                ) !!}
        </p>
    </div>
</article>
