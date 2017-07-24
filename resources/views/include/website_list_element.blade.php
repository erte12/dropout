<div class="panel panel-default">
    <div class="panel-heading">
        @php
            $website_url = str_replace('http://', '', $website->url);
            $website_url = str_replace('https://', '', $website->url);
        @endphp
        <a href="{{ url('website/' . $website->id) }}" class="website">
            <span class="glyphicon glyphicon-hand-right"></span>
            <strong>{{ $website->name }}</strong> - {{ $website_url }}
        </a>
    </div>
    <div class="panel-body text-justify">
        <div class="website">
            <a href="{{ url('website/' . $website->id) }}" >
                <img src="http://free.pagepeeker.com/v2/thumbs.php?size=m&url={{ $website->url }}" class="img-responsive thumbnail website" />
            </a>
        </div>
        <div class="text-justify">
            {{ $website->description }}
        </div>
    </div>
</div>
