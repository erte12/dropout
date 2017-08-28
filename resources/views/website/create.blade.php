@extends('layouts.app')

@section('title', 'Add website | ' . config('constants.title'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                <a href="{{ route('panel') }}">User panel</a> -> <a href="{{ route('website.create') }}">Add website</a></div>

                <div class="panel-body">
                    <form id="form" class="form-horizontal" method="POST" action="{{ route('website.store') }}">
                        {{ csrf_field() }}

                        <!-- Name -->
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- URL -->
                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="url" class="col-md-4 control-label">URL</label>

                            <div class="col-md-6">
                                <input id="url" type="url" class="form-control" name="url" value="{{ $errors->any() ? old('url') : 'http://' }}" required>
                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" type="description" class="form-control" name="description" rows="8" required>{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                            <label for="tagsInput" class="col-md-4 control-label">Tags (at leats one)</label>

                            <div class="col-md-6">
                                <input id="tagsInput" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tags.*') || $errors->has('tags') ? ' has-error' : '' }}">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="form-control-list">
                                    <ul id="tagsList" class="list-inline">
                                    @if($errors->any())
                                    @foreach (old('tags') as $tag)
                                    <li>
                                        {{ $tag }}
                                        <span class="glyphicon glyphicon-remove tag-remove"></span>
                                    </li>
                                    <input type="hidden" name="tags[{{ $loop->iteration }}]" value="{{ $tag }}">
                                    @endforeach
                                    @endif
                                    </ul>
                                </div>
                                @if ($errors->has('tags.*'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tags.*') }}</strong>
                                </span>
                                @endif
                                @if ($errors->has('tags'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tags') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <!-- Categories -->
                        <div class="form-group{{ $errors->has('subcategory_id') ? ' has-error' : '' }}">
                            <label for="subcategory_id" class="col-md-4 control-label">Category</label>

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

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    Submit
                                </button>
                                <a href="{{ route('panel')}}" class="btn btn-md btn-info">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script src="{{ asset('js/tags.js') }}"></script>
@endsection
