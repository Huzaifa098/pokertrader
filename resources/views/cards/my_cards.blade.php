@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(count($cards) > 0)
                @foreach($cards as $card)
                    <div class="col-sm-6 col-lg-3">
                        <div class="card mb-3">
                            <img src="{{ $card->card->image }}" class="card-img-top" alt="">
                            <div class="card-body">
                                <h4 class="card-title">{{$card->card->name}}</h4>
                                <div class="card-text mb-2">
                                    Type: {{$card->card->type}}<br>
                                    Hoogte: {{$card->card->length}}<br>
                                    Gewicht: {{$card->card->weight}}<br>
                                    Koper: {{$card->user?->username}}<br>
                                    Bod: <b>₱</b>{{$card->highest_bid}}<br>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center text-muted">
                    <p>Geen kaarten gevonden</p>
                </div>
            @endif
@endsection

