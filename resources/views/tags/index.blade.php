@extends('layouts.master')

@section('title')
    Tags
@stop

@section('content')
    <div class="col-md-3">
        @include('partials/_tags')
    </div>
    <div class="col-md-9">
        <div class="tag-header" xmlns="http://www.w3.org/1999/html">
            <h1>Tags</h1>
        </div>
        @foreach(array_chunk($tags->all(), 3) as $row)
            <div class="row">
                @foreach($row as $tag)
                    <div class="col-md-4">
                        <div class="tag-header">
                            <h2>
                                {{ link_to_route('blog.tag', $tag->tag, $tag->tag) }}
                            </h2>
                        </div>
                        <div class="tagged-posts">
                            @foreach(array_chunk($tag->posts->all(), 3)[0] as $post)
                                {{ link_to_route('blog.show', ucwords($post->title),
                                                 $post->slug, ['class' => "tagged-post"]) }}
                            @endforeach
                            {{ link_to_route("blog.tag", "More posts marked {$tag->tag}...",
                                             $tag->$tag, array('class' => 'tag-link')) }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
        {{ $tags->links() }}
    </div>
@stop
