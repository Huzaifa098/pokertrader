@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session()->has('message'))
                            <div class="m-0 text-center alert alert-secondary alert-dismissible fade show w-75 mx-auto mb-3" role="alert">
                                {{ session()->get('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                @endif
                <div class="card">
                    <div class="card-header text-center">{{ __('Mijn Profiel') }}</div>
                        @auth
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="" class="col-md-4 text-md-end">{{ __('Gebruikersnaam:') }}</label>
                                    <div class="col-md-4">
                                        <p><b>{{ $user->username ?? '-'}}</b></p>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="" class="col-md-4 text-md-end">{{ __('Email') }}</label>
                                    <div class="col-md-4">
                                        <p><b>{{ $user->email ?? '-' }}</b></p>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="" class="col-md-4 text-md-end">{{ __('Banknaam:') }}</label>
                                    <div class="col-md-4">
                                        <p><b>{{ $user->bank_name ?? '-' }}</b></p>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="" class="col-md-4 text-md-end">{{ __('Banknummer:') }}</label>
                                    <div class="col-md-4">
                                        <p><b>{{ $user->bank_number ?? '-' }}</b></p>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-6 offset-md-4">
                                        <a href="{{ route('profile.edit', Auth::id() ) }}" type="submit" class="btn btn-primary">
                                            {{ __('Bewerken') }}
                                        </a>

                                        {{-- Maybe later needed  --}}
                                    
                                        {{-- <a href="{{ url('/password/change') }}" type="submit" class="btn btn-secondary">
                                            {{ __('Wachtwoord wijzigen') }}
                                        </a> --}}
                                    </div>
                                </div>
                            </div>
                        @endauth
                </div>
        </div>
    </div>
</div>
@endsection
