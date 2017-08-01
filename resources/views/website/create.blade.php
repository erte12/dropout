@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dodaj nową stronę</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('website') }}">
                        {{ csrf_field() }}

                        <!-- <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nazwa strony</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="url" class="col-md-4 control-label">Adres strony</label>

                            <div class="col-md-6">
                                <input id="url" type="url" class="form-control" name="url" value="{{ $errors->any() ? old('url') : 'http://' }}" required>
                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Opis</label>

                            <div class="col-md-6">
                                <textarea id="description" type="description" class="form-control" name="description" rows="8" required>{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                            <label for="tags" class="col-md-4 control-label">Tagi</label>

                            <div class="col-md-6">
                                <input id="tags" type="text" class="form-control" name="tags" value="{{ old('tags') }}" required>

                                @if ($errors->has('tags'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('subcategory_id') ? ' has-error' : '' }}">
                            <label for="subcategory_id" class="col-md-4 control-label">Kategoria 1</label>

                            <div class="col-md-6">
                                <select id="subcategory_id" class="form-control" name="subcategory_id">
                                    @foreach ($categories as $category):
                                        @foreach ($category->subcategories as $subcategory):
                                            <option value="{{ $subcategory->id }}">{{ $category->name }} -> {{ $subcategory->name }}</option>
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

                        <div class="form-group{{ $errors->has('subcategory_extra_id') ? ' has-error' : '' }}">
                            <label for="subcategory_extra_id" class="col-md-4 control-label">Kategoria 2</label>

                            <div class="col-md-6">
                                <select id="subcategory_extra_id" class="form-control" name="subcategory_extra_id">
                                    <option value="0">-</option>
                                    @foreach ($categories as $category):
                                        @foreach ($category->subcategories as $subcategory):
                                            <option value="{{ $subcategory->id }}">{{ $category->name }} -> {{ $subcategory->name }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                                @if ($errors->has('subcategory_extra_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subcategory_extra_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Wyślij
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
