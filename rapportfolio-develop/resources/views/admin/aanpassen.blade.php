@extends('layouts.app') @section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel white">
                @isset($error)
                    <div class="green card-panel white-text">
                        <span class="closebtn">&times;</span>
                        {{$error}}
                    </div>
                @endisset
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
            <span class="white-text center-align"><h3>Groep kiezen</h3><br><h5>Om een leerling aan te passen</h5>
            </span>
                        </div>
                    </div>
                </div>
                <table>
                    <tr>
                    <th>groep A</th>
                    <th>groep B</th>
                    </tr>

                    <tr>
                        @foreach($groep3 as $g3)
                            <td><a href="{{route('getleerling',$g3->groepid)}}"
                                   class="btn waves-effect waves-light pink">{{$g3->naam}}</a></td>

                        @endforeach
                    </tr>
                    <tr>
                        @foreach($groep4 as $g4)

                            <td><a href="{{route('getleerling',$g4->groepid)}}"
                                   class="btn waves-effect waves-light pink">{{$g4->naam}}</a></td>

                        @endforeach
                    </tr>
                    <tr>
                        @foreach($groep5 as $g5)

                            <td><a href="{{route('getleerling',$g5->groepid)}}"
                                   class="btn waves-effect waves-light pink">{{$g5->naam}}</a></td>

                        @endforeach
                    </tr>
                    <tr>
                        @foreach($groep6 as $g6)

                            <td><a href="{{route('getleerling',$g6->groepid)}}"
                                   class="btn waves-effect waves-light pink">{{$g6->naam}}</a></td>

                        @endforeach
                    </tr>
                    <tr>
                        @foreach($groep7 as $g7)

                            <td><a href="{{route('getleerling',$g7->groepid)}}"
                                   class="btn waves-effect waves-light pink">{{$g7->naam}}</a></td>

                        @endforeach
                    </tr>
                    <tr>
                        @foreach($groep8 as $g8)

                            <td><a href="{{route('getleerling',$g8->groepid)}}"
                                   class="btn waves-effect waves-light pink">{{$g8->naam}}</a></td>

                        @endforeach
                    </tr>
                </table>
            </div>
        </div>
    </div>


@endsection
