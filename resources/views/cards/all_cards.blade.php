@extends('layouts.app')

@section('content')

    <div class="container">

        <a href="{{ route('pokemon.create') }}" class="btn btn-primary mb-3">Nieuwe kaart ophalen</a>
        <div class="row">
            @foreach($cards as $card)
                <div class="col-sm-6 col-lg-3">
                    <div class="card mb-3">
                        <img src="{{ $card->image }}" class="card-img-top" alt="{{$card->name}}">
                        <div class="card-body">
                            <h4 class="card-title">{{$card->name}}</h4>
                            <div class="card-text mb-2">
                                Type: {{$card->type}}<br>
                                Hoogte: {{$card->length}}<br>
                                Gewicht: {{$card->weight}}<br>
                            </div>
                        </div>
                    </div>
                </div>
    @endforeach
@endsection
