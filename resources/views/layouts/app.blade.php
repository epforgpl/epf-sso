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
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-container container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="https://epf.org.pl/pl/">
                        <img src="{{ asset('images/logo-epanstwo.svgz') }}" class="svg" width="187" height="63" alt="Fundacja ePanstwo">
                        <img src="{{ asset('images/logo-epanstwo.png') }}" class="png" width="187" height="63" alt="Fundacja ePanstwo">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul id="menu-main-menu" class="nav navbar-nav navbar-right">
                        <li><a href="https://epf.org.pl/">Strona główna</a></li>
                        <li><a href="https://epf.org.pl/pl/blog/">Aktualności</a></li>
                        <li><a href="https://epf.org.pl/pl/projekty">Projekty</a></li>
                        <li><a href="https://epf.org.pl/pl/zespol/">Zespół</a></li>
                        <li><a href="https://epf.org.pl/pl/o-nas/">O nas</a></li>
                        <li><a href="https://epf.org.pl/pl/kontakt/">Kontakt</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <ul class="nav nav-tabs">
                        @guest
                            <li class="{{ Request::is('*login*') ? 'active' : '' }}"><a href="{{ route('login') }}">Zaloguj się</a></li>
                            <li class="{{ Request::is('*register*') ? 'active' : '' }}"><a href="{{ route('register') }}">Zarejestruj się</a></li>
                            @if (Request::is('*password/reset*'))
                                <li class="active"><a href="{{ route('password.request') }}">Zresetuj hasło</a></li>
                            @endif
                        @else
                            <li class="{{ Request::is('*password/change*') ? 'active' : '' }}"><a href="{{ route('password.change') }}">Zmień hasło</a></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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

        @yield('content')

        {{-- The 'push' element below is part of 'sticky footer' solution. https://stackoverflow.com/a/12239188 --}}
        <div class="push"></div>
    </div>

    <footer class="footer">
        <div class="footer-container container">
            <div class="row">
                <ul class="footer-nav footer-nav--primary">
                    <li><a href="https://epf.org.pl/pl/">Strona główna</a></li>
                    <li><a href="https://epf.org.pl/pl/o-nas/">O nas</a></li>
                    <li><a href="https://epf.org.pl/pl/projekty">Projekty</a></li>
                    <li><a href="https://epf.org.pl/pl/zespol/">Zespół</a></li>
                    <li><a href="https://epf.org.pl/pl/regulamin/">Regulamin</a></li>
                    <li><a href="https://epf.org.pl/pl/polityka-prywatnosci/">Polityka prywatności</a></li>
                </ul>
                <ul class="footer-nav footer-nav--secondary">
                    <li><a href="https://epf.org.pl/pl/blog/">Wszystkie</a></li>
                    <li><a href="https://epf.org.pl/pl/category/policy/">Policy</a></li>
                    <li><a href="https://epf.org.pl/pl/category/otwartedane/">Otwarte dane</a></li>
                    <li><a href="https://epf.org.pl/pl/category/wydarzenia/">Wydarzenia</a></li>
                    <li><a href="https://kodujdlapolski.pl/blog/">Koduj dla Polski</a></li>
                    <li><a href="https://epf.org.pl/pl/category/moje-panstwo/">Moje Państwo</a></li>
                    <li><a href="https://epf.org.pl/pl/category/dla-dziennikarzy-i-blogerow/">Dla dziennikarzy</a></li>
                    <li><a href="https://epf.org.pl/pl/category/raporty-i-analizy/">Opinie, raporty i analizy</a></li>
                </ul>
            </div>
            <ul class="footer-social">
                <li><a target="_blank" href="https://www.youtube.com/user/epanstwo" class="footer-social-icon icon--youtube"></a></li>
                <li><a target="_blank" href="https://www.facebook.com/epanstwo" class="footer-social-icon icon--facebook"></a></li>
                <li><a target="_blank" href="https://twitter.com/epforgpl" class="footer-social-icon icon--twitter"></a></li>
            </ul>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
