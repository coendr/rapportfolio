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
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card-panel pink">
            <span class="white-text center-align"><h3>Opmerking Invullen</h3><br><h5>Kies een rapport</h5>
            </span>
                        </div>
                    </div>
                </div>

                <table>
                    <tr>
                        <td><a href="{{route('notitieleerling1',$leerlingid->leerlingid)}}"
                               class="btn waves-effect waves-light pink">Invullen rapport 1</a>
                        </td>
                        <td><a href="{{route('notitieleerling2',$leerlingid->leerlingid)}}"
                               class="btn waves-effect waves-light pink">Invullen rapport 2</a></td>
                    </tr>

                </table>
            </div>
        </div>
    </div>


@endsection
