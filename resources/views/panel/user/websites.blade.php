@extends('layouts.app')

@section('title', 'Twoje strony | ' . config('constants.title'))

@section('content')

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
                <strong id="deleteWebsiteName"></strong>
                Strona przestanie być widoczna w katalogu jednak w każdej chwili będziesz mógł ją przywrócić.
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST" action="">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
                    <button type="submit" class="btn btn-danger">Potwierdź</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModalFinal" tabindex="-1" role="dialog" aria-labelledby="deleteModalFinal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Usuwanie strony z katalogu</h4>
            </div>
            <div class="modal-body text-justify">
                Czy na pewno chcesz usunąć stronę:
                <strong id="deleteWebsiteNameFinal"></strong>
                Nie będzie możliwe jej przywrócenie.
            </div>
            <div class="modal-footer">
                <form id="deleteFormFinal" method="POST" action="">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
                    <button type="submit" class="btn btn-danger">Potwierdź</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModalRequest" tabindex="-1" role="dialog" aria-labelledby="deleteModalRequest">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Usunięcie prośby o edycję</h4>
            </div>
            <div class="modal-body text-justify">
                Czy na pewno chcesz usunąć prośbę o edycję strony:
                <strong id="deleteWebsiteNameFinal"></strong>
                Nie będzie możliwe jej przywrócenie.
            </div>
            <div class="modal-footer">
                <form id="deleteFormRequest" method="POST" action="">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
                    <button type="submit" class="btn btn-danger">Potwierdź</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{ url('panel') }}">Panel użytkownika</a> -> <a href="{{ url('panel/websites') }}">Twoje strony</a></div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-success">
                            <div class="panel-heading">
                            <span class="glyphicon glyphicon-ok"></span>
                            Strony zaakceptowane
                            </div>
                                @if(auth()->user()->websites()->where('active', 1)->count() > 0)
                                <div class="panel-body panel-scroll">
                                    <ul class="list-group">
                                        @foreach (auth()->user()->websites()->where('active', 1)->get() as $website)
                                        <a class="list-group-item" href="{{ $website->friendly_url_edit }}">
                                            <span websiteId="{{ $website->id }}" class="glyphicon glyphicon-remove pull-right deleteSymbol"></span>
                                            <div>{{ $website->name }}</div>
                                            <div>{{ $website->url }}</div>

                                        </a>
                                        @endforeach
                                    </ul>
                                </div>
                                @else
                                <div class="panel-body">
                                    Pusto
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="panel panel-info">
                            <div class="panel-heading">
                            <span class="glyphicon glyphicon-time"></span>
                            Strony oczekujące
                            </div>
                                @if(auth()->user()->websites()->where('active', 0)->count() > 0)
                                <div class="panel-body panel-scroll">
                                    <ul class="list-group">
                                        @foreach (auth()->user()->websites()->where('active', 0)->get() as $website)
                                        <a class="list-group-item" href="{{ $website->friendly_url_edit }}">
                                            <span websiteId="{{ $website->id }}" class="glyphicon glyphicon-remove pull-right deleteSymbolFinal"></span>
                                            <div>{{ $website->name }}</div>
                                            <div>{{ $website->url }}</div>
                                        </a>
                                        @endforeach
                                    </ul>
                                </div>
                                @else
                                <div class="panel-body">
                                    Pusto
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-warning">
                            <div class="panel-heading">
                            <span class="glyphicon glyphicon-wrench"></span>
                            Prośby o edycję
                            </div>
                                @if(auth()->user()->websites_edited()->count() > 0)
                                <div class="panel-body panel-scroll">
                                    <ul class="list-group">
                                        @foreach (auth()->user()->websites_edited()->get() as $website)
                                        <a class="list-group-item" href="{{ route('website.edited.edit', $website->id) }}">
                                            <span websiteId="{{ $website->id }}" class="glyphicon glyphicon-remove pull-right deleteSymbolRequest"></span>
                                            <div>{{ $website->name }}</div>
                                            <div>{{ $website->url }}</div>
                                        </a>
                                        @endforeach
                                    </ul>
                                </div>
                                @else
                                <div class="panel-body">
                                    Pusto
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-danger">
                            <div class="panel-heading">
                            <span class="glyphicon glyphicon-trash"></span>
                            Strony usunięte
                            </div>
                                @if(auth()->user()->websites()->onlyTrashed()->count() > 0)
                                <div class="panel-body panel-scroll">
                                    <ul class="list-group">
                                        @foreach (auth()->user()->websites()->onlyTrashed()->get() as $website)
                                        <a class="list-group-item">
                                            <span websiteId="{{ $website->id }}" class="glyphicon glyphicon-remove pull-right deleteSymbolFinal"></span>
                                            <div>{{ $website->name }}</div>
                                            <div>{{ $website->url }}</div>
                                        </a>
                                        @endforeach
                                    </ul>
                                </div>
                                @else
                                <div class="panel-body">
                                    Pusto
                                </div>
                                @endif
                            </div>
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
    $(".deleteSymbol").click(function() {
        event.preventDefault();
        let websiteId = $(this).attr('websiteId');
        $('#deleteForm').attr('action', '{{ url("strona") }}/' + websiteId);
        $('#deleteModal').modal('show');
    });

    $(".deleteSymbolFinal").click(function() {
        event.preventDefault();
        let websiteId = $(this).attr('websiteId');
        $('#deleteFormFinal').attr('action', '{{ url("strona/f") }}/' + websiteId);
        $('#deleteModalFinal').modal('show');
    });

    $(".deleteSymbolRequest").click(function() {
        event.preventDefault();
        let websiteId = $(this).attr('websiteId');
        $('#deleteFormRequest').attr('action', '{{ url("strona-edytowane") }}/' + websiteId);
        $('#deleteModalRequest').modal('show');

    });

    //TODO: Ajax requests
</script>
@endsection
