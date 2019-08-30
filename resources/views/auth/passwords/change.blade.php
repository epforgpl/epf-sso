@extends('layouts.app')

@section('title', 'Zmiana hasła')

@section('content')
    <div class="card card-main card-register">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form class="form-horizontal" method="POST" action="{{ route('password.change.execute') }}" autocomplete="off">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="current-password" class="control-label">Obecne hasło</label>
                    <input id="current-password" type="password" name="current-password" required autocomplete="off"
                           class="form-control {{ $errors->has('current-password') ? ' is-invalid' : '' }}">
                    @if ($errors->has('current-password'))
                        <span class="help-block invalid-feedback">{{ $errors->first('current-password') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="new-password" class="control-label">Nowe hasło</label>
                    <input id="new-password" type="password" name="new-password" required autocomplete="off"
                           class="form-control {{ $errors->has('new-password') ? ' is-invalid' : '' }}">
                    @if ($errors->has('new-password'))
                        <span class="help-block invalid-feedback">{{ $errors->first('new-password') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="new-password-confirm" class="control-label">Powtórz nowe hasło</label>
                    <input id="new-password-confirm" type="password" name="new-password_confirmation" required
                           autocomplete="off" class="form-control">
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
