@extends('layouts.app')

@section('title', 'Rejestracja')

@section('content')
    <div class="card card-main card-register">
        <div class="card-body">

            <h4 class="text-center mb-4">Tworzenie nowego konta</h4>

            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <fieldset>

                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <label for="email">Adres e-mail</label>
                        <input name="email" id="email" type="email" class="form-control" value="{{ old('email') }}"
                               placeholder="Adres e-mail" required />
                        @if ($errors->has('email'))
                            <div class="invalid-feedback d-block">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <label for="password">Hasło</label>
                        <small>(min. 8 znaków, w tym litera i cyfra)</small>
                        <input name="password" id="password" type="password" class="form-control"
                               placeholder="Hasło" required />
                        @if ($errors->has('password'))
                            <div class="invalid-feedback d-block">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Powtórz hasło</label>
                        <input name="password_confirmation" id="password-confirm" type="password" class="form-control"
                               placeholder="Powtórz hasło" required />
                        @if ($errors->has('password-confirm'))
                            <div class="invalid-feedback d-block">{{ $errors->first('password-confirm') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="agree-tc" name="agree-tc"
                                    {{ old('agree-tc') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="agree-tc">
                                Potwierdzam, że zapoznałam(em) się z treścią
                                <a href="{{ route('terms') }}" target="_blank">Regulaminu</a>, w tym
                                <a href="{{ route('privacy') }}" target="_blank">Polityką Prywatności</a>
                                i akceptuję jego postanowienia.
                            </label>
                            @if ($errors->has('agree-tc'))
                                <div class="invalid-feedback d-block">{{ $errors->first('agree-tc') }}</div>
                            @endif
                        </div>
                    </div>

                </fieldset>
                <div class="text-center mt-2">
                    <p class="mb-4">
                        <button type="submit" class="btn btn-primary">
                            Utwórz konto
                        </button>
                    </p>
                    <p class="mb-0 text-muted">Masz już konto? <a href="{{ route('login') }}">Zaloguj się &raquo;</a></p>
                </div>
            </form>
        </div>
    </div>
    <div id="registration-gdpr-notice">
        <div>
            <p>Administratorem Twoich danych osobowych jest Fundacja ePaństwo z siedzibą w Warszawie,
                przy ul. Nowogrodzkiej 25/37, 00-511 Warszawa</p>
            <p>Twoje dane osobowe będą przetwarzane w celu rejestracji i obsługi konta użytkownika w serwisie
                rejestr.io, a także w celach statystycznych
                i analitycznych Fundacji. <a href="{{ route('personal') }}" target="_blank">Więcej informacji
                    na temat przetwarzania danych osobowych.</a></p>
        </div>
    </div>
@endsection
