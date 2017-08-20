<a href="{{ $subcategory->friendly_url }}" class="list-group-item">
    <span class="badge">{{ $subcategory->websites->count() }}</span>
    <h5 class="list-group-item-heading">
        <span class="glyphicon glyphicon-folder-open"></span>
        <strong>{{ $subcategory->name }}</strong>
    </h5>
</a>
