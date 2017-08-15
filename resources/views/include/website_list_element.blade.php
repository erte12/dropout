<div class="panel panel-default" id="website_id{{ $website->id }}">
    <div class="panel-heading">
        @php
            $website_url = str_replace('http://', '', $website->url);
            $website_url = str_replace('https://', '', $website->url);
        @endphp
        <a href="{{ $website->friendly_url }}" class="website">
            <span class="glyphicon glyphicon-hand-right"></span>
            <strong>{{ $website->name }}</strong> - {{ $website_url }}
            @if($website->user_id == auth()->id())
            <div class="pull-right">
                <a href="{{ url('website/' . $website->id . '/edit') }}" class="website">Edytuj</a>
            </div>
            @endif
        </a>
    </div>
    <div class="panel-body text-justify">
        <div class="website">
            <a href="{{ $website->friendly_url }}" >
                <img src="http://free.pagepeeker.com/v2/thumbs.php?size=m&url={{ $website->url }}" class="img-responsive thumbnail website" />
            </a>
        </div>
        <div class="text-justify">
            {{ $website->description }}
        </div>
    </div>
</div>
