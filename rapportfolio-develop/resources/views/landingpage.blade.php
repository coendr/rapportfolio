@extends('layouts.app') @section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel white">
                @isset($error)
                    <div class="red card-panel white-text">
                        <span class="closebtn">&times;</span>
                        {{$error}}
                    </div>
                @endisset @isset($succes)
                    <div class="green card-panel white-text">
                        <span class="closebtn">&times;</span>
                        {{$succes}}
                    </div>
                @endisset
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card-panel pink">

                        <span class="white-text center-align">
                            <h4>Welkom @if(Auth::user()->hasRole('leerling')) {{ Auth::user()->getLeerlingnaam()}} @elseif(Auth::user()->hasRole('leerkracht'))
                                    {{ Auth::user()->getLeerkrachtnaam()}} @elseif(Auth::user()->hasRole('ouder')) {{ Auth::user()->getOudernaam()}}
                                @elseif(Auth::user()->hasRole('admin')) {{ Auth::user()->getAdminnaam()}} @else @endif
                            </h4>
                        </span>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->hasRole('leerkracht'))
                    <div class="row">
                        @if(Auth::user()->getLeerkrachtgroep() > 2)
                            <div class="col s12 m6 l6">
                                <div class="card pink">
                                    <div class="card-content white-text">
                                        <span class="card-title">Snel Acties Rapport</span>
                                        <p></p>
                                    </div>
                                    <div class="card-action">
                                        <a href="{{route('kiesvak')}}">Invullen</a>
                                        <a href="{{route('bekijken')}}">Bekijken</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col s12 m6 l6">
                            <div class="card pink">
                                <div class="card-content white-text">
                                    <span class="card-title">Snel Acties Portfolio</span>
                                    <p></p>
                                </div>
                                <div class="card-action">
                                    <a href="{{route('invoegennamen')}}">Invullen</a>
                                    <a href="{{route('portbekijk')}}">Bekijken</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif(Auth::user()->hasRole('leerling'))
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <div class="card pink">
                                <div class="card-content white-text">
                                    <span class="card-title">Snel Acties</span>
                                    <p></p>
                                </div>
                                <div class="card-action">
                                    <a href="{{route('bekijken')}}">Rapport Bekijken</a>
                                    <a href="{{route('leerlingkiezen')}}">Knap Invullen</a>
                                    <a href="{{route('portbekijk')}}">Portfolio Bekijken</a>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <div class="card-panel pink">
                        <span class="white-text">
                            <h4>Wat is het rapportfolio?</h4>
                        </span>
                            </div>
                            <p>Het rapportfolio is een website waar jij altijd je rapport en portfolio kan terug vinden.
                                Zo kun je altijd
                                aan mama of papa, opa of oma laten zien hoe goed jij het in de klas doet.
                                <br> Ook kun je zelf, als jouw juf of meester het zegt, laten zien hoe jij het in de
                                klas doet. Dit doe
                                je met knap. Verder staan al je werkjes, gedichten, verhalen en tekeningen hier. Die
                                vind je bij
                                jouw Portfolio.
                                <br>
                                <b>Let op! Het is belangrijk dat je altijd jouw wachtwoord voor jezelf houd. Vertel hem
                                    nooit aan je
                                    klasgenoten.
                                </b> Als je jouw wachtwoord bent vergeten of ga dan naar jouw juf of meester.</p>
                        </div>
                    </div>
                @elseif(Auth::user()->hasRole('ouder'))
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <div class="card pink">
                                <div class="card-content white-text">
                                    <span class="card-title">Snel Acties</span>
                                    <p></p>
                                </div>
                                <div class="card-action">
                                    <a href="{{route('oudersbekijk')}}">Rapport Bekijken</a>

                                    <a href="{{route('oudersportfolio')}}">Portfolio Bekijken</a>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m6 l6 l6">
                            <div class="card-panel pink">
                        <span class="white-text">
                            <h4>Wat is het rapportfolio?</h4>
                        </span>
                            </div>
                            <p>Het Rapportfolio is een webapplicatie waarmee u de voortgang van uw kind(eren) op de
                                Polsstok kunt bijhouden.
                                Het Rapportfolio is ontwikkeld door studenten van het Windesheim Flevoland met als
                                primaire doel
                                het vervangen van het oude papieren rapport. Door gebruik te maken van slimme functies
                                kunnen we
                                ook de werkdruk verlagen voor de leerkrachten. Een hot topic in het onderwijs. Naast
                                voordelen voor
                                de leerkracht zijn er ook voordelen voor u als ouder/verzorger. Zo kunt u 24 uur per dag
                                en 7 dagen
                                in de week de perstaties van uw kind inzien. Ook kunt u door middel van het portfolio de
                                creative
                                uitlatingen van uw kind bekijken en zo weer delen met familie en vrienden. </p>
                        </div>
                    </div>
                @elseif(Auth::user()->hasRole('admin'))
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <div class="card pink">
                                <div class="card-content white-text">
                                    <span class="card-title">Snel Acties Rapport</span>
                                    <p></p>
                                </div>
                                <div class="card-action">
                                    <a href="{{route('kiesvak')}}">Invullen</a>
                                    <a href="{{route('bekijken')}}">Bekijken</a>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <div class="card-panel pink">
                        <span class="white-text">
                            <h4>Beheerdersaccount</h4>
                        </span>
                            </div>
                            <p>Beste gebruiker,
                                <br> U bevind zich nu in het beheerdersomgeving van het rapportfolio. Hier kunt u
                                inhoudelijk het systeem
                                beheren. U kunt hier onder andere wachtwoorden van gebruikers resetten, gegevens van
                                gebruikers aanpassen
                                en gebruikers verwijderen. Het is belangrijk dat u hier voorzichtig te werk gaat.
                                <b>Verwijderde gevegevens zijn niet meer terug te halen!</b>
                                <br>
                                <br>
                            </p>
                        </div>
                    </div>
            </div>
            @endif
        </div>
    </div>
@endsection