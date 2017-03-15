@extends('layouts.app')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="row">
            <h1 class="pull-left">Edit: {{$article->name}}</h1>
            <form action="/dashboard/articles/{{$article->id}}" method="post" class="pull-right" onsubmit="return confirm('Delete {{$article->name}}?');">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
        <div class="row">
            <form action="/dashboard/articles/{{$article->id}}" method="post">
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
                            @if($page->id == $article->page_id)
                                <option value="{{$page->id}}" selected>{{$page->name}}</option>
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





