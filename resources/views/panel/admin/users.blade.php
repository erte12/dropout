@extends('layouts.app')

@section('title', 'Użytkownicy | ' . config('constants.title'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Użytkownicy serwisu</div>
                <div class="panel-body">
                    <ul class="list-group">

                        @foreach ($users as $user)
                            <li class="list-group-item list-group-item-default">
                                {{ $user->id }} - {{ $user->name }}
                                <span userId="{{ $user->id }}" userName="{{ $user->name }}" class="glyphicon glyphicon-remove pull-right deleteSymbolFinal"></span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="modal fade" id="deleteModalFinal" tabindex="-1" role="dialog" aria-labelledby="deleteModalFinal">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Usuwanie użytkownika</h4>
                                </div>
                                <div class="modal-body text-justify">
                                    Czy na pewno chcesz usunąć użytkownika:
                                    <strong id="userName"></strong>.
                                    Nie będzie możliwe jego przywrócenie.
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
    $(".deleteSymbolFinal").click(function() {
        event.preventDefault();
        let userId = $(this).attr('userId');
        let userName = $(this).attr('userName');
        $('#userName').html(userName);
        $('#deleteFormFinal').attr('action', '{{ url("user") }}/' + userId);
        $('#deleteModalFinal').modal('show');
    });
</script>
@endsection
