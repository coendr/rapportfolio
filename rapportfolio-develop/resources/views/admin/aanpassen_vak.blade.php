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
                            <span class="white-text center-align"><h3>Vak kiezen</h3><br><h5>Om aan te passen</h5></span>
                        </div>
                    </div>
                </div>

                <table>
                    <tr>
                        <th>Vaknaam</th>
                        <th>Groep</th>
                        <th>aanpassen</th>
                        <th>verwijderen</th>
                    </tr>

                    @foreach($vak as $v)
                        <tr>
                            <td>{{$v->naam}}</td>
                            <td>{{$v->groep}}</td>
                            <td><a href="{{route('editvak', $v->vakid)}}" class="black-text"><i class="material-icons prefix">edit</i></a></td>
                            <td><a class="modal-trigger red-text" href="#modal{{$v->vakid}}"><i
                                            class="material-icons prefix ">delete</i></a></td>
                            <!-- Modal Structure -->
                            <div id="modal{{$v->vakid}}" class="modal">
                                <div class="modal-content">
                                    <h5>Weet u zeker dat u het vak {{$v->naam}} voor groep {{$v->groep}} wilt verwijderen uit het systeem? </h5>
                                </div>
                                <div class="modal-footer">
                                    <a href="#!" class="modal-close waves-effect waves-green btn red">Nee</a>
                                    <a href="{{route('verwijdervak', $v->vakid)}}" class="modal-close waves-effect waves-green btn green">Ja</a>
                                </div>
                            </div>
                        </tr>
                    @endforeach


                </table>
            </div>
        </div>
    </div>


@endsection
