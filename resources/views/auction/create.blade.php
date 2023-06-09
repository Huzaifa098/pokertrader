@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Veiling aanmaken</h2>
                <form action="{{ route ('auctions.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Naam</label>
                             <input class="form-control w-75  @error('name') is-invalid @enderror" type="text" name="name" required>

                        <label for="duration">Lengte (minuten)</label>
                        <input type="number"
                               class="form-control w-50 @error('duration') is-invalid @enderror"
                               name="duration"
                               min="0" max="100000">

                        @error('duration')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-check form-switch" oncontextmenu="return false">
                        <input class="form-check-input p-2" type="checkbox" name="premium" value="1" id="alsocheck">
                        <label class="form-check-label" for="alsocheck">premium veiling</label>
                    </div>
                    <br>
                    <div>
                        <input type="hidden" name="location_id" value="{{ $location->id }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Opslaan</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('input[type="checkbox"]').change(function(){
            this.value = (Number(this.checked));
        });
    </script>
@endsection
