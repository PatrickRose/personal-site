@extends('layouts.master')

@section('title')
    {{ $blog->title }}
@stop

@section('content')
    <div class="row topspace">
        <article class="col-md-8 maincontent">
            <header class="page-header">
                <h2 class="page-title blog-title">
                    {{ ucwords($blog->title) }}
                </h2>
            </header>
            <div class="blog-content">
                {!! $blog->present()->compile() !!} 
            </div>
        </article>
        <aside class="col-md-4 sidebar sidebar-left">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Tagged with</h4>
                </div>
                <ul class="blog-tags">
                    @foreach($blog->tags as $tag)
                        <li class="blog-tag">
                            {!! link_to_route('blog.tag', $tag->tag, $tag->tag) !!}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Other Posts...</h4>
                </div>
                @if(Auth::user())
                    <div class="panel-body">
                        {!! link_to_route('blog.edit', "Edit Post", $blog->slug, array('class'=>'btn btn-action btn-block')) !!}
                    </div>
                @endif
                <ul class="list-group">
                    @foreach($blogs as $blog)
                        <li class="list-group-item">
                            {!! link_to_route('blog.show', ucwords($blog->title), $blog->slug) !!}
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </div>
@stop
