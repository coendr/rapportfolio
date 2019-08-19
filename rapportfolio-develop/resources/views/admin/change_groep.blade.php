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
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card-panel pink">
                            <span class="white-text center-align">
                                <h3>Groepen overzetten</h3>
                            </span>
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                <div class="card-panel red">
                    <span class="white-text"><i class="material-icons small left">error</i>Nog niet alle groepen zijn aangepast.</span>
                </div>
                @endif
                <div class="row">
                    <div class="col s12">
                        <form method="post" action="{{route('overzettengroep')}}" class="col s12">
                            {{csrf_field()}}
                            <table>
                                <tr>
                                    <th>Oude groep naam</th>
                                    <th>Nieuwe groep naam</th>
                                </tr>
                                @foreach($groepen as $groep)
                                    <tr>
                                        <td>
                                            <input class="black-text" name="oudenaam{{$groep->groepid}}" id="oudenaam{{$groep->groepid}}" readonly value="{{$groep->naam}}">
                                            <input name="oudid[{{$groep->naam}}]" type="hidden" value="{{$groep->groepid}}">
                                        </td>
                                        <td>
                                            <label for="groepnaam[{{$groep->groepid}}]"></label>
                                            <select name="groepnaam[{{$groep->groepid}}]" class="option-color" id="groepnaam[{{$groep->groepid}}]">
                                                <option disabled selected>kies een groep</option>
                                                @foreach($groepen as $g)
                                                    <option value="{{$g->groepid}}"  {{ old("groepnaam.$groep->groepid") == "$g->groepid" ? 'selected='.'"'.'selected'.'"' : '' }}>{{$g->naam}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="row">
                                <input class="btn pink" id="submit" type="submit" value="Overzetten">
                                <label for="submit"></label>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
