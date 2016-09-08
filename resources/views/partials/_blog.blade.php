<article class="post">
  <header class="entry-header">
    <div class="entry-meta">
      <span class="posted-on"><time class="entry-date published" datetime="{{ $blog->created_at }}">{{ $blog->present()->getDate() }}</time></span>
    </div>
    <h2 class="entry-title blog-title">
        {{ link_to_route("blog.show", ucwords($blog->title), $blog->slug, ['rel' => 'bookmark']) }}
    </h2>
  </header>
  <div class="entry-content">
    {!! $blog->present()->getFirstParagraph() !!}
    <p class="text-center">
      {!! link_to_route(
          "blog.show",
          "Continue Reading...",
          $blog->slug,
          array('class' => 'btn btn-action btn-blog')
        ) !!}
    </p>
  </div>
</article>
