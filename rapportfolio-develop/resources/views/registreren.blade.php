@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel white">
                @if(session()->has('error'))
                    <div class="red card-panel white-text">
                        <span class="closebtn">&times;</span>
                        {{session('error')}}
                    </div>
                @endif

                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card-panel pink">
            <span class="white-text center-align"><h3>Ouder Registeren</h3>
            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <form method="post" action="{{route('registerstore')}}" c class="col s12">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="input-field col s5">
                                <input name="voornaam" id="voornaam" type="text" class="validate" required>
                                <label for="voornaam">Voornaam</label>
                            </div>
                            <div class="input-field col s2">
                                <input name="tussenvoegsel" id="tussenvoegsel" type="text" class="validate">
                                <label for="tussenvoegsel">Tussenvoegsel</label>
                            </div>
                            <div class="input-field col s5">
                                <input name="achternaam" id="achternaam" type="text" class="validate" required>
                                <label for="achternaam">Achternaam</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input name="username" id="username" type="text" class="validate" required>
                                <label for="username">Gebruikersnaam</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input name="password" id="password" type="password" class="validate" required>
                                <label for="password">Password</label>
                            </div>
                            <div class="input-field col s6">
                                <input name="repassword" id="repassword" type="password" class="validate" required>
                                <label for="repassword">Wachtwoord opnieuw</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 left-align">
                                <a href="{{route('login')}}" class="btn pink">Terug</a>
                            </div>
                            <div class="col s6 right-align">
                                <input class="btn pink" id="submit" type="submit" value="Registreren">
                                <label for="submit"></label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection