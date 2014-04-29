<div class="col-md-4">
    <div class="blog-title">
        <h2>{{ link_to_route("blog.show", ucwords($blog->title), $blog->slug) }}</h2>
    </div>
    <div class="blog-text">
        {{ $blog->present()->getFirstParagraph() }}
    </div>
    {{ link_to_route("blog.show", "Continue Reading...",
    $blog->slug, array('class' => 'btn btn-blog btn-block')) }}
</div>