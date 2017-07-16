@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading"><a href="{{ url('/') }}">Strona główna</a> -> <a href="{{ url('/category/' . $category->id) }}">{{ $category->name }}</a></div>

                <div class="panel-body">
                    <div class="col-md-4">
                        <ul class="list-group">
                            @foreach ($subcategories_col_1 as $subcategory)
                                @include('category.include.subcategory_column')
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group">
                            @foreach ($subcategories_col_2 as $subcategory)
                                @include('category.include.subcategory_column')
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group">
                            @foreach ($subcategories_col_3 as $subcategory)
                                @include('category.include.subcategory_column')
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">Strony w tej kategorii</div>
                <div class="panel-body">
                    <div class="text-center">
                        {{ $websites }}
                    </div>
                    @foreach ($websites as $website)
                        <div class="panel panel-default">
                            <div class="panel-heading">{{ $website->name }}</div>
                            <div class="panel-body text-justify">
                                {{ $website->description }}
                            </div>
                        </div>
                    @endforeach
                    <div class="text-center">
                        {{ $websites }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
