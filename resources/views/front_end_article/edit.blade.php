@extends('layouts.front')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                @if(!empty($article->page))
                <li><a href="/page/{{ $article->page->id }}">{{ $article->page->alias }}</a></li>
                @elseif($article->on_all == 1)
                <li>All</li>
                @endif

                <li class="active">{{ $article->name }}</li>
            </ol>

        </div>

        @if(!empty(Session::get('status')))
        <div class="row">
            <div class="alert alert-success">
                {{ Session::get('status') }}
            </div>
        </div>
        @endif
        <div class="row">
            <h1 class="pull-left">Edit: {{$article->name}}</h1>
        </div>
        <div class="row">
            <form action="/article/{{$article->id}}" method="post">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$article->name}}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{$article->title}}">

                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="on_all">On All</label>
                    <input type="checkbox" id="on_all" name="on_all" class="checkbox"
                           @if(!empty($article->on_all))
                           checked
                            @endif>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control">{{$article->description}}</textarea>
                </div>

                <div class="form-group {{ $errors->has('html_content') ? ' has-error' : '' }}">
                    <label for="html_content">HTML Content</label>
                    <textarea id="html_content" name="html_content" class="form-control">{{ $article->html_content }}</textarea>

                    @if ($errors->has('html_content'))
                        <span class="help-block">
                            <strong>{{ $errors->first('html_content') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="content_area_id">Content Area</label>
                    <select id="content_area_id" name="content_area_id" class="form-control">
                        <option value=""></option>
                        @foreach(App\ContentArea::all() as $area)
                            @if($area->id == $article->content_area_id)
                                <option value="{{$area->id}}" selected>{{$area->name}}</option>
                            @else
                            <option value="{{$area->id}}">{{$area->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="page_id">Page</label>
                    <select id="page_id" name="page_id" class="form-control">
                        <option value=""></option>
                        @foreach(App\Page::all() as $page)
                            @if(!empty($article->page_id))
                                @if($page->id == $article->page_id)
                                    <option value="{{$page->id}}" selected>{{$page->name}}</option>
                                @endif
                            @else
                                <option value="{{$page->id}}">{{$page->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection





