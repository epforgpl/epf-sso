@extends('layouts.app')

@section('content')
    <div class="card card-main card-register">
        <div class="card-body text-center">

            <div class="alert alert-warning">
                @if (session('reason'))
                    @if (session('reason') === \App\Util\Constants::REGISTER_FB_FAILURE_NOT_ALLOWED)
                        Serwis otrzymał odmowę od Facebooka. To mogło się zdarzyć jeśli kliknąłeś
                        "Anuluj" gdy Facebook zapytał o pozwolenie dla naszego systemu logowania.
                    @elseif (session('reason') === \App\Util\Constants::REGISTER_FB_FAILURE_EMAIL_NOT_PROVIDED)
                        Serwis otrzymał pusty adres email użytkownika od Facebooka. To mogło się zdarzyć
                        jeśli wyłączyłeś udostępnianie go.
                    @endif

                    {{-- Clear status after displaying the message. --}}
                    @php(session(['status' => null]))
                @else
                    @php(\Illuminate\Support\Facades\Log::error('FB registration failure reason not present.');)
                    Wystąpił błąd. Skontaktuj się z nami, spróbuj jeszcze raz, lub zarejestruj się podając swój email.
                @endif
            </div>

            <p class="mb-2">
                <a href="/login" class="btn btn-primary">Wróć do strony logowania</a>
            </p>

        </div>
    </div>
@endsection
