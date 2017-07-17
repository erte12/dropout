@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">Kategorie</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-md-4">
                        <ul class="list-group">
                        @foreach ($categories_col_1 as $category)
                            @include('mainpage.include.category_column')
                        @endforeach
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group">
                        @foreach ($categories_col_2 as $category)
                            @include('mainpage.include.category_column')
                        @endforeach
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group">
                        @foreach ($categories_col_3 as $category)
                            @include('mainpage.include.category_column')
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">Ostatnio dodane</div>
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
