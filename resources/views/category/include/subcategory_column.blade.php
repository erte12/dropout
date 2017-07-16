<a href="{{ url('subcategory/' . $subcategory->id ) }}" class="list-group-item">
    <span class="badge">{{ websites_number_in_subcategory($subcategory->id) }}</span>
    <h5 class="list-group-item-heading">{{ $subcategory->name }}</h5>
</a>
