@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <a href="{{ url('/') }}">
                        <span class="glyphicon glyphicon-home"></span>
                        Strona główna
                    </a>
                </div>

                <div class="panel-body">
                    @foreach ($categories->split(3) as $category_column)
                        <div class="col-md-4">
                            <ul class="list-group">
                                @foreach ($category_column as $category)
                                    @include('mainpage.include.category_column')
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-pushpin"></span>
                    Ostatnio dodane
                </div>
                <div class="panel-body">
                @foreach ($websites as $website)
                    @include('include.website_list_element')
                @endforeach
                </div>
            </div>
        </div>

        @if( !empty(session('status')) )
        <!-- Modals -->
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModal">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Sukces!</h4>
                    </div>
                    <div class="modal-body text-justify">
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('status') }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('footer')
@if( !empty(session('status')) )
<script>
    $('#successModal').modal('show');
</script>
@endif
@endsection
