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
                @isset($succes)
                    <div class="green card-panel white-text">
                        <span class="closebtn">&times;</span>
                        {{$succes}}
                    </div>
                @endisset


                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card-panel pink">
            <span class="white-text center-align"><h3>Rapport Invullen</h3><br><h5>Kies een vak</h5>
            </span>
                        </div>
                    </div>
                </div>
                <table>

                    @foreach($vakken as $v)

                        @if($v->groep == $groepnaam->groep)
                            <tr>
                                <td>{{$v->naam}}</td>

                                <td>
                                    @if(Auth::user()->hasrole('leerkracht'))
                                        @if(\App\Http\Controllers\CijferController::CheckVakIngevuld1($v->vakid) == 1)
                                            <a href="#" class="btn disabled">Dit vak is al ingevuld</a>
                                        @else
                                            <a href="{{route('invullen1',$v->vakid)}}" class="btn waves-effect waves-light pink">Invullen rapport 1</a>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                     @if(Auth::user()->hasrole('leerkracht'))
                                        @if(\App\Http\Controllers\CijferController::CheckVakIngevuld2($v->vakid) == 1)
                                            <a href="#" class="btn disabled">Dit vak is al ingevuld</a>
                                        @else
                                            <a href="{{route('invullen2',$v->vakid)}}" class="btn waves-effect waves-light pink">Invullen rapport 2</a>
                                        @endif
                                    @endif
                                </td>

                            </tr>
                        @endif

                    @endforeach

                </table>
            </div>

        </div>
    </div>
@endsection
