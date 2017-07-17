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
                    <a href="{{ $website->url }}">{{ $website->name }} - {{ $website_url }}</a>
                </div>
                <div class="panel-body">
                    <div class="website">
                        <a href="{{ $website->url }}" >
                            <img src="http://free.pagepeeker.com/v2/thumbs.php?size=m&url={{ $website->url }}" class="img-responsive thumbnail website" />
                        </a>
                    </div>
                    <div class="text-justify">
                        {{ $website->description }}
                    </div>

                    <!-- <ul>
                        <li>
                            Kategoria: {{ $website->subcategory->category->name }} -> {{ $website->subcategory->name }}
                        </li>
                    </ul> -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
