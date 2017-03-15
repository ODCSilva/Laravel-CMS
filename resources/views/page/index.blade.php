@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="row">
            <div class="pull-left">
                <h1>Pages</h1>
            </div>
            <div class="pull-right">
                <a href="/dashboard/pages/create" role="button" class="btn btn-primary margin-top12px">Add</a>
            </div>
        </div>
        <div class="row">
            @foreach($pages as $page)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/dashboard/pages/{{$page->id}}"><strong>{{$page->name}}</strong></a>
                        <div class="pull-right">
                            <a href="/dashboard/pages/{{ $page->id }}/edit" role="button">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                        </div>


                    </div>
                    <div class="panel-body">
                        <dl class="dl-horizontal">
                            <dt>Alias</dt>
                            <dd>{{$page->alias}}</dd>
                            <dt>Description</dt>
                            <dd>{{$page->description}}</dd>
                            <dt>Created At</dt>
                            <dd>{{$page->created_at}}</dd>
                            <dt>Updated At</dt>
                            <dd>{{$page->updated_at}}</dd>
                            <dt>Created By</dt>
                            <dd>{{$page->createdBy->first_name}} {{$page->createdBy->last_name}}</dd>
                            <dt>Modified By</dt>
                            <dd>{{$page->modifiedBy->first_name}} {{$page->modifiedBy->last_name}}</dd>
                        </dl>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection