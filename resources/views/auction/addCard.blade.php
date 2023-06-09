@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(count($cards) > 0)
                    <form action="{{ route('auctions.addCardToAuction', $auction) }}" method="post">
                        @csrf
                        <h2>Kaart toevoegen</h2>
                        <select class="form-select" aria-label="Default select example" name="card">
                            <option value="" selected disabled>Selecteer card</option>
                            @foreach($cards as $card)
                                <option value="{{ $card->id }}"> {{ $card->name }} </option>
                            @endforeach
                        </select>
                        <div class="p-2">
                        <button type="submit" class="btn btn-success">Voeg toe</button>
                        <a href="{{ route('pokemon.create') }}" class="btn btn-secondary">Nieuwe kaart ophalen</a>
                        </div>
                    </form>
                    @else
                    <div>
                        <p class="text-secondary">Er zijn geen kaarten beschikbaar!</p>
                        <a href="{{ route('pokemon.create') }}" class="btn btn-secondary">Nieuwe kaart ophalen</a>
                    </div>
                </div> 
                @endif

            </div>
        </div>
    </div>
@endsection
