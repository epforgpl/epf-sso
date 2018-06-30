@extends('layouts.app')

@section('content')
    <div class="card card-main card-register">
        <div class="card-body">

            <h4 class="text-center mb-4">Tworzenie nowego konta</h4>

            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <fieldset>

                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label for="name">Imię i nazwisko</label>
                        <input name="name" id="name" type="text" class="form-control" value="{{ old('name') }}" placeholder="Imię i nazwisko" required autofocus />
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <label for="email">Adres e-mail</label>
                        <input name="email" id="email" type="email" class="form-control" value="{{ old('email') }}" placeholder="Adres e-mail" required />
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <label for="password">Hasło</label>
                        <input name="password" id="password" type="password" class="form-control" placeholder="Hasło" required />
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Powtórz hasło</label>
                        <input name="password_confirmation" id="password-confirm" type="password" class="form-control" placeholder="Powtórz hasło" required />
                        @if ($errors->has('password-confirm'))
                            <div class="invalid-feedback">{{ $errors->first('password-confirm') }}</div>
                        @endif
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
@endsection
