@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Locatie aanpassen</h2>
                <form action="{{ route ('locations.update', $location) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name">Naam locatie</label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name"
                               value="{{ $location->name }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="postcode">Postcode</label>
                        <input type="text"
                               class="form-control @error('postcode') is-invalid @enderror"
                               name="postcode"
                               value="{{ $location->postcode }}">
                        @error('postcode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="city">Stad</label>
                        <input type="text"
                               class="form-control @error('city') is-invalid @enderror"
                               name="city"
                               value="{{ $location->city }}">
                        @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="street">Straatnaam</label>
                        <input type="text"
                               class="form-control @error('street') is-invalid @enderror"
                               name="street"
                               value="{{ $location->street }}">
                        @error('street')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="street_number">Huisnummer</label>
                        <input type="text"
                               class="form-control @error('street_number') is-invalid @enderror"
                               name="street_number"
                               value="{{ $location->street_number }}">
                        @error('street_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Opslaan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
