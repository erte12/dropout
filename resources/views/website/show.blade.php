@extends('layouts.app')

@section('title', $website->friendly_url)
@section('keywords', $website->getTagsString())
@section('description', $website->description)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @php
                        $website_url = str_replace('http://', '', $website->url);
                        $website_url = str_replace('https://', '', $website_url);
                    @endphp
                    <a href="{{ $website->url }}">
                        <span class="glyphicon glyphicon-pushpin"></span>
                        {{ $website->name }} - {{ $website_url }}
                    </a>
                </div>
                <div class="panel-body">
                    <div class="clearfix col-md-12" style="margin-bottom: 20px;">
                        <div class="website">
                            <a href="{{ $website->url }}" >
                                <img src="http://free.pagepeeker.com/v2/thumbs.php?size=l&url={{ $website->url }}" class="img-responsive thumbnail website" style="width: 300px; height: auto;">
                            </a>
                        </div>
                        <div class="text-justify">
                            {{ $website->description }}
                        </div>
                    </div>

                    <div>
                        <div class="col-md-6">
                            <ul class="list-group">
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
                                    <a href="{{ $website->subcategory->category->friendly_url }}">{{ $website->subcategory->category->name }}</a> ->
                                    <a href="{{ $website->subcategory->friendly_url }}">{{ $website->subcategory->name }}</a>
                                </li>
                                <li class="list-group-item">
                                    <span class="glyphicon glyphicon-time"></span>
                                    Dodano:
                                    {{ $website->created_at }}
                                </li>
                                <li class="list-group-item">
                                    <span class="glyphicon glyphicon-list"></span>
                                    Tagi:
                                    @foreach ($website->tags as $tag)
                                        <a href="{{ url('/tags/' . $tag->id) }}">{{ $tag->name }}</a>{{(! $loop->last) ? ',' : ''}}
                                    @endforeach
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Podlinkuj stronę: {{ $website_url }}</strong></li>
                                <li class="list-group-item"><textarea id="linker" rows="4" class="form-control"><a href="{{ url('website/' . $website->id) }}" target="_blank" title="{{ $website->name }}k"><strong>{{ $website->name }}</strong></a></textarea>
                                </li>
                                <li class="list-group-item">
                                    <button id="copyButton" type="button" class="btn btn-md btn-primary">Skopiuj</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
$('#copyButton').on('click', function(){
    $('#linker').select();
    document.execCommand('copy');
});
</script>
@endsection
