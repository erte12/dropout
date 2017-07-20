@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    @php
                        $website_url = str_replace('http://', '', $website->url);
                        $website_url = str_replace('https://', '', $website->url);
                    @endphp
                    <a href="{{ $website->url }}">
                        <span class="glyphicon glyphicon-pushpin"></span>
                        {{ $website->name }} - {{ $website_url }}
                    </a>
                </div>
                <div class="panel-body">
                    <div class="clearfix">
                        <div class="website">
                            <a href="{{ $website->url }}" >
                                <img src="http://free.pagepeeker.com/v2/thumbs.php?size=m&url={{ $website->url }}" class="img-responsive thumbnail website" />
                            </a>
                        </div>
                        <div class="text-justify">
                            {{ $website->description }}
                        </div>
                    </div>

                    <ul class="list-group website">
                        <li class="list-group-item">
                            <span class="glyphicon glyphicon-pencil"></span>
                            Nazwa: {{ $website->name }}
                        </li>
                        <li class="list-group-item">
                            <span class="glyphicon glyphicon-check"></span>
                            Adres:
                            <a href="{{ $website->url }}">{{ $website_url }}</a>
                        </li>
                        <li class="list-group-item">
                            <span class="glyphicon glyphicon-folder-open"></span>
                            Kategoria:
                            <a href="{{ url('/subcategory/' . $website->subcategory->id) }}">{{ $website->subcategory->name }}</a>
                        </li>
                        <li class="list-group-item">
                            <span class="glyphicon glyphicon-time"></span>
                            Dodano:
                            <a href="{{ url('/subcategory/' . $website->created_at) }}">{{ $website->created_at }}</a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
