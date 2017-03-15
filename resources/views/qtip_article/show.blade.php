<ul class="list-group">
    @foreach($onAll as $article)
        @if (!empty($article->area->id))
            <li class="list-group-item">{{ $article->title }}</li>
        @endif
    @endforeach
    @foreach($articles as $article)
        @if (!empty($article->area->id))
            <li class="list-group-item">{{ $article->title }}</li>
        @endif
    @endforeach
</ul>