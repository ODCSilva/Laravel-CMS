@extends('layouts.app')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="row">
            <h1 class="pull-left">Edit: {{$template->name}}</h1>
            <form action="/dashboard/csstemplates/{{$template->id}}" method="post" class="pull-right" onsubmit="return confirm('Delete {{$template->name}}?');">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
        <div class="row">
            <form action="/dashboard/csstemplates/{{$template->id}}" method="post">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$template->name}}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control">{{$template->description}}</textarea>
                </div>

                <div class="form-group {{ $errors->has('css_content') ? ' has-error' : '' }}">
                    <label for="css_content">CSS Content</label>
                    <textarea id="css_content" name="css_content" class="form-control" >{{$template->css_content}}</textarea>

                    @if ($errors->has('css_content'))
                        <span class="help-block">
                            <strong>{{ $errors->first('css_content') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="active">Active</label>
                    <input type="checkbox" id="active" name="active" class="checkbox"
                           @if(!empty($template->active))
                               checked
                           @endif
                    >
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection



