@extends('layouts.app')

@section('title', 'Regulamin | ' . config('constants.title'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ url('rules') }}">Regulamin</a></div>
                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
