@extends('layouts.app')

@section('title', 'Zaloguj się')

@section('content')
    <div class="card card-main card-register">
        <div class="card-body">

            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <fieldset>

                    <div class="form-group">
                        <label for="email">Adres e-mail</label>
                        <input name="email" id="email" type="email" value="{{ old('email') }}"
                               placeholder="Adres e-mail" required autofocus class="form-control"/>
                        @if ($errors->has('email'))
                            <div class="invalid-feedback d-block">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">Hasło</label>
                        <input name="password" id="password" type="password" placeholder="Hasło" required
                               class="form-control"/>
                        @if ($errors->has('password'))
                            <div class="invalid-feedback d-block">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="remember"
                                   name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">Zapamiętaj mnie</label>
                        </div>
                    </div>

                </fieldset>
                <div class="text-center mt-2">
                    <p class="mb-4">
                        <button type="submit" class="btn btn-primary" id="dusk-login-button">
                            Zaloguj się
                        </button>
                    </p>
                    <p class="mb-1 text-muted"><a href="{{ route('password.request') }}">Nie pamiętasz hasła?</a></p>
                    <p class="mb-0 text-muted"><a href="{{ route('register') }}">Utwórz nowe konto</a></p>
                    <!--
                    <button class="btn btn-primary" onclick="location.href = '{{ url('/') }}/oauth/google';">
                        Zaloguj się przez Google
                    </button>
                    -->
                    <hr/>
                </div>
            </form>
            <div class="text-center mt-2">
                <button class="btn btn-primary" onclick="location.href = '{{ url('/') }}/oauth/facebook';">
                    Zaloguj się przez Facebook
                </button>
            </div>
        </div>
    </div>
@endsection
