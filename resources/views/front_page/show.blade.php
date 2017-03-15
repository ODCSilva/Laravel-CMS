@extends('layouts.front')

@section('content')
    <div class="container">
        @if (Auth::user() && Auth::user()->hasPrivilege("Author"))
        <div class="row">
            <form class="form" action="/article/create" method="get">
                <input type="hidden" name="page_id" value="{{ $page->id }}">
                <button type="submit" class="btn btn-primary pull-right" href="/article/create">New Article</button>
            </form>

        </div>
        @endif
        @foreach($areas as $area)
            <div class="row {{ $area->alias }}">

                @foreach($onAll as $article)
                    @if(!empty($article->area->id))
                        @if($article->area->id == $area->id)
                            <article>
                                <h2 class="article-header">
                                    {{ $article->title }}
                                    @if (Auth::user() && Auth::user()->hasPrivilege("Author"))
                                        <small>
                                            <a href="/article/{{ $article->id }}/edit" id="edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                        </small>
                                    @endif
                                </h2>

                                {!! $article->html_content !!}

                            </article>
                        @endif
                    @endif
                @endforeach

                @foreach($page->articles()->get() as $article)
                    @if(!empty($article->area->id))
                        @if($article->area->id == $area->id)
                        <article>
                            <h2 class="article-header">
                                {{ $article->title }}
                                @if (Auth::user() && Auth::user()->hasPrivilege("Author"))
                                    <small>
                                        <a href="/article/{{ $article->id }}/edit" id="edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                    </small>
                                @endif
                            </h2>

                            {!! $article->html_content !!}

                        </article>
                        @endif
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
@endsection