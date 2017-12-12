@extends('layouts.app')

@section('title', 'User panel | ' . config('constants.title'))

@section('content')
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Account delete</h4>
            </div>
            <div class="modal-body text-justify">
                Czy na pewno chcesz usunąć swoje konto? Spowoduje to usunięcie także wszystkich stron z nim powiązanych.
            </div>
            <div class="modal-footer">
                <form method="post" action="{{ url('user/' . auth()->user()->id) }}">
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
                <div class="panel-heading"><a href="{{ url('panel') }}">User panel</a></div>

                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">Menu</div>
                                <div class="panel-body">
                                    <ul class="list-group">
                                        @if( !superuser() )
                                        <a class="list-group-item" href="{{ route('panel.user.websites') }}">
                                            <span class="glyphicon glyphicon-check"></span>
                                            Your websites
                                            <div class="pull-right">
                                                <span class="label label-success">Accepted: {{ auth()->user()->websites->where('active', 1)->count() }}</span>
                                                <span class="label label-info">Waiting: {{ auth()->user()->websites->where('active', 0)->count() }}</span>
                                                <span class="label label-warning">In edit: {{ auth()->user()->websites_edited()->count() }}</span>
                                                <span class="label label-danger">Deleted: {{ auth()->user()->websites()->onlyTrashed()->count() }}</span>
                                            </div>
                                        </a>
                                        <a class="list-group-item" href="{{ route('website.create') }}">
                                            <span class="glyphicon glyphicon-link"></span>
                                            Add website
                                        </a>
                                        <a class="list-group-item" href="{{ route('rules') }}">
                                            <span class="glyphicon glyphicon-list-alt"></span>
                                            Rules
                                        </a>
                                        <a class="list-group-item" href="{{ url('user/' . auth()->id() . '/edit') }}">
                                            <span class="glyphicon glyphicon-wrench"></span>
                                            Edit your data
                                        </a>
                                        <a href="" class="list-group-item" data-toggle="modal" data-target="#deleteUserModal">
                                            <span class="glyphicon glyphicon-trash"></span>
                                            Delete account
                                        </a>
                                        @else
                                        <a class="list-group-item" href="{{ route('panel.admin.websites.waiting') }}">
                                            <span class="glyphicon glyphicon-zoom-in"></span>
                                            Waiting websites <span class="label label-info">{{ $websites->where('active', '=', '0')->count() }}</span>

                                        </a>
                                        <a class="list-group-item" href="{{ route('panel.admin.websites.edited') }}">
                                            <span class="glyphicon glyphicon-cog"></span>
                                            Edit requests <span class="label label-warning">{{ $websites_in_edit->count() }}</span>
                                        </a>
                                        <a class="list-group-item" href="{{ route('panel.admin.websites.accepted') }}">
                                            <span class="glyphicon glyphicon-ok"></span>
                                            Accepted websites <span class="label label-success">{{ $websites->count() }}</span>
                                        </a>
                                        <a class="list-group-item" href="{{ route('panel.admin.websites.deleted') }}">
                                            <span class="glyphicon glyphicon-remove"></span>
                                            Deleted websites <span class="label label-danger">{{ $websites_trashed->count() }}</span>
                                        </a>
                                        <a class="list-group-item" href="{{ route('panel.admin.users') }}">
                                            <span class="glyphicon glyphicon-user"></span>
                                            Users <span class="label label-warning">{{ $users->count() }}</span>
                                        </a>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
<!--                         <div class="col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">Powiadomienia</div>
                                <div class="panel-body">
                                    <dl>
                                        <dd>2017.05.04 18:32</dd>
                                        <dt>Twoja strona została zaakceptowana!</dt>
                                        <button class="btn btn-sm btn-primary">Przeczytane</button>
                                    </dl>
                                    <hr>
                                    <dl>
                                        <dd>2017.05.04 18:32</dd>
                                        <dt>Twoja strona została zaakceptowana!</dt>
                                        <button class="btn btn-sm btn-primary">Przeczytane</button>
                                    </dl>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
