@extends('layouts.app')

@section('content')
    <div class="card card-main card-register">
        <div class="card-body text-center">

            <h4 class="mb-4">Utworzono nowe konto</h4>

            <p class="mb-2">
                <a href="{{ \App\Util\OAuthUtil::getAuthorizationCodeRedirect() }}" class="btn btn-primary">Kontynuuj</a>
            </p>

        </div>
    </div>
@endsection