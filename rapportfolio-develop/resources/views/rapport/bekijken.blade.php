@extends('layouts.app') @section('content')
    <div class="row">
        <div class="col s12">
            <div class="card-panel white">
                @isset($succes)
                    <div class="green card-panel white-text">
                        <span class="closebtn">&times;</span>
                        {{$succes}}
                    </div>
                @endisset
                <div class="row center-align">
                    <div class="col s12 ">
                        <div class="card-panel pink center-align">
                        <span class="white-text">
                            <h3>Rapport van {{$leerling->voornaam}} {{$leerling->tussenvoegsel}} {{$leerling->achternaam}}</h3>
                        </span>
                        </div>
                    </div>
                    <div class="hide-on-small-and-down">
                        @if(auth::user()->hasrole('leerling')) @if($ouderbekeken->ouder_bekeken == '0')
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="card-panel red">
                                <span class="white-text">Nog niet bekeken door papa of mama
                                </span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="card-panel green">
                                <span class="white-text">Rapport laatst bekeken door papa of mama op {{$ouderbekeken->ouder_bekeken}}
                                </span>
                                    </div>
                                </div>
                            </div>
                        @endif @endif @if(auth::user()->hasrole('ouder')) @if($leerlingbekeken->leerling_bekeken == '0')
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="card-panel red">
                                <span class="white-text">Rapport nog niet bekeken door {{$leerling->voornaam}}.
                                </span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="card-panel green">
                                <span class="white-text">Rapport laatst bekeken door {{$leerling->voornaam}}
                                    op {{$leerlingbekeken->leerling_bekeken}}.
                                </span>
                                    </div>
                                </div>
                            </div>
                        @endif @endif
                        @if(auth::user()->hasrole('leerkracht')) @if($leerlingbekeken->leerling_bekeken == '0')
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="card-panel red">
                                <span class="white-text"><i class="material-icons left">visibility_off</i>Rapport nog niet bekeken door {{$leerling->voornaam}}
                                    .
                                </span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="card-panel green">
                                <span class="white-text"><i class="material-icons left">visibility</i>Rapport laatst bekeken door {{$leerling->voornaam}}
                                    op {{$leerlingbekeken->leerling_bekeken}}.
                                </span>
                                    </div>
                                </div>
                            </div>
                        @endif @if($ouderbekeken->ouder_bekeken == '0')
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="card-panel red">
                                <span class="white-text"><i class="material-icons left">visibility_off</i> Nog niet bekeken door de ouders/verzorgers van {{$leerling->voornaam}}
                                </span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="card-panel green">
                                <span class="white-text"><i class="material-icons left">visibility</i>Rapport laatst bekeken door de ouders/verzorgers van {{$leerling->voornaam}}
                                    op {{$ouderbekeken->ouder_bekeken}}
                                </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @endif

                        <div class="row">
                            @if(!empty($cijfer))
                                <div class="col s6">
                                    <div class="card pink ">
                                        <div class="card-content white-text">
                                            <span class="card-title center-align">Rapport 1</span>
                                            <table class="bordered white-text">
                                                <tr>
                                                    <th>Vaknaam:</th>
                                                    <th>Resultaat 1:</th>
                                                </tr>
                                                @foreach($cijfer1 as $c1)
                                                    <tr>
                                                        <td>{{$c1->naam}}</td>
                                                        <td>
                                                            @if($c1->cijfer == 'o') Onvoldoende
                                                            @elseif($c1->cijfer == "m") Matig
                                                            @elseif($c1->cijfer == "v") Voldoende
                                                            @elseif($c1->cijfer == "rv") Ruim Voldoende
                                                            @elseif($c1->cijfer == "g") Goed
                                                            @endif
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if(auth::user()->hasrole('leerkracht'))
                            @endif
                            @if(!empty($check3))
                                <div class="col s6">
                                    <div class="card  pink">
                                        <div class="card-content white-text">
                                            <span class="card-title center-align">Rapport 2</span>
                                            <table class="bordered white-text">
                                                <tr>
                                                    <th>Vaknaam:</th>
                                                    <th>Resultaat 2:</th>
                                                </tr>
                                                @foreach($cijfer2 as $c2)
                                                    <tr>
                                                        <td>{{$c2->naam}}</td>
                                                        <td>
                                                            @if($c2->cijfer == 'o') Onvoldoende
                                                            @elseif($c2->cijfer == "m") Matig
                                                            @elseif($c2->cijfer == "v") Voldoende
                                                            @elseif($c2->cijfer == "rv") Ruim Voldoende
                                                            @elseif($c2->cijfer == "g") Goed
                                                            @endif
                                                        </td>
                                                    </tr>

                                                @endforeach

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- einde rapportkaarten -->
                        <div class="row">
                            @if(!empty($notitie1->notitie))
                                <div class="col s6">
                                    <div class="card pink ">
                                        <div class="card-content white-text">
                                            <span class="card-title center-align">Notitie 1</span>
                                            <b>Leerkracht:</b>
                                            <br>
                                            <div style="word-wrap: break-word;">{{ $notitie1->notitie }}</div>
                                            <br>
                                            <br>
                                            <b>Leerling:</b>
                                            <br>
                                            <div style="word-wrap: break-word;">{{$notitie1->notitie_leerling}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endif @if(isset($notitie2->notitie))
                                <div class="col s6">
                                    <div class="card pink">
                                        <div class="card-content white-text">
                                            <span class="card-title center-align">Notitie 2</span>
                                            <b>Leerkracht:</b>
                                            <div style="word-wrap: break-word;">{{ $notitie2->notitie }}</div>
                                            <br>
                                            <br>
                                            <b>Leerling:</b>
                                            <br>
                                            <div style="word-wrap: break-word;">{{$notitie2->notitie_leerling}}</div>
                                        </div>
                                    </div>
                                </div>

                            @else @endif
                        </div>
                        <div class="row">
                            @if($check1 != null && $check1->kind != null)
                                <div class="col s6">
                                    <div class="card pink">
                                        <div class="card-content white-text">
                                            <span class="card-title center-align">Knap 1</span>
                                            <table class="bordered white-text">
                                                <tr>
                                                    <th>Zelfknap:</th>
                                                    <th>Leerling:</th>
                                                    <th>Leerkracht:</th>
                                                </tr>
                                                @foreach($zelfknap1 as $z1)
                                                    <tr>
                                                        <td>{{$z1->naam}}</td>
                                                        <td>
                                                            <img src="{{asset('img/'.$z1->kind)}}">
                                                        </td>
                                                        @if($z1->leerkracht != null)
                                                            <td>
                                                                <img src="{{asset('img/'.$z1->leerkracht)}}">
                                                            </td>
                                                        @endif

                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th>Mensknap:</th>
                                                    <th>Leerling:</th>
                                                    <th>Leerkracht:</th>
                                                </tr>
                                                @foreach($mensknap1 as $m1)
                                                    <tr>
                                                        <td>{{$m1->naam}}</td>
                                                        <td>
                                                            <img src="{{asset('img/'.$m1->kind)}}">
                                                        </td>
                                                        <td>
                                                            <img src="{{asset('img/'.$z1->leerkracht)}}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th>Werkknap:</th>
                                                    <th>Leerling:</th>
                                                    <th>Leerkracht:</th>
                                                </tr>
                                                @foreach($werkknap1 as $w1)
                                                    <tr>
                                                        <td>{{$w1->naam}}</td>
                                                        <td>
                                                            <img src="{{asset('img/'.$w1->kind)}}">
                                                        </td>
                                                        <td>
                                                            <img src="{{asset('img/'.$w1->leerkracht)}}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif @if($check2 != null && $check2->kind != null)
                                <div class="col s6">
                                    <div class="card pink ">
                                        <div class="card-content white-text">
                                            <span class="card-title center-align">Knap 2</span>
                                            <table class="bordered white-text">
                                                <tr>
                                                    <th>Zelfknap:</th>
                                                    <th>Leerling:</th>
                                                    <th>Leerkracht:</th>
                                                </tr>
                                                @foreach($zelfknap2 as $z2)
                                                    <tr>
                                                        <td>{{$z2->naam}}</td>
                                                        <td>
                                                            <img src="{{asset('img/'.$z2->kind)}}">
                                                        </td>
                                                        @if($z2->leerkracht != null)
                                                            <td>
                                                                <img src="{{asset('img/'.$z2->leerkracht)}}">
                                                            </td>
                                                        @endif

                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th>Mensknap:</th>
                                                    <th>Leerling:</th>
                                                    <th>Leerkracht:</th>
                                                </tr>
                                                @foreach($mensknap2 as $m2)
                                                    <tr>
                                                        <td>{{$m2->naam}}</td>
                                                        <td>
                                                            <img src="{{asset('img/'.$m2->kind)}}">
                                                        </td>
                                                        <td>
                                                            <img src="{{asset('img/'.$m2->leerkracht)}}">
                                                        </td>

                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th>Werkknap:</th>
                                                    <th>Leerling:</th>
                                                    <th>Leerkracht:</th>
                                                </tr>
                                                @foreach($werkknap2 as $w2)
                                                    <tr>
                                                        <td>{{$w2->naam}}</td>
                                                        <td>
                                                            <img src="{{asset('img/'.$w2->kind)}}">
                                                        </td>
                                                        <td>
                                                            <img src="{{asset('img/'.$w2->leerkracht)}}">
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            {{--{{dd($notitie1)}}--}}
                            @if(!empty($notitie1))
                                @if(isset($cijfer) &&  isset($check1) && isset($notitie1->notitie))
                                    <div class="col s6">
                                        <a class="btn waves-effect waves-light pink"
                                           href={{route( 'pdfrap1', [ 'leerlingid'=>$leerling->leerlingid, 'jaar'=>$notitie1->jaar])}}>
                                            <i class="material-icons left">print</i> Printen Rapport 1
                                        </a>
                                    </div>
                                @endif
                            @endif

                            @if(!empty($notitie2))
                                @if(isset($cijfer2) &&  isset($check3) && isset($notitie2->notitie))
                                    <div class="col s6">
                                        <a class="btn waves-effect waves-light pink"
                                           href={{route( 'pdfrap2', [ 'leerlingid'=>$leerling->leerlingid, 'jaar'=>$notitie2->jaar])}}>
                                            <i class="material-icons left">print</i> Printen Rapport 2
                                        </a>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>


                    <!--- ,Dit is for like mobiel -->
                    <div class="hide-on-med-and-up">
                        <div class="row">
                            @if(!empty($cijfer))
                                <div class="col s12">
                                    <div class="card pink ">
                                        <div class="card-content white-text">
                                            <span class="card-title center-align">Rapport 1</span>
                                            <table class="bordered white-text">
                                                <tr>
                                                    <th>Vaknaam:</th>
                                                    <th>Resultaat 1:</th>
                                                </tr>
                                                @foreach($cijfer1 as $c1)
                                                    <tr>
                                                        <td>{{$c1->naam}}</td>
                                                        <td>{{$c1->cijfer}}</td>
                                                    </tr>

                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif @if(!empty($notitie1->notitie))
                                <div class="col s12">
                                    <div class="card pink ">
                                        <div class="card-content white-text">
                                            <span class="card-title center-align">Notitie 1</span> {{ $notitie1->notitie }}
                                        </div>
                                    </div>
                                </div>
                            @endif @if($check1!= null && $check1->kind != null)
                                <div class="col s12">
                                    <div class="card pink ">
                                        <div class="card-content white-text">
                                            <span class="card-title center-align">Knap 1</span>
                                            <table class="bordered white-text">
                                                <tr>
                                                    <th>Zelfknap:</th>
                                                    <th>Kind::</th>
                                                    <th>Leerkracht:</th>
                                                </tr>
                                                @foreach($zelfknap1 as $z1)
                                                    <tr>
                                                        <td>{{$z1->naam}}</td>

                                                        <td>
                                                            <img src="{{asset('img/'.$z1->kind)}}">
                                                        </td>
                                                        @if($z1->leerkracht != null)
                                                            <td>
                                                                <img src="{{asset('img/'.$z1->leerkracht)}}">
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif @if(!empty($check3))
                                <div class="col s12">
                                    <div class="card  pink">
                                        <div class="card-content white-text">
                                            <span class="card-title center-align">Rapport 2</span>
                                            <table class="bordered white-text">
                                                <tr>
                                                    <th>Vaknaam:</th>
                                                    <th>Resultaat 2:</th>
                                                </tr>
                                                @foreach($cijfer2 as $c2)
                                                    <tr>
                                                        <td>{{$c2->naam}}</td>
                                                        <td>{{$c2->cijfer}}</td>
                                                    </tr>

                                                @endforeach

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif @if(!empty ($notitie2->notitie))
                                <div class="col s12">
                                    <div class="card  pink">
                                        <div class="card-content white-text">
                                            <span class="card-title center-align">Notitie 2</span> {{ $notitie2->notitie}}
                                        </div>
                                    </div>
                                </div>
                            @endif @if($check2!= null && $check2->kind != null)
                                <div class="col s12">
                                    <div class="card pink ">
                                        <div class="card-content white-text">
                                            <span class="card-title center-align">Knap 2</span>
                                            <table class="bordered white-text">
                                                <tr>
                                                    <th>Zelfknap:</th>
                                                    <th>Kind::</th>
                                                    <th>Leerkracht:</th>
                                                </tr>
                                                @foreach($zelfknap2 as $z2)
                                                    <tr>
                                                        <td>{{$z2->naam}}</td>

                                                        <td>
                                                            <img src="{{asset('img/'.$z2->kind)}}">
                                                        </td>
                                                        @if($z2->leerkracht != null)
                                                            <td>
                                                                <img src="{{asset('img/'.$z2->leerkracht)}}">
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>




@endsection