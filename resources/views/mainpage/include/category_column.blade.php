<a href="{{ $category->friendly_url }}" class="list-group-item" style="height: 70px;">
    <span class="badge">{{ $category->websites->count() }}</span>
    <h5 class="list-group-item-heading">
        <span class="glyphicon glyphicon-folder-open"></span>
        <strong>{{ $category->name }}</strong>
    </h5>
    <p class="list-group-item-text small">
        @foreach ($category->subcategories->take(6) as $subcategory)
            @if(! $loop->last)
                {{ $subcategory->name }},
            @else
                {{ $subcategory->name }}
            @endif
        @endforeach
        ...
    </p>
</a>
