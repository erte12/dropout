@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Twoje strony</div>
                <div class="panel-body">
                    <ul class="list-group">

                        @foreach (auth()->user()->websites()->where('active', 1)->get() as $website)
                            <a class="list-group-item list-group-item-success" href="{{ url('website/' . $website->id) . '/edit' }}">
                                {{ $website->name }}
                            </a>
                        @endforeach
                        @foreach (auth()->user()->websites()->where('active', 0)->where('edit', 0)->get() as $website)
                            <a class="list-group-item list-group-item-info" href="{{ url('website/edit/ . $website->id' . '/edit') }}">
                                {{ $website->name }}
                            </a>
                        @endforeach
                        @foreach (auth()->user()->websites()->where('active', 0)->where('edit', 1)->get() as $website)
                            <a class="list-group-item list-group-item-warning" href="{{ url('website/edit/ . $website->id' . '/edit') }}">
                                {{ $website->name }}
                            </a>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
