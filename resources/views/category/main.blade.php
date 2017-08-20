@extends('layouts.app')

@section('title', 'Kategoria: ' . $category->name . ' | ' . config('constants.title'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ url('/') }}"><span class="glyphicon glyphicon-home"></span> Strona główna</a> -> <a href="{{ $category->friendly_url }}">{{ $category->name }}</a>
                </div>

                <div class="panel-body">
                    @foreach ($subcategories->split(3) as $subcategory_column)
                        <div class="col-md-4">
                            <ul class="list-group">
                                @foreach ($subcategory_column as $subcategory)
                                    @include('category.include.subcategory_column')
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ url('/') }}"><span class="glyphicon glyphicon-home"></span> Strona główna</a> -> <a href="{{ url('/category/' . $category->id) }}">{{ $category->name }}</a>
                </div>



                <div class="panel-body">
                    @if ($websites->isNotEmpty())
                        <div class="text-center">
                            {{ $websites }}
                        </div>
                        @foreach ($websites as $website)
                            @include('include.website_list_element')
                        @endforeach
                        <div class="text-center">
                            {{ $websites }}
                        </div>
                    @else
                        <div class="text-center">
                            <h4><strong>Ta kategoria jest pusta</strong></h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
