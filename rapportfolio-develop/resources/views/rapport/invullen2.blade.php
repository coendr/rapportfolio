@extends('layouts.app') @section('content')
<div class="row">
    <div class="col s12 m12 l12">
        <div class="card-panel white" style="padding-bottom: 100px">
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card-panel pink">
                        <span class="white-text center-align">
                            <h3>{{$vak->naam}}</h3>
                            <br>
                            <h5>Rapport 2</h5>
                        </span>
                    </div>
                </div>
            </div>
            @if ($errors->any())
            <div class="card-panel red">
                <span class="white-text"><i style="margin-bottom: 20px" class="material-icons left">error</i>Voor dit vak zijn nog niet alle resultaten ingevuld. Controleer of alles is ingevuld.</span>
            </div>
            @endif

            <form action="{{route('invullen2',$id)}} " method="post">
                {{csrf_field()}}

                <table class="bordered">
                    <tr>
                        <th>Leerling</th>
                        <th>Onvoldoende</th>
                        <th>Matig</th>
                        <th>Voldoende</th>
                        <th>Ruim Voldoende</th>
                        <th>Goed</th>
                    </tr>
                    @foreach($leerlingen as $leerling)
                    <tr>
                        <td>
                            {{$leerling->voornaam}} {{$leerling->tussenvoegsel}} {{$leerling->achternaam}}
                        </td>
                        @foreach($cijfer as $c)
                        <td>
                            <input type="checkbox" name="cijfer[{{$leerling->leerlingid}}]" id="{{$c}}{{$leerling->leerlingid}}" value="{{$c}}" {{ old("cijfer.$leerling->leerlingid") == "$c" ? 'checked='.'"'.'checked'.'"' : '' }}>
                            <label for="{{$c}}{{$leerling->leerlingid}}"></label>
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                    <input name="vaknaam" type="hidden" value="{{$vak->naam}}">
                    <input name="klascount" type="hidden" value="{{count($leerlingen)}}">
                </table>
                <div style="margin-top: 30px" class="right align">
                    <button class="btn waves-effect waves-light pink" type="submit" name="submit">Verzend
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection