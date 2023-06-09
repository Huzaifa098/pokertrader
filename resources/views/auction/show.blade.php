@php
    use Carbon\Carbon;

    $admin = auth()->user()->is_admin;
@endphp

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="d-flex justify-content-between">
                    <div>
                        <h2>Veiling overzicht</h2>
                    </div>
                    <div>
                        @if($admin && !$auction->start_auction)
                            <a class="btn btn-outline-secondary" href="{{ route('auctions.edit', $auction) }}">Bewerken</a>

                            <a class="btn btn-success" href="{{ route('auctions.addCard', $auction) }}">Kaart toevoegen</a>

                            <a class="btn btn-warning" href="{{ route('auctions.start_auction', $auction) }}">Start veiling</a>
                        @else
                            @if($auction->ended)
                                <span class="badge bg-danger rounded-pill p-3"> Eindigt</span>
                            @else
                                <span class="badge bg-info rounded-pill p-3"> Gestart</span>
                            @endif
                        
                        @endif
                    </div>
                </div>
                <h5><b>Veiling naam:</b> {{ $auction->name }}</h5>
                <h5><b>Locatie naam:</b> {{ $auction->location->name }}</h5>
                @if(isset($auction?->start_auction) && $auction->start_auction <= now())
                    <h5 class="card-title">
                        Veiling gestart op: {{ $auction->getStartTime() }}
                    </h5>
                    <h5 class="card-title">
                        Veiling eindigt op: {{ $auction->getEndTime() }}
                    </h5>
                    <h5 class="card-title">
                        Duur: {{ $auction->duration }} minuten
                    </h5>
                @else
                    <h5 class="card-title">
                        Veiling is nog niet gestart.
                    </h5>
                @endif
                <div class="row mt-4">
                    @foreach($auction->auctionCards as $auction_card)
                        <div class="col-sm-6 col-lg-4">
                            <div class="card mb-3">

                                <img src="{{ $auction_card->card->image }}" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $auction_card->card->name }}</h4>
                                    <div class="card-text mb-2">
                                        Type: {{ $auction_card->card->type }}<br>
                                        Hoogte: {{ $auction_card->card->length }}<br>
                                        Gewicht: {{ $auction_card->card->weight }}<br>
                                        Hoogste bod: <b>₱</b>{{ $auction_card->highest_bid }}<br>

                                        Hoogste bieder: {{ $auction_card->user?->username }}
                                    </div>
                                        @if(!$admin)

                                    <a class="btn btn-primary" href="{{ route('bieden' , $auction_card->id) }}">Bied</a>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
