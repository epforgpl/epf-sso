@extends('layouts.app')

@section('title', 'Logowanie do portalu Rejestr.io')

@section('content')
    <div class="card card-main card-register">
        <div class="card-body">
            {{-- TODO: Improve UI. --}}

            <div class="text-center">
                Jesteś teraz zalogowany/-a jako:
                <br/><br/>
                <b>{{ Auth::user()->email }}</b>
                <br/><br/>
                <p class="text-muted"><a href="{{ route('password.change') }}">Zmień hasło</a></p>
                {{-- TODO: Add logout.
                    <p class="text-muted"><a href="{{ route('logout') }}">Wyloguj</a></p>
                --}}
            </div>

            <hr/>

            <div class="text-center">
                {{-- TODO: This redirect doesn't work. --}}
                <a href="https://rejestr.io/sso-login">Przejdź do portalu Rejestr.io</a>

                {{-- TODO: Uncomment if we ever bring back / have portals other than rejestr.io.
                Przejdź do portalu:

                <ul class="services mt-3">
                    <li><a href="https://rejestr.io/sso-login"><img src="{{ asset('images/services/rejestrio.svg') }}"></a></li>
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
