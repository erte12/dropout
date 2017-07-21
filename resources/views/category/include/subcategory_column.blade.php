<a href="{{ url('subcategory/' . $subcategory->id ) }}" class="list-group-item">
    <span class="badge">{{ $subcategory->websites->count() }}</span>
    <h5 class="list-group-item-heading">
        <span class="glyphicon glyphicon-folder-open"></span>
        {{ $subcategory->name }}
    </h5>
</a>
