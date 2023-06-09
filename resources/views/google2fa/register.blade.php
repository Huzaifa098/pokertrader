@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card card-default">
                    <h4 class="card-heading text-center mt-4">Stel Google Authenticator in</h4>

                    <div class="card-body" style="text-align: center;">
                        <p>Stel uw tweefactorauthenticatie in door onderstaande streepjescode te scannen. Als alternatief kunt u de code gebruiken <strong>{{ $secret }}</strong></p>
                        <div>
                            <div>
                                {!! $QR_Image !!}
                            </div>
                        </div>
                        <p>U moet uw Google Authenticator-app instellen voordat u doorgaat. Anders kunt u niet inloggen</p>
                        <div>
                            <a href="{{ route('complete.registration') }}" class="btn btn-primary">Voltooi registratie</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
