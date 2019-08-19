@extends('layouts.app') @section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel white">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card-panel pink">
            <span class="white-text center-align"><h3>Rapport Bekijken</h3><br><h5>Kies een leerling</h5>
            </span>
                        </div>
                    </div>
                </div>
                <div class="collection">
                    @foreach($leerlingen  as $l)
                        <h5><b><a href="{{route('jaar', $l->leerlingid)}}"
                                  class="collection-item pink-text center-align">
                                    {{$l->voornaam}} {{$l->tussenvoegsel}} {{$l->achternaam}}
                                </a></b>
                        </h5>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
