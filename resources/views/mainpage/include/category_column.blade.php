<a href="{{ url('category/' . $category->id ) }}" class="list-group-item">
    <span class="badge">{{ websites_number_in_category($category->id) }}</span>
    <h5 class="list-group-item-heading">{{ $category->name }}</h5>
    <p class="list-group-item-text">
        @foreach ($category->subcategories()->inRandomOrder()->limit(6)->get() as $subcategory)
            @if(! $loop->last)
                {{ $subcategory->name }},
            @else
                {{ $subcategory->name }}
            @endif
        @endforeach
        ...
    </p>
</a>
