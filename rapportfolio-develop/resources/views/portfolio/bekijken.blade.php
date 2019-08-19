@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col s12">
            <div class="card-panel white">
                @if(session('succes'))
                    <div class="alert alert-success">
                        <div class="green card-panel white-text">
                            <span class="closebtn">&times;</span>
                            {{session('succes')}}
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col s12 ">
                        <div class="card-panel pink center-align">
                            <span class="white-text"><h3>Portfolio van {{$naam->voornaam}} {{$naam->tussenvoegsel}} {{$naam->achternaam}}</h3></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="hide-on-small-and-down">
                        <div class="col s12">
                            <div class="card pink ">
                                <div class="card-content white-text">
                                    <table class="bordered white-text">
                                        <tr>
                                            <h4>
                                                <th>Naam:</th>
                                                <th>Bestand:</th>
                                                <th></th>
                                            </h4>
                                        </tr>
                                        @foreach($portfolio as $p)
                                            <tr>
                                                <td><h5>{{$p->naam}}</h5></td>
                                                <td>
                                                    <center>
                                                        @if(strpos($p->path, 'pdf'))
                                                            <a class="btn waves-effect waves-light white pink-text"
                                                               href="{{asset('storage/img/'.$p->path)}}"
                                                               download="{{$p->path}}">Download</a>
                                                        @endif
                                                        @if(strpos($p->path, 'jpg') or strpos($p->path, 'JPG')
                                                        or strpos($p->path, 'png') or strpos($p->path, 'PNG')
                                                        or strpos($p->path, 'jpeg') or strpos($p->path, 'JPEG')
                                                        or strpos($p->path, 'gif') or strpos($p->path, 'GIF')
                                                        or strpos($p->path, 'svg') or strpos($p->path, 'SVG'))
                                                            <img class="materialboxed responsive-img"
                                                                 src="{{asset('storage/img/'.$p->path)}}"
                                                                 data-caption="{{$p->naam}}"
                                                                 width="250px"/>
                                                        @endif
                                                    </center>
                                                </td>
                                                @if (Auth::user()->hasrole('leerkracht'))
                                                    <td>
                                                        <a class="btn waves-effect waves-light white pink-text"
                                                           href="{{route('verwijderen', $p->portfolioid)}}">Verwijderen</a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hide-on-med-and-up">
                    <div class="row">
                        <div class="col s12">
                            <div class="card pink ">
                                <div class="card-content white-text">

                                    @foreach($portfolio as $p)
                                        <h5>{{$p->naam}}</h5><br>
                                        @if(strpos($p->path, 'pdf'))
                                            <a class="btn waves-effect waves-light white pink-text"
                                               href="{{asset('storage/img/'.$p->path)}}"
                                               download="{{$p->path}}">Download</a>
                                        @endif
                                        @if(strpos($p->path, 'jpg') or strpos($p->path, 'JPG')
                                        or strpos($p->path, 'png') or strpos($p->path, 'PNG')
                                        or strpos($p->path, 'jpeg') or strpos($p->path, 'JPEG')
                                        or strpos($p->path, 'gif') or strpos($p->path, 'GIF')
                                        or strpos($p->path, 'svg') or strpos($p->path, 'SVG'))
                                            <img class="materialboxed responsive-img"
                                                 src="{{asset('storage/img/'.$p->path)}}"
                                                 data-caption="{{$p->naam}}"
                                                 width="250px"/>
                                        @endif

                                        <br>

                                        @if (Auth::user()->hasrole('leerkracht'))
                                            <br>
                                            <a class="btn waves-effect waves-light white pink-text"
                                               href="{{route('verwijderen', $p->portfolioid)}}">Verwijderen</a><br><br>
                                        @endif
                                        <div class="divider"></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var elem = document.querySelector('.materialboxed');
        var instance = M.Materialbox.init(elem, options);
    </script>
@endsection