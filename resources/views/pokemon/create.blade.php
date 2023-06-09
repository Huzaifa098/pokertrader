@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Kaart ophalen</h2>
                <form action="{{ route ('pokemon.create') }}" method="get">
                    <div class="mb-3">
                        <label for="pokemon">Kaart naam:</label>
                        <input type="text" class="form-control" name="pokemon" placeholder="pokemon volledige naam of id">
                    </div>
                    <button type="submit" class="btn btn-primary">Ophalen</button>
                </form>
                @if(isset($pokemon['name'], $pokemon['id']))
                    <div class="d-flex flex-column border border-1 border-success w-25 mx-auto shadow-lg p-3 bg-white rounded">
                        <h1 class="text-center">{{ ucfirst($pokemon['name']) ?? '' }}</h1>
                        <hr />
                        <p><b> Type: </b> {{ $pokemon['type'] ?? 'Nvt..'}}</p>
                        <img src="{{ $pokemon['image'] }}" alt="{{ $pokemon['name'] }}">
                        <p><b> Hoogte: </b> {{ $pokemon['length'] ?? 'Nvt..'}} m</p>
                        <p><b> Gewicht: </b> {{ $pokemon['weight'] ?? 'Nvt..'}} kg</p>
                        <a href="{{ route('pokemon.add_card_item' , $pokemon['id'] ) }}" type="button" class="btn btn-success">Toevoegen</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
