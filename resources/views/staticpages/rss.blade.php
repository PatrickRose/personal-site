{{ '<?xml version="1.0" encoding="utf-8"?>' }}
<feed xmlns="http://www.w3.org/2005/Atom">
    <title>Patrick Rose's Blog</title>
    <subtitle>Posts about coding and folk music</subtitle>
    <link href="{{ route('rss')}}" rel="self"/>
    <updated>{{ Carbon\Carbon::now()->toATOMString() }}</updated>
    <author>
        <name>Patrick Rose</name>
    </author>
    <id>{{ rss_tag() }}</id>
    @foreach($blogs as $blog)
        <entry>
            <title>{{ $blog->title }}</title>
            <link href="{{ URL::route('blog.show', $blog->slug) }}" />
            <id>{{ blog_tag_uri($blog) }}</id>
            <updated>{{ $blog->updated_at->toATOMSTRING() }}</updated>
            <summary>{{ strip_tags($blog->present()->getFirstParagraph()) }}</summary>
        </entry>
    @endforeach
</feed>