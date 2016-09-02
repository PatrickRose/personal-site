<div class="panel panel-default">
    <div class="panel-heading">
        Tag List
    </div>
    <ul class="all-tags">
        @foreach($allTags as $tag)
            @if(isset($thisTag) && $tag->tag == $thisTag)
                {{ link_to_route("blog.tag", $tag->tag, $tag->tag, ['class'=>'tag active']) }}
            @else
                {{ link_to_route("blog.tag", $tag->tag, $tag->tag, ['class'=>'tag']) }}
            @endif
        @endforeach
    </ul>
</div>
