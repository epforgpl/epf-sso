@extends('layouts.app')

@section('content')
    <div class="card card-main card-register">
        <div class="card-body text-center">

            <div class="alert alert-success">
                Utworzono nowe konto. Jesteś teraz zalogowany/-a.
            </div>

            <p class="mb-2">
                <a href="{{ \App\Util\OAuthUtil::getAuthorizationCodeRedirect() }}" class="btn btn-primary">Kontynuuj</a>
            </p>

        </div>
    </div>
@endsection
