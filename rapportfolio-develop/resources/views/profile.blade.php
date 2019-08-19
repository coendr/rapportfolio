@extends('layouts.app') @section('content')

    <div class="row center-align">
        <div class="col s12">
            <div class="card-panel white">
                @isset($wachtwoorderror)
                    <div class="red card-panel white-text">
                        <span class="closebtn">&times;</span>
                        {{$wachtwoorderror}}
                    </div>
                @endisset
                @isset($wachtwoordsucces)
                    <div class="green card-panel white-text">
                        <span class="closebtn">&times;</span>
                        {{$wachtwoordsucces}}
                    </div>
                @endisset
                @if(session()->has('succes'))
                    <div class="green card-panel white-text">
                        <span class="closebtn">&times;</span>
                        {{session('succes')}}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="red card-panel white-text">
                        <span class="closebtn">&times;</span>
                        {{session('error')}}
                    </div>
                @endif
                <form action="{{route('changepassword')}}" method="post">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="card-panel pink">
                                <div class="white-text">
                                    <h3>Wachtwoord Wijzigen</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">lock_outline</i>
                                    <input class="form-control" type="password" name="oldpassword" id="oldpassword">
                                    <label for="oldpassword">Oud wachtwoord</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">lock</i>
                                    <input class="form-control" type="password" name="newpassword" id="newpassword">
                                    <label for="newpassword">Nieuw wachtwoord</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">lock</i>
                                    <input class="form-control" type="password" name="password_confirmation"
                                           id="password_confirmation">
                                    <label for="password_confirmation">Herhaal nieuw wachtwoord</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="left-align">
                                    <button class="btn pink" type="submit">Opslaan</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                </div>
                            </div>
                </form>

                @if(Auth::user()->HasRole('leerling'))
                    <div class="row center-align">
                        <div class="col s12 m12 l12">
                            <div class="card-panel pink">
                                <div class="white-text">
                                    <h3>Kind en Ouder linken</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <center>
                            <a onclick="myCode()" class="btn pink">
                                Laat code zien</a>
                            <div id="code"><br>
                                <b>Uw link code:<br> {{$leerling->leerlingid}}</b>
                            </div>
                        </center>
                    </div>
                    @if(isset($naam))

                        <div class="row center-align">
                            <b>Gelinkte ouders/verzorgers</b>
                            @foreach($naam as $n)
                                <br>
                                {{$n->voornaam}} {{$n->tussenvoegsel}} {{$n->achternaam}}
                            @endforeach

                        </div>
                    @endif
            </div>
            @endif
            @if(Auth::user()->HasRole('ouder'))
                <div class="row center-align">
                    <div class="col s12 m12 l12">
                        <div class="card-panel pink">
                            <div class="white-text">
                                <h3>Kind linken</h3>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col s6 offset-s3 center-align">
                                <center>
                                    <form action="{{route('link')}}" method="post">
                                        Wat is de code van uw kind?
                                        <input id="leerlinglink" type="text" name="leerlinglink">
                                        <label for="leerlinglink"></label>
                                        {{csrf_field()}}
                                        <button type="submit" class="btn pink"> kind toevoegen</button>


                                    </form>
                                </center>
                            </div>
                        </div>
                    </div>
                    @if(isset($naam))
                        <div class="row">
                            <b>Gelinkt kind(eren)</b>
                            <br>
                            @foreach($naam as $naam)
                                {{$naam->voornaam}} {{$naam->tussenvoegsel}} {{$naam->achternaam}}
                                <a class="red-text" href="{{route('unlinkouder',$naam->leerlingid)}}"><i
                                            class="material-icons">delete</i></a><br>
                            @endforeach
                        </div>
                </div>
            @endif
            @endif
        </div>

        @if(Auth::user()->HasRole('ouder'))
            <div class="row center-align">
                <div class="col s12 m12 l12">
                    <div class="card-panel pink">
                        <div class="white-text">
                            <h3>Account verwijderen</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <center>
                    <a class="waves-effect waves-light btn pink modal-trigger" href="#modal1">Account verwijderen</a>

                    <div id="modal1" class="modal">
                        <div class="modal-content">
                            <h5>Weet u zeker dat u uw account wilt verwijderen?</h5>
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-close waves-effect waves-green btn red">Nee</a>
                            <a href="{{route('verwijderouder',$ouderid->ouderid)}}"
                               class="modal-close waves-effect waves-green btn green">Ja</a>
                        </div>
                    </div>
                </center>
            </div>
        @endif
    </div>
@endsection