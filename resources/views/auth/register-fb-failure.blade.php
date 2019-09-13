@extends('layouts.app')

@section('content')
    <div class="card card-main card-register">
        <div class="card-body text-center">

            <div class="alert alert-warning">
                Serwis otrzymał odmowę od Facebooka. To mogło się zdarzyć jeśli kliknąłeś
                "Anuluj" gdy Facebook zapytał o pozwolenie dla naszego systemu logowania.
            </div>

            <p class="mb-2">
                <a href="/login" class="btn btn-primary">Wróć do strony logowania</a>
            </p>

        </div>
    </div>
@endsection
