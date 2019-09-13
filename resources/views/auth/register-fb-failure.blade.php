@extends('layouts.app')

@section('content')
    <div class="card card-main card-register">
        <div class="card-body text-center">

            <div class="alert alert-warning">
                @switch($reason)
                    @case(\App\Util\Constants::REGISTER_FB_FAILURE_NOT_ALLOWED)
                    Serwis otrzymał odmowę od Facebooka. To mogło się zdarzyć jeśli kliknąłeś
                    "Anuluj" gdy Facebook zapytał o pozwolenie dla naszego systemu logowania.
                    @break

                    @case(\App\Util\Constants::REGISTER_FB_FAILURE_EMAIL_NOT_PROVIDED)
                    Serwis otrzymał pusty adres email użytkownika od Facebooka. To mogło się zdarzyć
                    jeśli wyłączyłeś udostępnianie go.
                    @break
                @endswitch
            </div>

            <p class="mb-2">
                <a href="/login" class="btn btn-primary">Wróć do strony logowania</a>
            </p>

        </div>
    </div>
@endsection
