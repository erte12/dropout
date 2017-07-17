@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading"><a href="{{ url('/') }}">Strona główna</a> ->
                    <a href="{{ url('/category/' . $subcategory->category->id) }}">{{  $subcategory->category->name }}</a> ->
                    <a href="{{ url('/subcategory/' . $subcategory->id) }}">{{ $subcategory->name }}</a>
                    </div>
                <div class="panel-body">

                    @if (empty($websites))
                        <div class="text-center">
                            <h4><strong>Ta kategoria jest pusta</strong></h4>
                        </div>
                    @else
                        <div class="text-center">
                            {{ $websites }}
                        </div>
                        @foreach ($websites as $website)
                            @include('include.website_list_element')
                        @endforeach
                        <div class="text-center">
                            {{ $websites }}
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
