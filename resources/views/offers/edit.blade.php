
@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="pb-3">Aanbieding bewerken </h3>

                        <form method="POST" action="{{route('offers.update', $offers->id)}}">


                            @method('PUT')
                            @csrf
                            <!-- euro-->
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">euro's</label>

                                <div class="col-md-6 d-flex">
                                    <input id="euro" type="number" step="0.01"
                                           class="form-control @error('euro') is-invalid @enderror"
                                           name="euro" value="{{$offers->euro}}" required
                                           autocomplete="name" min="0.01" max="999.99"
                                           autofocus>

                                    <a class="btn btn-outline-primary ms-1" onclick="calculateEuros()">
                                        Bereken
                                    </a>

                                    @error('euro')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- pokedollars-->

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">pokedollars</label>

                                <div class="col-md-6 d-flex">
                                    <input id="poke_dollars" type="number"
                                           class="form-control @error('poke_dollars') is-invalid @enderror"
                                           name="poke_dollars" value="{{$offers->poke_dollars}}" required
                                           autocomplete="name" min="10" max="999990"
                                           autofocus>

                                    <a class="btn btn-outline-primary ms-1" onclick="calculatePokedollars()">
                                        Bereken
                                    </a>

                                    @error('poke_dollars')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a class="btn btn-danger" href="{{ route('offers.index') }}">Terug</a>
                                    <button type="submit" class="btn btn-primary">
                                        bewerken
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calculateEuros() {
            $pokedollar = document.getElementById("poke_dollars").value;
            $euro = $pokedollar / 1000;

            document.getElementById("euro").value = $euro;
        }

        function calculatePokedollars() {
            $pokedollar = document.getElementById("euro").value;
            $euro = $pokedollar * 1000;

            document.getElementById("poke_dollars").value = $euro;
        }
    </script>

@endsection

