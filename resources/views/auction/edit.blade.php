@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8"><h2>Veiling bewerken</h2>
                <form action="{{ route ('auctions.update', $auction) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name">Naam</label>
                        <input class="form-control w-75  @error('name') is-invalid @enderror" type="text" name="name" value="{{ $auction->name }}" required>

                        <label for="duration">Lengte (minuten)</label>
                        <input type="number"
                               class="form-control w-50 @error('duration') is-invalid @enderror"
                               name="duration"
                               min="0" max="100000"
                               value="{{ $auction->duration }}">
                        @error('duration')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="form-check form-switch" oncontextmenu="return false">
                            <input class="form-check-input p-2" type="checkbox" name="premium" value="1" id="alsocheck"
                            @if($auction->premium)checked @endif>
                            <label class="form-check-label" for="alsocheck">premium veiling</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Opslaan</button>
                    @if(!$auction->start_auction)
                    <a class="btn btn-outline-secondary mx-2" href="{{ route('auctions.addCard', $auction) }}">Kaart
                        toevoegen</a>
                    @endif
                </form>

                <div class="row mt-4">
                    @foreach($auction->auctionCards as $auction_card)
                        <div class="col-sm-6 col-lg-4">
                            <div class="card mb-3">
                                <img src="{{ $auction_card->card->image }}" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $auction_card->card->name }}</h4>
                                    <div class="card-text mb-2">
                                        Type: {{ $auction_card->card->type }}<br>
                                        Height: {{ $auction_card->card->length }}<br>
                                        Weight: {{ $auction_card->card->weight }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        $('input[type="checkbox"]').change(function(){
            this.value = (Number(this.checked));
        });
    </script>
@endsection
