@extends('layouts.app')

@section('title', 'Resetowanie hasła')

@section('content')
    <div class="card card-main card-register">
        <div class="card-body">
            <form class="form-horizontal" method="POST" action="{{ route('password.request') }}" autocomplete="off">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Adres e-mail</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus autocomplete="off">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Nowe hasło</label>
                    <input id="password" type="password" class="form-control" name="password" required autocomplete="off">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm">Powtórz nowe hasło</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="off">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
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
