@extends('layouts.app')

@section('title', 'O portalu')

@section('styles')
    @parent
    <link href="{{ asset('/css/info.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container info-pages">
        <h1>O portalu</h1>

        <div class="sector">
            <p>Wydawcą portalu sso.epf.org.pl jest
                <a href="http://epf.org.pl" target="_blank">Fundacja ePaństwo</a> - niezależna organizacja pozarządowa
                działająca na rzecz rozwoju demokracji w Polsce.</p>
        </div>

        <h2>Kontakt z redakcją:</h2>
        <div class="sector">
            <p>E-mail: <a href="mailto:biuro@epf.org.pl">biuro@epf.org.pl</a><br>
                Telefon: <a href="skype:224074204">(22) 40 74 204</a></p>
        </div>

        <h2>O portalu:</h2>
        <p>sso.epf.org.pl jest systemem logowania do zestawu aplikacji dających łatwy dostęp do danych publicznych:</p>
        <ul>
            <li><a href="https://archiwum.io">archiwum.io</a> - Archiwum poprzednich wersji stron internetowych polskich
                władz i urzędów państwowych.</li>
            <li><a href="https://mojeprawo.io">mojeprawo.io</a> - Obecne i przeszłe polskie prawo.</li>
            <li><a href="https://rejestr.io">rejestr.io</a> - Zbiory danych różnych rejestrów publicznych, m.in. KRS,
                zamówień publicznych, baz naukowych, raportów NIK, IPN.</li>
            <li><a href="https://sejmometr.pl">sejmometr.pl</a> - Informacje o składzie i pracach Sejmu.</li>
        </ul>
        <p>Planujemy udostępnienie kodu źródłowego portalu w postaci OpenSource.</p>

        <h2>Wykorzystywanie danych:</h2>
        <div class="sector">
            <p>Fundacja ePaństwo stara się strukturalizować, wzbogacać oraz łączyć informacje, które pozyskuje w ramach
                ponownego wykorzystywania informacji z sektora publicznego. W takim przypadku może powstać chroniony
                <a target="_self" title="Ustawa z dnia 4 lutego 1994 r. o prawie autorskim i prawach pokrewnych."
                   href="/DU/1994/24/83">prawem autorskim</a> utwór. Starania Fundacji dotyczace strukturalizacji
                danych mogą też powodować, że korzystający z naszych portali będą korzystali z bazy danych,
                o której mowa w <a target="_self" title="Ustawa z dnia 27 lipca 2001 r. o ochronie baz danych"
                                   href="/DU/2001/128/1402">ustawie o ochronie baz danych</a>. Fundacja ePaństwo
                niniejszym udziela "wolnej licencji" na udostępniane w ramach portalu mojeprawo.io utwory i bazy
                danych, do których przysługują jej autorskie prawa majątkowe oraz prawa pokrewne, a jedynym
                warunkiem takiej licencji - w przypadku tworzenia aplikacji wykorzystujących dane udostępniane
                przez Fundację - jest umieszczenie informacji o pochodzeniu danych wraz z linkiem do portalu
                z którego pochodzą.</p>
        </div>
    </div>
@endsection
