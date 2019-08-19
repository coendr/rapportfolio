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
            <span class="white-text center-align"><h3>Notitie Invullen</h3><br><h5>Kies een leerling en een rapport</h5>
            </span>
                        </div>
                    </div>
                </div>

                <table>
                    @foreach($leerlingen as $l)
                        <tr>
                            <td>{{$l->voornaam}} {{$l->tussenvoegsel}} {{$l->achternaam}}</td>
                            @if(\App\Http\Controllers\NotitieController::CheckNotitie1Ingevuld($l->leerlingid) == 1)
                                <td><a href="#" class="btn disabled">Notitie is ingevuld</a></td>
                            @else
                                <td><a href="{{route('notinvullen1',$l->leerlingid)}}"
                                       class="btn waves-effect waves-light pink">Invullen rapport 1</a></td>
                            @endif
                            @if(\App\Http\Controllers\NotitieController::CheckNotitie2Ingevuld($l->leerlingid) == 1)
                                <td><a href="#" class="btn disabled">Notitie is ingevuld</a></td>
                            @else
                                <td><a href="{{route('notinvullen2',$l->leerlingid)}}"
                                       class="btn waves-effect waves-light pink">Invullen rapport 2</a></td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>


@endsection
