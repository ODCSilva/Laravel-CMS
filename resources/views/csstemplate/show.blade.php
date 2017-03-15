@extends('layouts.app')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>{{$template->name}}</strong>
                    <div class="pull-right">
                        <a href="/dashboard/csstemplates/{{ $template->id }}/edit" role="button">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <dl class="dl-horizontal">
                        <dt>Description</dt>
                        <dd>{{$template->description}}</dd>
                        <dt>CSS Content</dt>
                        <dd>{{$template->css_content}}</dd>
                        <dt>Active</dt>
                        <dd>
                            @if ($template->active == 0)
                                No
                            @else
                                Yes
                            @endif
                        </dd>
                        <dt>Created At</dt>
                        <dd>{{$template->created_at}}</dd>
                        <dt>Updated At</dt>
                        <dd>{{$template->updated_at}}</dd>
                        <dt>Created By</dt>
                        <dd>{{$template->createdBy->first_name}} {{$template->createdBy->last_name}}</dd>
                        <dt>Modified By</dt>
                        <dd>{{$template->modifiedBy->first_name}} {{$template->modifiedBy->last_name}}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

@endsection