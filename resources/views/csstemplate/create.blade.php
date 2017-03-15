@extends('layouts.app')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="row">
            <h1>Create New CSS Template</h1>
            <form action="/dashboard/csstemplates" method="post">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control"></textarea>
                </div>

                <div class="form-group {{ $errors->has('css_content') ? ' has-error' : '' }}">
                    <label for="css_content">CSS Content</label>
                    <textarea id="css_content" name="css_content" class="form-control" >{{old('css_content')}}</textarea>

                    @if ($errors->has('css_content'))
                        <span class="help-block">
                            <strong>{{ $errors->first('css_content') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="active">Active</label>
                    <input type="checkbox" id="active" name="active" class="checkbox">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>

@endsection



