@extends('layouts.app')

@section('content')

    <div class="container w-75 mx-auto">
        @if($admin)
            <a class="btn btn-success" href="{{route('offers.create')}}">Aanmaken</a>
        @endif
        @if(count($offers) > 0)
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Prijs</th>
                    <th scope="col">Normale hoeveelheid</th>
                    <th scope="col">Nieuwe hoeveelheid</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($offers as $offer)
                    <tr>
                        <td>€{{$offer->euro}}</td>
                        @if($offer->euro *  1000 != $offer->poke_dollars)
                        <td class="text-decoration-line-through text-danger fw-bold">₱{{$offer->euro * 1000}}</td>
                        @else
                        <td>---</td>
                        @endif
                        <td class="fw-bold">₱{{$offer->poke_dollars}}</td>

                        <td>

                            <div class="d-flex">
                                @if($admin)
                                    <a class="btn btn-primary m-1"
                                       href="{{route('offers.edit', $offer->id)}}">Bewerken</a>
                                @endif
                                @if($admin)
                                    <button type="button" class="btn btn-danger m-1" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop{{$offer->id}}">
                                        Verwijderen
                                    </button>

                                    <div class="modal fade" id="staticBackdrop{{$offer->id}}" data-bs-backdrop="static"
                                         data-bs-keyboard="false" tabindex="-1"
                                         aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form class="modal-content" method="POST"
                                                  action="{{route('offers.destroy', $offer->id)}}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">
                                                        Verwijder aanbieding?
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Weet je zeker dat je deze aanbieding wilt verwijderen?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" class="btn btn-danger m-1">
                                                        Verwijderen
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif

                                @if(!$admin)
                                    <a class="btn btn-success"
                                       href="{{ route('offers.purchase', $offer->id) }}">Kopen</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        @else
            <div class="text-center text-muted">
                <p>Geen aanbiedingen gevonden</p>
            </div>
        @endif
    </div>
@endsection
