@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="row">
            <div class="pull-left">
                <h1>Articles</h1>
            </div>
            <div class="pull-right">
                <a href="/dashboard/articles/create" role="button" class="btn btn-primary margin-top12px">Add</a>
            </div>
        </div>
        <div class="row">

            @foreach($articles as $article)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/dashboard/articles/{{$article->id}}"><strong>{{$article->name}}</strong></a>
                        <div class="pull-right">
                            <a href="/dashboard/articles/{{ $article->id }}/edit" role="button">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <dl class="dl-horizontal">
                            <dt>Title</dt>
                            <dd>{{$article->title}}</dd>
                            <dt>Description</dt>
                            <dd>{{$article->description}}</dd>
                            <dt>HTML Content</dt>
                            <dd>{{$article->html_content}}</dd>
                            <dt>Content Area</dt>
                            <dd>@if(!is_null($article->area))
                                    {{$article->area->name}}
                                @else
                                    None
                                @endif
                            </dd>
                            <dt>Page</dt>
                            <dd>@if(!is_null($article->page))
                                    {{$article->page->name}}
                                @else
                                    None
                                @endif
                            </dd>
                            <dt>On All</dt>
                            <dd>
                                @if ($article->on_all == 0)
                                    No
                                @else
                                    Yes
                                @endif
                            </dd>
                            <dt>Created At</dt>
                            <dd>{{$article->created_at}}</dd>
                            <dt>Updated At</dt>
                            <dd>{{$article->updated_at}}</dd>
                            <dt>Created By</dt>
                            <dd>{{$article->createdBy->first_name}} {{$article->createdBy->last_name}}</dd>
                            <dt>Modified By</dt>
                            <dd>{{$article->modifiedBy->first_name}} {{$article->modifiedBy->last_name}}</dd>
                        </dl>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection