@extends('layouts.app') @section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel white">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card-panel pink">
            <span class="white-text center-align"><h3>Rapport Bekijken</h3><br><h5>Kies een Jaar</h5>
            </span>
                        </div>
                    </div>
                </div>
                <div class="collection">


                    @foreach($jaar  as $j)
                        <h5><b><a href="{{URL::route('bekijkrap',[$id,$j->jaar])}}"
                               class="collection-item pink-text center-align">
                                    {{$j->jaar}}
                                </a></b>
                        </h5>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
