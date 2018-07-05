@extends('layouts.app')

@section('title', 'Dane osobowe | SSO')

@section('styles')
    @parent
    <link href="{{ asset('/css/info.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container info-pages">
        <h1>Dane osobowe</h1>
        <ol>
            <li>Administratorem Twoich danych osobowych jest Fundacja ePaństwo z siedzibą w Zgorzale przy ul. Pliszki
                2B/1 05-500 Mysiadło („<b>Fundacja</b>”).
            </li>
            <li>Kontakt z Fundacją jest możliwy poprzez adres e-mail: biuro@epf.org.pl lub pisemnie na adres:
                Nowogrodzka 25/37, 00-511 Warszawa.
            </li>
            <li>Twoje dane osobowe podane podczas rejestracji konta będą przetwarzane:
                <ol>
                    <li>w celu obsługi konta oraz świadczenia usług dostępnych w serwisie archiwum.io, mojeprawo.io,
                        rejestr.io oraz sejmometr.pl na zasadach opisanych w regulaminie serwisu – podstawą prawną jest
                        niezbędność przetwarzania do wykonania umowy, której jesteś stroną (art. 6 ust. 1 lit b ogólnego
                        rozporządzenia o ochronie danych osobowych nr 2016/679 (“<b>RODO</b>”);
                    </li>
                    <li>w celu ustalenia lub dochodzenia ewentualnych roszczeń lub obrony przed takimi roszczeniami
                        przez Fundację – podstawą prawną przetwarzania danych jest prawnie uzasadniony interes Fundacji
                        (art. 6 ust. 1 lit f RODO), prawnie uzasadnionym interesem Fundacji jest umożliwienie ustalenia,
                        dochodzenia lub obrony przed roszczeniami.
                    </li>
                </ol>
            </li>
            <li>Twoje dane osobowe mogą być przekazywane podmiotom świadczącym usługi na rzecz Fundacji, takim jak
                dostawcy systemów informatycznych i usług IT.
            </li>
            <li>Twoje dane osobowe będą przetwarzane przez okres świadczenia usług, do czasu usunięcia konta w serwisie
                archiwum.io, mojeprawo.io, rejestr.io oraz sejmometr.pl. Okres przetwarzania może zostać każdorazowo
                przedłużony o okres przedawnienia roszczeń, jeżeli przetwarzanie Twoich danych osobowych będzie
                niezbędne dla ustalenia lub dochodzenia ewentualnych roszczeń lub obrony przed takimi roszczeniami przez
                Fundację.
            </li>
            <li>Przysługuje Ci prawo dostępu do Twoich danych oraz prawo żądania ich sprostowania, ich usunięcia lub
                ograniczenia ich przetwarzania, prawo sprzeciwu względem przetwarzania danych, prawo do przenoszenia
                danych oraz prawo wniesienia skargi do organu nadzorczego zajmującego się ochroną danych osobowych w
                państwie członkowskim Twojego zwykłego pobytu, miejsca pracy lub miejsca popełnienia domniemanego
                naruszenia.
            </li>
            <li>Podanie danych jest wymagane przez Fundację. Brak podania danych w zakresie wymaganym w formularzu
                rejestracyjnym uniemożliwi dokonanie rejestracji konta w serwisie.
            </li>
        </ol>
    </div>
@endsection
