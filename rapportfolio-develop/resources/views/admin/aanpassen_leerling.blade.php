@extends('layouts.app') @section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel white">
                @isset($error)
                    <div class="green card-panel white-text">
                        <span class="closebtn">&times;</span>
                        {{$error}}
                    </div>
                @endisset
                @if(session()->has('error'))
                    <div class="red card-panel white-text">
                        <span class="closebtn">&times;</span>
                        {{session('error')}}
                    </div>
                @endif
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card-panel pink">
                            <span class="white-text center-align"><h3>Leerling aanpassen</h3>
            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <form method="post" action="{{route('aanpassenleerling',$leerling->leerlingid)}}" class="col s12">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="input-field col s5">
                                <input name="voornaam" id="voornaam" type="text" class="validate"
                                       value="{{$leerling->voornaam}}" required>
                                <label for="voornaam">Voornaam</label>
                            </div>
                            <div class="input-field col s2">
                                <input name="tussenvoegsel" id="tussenvoegsel" type="text" class="validate"
                                       value="{{$leerling->tussenvoegsel}}">
                                <label for="tussenvoegsel">Tussenvoegsel</label>
                            </div>
                            <div class="input-field col s5">
                                <input name="achternaam" id="achternaam" type="text" class="validate"
                                       value="{{$leerling->achternaam}}" required>
                                <label for="achternaam">Achternaam</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <select name="groep" class="option-color">
                                    <option value="{{$leerling->groepid}}" >{{$leerling->naam}}</option>
                                    @foreach($groepid as $g)
                                        <option class="black-text" value="{{$g->groepid}}">{{$g->naam}}</option>
                                    @endforeach

                                </select>
                                <label>Groep</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 left-align">
                                <a href="{{route('getgroep')}}" class="btn pink">Terug</a>
                            </div>
                            <input type="hidden" name="userid" value="{{$leerling->id}}">
                            <div class="col s6 right-align">
                                <input class="btn pink" id="submit" type="submit" value="Aanpassen">
                                <label for="submit"></label>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


@endsection
