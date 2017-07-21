@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <a href="{{ url('/') }}">
                        <span class="glyphicon glyphicon-home"></span>
                        Strona główna
                    </a>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach ($categories->split(3) as $category_column)
                        <div class="col-md-4">
                            <ul class="list-group">
                                @foreach ($category_column as $category)
                                    @include('mainpage.include.category_column')
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-pushpin"></span>
                    Ostatnio dodane
                </div>
                <div class="panel-body">
                @foreach ($websites as $website)
                    @include('include.website_list_element')
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
