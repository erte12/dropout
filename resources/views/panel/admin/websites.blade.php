@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{ url('panel/') }}">Panel użytkownika</a> - Strony</div>
                <div class="panel-body">
                    <ul class="list-group">
                    @foreach ($websites as $website)
                        <!-- TODO: edycja odnośnika -->
                        <a class="list-group-item list-group-item" href="{{ isset($website->active) ? url('website/' . $website->id . '/edit') : url('website/edited/' . $website->id . '/edit') }}">
                            {{ $website->name }} - {{ $website->url }}
                            <span websiteId="{{ $website->id }}" class="glyphicon glyphicon-remove pull-right{{($website->active === 0 || !is_null($website->deleted_at)) ? ' deleteSymbolFinal' : ' deleteSymbol' }}"></span>
                        </a>
                    @endforeach
                    </ul>

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
                                    <strong>""?</strong>
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
                                    <strong>""?</strong>
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
        $('#deleteForm').attr('action', '{{ url("website") }}/' + websiteId);
        $('#deleteModal').modal('show');
    });

    $(".deleteSymbolFinal").click(function() {
        event.preventDefault();
        let websiteId = $(this).attr('websiteId');
        $('#deleteFormFinal').attr('action', '{{ url("website/force") }}/' + websiteId);
        $('#deleteModalFinal').modal('show');
    });
</script>
@endsection
