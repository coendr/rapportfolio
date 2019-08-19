@extends('layouts.app') @section('content')
    @if(Auth::guest())
        <div class="row">
            <div class="col s12 m7 l7 offset-m3 offset-l3">
                <div class="card-panel white">
                    @isset($succes)
                        <div class="green card-panel white-text">
                            <span class="closebtn">&times;</span>
                            {{$succes}}
                        </div>
                    @endisset
                        @isset($error)
                            <div class="red card-panel white-text">
                                <span class="closebtn">&times;</span>
                                {{$error}}
                            </div>
                        @endisset
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div class="card pink">
                                <div class="card-content">
                                    <span class="card-title  white-text">Inloggen</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                @if(session()->has('succes'))
                                    <div class="green card-panel white-text">
                                        <span class="closebtn">&times;</span>
                                        {{session('succes')}}
                                    </div>
                                @endif
                            <div class="col s12 m12 l12">
                                @if(session()->has('error'))
                                    <div class="red card-panel white-text">
                                        <span class="closebtn">&times;</span>
                                        {{session('error')}}
                                    </div>
                                @endif

                                <form action="{{route('loggedin')}}" method="post">
                                    <div class="card-panel transparant hoverable">
                                        <div class="row">
                                            <div class="input-field col s12 m12 l12">
                                                <i class="material-icons prefix">account_box</i>
                                                <input class="form-control" type="text" name="username"
                                                       id="gebruikersnaam" required>
                                                <label for="gebruikersnaam">Gebruikersnaam</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12 m12 l12">
                                                <i class="material-icons prefix">lock_outline</i>
                                                <input class="form-control" type="password" name="password"
                                                       id="password" required>
                                                <label for="password">Wachtwoord</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="center-align">
                                        <a href="{{route('register')}}">Registreren als Ouder?</a>
                                    </div>
                                    <div class=" right-align">
                                        <button type="submit" class="btn #e91e63 pink ">Inloggen</button>
                                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
                <meta http-equiv="refresh" content="{{view('landingpage')}}"/>

    @endif

@endsection
