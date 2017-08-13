@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{ url('panel') }}">Panel użytkownika</a> -> <a href="{{ url('panel/websites') }}">Twoje strony</a> -> <a href="{{ url('website/' . $website->id . '/edit') }}">Edytuj stronę ({{ $website->name }})</a></div>

                <div class="panel-body">
                    <form id="form" class="form-horizontal" method="POST" action="{{ url('website/' . $website->id) }}">
                        {{ csrf_field() }}
                        <input id="requestType" type="hidden" name="_method" value="PATCH">

                        <!-- Name -->
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nazwa strony</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $errors->any() ? old('name') : $website->name }}" required autofocus>
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="url" class="col-md-4 control-label">Adres strony</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ $website->url }}" disabled>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ $website->url }}" class="btn btn-primary" role="button">Odwiedź</a>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Opis</label>

                            <div class="col-md-6">
                                <textarea id="description" type="description" class="form-control" name="description" rows="8" required>{{ $website->description }}</textarea> 
                                @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="form-group">
                            <label for="tagsInput" class="col-md-4 control-label">Tagi</label>

                            <div class="col-md-6">
                                <input id="tagsInput" type="text" class="form-control" value="{{ old('tags') }}">

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="form-control-list">
                                    <ul id="tagsList" class="list-inline">
                                    @foreach ($website->tags as $tag)
                                    <li>
                                        {{ $tag->name }}
                                        <span class="glyphicon glyphicon-remove tag-remove"></span>
                                    </li>
                                    <input type="hidden" name="tags[]" value="{{ $tag->name }}">
                                    @endforeach
                                    </ul>
                                </div>
                                @if ($errors->has('tags'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="form-group{{ $errors->has('subcategory_id') ? ' has-error' : '' }}">
                            <label for="subcategory_id" class="col-md-4 control-label">Kategoria 1</label>

                            <div class="col-md-6">
                                <select id="subcategory_id" class="form-control" name="subcategory_id">
                                    @foreach ($categories as $category):
                                    @foreach ($category->subcategories as $subcategory):
                                    <option value="{{ $subcategory->id }}" {{ ($subcategory->id == $website->subcategory_id) ? 'selected' : '' }}>{{ $category->name }} -> {{ $subcategory->name }}</option>
                                    @endforeach
                                    @endforeach
                                </select>
                                @if ($errors->has('subcategory_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('subcategory_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">

                                @if(superuser())
                                <button type="submit" class="btn btn-primary">
                                    Zapisz zmiany
                                </button>
                                @elseif($website->active == 1)
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateModal">
                                    Wyślij prośbę o edycję
                                </button>
                                @else
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal">
                                    Zapisz zmiany
                                </button>
                                @endif


                                @if (superuser())
                                <input type="hidden" id="accept" name="accept" value="{{ $website->active }}" />
                                @if ($website->active === 0)
                                <button id="acceptButton" type="button" class="btn btn-success">
                                    Zaakceptuj
                                </button>
                                @endif
                                @endif

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                    Usuń
                                </button>
                            </div>
                        </div>

                        <!-- Modals -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Usuwanie strony z katalogu</h4>
                                    </div>
                                    <div class="modal-body text-justify">
                                        Czy na pewno chcesz usunąć stronę:
                                        <strong>"{{ $website->name }}"?</strong>
                                        @if($website->active === 0)
                                        Nie będzie możliwe jej przywrócenie.
                                        @else
                                        Strona przestanie być widoczna w katalogu jednak w każdej chwili będziesz mógł ją przywrócić.
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
                                        <button id="deleteButton" type="button" class="btn btn-danger">Potwierdź</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        @if(!superuser())
                        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Edycja danych strony</h4>
                                    </div>
                                    <div class="modal-body text-justify">
                                        @if($website->active == 1)
                                        Czy na pewno chcesz wysłać prośbę o edycję danych strony:
                                        <strong>"{{ $website->name }}"?</strong> Wszelkie zmiany podlegają weryfikacji moderatora. Twoja strona będzie nadal widoczna w katalogu ze starymi danymi. O decyzji administratora zostaniesz poinformowany.
                                        @else
                                        Czy na pewno chcesz zapisz dane strony:
                                        <strong>"{{ $website->name }}"?</strong>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
                                        <button type="submit" class="btn btn-primary">Potwierdź</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
@if (superuser())
<script>
    $('#acceptButton').click(function() {
        $('#accept').attr('value', 1);
        $('#form').submit();
    });
</script>
@endif

<script>
    $('#deleteButton').click(function() {
        $('#requestType').attr("value", "DELETE");
        @if($website->active === 0)
        $('#form').attr('action', '{{ url("website/force/" . $website->id) }}');
        @endif
        $('#form').submit();
    });
</script>

<script src="{{ asset('js/newwebsite.js') }}"></script>
@endsection
