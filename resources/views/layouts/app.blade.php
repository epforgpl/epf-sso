<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- TODO: Style it better. -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ePaństwo Login') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="menu-main">
            <a href="/" class="navbar-brand">
                <img src="{{ asset('images/logo-epanstwo.svgz') }}" class="svg" width="187" height="63" alt="Fundacja ePanstwo">
            </a>
            <h4 class="mt-4">Zaloguj się do serwisów Fundacji ePaństwo</h4>
            <ul class="services mt-3">
                <li><a target="_blank" href="https://rejestr.io"><img src="{{ asset('images/services/rejestrio.svg') }}"></a></li>
                <li><a target="_blank" href="https://mojeprawo.io"><img src="{{ asset('images/services/mojeprawo.svg') }}"></a></li>
                <li><a target="_blank" href="https://sejmometr.pl"><img src="{{ asset('images/services/sejmometr.svg') }}"></a></li>
                <li><a target="_blank" href="https://archiwum.io"><img src="{{ asset('images/services/archiwum.svg') }}"></a></li>
            </ul>
        </div>

        <!--
        <div class="container mt-4 mb-5">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <h1>Paszport ePaństwa</h1>
                    <h4>Korzystaj z usług tworzonych przez Fundację ePaństwo</h4>
                    <ul class="nav nav-tabs mt-5">
                        @guest
                            <li class="nav-item"><a class="nav-link {{ Request::is('*login*') ? 'active' : '' }}" href="{{ route('login') }}">Zaloguj się</a></li>
                            <li class="nav-item"><a class="nav-link {{ Request::is('*register*') ? 'active' : '' }}" href="{{ route('register') }}">Zarejestruj się</a></li>
                            @if (Request::is('*password/reset*'))
                                <li class="nav-item"><a class="nav-link active" href="{{ route('password.request') }}">Zresetuj hasło</a></li>
                            @endif
                        @else
                            <li class="nav-item"><a class="nav-link {{ Request::is('*password/change*') ? 'active' : '' }}" href="{{ route('password.change') }}">Zmień hasło</a></li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Wyloguj się
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
        -->

        @yield('content')

        {{-- The 'push' element below is part of 'sticky footer' solution. https://stackoverflow.com/a/12239188 --}}
        <div class="push"></div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
