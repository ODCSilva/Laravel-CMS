@extends('layouts.app')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="row">
            <h1 class="pull-left">Edit: {{$page->name}}</h1>
            <form action="/dashboard/pages/{{$page->id}}" method="post" class="pull-right" onsubmit="return confirm('Delete {{$page->name}}?');">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
        <div class="row">
            <form action="/dashboard/pages/{{$page->id}}" method="post" class="clearfix">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$page->name}}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('alias') ? ' has-error' : '' }}">
                    <label for="alias">Alias</label>
                    <input type="text" id="alias" name="alias" class="form-control" value="{{$page->alias}}">

                    @if ($errors->has('alias'))
                        <span class="help-block">
                            <strong>{{ $errors->first('alias') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control">{{$page->description}}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection



