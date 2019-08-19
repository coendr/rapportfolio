<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    {!! MaterializeCSS::include_full() !!}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Rapportfolio') }}</title>

</head>

<body>
<main>
    <div id="app">
        <ul id="rapport" class="dropdown-content">
            <li>
                <a class="dropdown-button black-text" data-activates="rapport1">Invullen<i class="material-icons right">class</i></a>
            </li>
            <li>
                <a href="{{route('bekijken')}}" class="black-text">Bekijken<i class="material-icons right">chrome_reader_mode</i></a>
            </li>
            <li>
                <a href="{{route('wijzig')}}" class="black-text">Wijzigen<i class="material-icons right">transform</i></a>
                
            </li>
        </ul>

        <ul id="rapport1" class="dropdown-content secondDropDown">
            <li>
                <a href="{{route('kiesvak')}}" class="black-text">Rapport <i class="material-icons right">school</i></a>
            </li>
            <li>
                <a href="{{route('knapinvullennamen')}}" class="black-text">Knap<i class="material-icons right">local_florist</i></a>
            </li>
            <li>
                <a href="{{route('notitie')}}" class="black-text">Notitie <i class="material-icons right">insert_comment</i></a>
            </li>
        </ul>
        <ul id="portfolio" class="dropdown-content">
            <li>
                <a href="{{route('invoegennamen')}}" class="black-text">Invullen <i class="material-icons right">add_photo_alternate</i></a>
            </li>
            <li>
                <a href="{{route('portbekijk')}}" class="black-text">Bekijken <i class="material-icons right">photo_album</i></a>
            </li>
        </ul>
        <!-- dropdown content Leerling -->
        <ul id="rapportLeerling" class="dropdown-content">
            <li>
                <a class="dropdown-button black-text" data-activates="rapportleerling">Invullen<i class="material-icons right">class</i></a>
            </li>
            <li>
                <a href="{{route('getjaar')}}" class="black-text">Bekijken <i class="material-icons right">chrome_reader_mode</i></a>
            </li>

        </ul>
        <ul id="rapportleerling" class="dropdown-content secondDropDown">
            <li>
                <a href="{{route('leerlingkiezen')}}" class="black-text">Knap<i class="material-icons right">local_florist</i></a>
            </li>
            <li>
                <a href="{{route('leerlingnotitie')}}" class="black-text">Bericht<i class="material-icons right">insert_comment</i></a>
            </li>
        </ul>
        <ul id="portfolioLeerling" class="dropdown-content">
            <li>
                <a href="{{route('leerlingportfolio')}}" class="black-text">Bekijken <i class="material-icons right">photo_album</i></a>
            </li>
        </ul>
        <!-- dropdown content Ouders -->
        <ul id="rapportOuder" class="dropdown-content">
            <li>
                <a href="{{route('oudersbekijk')}}" class="black-text">Bekijken<i class="material-icons right">chrome_reader_mode</i></a>
            </li>
        </ul>
        <ul id="portfolioOuder" class="dropdown-content">
            <li>
                <a href="{{route('oudersportfolio')}}" class="black-text">Bekijken<i class="material-icons right">photo_album</i></a>
            </li>
        </ul>
        <!-- dropdown content Beheerders -->
        <ul id="beheergebruiker" class="dropdown-content">
            <li>
                <a class="dropdown-button black-text" data-activates="beheergebruiker1">Toevoegen</a>
            </li>
            <li>
                <a class="dropdown-button black-text" data-activates="beheergebruiker2">Aanpassen</a>
            </li>
        </ul>
        <ul id="beheergebruiker1" class="dropdown-content secondDropDownAdmin">
            <li>
                <a href="{{route('importleerling')}}" class="black-text">Leerlingen toevoegen</a>
            </li>
            <li>
                <a href="{{route('importleerkracht')}}" class="black-text">Leerkracht toevoegen</a>
            </li>
        </ul>
        <ul id="beheergebruiker2" class="dropdown-content secondDropDownAdmin">
            <li>
                <a href="{{route('getgroep')}}" class="black-text">Leerlingen aanpassen</a>
            </li>
            <li>
                <a href="{{route('getleerkracht')}}" class="black-text">Leerkracht aanpassen</a>
            </li>
        </ul>
        <ul id="beheerLK" class="dropdown-content">
            <li>
                <a href="{{route('importvak')}}" class="black-text">Toevoegen</a>
            </li>
            <li>
                <a href="{{route('aanpassenvak')}}" class="black-text">Aanpassen</a>
            </li>
        </ul>
        <ul id="beheerGroep" class="dropdown-content">
            <li>
                <a href="{{route('aanpassengroep')}}" class="black-text">Beheren</a>
            </li>

        </ul>
        <ul id="usernameLeerkracht" class="dropdown-content">
            <li style="min-width: 170x">
                <a href="{{route('pending')}}" class="black-text">Link Bevestigen
                    <i class="material-icons right">thumbs_up_down</i>
                </a>
            </li>
            <li style="min-width: 170x">
                <a href="{{route('profile')}}" class="black-text">Instellingen
                    <i class="material-icons right">build</i>
                </a>
            </li>
            <li style="min-width: 170px">
                <a href="{{route('logout')}}" class="red-text">Uitloggen
                    <i class="material-icons right">exit_to_app</i>
                </a>
            </li>
        </ul>
        <!-- dropdown content Alle gebruikers -->
        <ul id="username" class="dropdown-content">
            <li style="min-width: 170x">
                <a href="{{route('profile')}}" class="black-text">Instellingen
                    <i class="material-icons right">build</i>
                </a>
            </li>
            <li style="min-width: 170px">
                <a href="{{route('logout')}}" class="red-text">Uitloggen
                    <i class="material-icons right">exit_to_app</i>
                </a>
            </li>
        </ul>
    </div>

    <!-- Einde dropdown content -->
    <div class="container" style="width: 80%">
        <div class="row">
            <div class="col s4">
                <a href="{{route('home')}}" class="brand-logo">
                    <img class="responsive-img" src="{{asset('img/Rapportfoliologo.png')}}" width="300px">
                </a>
            </div>
            <!-- Menu Leraren -->
            <div class="col s8">
                <nav class="card pink">
                    <div class="nav-wrapper @if(Auth::guest())center @endif ">
                        @if(Auth::guest())
                            <b>Welkom bij het RapportFolio</b>



                        @elseif(Auth::user()->hasrole('leerkracht'))
                            <a href="#" data-activates="mobile-demo" class="button-collapse">
                                <i class="material-icons">menu</i>
                            </a>
                            <div class="dropbox">
                                <ul class="left hide-on-med-and-down">
                                    @if(Auth::user()->getLeerkrachtgroep() > 2)
                                        <li style="min-width:150px">
                                            <a class="dropdown-button" data-activates="rapport">Rapport
                                                <i class="material-icons right">arrow_drop_down</i>
                                            </a>
                                        </li>
                                    @endif
                                    <li style="min-width:150px">
                                        <a class="dropdown-button" data-activates="portfolio">Portfolio
                                            <i class="material-icons right">arrow_drop_down</i>
                                        </a>
                                    </li>
                                    <li style="min-width: 170px">
                                        <a class="dropdown-button" type="button" id="dropdownMenuButton"
                                           data-toggle="dropdown" data-activates="usernameLeerkracht" style="min-width: 200px ">
                                            {{ Auth::user()->getLeerkrachtnaam()}}
                                            <i class="material-icons right">arrow_drop_down</i>
                                        </a>

                                </ul>
                            </div>
                    </div>


                    <!-- Move the sidenav outside of .navbar-fixed -->

                    <ul class="side-nav black-text" id="mobile-demo">
                        <li>Rapport</li>
                        <li class="devider" tabindex="-1"></li>
                        <li>
                            <a href="#" class="black-text">Invullen</a>
                        </li>
                        <li class="devider " tabindex="-1"></li>
                        <div style="margin-left: 25px">
                            <li>
                                <a href="{{route('kiesvak')}}" class="black-text">Rapport</a>
                            </li>
                            <li>
                                <a href="{{route('knapinvullennamen')}}" class="black-text">Knap</a>
                            </li>
                            <li>
                                <a href="{{route('notitie')}}" class="black-text">Notitie</a>
                            </li>
                        </div>
                        <li>
                            <a href="{{route('bekijken')}}" class="black-text">Bekijken</a>
                        </li>
                        <li>
                            <a href="{{route('wijzig')}}" class="black-text">Wijzig</a>
                        </li>
                        <li class="devider" tabindex="-1"></li>
                        <li>Portfolio</li>
                        <li class="devider" tabindex="-1"></li>
                        <li>
                            <a href="{{route('invoegennamen')}}" class="black-text">Invullen</a>
                        </li>
                        <li>
                            <a href="{{route('portbekijk')}}" class="black-text">Bekijken</a>
                        </li>
                        <li class="devider" tabindex="-1"></li>
                        <li>{{ Auth::user()->getLeerkrachtnaam()}}</li>
                        <li class="devider" tabindex="-1"></li>
                        <li>
                            <a href="{{route('profile')}}" class="black-text">Instellingen
                                <i class="material-icons right">build</i>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('logout')}}" class="red-text">Uitloggen
                                <i class="material-icons right">exit_to_app</i>
                            </a>
                        </li>

                    </ul>


                    <!-- Menu Kinderen -->
                    @elseif(Auth::user()->hasrole('leerling'))
                        <a href="#!" class="brand-logo"></a>
                        <a href="#" data-activates="mobile-demo" class="button-collapse">
                            <i class="material-icons">menu</i>
                        </a>
                        <div class="dropbox">
                            <ul class="left hide-on-med-and-down">

                                <li style="min-width:150px">
                                    <a class="dropdown-button" data-activates="rapportLeerling">Rapport
                                        <i class="material-icons right">arrow_drop_down</i>
                                    </a>
                                </li>
                                <li style="min-width:150px">
                                    <a class="dropdown-button" data-activates="portfolioLeerling">Portfolio
                                        <i class="material-icons right">arrow_drop_down</i>
                                    </a>
                                </li>
                                <li style="min-width: 170px">
                                    <a class="dropdown-button" type="button" id="dropdownMenuButton"
                                       data-toggle="dropdown" data-activates="username">
                                        {{ Auth::user()->getLeerlingnaam()}}
                                        <i class="material-icons right">arrow_drop_down</i>
                                    </a>

                            </ul>
                        </div>
                </nav>


                <!-- Move the sidenav outside of .navbar-fixed -->

                <ul class="side-nav" id="mobile-demo">
                    <li>Rapport</li>
                    <li class="devider" tabindex="-1"></li>
                    <li>
                        <a href="#" class="black-text">Invullen</a>
                    </li>
                    <div style="margin-left: 25px">
                        <li>
                            <a href="{{route('leerlingkiezen')}}" class="black-text">Knap</a>
                        </li>
                        <li>
                            <a href="{{route('leerlingnotitie')}}" class="black-text">Opmerking</a>
                        </li>
                    </div>
                    <li>
                        <a href="{{route('getjaar')}}" class="black-text">Bekijken</a>
                    </li>
                    <li class="devider" tabindex="-1"></li>
                    <li>Portfolio</li>
                    <li class="devider" tabindex="-1"></li>
                    <li>
                        <a href="{{route('leerlingportfolio')}}" class="black-text">Bekijken</a>
                    </li>
                    <li class="devider" tabindex="-1"></li>
                    <li>{{ Auth::user()->getLeerlingnaam()}}</li>
                    <li class="devider" tabindex="-1"></li>
                    <li>
                        <a href="{{route('profile')}}" class="black-text">Instellingen
                            <i class="material-icons right">build</i>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('logout')}}" class="red-text">Uitloggen
                            <i class="material-icons right">exit_to_app</i>
                        </a>
                    </li>

                </ul>

                <!-- Menu Ouders -->
                @elseif(Auth::user()->hasrole('ouder'))
                    <a href="#!" class="brand-logo"></a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse">
                        <i class="material-icons">menu</i>
                    </a>
                    <div class="dropbox">
                        <ul class="left hide-on-med-and-down">
                            <li style="min-width:150px">
                                <a class="dropdown-button" data-activates="rapportOuder">Rapport @if(Auth::user()->CheckNieuweRapportenOuder() > 0) <span class="new badge pink darken-2">{{Auth::user()->CheckNieuweRapportenOuder()}}</span> @endif
                                    <i class="material-icons right">arrow_drop_down</i>
                                </a>
                            </li>
                            <li style="min-width:150px">
                                <a class="dropdown-button" data-activates="portfolioOuder">Portfolio
                                    <i class="material-icons right">arrow_drop_down</i>
                                </a>
                            </li>
                            <li style="min-width: 170px">
                                <a class="dropdown-button" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                   data-activates="username">
                                    {{ Auth::user()->getOudernaam()}}
                                    <i class="material-icons right">arrow_drop_down</i>
                                </a>

                        </ul>
                    </div>

                    <!-- Move the sidenav outside of .navbar-fixed -->

                    <ul class="side-nav black-text" id="mobile-demo">
                        <li>Rapport</li>
                        <li class="devider" tabindex="-1"></li>
                        <li>
                            <a href="{{route('oudersbekijk')}}" class="black-text">Bekijken</a>
                        </li>
                        <li class="devider" tabindex="-1"></li>
                        <li>Portfolio</li>
                        <li class="devider" tabindex="-1"></li>
                        <li>
                            <a href="{{route('oudersportfolio')}}" class="black-text">Bekijken</a>
                        </li>
                        <li class="devider" tabindex="-1"></li>
                        <li>{{ Auth::user()->getOudernaam()}}</li>
                        <li class="devider" tabindex="-1"></li>
                        <li>
                            <a href="{{route('profile')}}" class="black-text">Instellingen
                                <i class="material-icons right">build</i>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('logout')}}" class="red-text">Uitloggen
                                <i class="material-icons right">exit_to_app</i>
                            </a>
                        </li>

                    </ul>
                    <!-- Menu Beheer -->
                @elseif(Auth::user()->hasrole('admin'))
                    <a href="#!" class="brand-logo"></a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse">
                        <i class="material-icons">menu</i>
                    </a>
                    <div class="dropbox">
                        <ul class="left hide-on-med-and-down">

                            <li>
                                <a class="dropdown-button" data-activates="beheergebruiker">Gebruikers
                                    <i class="material-icons right">arrow_drop_down</i>
                                </a>
                            </li>
                            <li>
                                <a style="width: 120px" class="dropdown-button" data-activates="beheerLK">Vak
                                    <i class="material-icons right">arrow_drop_down</i>
                                </a>
                            </li>
                            <li>
                                <a style="width: 120px" class="dropdown-button" data-activates="beheerGroep">Groep
                                    <i class="material-icons right">arrow_drop_down</i>
                                </a>
                            </li>
                            <li style="min-width: 170px; display: block">
                                <a class="dropdown-button" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                   data-activates="username">
                                    {{ Auth::user()->getAdminnaam()}}
                                    <i class="material-icons right">arrow_drop_down</i>
                                </a>

                        </ul>
                    </div>

                    <!-- Move the sidenav outside of .navbar-fixed  Mobiele menu-->

                    <ul class="side-nav black-text" id="mobile-demo">
                        <li>Gebruikers</li>
                        <li class="devider" tabindex="-1"></li>
                        <li>
                            <a href="#" class="black-text">Toevoegen</a>
                        </li>
                        <div style="margin-left: 25px">
                            <li>
                                <a href="{{route('importleerling')}}" class="black-text">Leerlingen toevoegen</a>
                            </li>
                            <li>
                                <a href="{{route('importleerkracht')}}" class="black-text">Leerkracht toevoegen</a>
                            </li>
                        </div>
                        <li>
                            <a href="#" class="black-text">Aanpassen</a>
                        </li>
                        <div style="margin-left: 25px">
                            <li>
                                <a href="{{route('getgroep')}}" class="black-text">Leerlingen aanpassen</a>
                            </li>
                            <li>
                                <a href="{{route('getleerkracht')}}" class="black-text">Leerkracht aanpassen</a>
                            </li>
                        </div>
                        <li class="devider" tabindex="-1"></li>
                        <li>Vak</li>
                        <li class="devider" tabindex="-1"></li>
                        <li>
                            <a href="{{route('importvak')}}" class="black-text">Toevoegen</a>
                        </li>
                        <li>
                            <a href="{{route('aanpassenvak')}}" class="black-text">Aanpassen</a>
                        </li>
                        <li class="devider" tabindex="-1"></li>
                        <li>Groep</li>
                        <li class="devider" tabindex="-1"></li>
                        <li>
                            <a href="{{route('aanpassengroep')}}" class="black-text">Beheren</a>
                        </li>
                        <li class="devider" tabindex="-1"></li>
                        <li>{{ Auth::user()->getAdminnaam()}}</li>
                        <li class="devider" tabindex="-1"></li>
                        <li>
                            <a href="{{route('profile')}}" class="black-text">Instellingen
                                <i class="material-icons right">build</i>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('logout')}}" class="red-text">Uitloggen
                                <i class="material-icons right">exit_to_app</i>
                            </a>
                        </li>

                    </ul>
                @endif


            </div>
        </div>
        @yield('content')

    </div>
</main>
<!-- Footer -->
<footer class="page-footer pink">
    <div class="container">
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2017 - {{date('Y')}} Windesheim Flevoland & Polsstok
            <a class="grey-text text-lighten-4 right" href="http://www.polsstok.nl">Polsstok.nl</a>
        </div>
    </div>
</footer>
<script src="{{asset('js/custom.js')}}"></script>
</body>