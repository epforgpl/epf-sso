@extends('layouts.app')

@section('title', 'Resetowanie hasła')

@section('content')
    <div class="card card-main card-register">
        <div class="card-body">

            <div class="alert alert-success">
                Twoje hasło zostało zresetowane. Jesteś teraz zalogowany/-a.
            </div>

            <div class="text-center">
                <a href="https://rejestr.io/login">Przejdź do portalu Rejestr.io</a>

                {{-- TODO: Uncomment if we ever bring back sejmometr or mojeprawo.
                Przejdź do portalu:

                <ul class="services mt-3">
                    <li><a href="https://rejestr.io/login"><img src="{{ asset('images/services/rejestrio.svg') }}"></a></li>
                    <li><a href="https://mojeprawo.io/sso-login"><img src="{{ asset('images/services/mojeprawo.svg') }}"></a></li>
                    <li><a href="https://sejmometr.pl/sso-login"><img src="{{ asset('images/services/sejmometr.svg') }}"></a></li>
                    <li><a href="https://archiwum.io/"><img src="{{ asset('images/services/archiwum.svg') }}"></a></li>
                </ul>
                --}}
            </div>
        </div>
    </div>
@endsection

{{-- Remove 'header-links' section because we include icons in the code above. --}}
@section('header-links')
@endsection
