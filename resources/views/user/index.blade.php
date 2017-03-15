@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
    <div class="container col-md-6 col-md-offset-3">
            <div class="row">
                <div class="pull-left">
                    <h1>Users</h1>
                </div>
                <div class="pull-right">
                    <a href="/dashboard/users/create" role="button" class="btn btn-primary margin-top12px">Add</a>
                </div>
            </div>

            <div class="row">
            @foreach($users as $user)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/dashboard/users/{{$user->id}}"><strong>{{$user->first_name}} {{$user->last_name}}</strong></a>
                        <div class="pull-right">
                            <a href="/dashboard/users/{{ $user->id }}/edit" role="button">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <dl class="dl-horizontal">
                            <dt>Email</dt>
                            <dd>{{$user->email}}</dd>
                            <dt>Created At</dt>
                            <dd>{{$user->created_at}}</dd>
                            <dt>Updated At</dt>
                            <dd>{{$user->updated_at}}</dd>
                            <dt>Privileges</dt>
                            @foreach($user->privileges()->get() as $p)
                                <dd style="list-style-type: none;">{{$p->name}}</dd>
                            @endforeach
                            <dt>Created By</dt>
                            <dd>
                                @if(!empty($user->createdBy))
                                    {{$user->createdBy->first_name}} {{$user->createdBy->last_name}}</dd>
                                @endif
                            <dt>Modified By</dt>
                            <dd>
                                @if(!empty($user->modifiedBy))
                                    {{$user->modifiedBy->first_name}} {{$user->modifiedBy->last_name}}
                                @endif
                            </dd>
                        </dl>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection