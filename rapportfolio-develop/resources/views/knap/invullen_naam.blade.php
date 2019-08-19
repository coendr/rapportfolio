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
            <span class="white-text center-align"><h3>Knap Invullen</h3><br><h5>Kies een leerling en een rapport</h5>
            </span>
                        </div>
                    </div>
                </div>

                <table>
                    <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Rapport 1</th>
                        <th>Leerling heeft knap ingevuld?</th>
                        <th>Rapport 2</th>
                        <th>Leerling heeft knap ingevuld?</th>
                    </tr>
                    </thead>
                    @foreach($leerlingen as $l)
                        <tr>
                            <td>{{$l->voornaam}} {{$l->tussenvoegsel}} {{$l->achternaam}}</td>

                            <td>
                                @if(Auth::user()->hasrole('leerkracht'))
                                    @if(\App\Http\Controllers\KnapController::CheckKnapIngevuld($l->leerlingid, 'rapport 1', 'leerkracht') == true)
                                        <a href="#" class="btn disabled" style="font-size: 14.5px">Knap ingevuld</a>
                                        <br>
                                        Leerling kan nu knap invullen.
                                    @else
                                        <a href="{{route('knapinvullenleerkracht1',$l->leerlingid)}}"
                                           class="btn waves-effect waves-light pink">Invullen rapport 1</a>
                                    @endif
                                @endif
                            </td>
                            <td class="center-align">
                                @if(Auth::user()->hasrole('leerkracht'))
                                    @if(\App\Http\Controllers\KnapController::CheckKnapIngevuld($l->leerlingid, 'rapport 1', 'kind') == true)
                                        <i class="material-icons green-text">check_circle_outline</i>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if(Auth::user()->hasrole('leerkracht'))
                                    @if(\App\Http\Controllers\KnapController::CheckKnapIngevuld($l->leerlingid, 'rapport 2', 'leerkracht') == true)
                                        <a href="#" class="btn disabled" style="font-size: 14.5px">Knap is
                                            ingevuld</a>
                                        <br>Leerling kan nu knap invullen.
                                    @else
                                        <a href="{{route('knapinvullenleerkracht2',$l->leerlingid)}}"
                                           class="btn waves-effect waves-light pink">Invullen rapport 2</a>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if(Auth::user()->hasrole('leerkracht'))
                                    @if(\App\Http\Controllers\KnapController::CheckKnapIngevuld($l->leerlingid, 'rapport 2', 'kind') == true)
                                        <i class="material-icons green-text">check_circle_outline</i>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>


@endsection
