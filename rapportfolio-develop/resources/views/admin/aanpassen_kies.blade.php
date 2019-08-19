@extends('layouts.app') @section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel white">
                @if(session()->has('error'))
                    <div class="red card-panel white-text">
                        <span class="closebtn">&times;</span>
                        {{session('error')}}
                    </div>
                @endif
                @if(session()->has('succes'))
                    <div class="green card-panel white-text">
                        <span class="closebtn">&times;</span>
                        {{session('succes')}}
                    </div>
                @endif
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card-panel pink">
            <span class="white-text center-align"><h3>Leerling  kiezen</h3><br><h5>Om aan te passen</h5>
            </span>
                        </div>
                    </div>
                </div>
                <table>
                    <tr>
                        <th>naam</th>
                        <th>email</th>
                        <th>groep</th>
                        <th>aanpassen</th>
                        <th>wachtwoord resetten</th>
                        <th>verwijderen</th>

                    </tr>


                    @foreach($leerlingen as $l)
                        <tr>
                            <td>{{$l->voornaam}} {{$l->tussenvoegsel}} {{$l->achternaam}}</td>
                            <td>{{$l->email}}</td>
                            <td>{{$groepnaam->naam}}</td>
                            <td><a href="{{route('editleerling', [$groep, $l->leerlingid])}}" class="black-text"><i class="material-icons prefix">edit</i></a></td>
                            <td><a class="modal-trigger orange-text" href="#modal2{{$l->leerlingid}}" ><i class="material-icons prefix">lock</i></a></td>
                            <td><a class="modal-trigger red-text" href="#modal1{{$l->leerlingid}}"><i
                                            class="material-icons prefix ">delete</i></a></td>
                            <!-- Modal Structure -->
                            <div id="modal2{{$l->leerlingid}}" class="modal">
                                <div class="modal-content">
                                    <h5>Weet u zeker dat u het wachtwoord van {{$l->voornaam}} {{$l->tussenvoegsel}} {{$l->achternaam}} wilt resetten? </h5>
                                </div>
                                <div class="modal-footer">
                                    <a href="#!" class="modal-close waves-effect waves-green btn red">Nee</a>
                                    <a href="{{route('forcepasswordleerling', $l->leerlingid)}}" class="modal-close waves-effect waves-green btn green">Ja</a>
                                </div>
                            </div>
                            <div id="modal1{{$l->leerlingid}}" class="modal">
                                <div class="modal-content">
                                    <h5>Weet u zeker dat u {{$l->voornaam}} {{$l->tussenvoegsel}} {{$l->achternaam}} wilt verwijderen uit het systeem? </h5>
                                </div>
                                <div class="modal-footer">
                                    <a href="#!" class="modal-close waves-effect waves-green btn red">Nee</a>
                                    <a href="{{route('verwijderleerling',[$groep,$l->leerlingid])}}" class="modal-close waves-effect waves-green btn green">Ja</a>
                                </div>
                            </div>
                        </tr>
                    @endforeach


                </table>
            </div>
        </div>
    </div>


@endsection
