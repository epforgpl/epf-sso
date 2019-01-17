<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Generated using faviconit.com --}}
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon.ico') }}">
    <link rel="icon" sizes="16x16 32x32 64x64" href="{{ asset('images/favicon/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="196x196" href="{{ asset('images/favicon/favicon-192.png') }}">
    <link rel="icon" type="image/png" sizes="160x160" href="{{ asset('images/favicon/favicon-160.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicon/favicon-96.png') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/favicon/favicon-64.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon/favicon-57.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/favicon/favicon-114.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/favicon/favicon-72.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicon/favicon-144.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/favicon/favicon-60.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicon/favicon-120.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicon/favicon-76.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicon/favicon-152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/favicon-180.png') }}">
    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="menu-main">
            <a href="https://epf.org.pl" class="navbar-brand">
                <img src="{{ asset('images/logo-epanstwo.svgz') }}" class="svg" width="187" height="63" alt="Fundacja ePanstwo">
            </a>
            <h4 class="mt-4">Logowanie do serwisów Fundacji ePaństwo</h4>
            {{-- Icons defined as section because we want to override them in some sub-templates. --}}
            @section('header-links')
                <ul class="services mt-3">
                    <li><a target="_blank" href="https://rejestr.io"><img src="{{ asset('images/services/rejestrio.svg') }}"></a></li>
                    <li><a target="_blank" href="https://mojeprawo.io"><img src="{{ asset('images/services/mojeprawo.svg') }}"></a></li>
                    <li><a target="_blank" href="https://sejmometr.pl"><img src="{{ asset('images/services/sejmometr.svg') }}"></a></li>
                    {{-- TODO: Uncomment when we want to show archiwum.io
                    <li><a target="_blank" href="https://archiwum.io"><img src="{{ asset('images/services/archiwum.svg') }}"></a></li>
                    --}}
                </ul>
            @endsection
            @yield('header-links')
        </div>

        @yield('content')

        {{-- The 'push' element below is part of 'sticky footer' solution. https://stackoverflow.com/a/12239188 --}}
        <div class="push"></div>
    </div>
    <footer id="footer">
        <ul>
            <li><a href="{{ route('about') }}">O portalu</a></li>
            <li><a href="{{ route('personal') }}">Dane osobowe</a></li>
            <li><a href="{{ route('terms') }}">Regulamin</a></li>
            <li><a href="{{ route('privacy') }}">Polityka prywatności</a></li>
        </ul>
        <cookie-law button-text="OK">
            <div slot="message">
                Informujemy, że nasz serwis internetowy wykorzystuje pliki cookies. Celem przetwarzania
                danych zapisanych za pomocą cookies jest dostosowanie zawartości serwisu do preferencji
                Użytkownika. Jeśli nie wyrażasz zgody, ustawienia dotyczące plików cookies możesz zmienić
                w ustawieniach swojej przeglądarki. Więcej informacji na temat cookies znajdziesz
                w <a href="{{ route('privacy') }}">Polityce Prywatności</a>.
            </div>
        </cookie-law>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
