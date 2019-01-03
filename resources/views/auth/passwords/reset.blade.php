@extends('layouts.app')

@section('title', 'Resetowanie hasła')

@section('content')
    <div class="card card-main card-register">
        <div class="card-body">
            <form class="form-horizontal" method="POST" action="{{ route('password.request') }}" autocomplete="off">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="email">Adres e-mail</label>
                    <input id="email" type="email" name="email" value="{{ $email or old('email') }}" required autofocus autocomplete="off"
                           class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}">
                    @if ($errors->has('email'))
                        <span class="help-block invalid-feedback">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Nowe hasło</label>
                    <input id="password" type="password" name="password" required autocomplete="off"
                           class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}">
                    @if ($errors->has('password'))
                        <span class="help-block invalid-feedback">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password-confirm">Powtórz nowe hasło</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="off"
                           class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}">
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>

                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-primary">
                        Zmień hasło
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
