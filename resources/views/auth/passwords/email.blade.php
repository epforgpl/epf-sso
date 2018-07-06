@extends('layouts.app')

@section('title', 'Resetowanie hasła | SSO')

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

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">Adres e-mail</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="off">
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="text-center mt-2">
                    <p class="mb-4">
                        <button type="submit" class="btn btn-primary">
                            Wyślij link do zmiany hasła
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
