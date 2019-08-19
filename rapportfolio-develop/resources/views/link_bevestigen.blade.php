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
                            <h4>Ouder leerling link bevestigen </h4>
                        </span>
                        </div>

                        <table>
                            <tr>
                                <th>Leerling</th>
                                <th>ouder</th>
                                <th>accepteren</th>
                                <th>verwijderen</th>
                            </tr>
                        @foreach($links as $l)
                            {{--<a href="{{route('acceptLink', $l->leerling_ouder_pendingid)}}">Bevestig link voor {{$l->leerlingid->voornaam}} {{$l->leerlingid->tussenvoegsel}} {{$l->leerlingid->achternaam}}</a>--}}
                            <tr>
                                <td>{{$l->leerlingid->voornaam}} {{$l->leerlingid->tussenvoegsel}} {{$l->leerlingid->achternaam}}</td>
                                <td>{{$l->ouderid->voornaam}} {{$l->ouderid->tussenvoegsel}} {{$l->ouderid->achternaam}}</td>
                                <td><a class="waves-effect waves-light btn modal-trigger green" href="#modal1"><i class="material-icons prefix">check</i>accepteren</a</td>
                                <td><a class="waves-effect waves-light btn modal-trigger red" href="#modal2"><i class="material-icons prefix">delete</i>verwijderen</a</td>


                            </tr>
                                <div id="modal1" class="modal">
                                    <div class="modal-content">
                                        <h4>Ouder aan leerling koppelen</h4>
                                        <p>Weet u zeker dat u {{$l->leerlingid->voornaam}} {{$l->leerlingid->tussenvoegsel}} {{$l->leerlingid->achternaam}} aan {{$l->ouderid->voornaam}} {{$l->ouderid->tussenvoegsel}} {{$l->ouderid->achternaam}} wilt koppelen?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{route('acceptLink', $l->leerling_ouder_pendingid)}}" class="btn green white-text"><i class="material-icons prefix">check</i>accepteren</a>
                                        <a href="{{route('pending')}}" class="btn red white-text"><i class="material-icons prefix">check</i>niet accepteren</a>
                                    </div>
                                </div><div id="modal2" class="modal">
                                    <div class="modal-content">
                                        <h4>Ouder aan leerling koppelen verwijderen</h4>
                                        <p>Weet u zeker dat u {{$l->leerlingid->voornaam}} {{$l->leerlingid->tussenvoegsel}} {{$l->leerlingid->achternaam}} en {{$l->ouderid->voornaam}} {{$l->ouderid->tussenvoegsel}} {{$l->ouderid->achternaam}} niet wilt koppelen?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{route('rejectLink', $l->leerling_ouder_pendingid)}}" class="btn red white-text"><i class="material-icons prefix">delete</i>Verwijderen</a>
                                        <a href="{{route('pending')}}" class="btn red white-text">terug</a>
                                    </div>
                                </div>
                                
                            <br>
                        @endforeach
                        </table>
                        <br>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection