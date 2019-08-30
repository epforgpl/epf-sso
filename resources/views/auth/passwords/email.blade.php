@extends('layouts.app')

@section('title', 'Resetowanie hasła')

@section('content')
    <div class="card card-main card-register">
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-horizontal" method="POST" action="{{ route('password.email') }}" autocomplete="off">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="email" class="control-label">Adres e-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="off"
                           class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}">
                    @if ($errors->has('email'))
                        <span class="help-block invalid-feedback">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-primary">
                        Wyślij link do zmiany hasła
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
