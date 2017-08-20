@extends('layouts.app')

@section('title', 'Podkategoria: ' . $subcategory->name . ' | ' . config('constants.title'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ url('/') }}"><span class="glyphicon glyphicon-home"></span> Strona główna</a> ->
                    <a href="{{ $subcategory->category->friendly_url }}">{{  $subcategory->category->name }}</a> ->
                    <a href="{{ $subcategory->friendly_url }}">{{ $subcategory->name }}</a>
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
                            <h4><strong>Ta podkategoria jest pusta</strong></h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
