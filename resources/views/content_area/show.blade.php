@extends('layouts.app')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>{{$area->name}}</strong>
                    <div class="pull-right">
                        <a href="/dashboard/contentareas/{{ $area->id }}/edit" role="button">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <dl class="dl-horizontal">
                        <dt>Alias</dt>
                        <dd>{{$area->alias}}</dd>
                        <dt>Description</dt>
                        <dd>{{$area->description}}</dd>
                        <dt>Display Order</dt>
                        <dd>{{$area->display_order}}</dd>
                        <dt>Created At</dt>
                        <dd>{{$area->created_at}}</dd>
                        <dt>Updated At</dt>
                        <dd>{{$area->updated_at}}</dd>
                        <dt>Created By</dt>
                        <dd>{{$area->createdBy->first_name}} {{$area->createdBy->last_name}}</dd>
                        <dt>Modified By</dt>
                        <dd>{{$area->modifiedBy->first_name}} {{$area->modifiedBy->last_name}}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

@endsection