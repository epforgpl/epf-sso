@extends('layouts.app')

@section('title', 'Resetowanie hasła')

@section('content')
    <div class="card card-main card-register">
        <div class="card-body">

            <div class="alert alert-success">
                Twoje hasło zostało zmienione.
            </div>

            <div>
                Przejdź do portalu:<br/>

                <ul class="services mt-3">
                    <li><a target="_blank" href="https://rejestr.io/sso-login"><img src="{{ asset('images/services/rejestrio.svg') }}"></a></li>
                    <li><a target="_blank" href="https://mojeprawo.io/sso-login"><img src="{{ asset('images/services/mojeprawo.svg') }}"></a></li>
                    <li><a target="_blank" href="https://sejmometr.pl/sso-login"><img src="{{ asset('images/services/sejmometr.svg') }}"></a></li>
                    <li><a target="_blank" href="https://archiwum.io/sso-login"><img src="{{ asset('images/services/archiwum.svg') }}"></a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection

{{-- Remove 'header-links' section because we include icons in the code above. --}}
@section('header-links')
@endsection
