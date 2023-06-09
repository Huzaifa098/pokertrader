@extends('layouts.app')

@section('content')

    @php
        $premium = auth()->user()->is_premium;
    @endphp
    @if(!$premium)
        <div class="card border-0 shadow mb-4 w-75 mx-auto">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="https://img.freepik.com/vrije-vector/premium-collectie-badgeontwerp_53876-63011.jpg"
                         class="card-img">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title mb-0"> Premium Kaart</h5>
                        <div class="d-flex align-items-center mt-3">
                            <span class="text-muted mr-2">Prijs:</span>
                            <span class="h4 mb-0">$49</span>
                        </div>
                        <div class="mt-4">
                            <p class="card-text"> Ervaar het beste wat onze producten te bieden hebben met onze premium
                                optie.
                                Met onze premium producten krijg je toegang tot een exclusieve en hoogwaardige versie
                                van ons product met extra functies en voordelen die niet beschikbaar zijn in onze
                                standaardversie.
                                Of je nu een professionele gebruiker bent die op zoek is naar geavanceerde tools,
                                of gewoon op zoek bent naar een betere gebruikerservaring,
                                onze premium producten zijn de perfecte keuze voor jou.
                                Wacht niet langer en upgrade vandaag nog naar premium voor de ultieme ervaring!</p>

                            <a href="{{route('premium_aanschaffen')}}" class="btn btn-primary">koop nu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@if($premium)
    <div class="card border-0 shadow mb-4 w-75 mx-auto">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e4/Twitter_Verified_Badge.svg/640px-Twitter_Verified_Badge.svg.png"
                    class="card-img">
            </div>
            <div class="col-md-8">
                <div class="card-body">


                    <div class="mt-4">

                        <h3 class="card-title mb-0"> U heeft een premium account</h3>


                    </div>

                </div>
            </div>

        </div>

    </div>

@endif

@endsection
