@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div style="padding-bottom: 30px" class="card-panel white">
            @if ($errors->any())
            <div class="card-panel red">
                <span class="white-text"><i style="margin-bottom: 20px" class="material-icons left">error</i>Nog niet alles is ingevuld. Check of alles is ingevuld!</span>
            </div>
            @endif

                <form action="{{route('invullenknapleerling1',$id)}} " method="post">
                {{csrf_field()}}

                <!-- Eerste tabel mensknap-->
                    <div class="row">
                        <div class="col s12 ">
                            <div class="card-panel pink center-align">
                <span class="white-text"><h3>Zelfknap</h3>
                </span>
                            </div>
                        </div>
                    </div>
                    <table class="bordered">
                        <tr>
                            <th></th>
                            <th><img src={{asset('img/plantje_klein.png')}}></th>
                            <th><img src={{asset('img/plantje_middel.png')}}></th>
                            <th><img src={{asset('img/plantje_groot.png')}}></th>
                        </tr>

                        @foreach($zelfknap as $zknap)
                            <tr>
                                <td>{{$zknap->naam}}</td>

                                @foreach($cijfer as $c)
                                    <td><input name="zelfknap[{{$zknap->knapid}}]" type="checkbox"
                                               id="{{$c}}{{$zknap->knapid}}"
                                               value="{{$c}}" {{ old("zelfknap.$zknap->knapid") == "$c" ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                        <label for="{{$c}}{{$zknap->knapid}}"></label></td>
                                @endforeach
                            </tr>
                        @endforeach
                    </table>

                    <div class="divider"></div>
                    <!-- Tweede tabel mensknap-->
                    <div class="row">
                        <div class="col s12 ">
                            <div class="card-panel pink center-align">
                <span class="white-text"><h3>Mensknap</h3>
                </span>
                            </div>
                        </div>
                    </div>
                    <table class="bordered">
                        <tr>
                            <th></th>
                            <th><img src={{asset('img/plantje_klein.png')}}></th>
                            <th><img src={{asset('img/plantje_middel.png')}}></th>
                            <th><img src={{asset('img/plantje_groot.png')}}></th>
                        </tr>

                        @foreach($mensknap as $m)
                            <tr>
                                <td>{{$m->naam}}</td>

                                @foreach($cijfer as $c)
                                    <td><input name="mensknap[{{$m->knapid}}]" type="checkbox"
                                               id="{{$c}}{{$m->knapid}}"
                                               value="{{$c}}" {{ old("mensknap.$m->knapid") == "$c" ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                        <label for="{{$c}}{{$m->knapid}}"></label></td>
                                @endforeach
                            </tr>
                        @endforeach
                    </table>

                    <!-- Derde tabel werkknap-->
                    <div class="row">
                        <div class="col s12 ">
                            <div class="card-panel pink center-align">
                <span class="white-text"><h3>Werkknap</h3>
                </span>
                            </div>
                        </div>
                        <table class="bordered">
                            <tr>
                                <th></th>
                                <th class="center-align"><img src={{asset('img/plantje_klein.png')}}></th>
                                <th class="center-align"><img src={{asset('img/plantje_middel.png')}}></th>
                                <th class="center-align"><img src={{asset('img/plantje_groot.png')}}></th>
                            </tr>

                            @foreach($werkknap as $w)
                                <tr>
                                    <td>{{$w->naam}}</td>

                                    @foreach($cijfer as $c)
                                        <td><input name="werkknap[{{$w->knapid}}]" type="checkbox"
                                                   id="{{$c}}{{$w->knapid}}"
                                                   value="{{$c}}" {{ old("werkknap.$w->knapid") == "$c" ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                            <label for="{{$c}}{{$w->knapid}}"></label></td>
                                    @endforeach
                                </tr>
                                @endforeach
                        </table>

                        <input type="hidden" name="id" value="{{ $id }}">
                        <div style="margin-top: 30px" class="right align">
                            <button class="btn waves-effect waves-light pink" type="submit" name="submit">Verzend
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>



@endsection
