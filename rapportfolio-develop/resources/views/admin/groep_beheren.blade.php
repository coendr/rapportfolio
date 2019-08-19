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
            <span class="white-text center-align"><h3>Groep kiezen</h3><br><h5>Om aan te passen</h5>
            </span>
                        </div>
                    </div>
                </div>
                <table>
                    <tr>
                        <th>groep naam</th>
                        <th>groep jaar</th>
                        <th>aanpassen</th>
                        <th>verwijderen</th>

                    </tr>

                    @foreach($groepen as $g)
                        <tr>
                            <td>{{$g->naam}}</td>
                            <td>{{$g->groep}}</td>
                            <td><a class="black-text" href="{{route('editgroep', $g->groepid)}}"><i
                                            class="material-icons prefix ">edit</i></a></td>
                            <td><a class="modal-trigger red-text" href="#modal1{{$g->groepid}}"><i
                                            class="material-icons prefix ">delete</i></a></td>
                            <!-- Modal Structure -->
                            <div id="modal1{{$g->groepid}}" class="modal">
                                <div class="modal-content">
                                    <h5>Weet u zeker dat u {{$g->naam}} wilt verwijderen uit het systeem? </h5>
                                </div>
                                <div class="modal-footer">
                                    <a href="#!" class="modal-close waves-effect waves-green btn red">Nee</a>
                                    <a href="{{route('deletegroep',$g->groepid)}}"
                                       class="modal-close waves-effect waves-green btn green">Ja</a>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                    <tr>
                        <td>
                            <a href="{{route('toevoegengroep')}}" class="pink btn modal-trigger white-text">
                                <i class="small material-icons left">
                                    add_box
                                </i>Toevoegen
                            </a>
                        </td>
                        <td></td>
                        <td>
                            <a href="{{route('changegroep')}}" class="pink btn modal-trigger white-text">Overzetten groepen</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


@endsection
