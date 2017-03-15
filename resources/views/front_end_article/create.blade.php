@extends('layouts.app')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/page/{{ $page->id }}">{{ $page->alias }}</a></li>
                <li class="active">Create New Article</li>
            </ol>

        </div>
        <div class="row">
            <h1>Create New Article</h1>
            <form action="/article" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="page_id" value="{{ $page->id }}">
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}">

                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="on_all">On All</label>
                    <input type="checkbox" id="on_all" name="on_all" class="checkbox">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control"></textarea>
                </div>

                <div class="form-group {{ $errors->has('html_content') ? ' has-error' : '' }}">
                    <label for="html_content">HTML Content</label>
                    <textarea id="html_content" name="html_content" class="form-control">{{ old('html_content') }}</textarea>

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
                            <option value="{{$area->id}}">{{$area->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="page_id">Page</label>
                    <select id="page_id" name="page_id" class="form-control">
                        <option value=""></option>
                        @foreach(App\Page::all() as $page_ids)
                            <option value="{{$page_ids->id}}" @if($page_ids->id == $page->id)
                                selected
                                    @endif>{{$page_ids->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>

@endsection





