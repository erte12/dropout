@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Panel użytkownika</div>

                <div class="panel-body">

                    <div class="panel panel-primary">
                        <div class="panel-heading">Powiadomienia</div>
                            <div class="panel-body">
                                Brak powiadomień
                            </div>
                    </div>

                    <ul class="list-group" style="">
                        @if( superuser() )
                            <a class="list-group-item list-group-item-info" href="{{ url('website/create') }}">
                                <span class="glyphicon glyphicon-zoom-in"></span>
                                Strony w poczekalni
                                <div class="pull-right">
                                    <span class="label label-info">Oczekujące:</span>
                                    <span class="label label-warning">W edycji:</span>
                                </div>
                            </a>
                            <a class="list-group-item list-group-item-success" href="{{ url('website/create') }}">
                                <span class="glyphicon glyphicon-ok"></span>
                                Strony zaakceptowane
                                <div class="pull-right">
                                    <span class="label label-success">Liczba: </span>
                                </div>
                            </a>
                            <a class="list-group-item list-group-item-danger" href="{{ url('website/create') }}">
                                <span class="glyphicon glyphicon-remove"></span>
                                Strony usunięte
                                <div class="pull-right">
                                    <span class="label label-danger">Liczba: </span>
                                </div>
                            </a>
                            <a class="list-group-item list-group-item-warning" href="{{ url('website/create') }}">
                                <span class="glyphicon glyphicon-user"></span>
                                Użytkownicy
                                <div class="pull-right">
                                    <span class="label label-warning">Liczba: </span>
                                </div>
                            </a>
                        @endif

                        <a class="list-group-item"href="{{ url('panel/websites') }}">
                            <span class="glyphicon glyphicon-check"></span>
                            Twoje strony
                            <div class="pull-right">
                                <span class="label label-success">Zaakceptowane: {{ auth()->user()->websites->where('active', 1)->count() }}</span>
                                <span class="label label-info">Oczekujące: {{ auth()->user()->websites->where('active', 0)->count() }}</span>
                                <span class="label label-warning">W edycji: {{ auth()->user()->websites->where('in_edit', 1)->count() }}</span>
                                <span class="label label-danger">Usunięte: </span>
                            </div>
                        </a>
                        <a class="list-group-item" href="{{ url('website/create') }}">
                            <span class="glyphicon glyphicon-link"></span>
                            Dodaj stronę
                        </a>
                        <a class="list-group-item" href="{{ url('rules') }}">
                            <span class="glyphicon glyphicon-list-alt"></span>
                            Regulamin
                        </a>
                        <a class="list-group-item" href="{{ url('user/' . auth()->id() . '/edit') }}">
                            <span class="glyphicon glyphicon-wrench"></span>
                            Edytuj dane użytkownika
                        </a>
                        <a class="list-group-item" href="{{ url('') }}">
                            <span class="glyphicon glyphicon-trash"></span>
                            Usuń konto
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
