@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-pushpin"></span>
                    Wyniki wyszukiwania
                </div>
                <div class="panel-body">
                    @if($websites->isNotEmpty())
                        <div class="text-center">
                            {{ $websites->appends(['q' => $query])->links() }}
                        </div>
                        @foreach ($websites as $website)
                            @include('include.website_list_element')
                        @endforeach
                        <div class="text-center">
                            {{ $websites->appends(['q' => $query])->links() }}
                        </div>
                    @else
                        <h4 class="text-center">Brak wyniów wyszukiwania</h4>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
