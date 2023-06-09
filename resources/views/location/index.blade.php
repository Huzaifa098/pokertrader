@php
    use Carbon\Carbon;


@endphp

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>Locatie overzicht</h2>
                    </div>
                    <div>
                        @if($admin)
                            <a class="btn btn-success" href="{{ route('locations.create') }}">Locatie Aanmaken</a>
                        @endif
                    </div>
                </div>

                @foreach($locations as $location)

                    <div class="card mt-3 container">
                        <div class="card-body row">
                            <div class="d-flex justify-content-between">
                                <div class="w-50">
                                    <h4 class="card-title">{{ $location->name }}</h4>
                                    <ul class="list-inline text-muted">
                                        <li class="list-inline-item">Stad: {{ $location->city ?? 'nvt' }}</li>
                                        <li class="list-inline-item">Straatnaam: {{ $location->street ?? 'nvt' }}</li>
                                        <li class="list-inline-item">Postcode: {{ $location->postcode ?? 'nvt' }}</li>
                                        <li class="list-inline-item">Huisnummer: {{ $location->street_number ?? 'nvt' }}</li>
                                      </ul>
                                </div>
                                <div class="">
                                    @if($admin)
                                        <a class="btn btn-outline-secondary"
                                           href="{{ route('locations.edit', $location) }}">Locatie Bewerken</a>

                                        <a class="btn btn-success" href="{{ route('auctions.create', $location) }}">Veiling
                                            aanmaken</a>
                                    @endif
                                </div>
                            </div>

                            @foreach($location->auctions as $auction)
                                @if($admin ||  !$auction->ended)
                                    @if((auth()->user()->is_premium && $auction->premium) || !$auction->premium || auth()->user()->is_admin)

                                    <div class="col-lg-6">
                                        <div class="card bg-light mt-2">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <h4>{{ $auction->name ?? '' }}</h4>

                                                    @if($auction->premium)
                                                        <div>
                                                            <span class="badge badge-pill bg-warning"><span>&#9733;</span> premium</span>
                                                        </div>
                                                    @endif
                                                </div>

                                                @if(isset($auction->start_auction) && $auction->start_auction <= now())
                                                    <h6 class="card-title">
                                                        Veiling eindigt op: {{ $auction->getEndTime() }}
                                                    </h6>
                                                @else
                                                    <h6 class="card-title">
                                                        Veiling is nog niet gestart.
                                                    </h6>
                                                @endif

                                                <h6 class="card-title">Kaarten in
                                                    veiling: {{ $auction->auctionCards->count() }}</h6>

                                                <a class="btn btn-primary"
                                                   href="{{ route('auctions.show', $auction) }}">Bekijk</a>
                                                @if($admin)
                                                    <a class="btn btn-outline-secondary"
                                                       href="{{ route('auctions.edit', $auction) }}">Bewerken</a>
                                                @endif

                                            </div>

                                        </div>
                                    </div>
                                @endif
                                @endif
                            @endforeach
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
@endsection
