@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('Profile bewerken') }}</div>
                    @auth
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.update', Auth::id()) }}">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <label for="username"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Gebruikersnaam:') }}</label>

                                    <div class="col-md-6">
                                        <input id="username" type="text"
                                               class="form-control @error('username') is-invalid @enderror"
                                               name="username" value="{{ old('username') ?? $user->username }}" required
                                               autocomplete="username" autofocus>

                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="text"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') ?? $user->email }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="bank_name"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Banknaam:') }} </label>

                                    <div class="col-md-6">
                                        <input id="bank_name" type="text"
                                               class="form-control @error('bank_name') is-invalid @enderror"
                                               name="bank_name" value="{{ old('bank_name') ?? $user->bank_name }}">

                                        @error('bank_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="bank_number"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Banknummer:') }} </label>

                                    <div class="col-md-6">
                                        <input id="bank_number" type="text"
                                               class="form-control @error('bank_number') is-invalid @enderror"
                                               name="bank_number"
                                               value="{{ old('bank_number') ?? $user->bank_number }}">

                                        @error('bank_number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

@endsection
