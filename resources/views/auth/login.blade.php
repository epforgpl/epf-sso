@extends('layouts.app')

@section('content')
    <div class="card card-main card-register">
        <div class="card-body">

            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <fieldset>

                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <label for="email">Adres e-mail</label>
                        <input name="email" id="email" type="email" class="form-control" value="{{ old('email') }}" placeholder="Adres e-mail" required autofocus />
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

                </fieldset>
                <div class="text-center mt-2">
                    <p class="mb-4">
                        <button type="submit" class="btn btn-primary">
                            Zaloguj się
                        </button>
                    </p>
                    <p class="mb-1 text-muted"><a href="{{ route('password.request') }}">Nie pamiętasz hasła?</a></p>
                    <p class="mb-0 text-muted"><a href="{{ route('register') }}">Utwórz nowe konto</a></p>
                </div>
            </form>

        </div>
    </div>


<!--
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}" autocomplete="off">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>Zapamiętaj mnie
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Zaloguj się
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Nie pamiętasz hasła?
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                &nbsp;
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <b>Lub:</b>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button class="btn btn-primary" onclick="location.href = '{{ url('/') }}/oauth/google';">
                                    Zaloguj się przez Google
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button class="btn btn-primary" onclick="location.href = '{{ url('/') }}/oauth/facebook';">
                                    Zaloguj się przez Facebook
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
-->
@endsection
