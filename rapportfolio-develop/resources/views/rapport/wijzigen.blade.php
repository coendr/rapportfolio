@extends('layouts.app') @section('content')
    <div class="row hide-on-small-only">
        <div class="col s12">
            <div class="card-panel white">
                @if ($errors->any()) @foreach ($errors->all() as $error)
                    <div class="row">
                        <div class="col s12">
                            <div class="card-panel red">
            <span class="white-text">{{ $error }}
            </span>
                            </div>
                        </div>
                    </div>
                @endforeach @endif
                <form action=# method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs">
                                <li class="tab col s6">
                                    <b>
                                        <a class="active" href="#test1">Rapport 1</a>
                                    </b>
                                </li>
                                <li class="tab col s6">
                                    <b>
                                        <a href="#test2">Rapport 2</a>
                                    </b>
                                </li>
                            </ul>
                        </div>
                        <div id="test1" class="col s12">
                            @if($rid1 == null)
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <div class="card-panel red">
                  <span class="white-text">Rapport 1 is nog niet aangemaakt voor deze leerling en kan daarom niet gewijzigd worden.
                  </span>
                                        </div>
                                    </div>
                                </div>
                            @else @if(empty($zelfknap1[0]))
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <div class="card-panel red">
                  <span class="white-text">Knap is voor deze leerling nog niet ingevuld.
                  </span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col s12 ">
                                        <div class="card-panel pink center-align">
                  <span class="white-text">
                    <h3>Zelfknap</h3>
                  </span>
                                        </div>
                                    </div>
                                </div>
                                <table class="bordered">
                                    <tr>
                                        <th></th>
                                        <th>
                                            <img src={{asset( 'img/plantje_klein.png')}}>
                                        </th>
                                        <th>
                                            <img src={{asset( 'img/plantje_middel.png')}}>
                                        </th>
                                        <th>
                                            <img src={{asset( 'img/plantje_groot.png')}}>
                                        </th>
                                    </tr>

                                    @foreach($zelfknap1 as $zknap1)
                                        <tr>
                                            <td>{{$zknap1->naam}}</td>

                                            <td>
                                                <input name="zelfknap[{{$zknap1->knapid}}]" type="checkbox"
                                                       id="z0{{$zknap1->knapid}}" value="plantje_klein.png"
                                                        {{ $zknap1->leerkracht=='plantje_klein.png' ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                                <label for="z0{{$zknap1->knapid}}"></label>
                                            </td>
                                            <td>
                                                <input name="zelfknap[{{$zknap1->knapid}}]" type="checkbox"
                                                       id="z1{{$zknap1->knapid}}" value="plantje_middel.png"
                                                        {{ $zknap1->leerkracht=='plantje_middel.png' ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                                <label for="z1{{$zknap1->knapid}}"></label>
                                            </td>
                                            <td>
                                                <input name="zelfknap[{{$zknap1->knapid}}]" type="checkbox"
                                                       id="z2{{$zknap1->knapid}}" value="plantje_groot.png"
                                                        {{ $zknap1->leerkracht=='plantje_groot.png' ? 'checked='.'"'.'checked'.'"' : '' }} />
                                                <label for="z2{{$zknap1->knapid}}"></label>
                                            </td>
                                    @endforeach
                                </table>

                                <div class="divider"></div>
                                <!-- Tweede tabel mensknap-->
                                <div class="row">
                                    <div class="col s12 ">
                                        <div class="card-panel pink center-align">
                  <span class="white-text">
                    <h3>Mensknap</h3>
                  </span>
                                        </div>
                                    </div>
                                </div>
                                <table class="bordered">
                                    <tr>
                                        <th></th>
                                        <th>
                                            <img src={{asset( 'img/plantje_klein.png')}}>
                                        </th>
                                        <th>
                                            <img src={{asset( 'img/plantje_middel.png')}}>
                                        </th>
                                        <th>
                                            <img src={{asset( 'img/plantje_groot.png')}}>
                                        </th>
                                    </tr>

                                    @foreach($mensknap1 as $m)
                                        <tr>
                                            <td>{{$m->naam}}</td>

                                            <td>
                                                <input name="mensknap[{{$m->knapid}}]" type="checkbox"
                                                       id="m0{{$m->knapid}}" value="plantje_klein.png" {{
                    $m->leerkracht=='plantje_klein.png' ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                                <label for="m0{{$m->knapid}}"></label>
                                            </td>
                                            <td>
                                                <input name="mensknap[{{$m->knapid}}]" type="checkbox"
                                                       id="m1{{$m->knapid}}" value="plantje_middel.png" {{
                    $m->leerkracht=='plantje_middel.png' ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                                <label for="m1{{$m->knapid}}"></label>
                                            </td>
                                            <td>
                                                <input name="mensknap[{{$m->knapid}}]" type="checkbox"
                                                       id="m2{{$m->knapid}}" value="plantje_groot.png" {{
                    $m->leerkracht=='plantje_groot.png' ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                                <label for="m2{{$m->knapid}}"></label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>

                                <!-- Derde tabel werkknap-->
                                <div class="row">
                                    <div class="col s12 ">
                                        <div class="card-panel pink center-align">
                  <span class="white-text">
                    <h3>Werkknap</h3>
                  </span>
                                        </div>
                                    </div>
                                    <table class="bordered">
                                        <tr>
                                            <th></th>
                                            <th class="center-align">
                                                <img src={{asset( 'img/plantje_klein.png')}}>
                                            </th>
                                            <th class="center-align">
                                                <img src={{asset( 'img/plantje_middel.png')}}>
                                            </th>
                                            <th class="center-align">
                                                <img src={{asset( 'img/plantje_groot.png')}}>
                                            </th>
                                        </tr>

                                        @foreach($werkknap1 as $w)
                                            <tr>
                                                <td>{{$w->naam}}</td>
                                                <td>
                                                    <input name="werkknap[{{$w->knapid}}]" type="checkbox"
                                                           id="w0{{$w->knapid}}" value="plantje_klein.png"
                                                            {{ $w->leerkracht=='plantje_klein.png' ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                                    <label for="w0{{$w->knapid}}"></label>
                                                </td>
                                                <td>
                                                    <input name="werkknap[{{$w->knapid}}]" type="checkbox"
                                                           id="w1{{$w->knapid}}" value="plantje_middel.png"
                                                            {{ $w->leerkracht=='plantje_middel.png' ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                                    <label for="w1{{$w->knapid}}"></label>
                                                </td>
                                                <td>
                                                    <input name="werkknap[{{$w->knapid}}]" type="checkbox"
                                                           id="w2{{$w->knapid}}" value="plantje_groot.png"
                                                            {{ $w->leerkracht=='plantje_groot.png' ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                                    <label for="w2{{$w->knapid}}"></label>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col s12 ">
                                    <div class="card-panel pink center-align">
                  <span class="white-text">
                    <h3>Methode gebonden resultaten</h3>
                  </span>
                                    </div>
                                </div>
                            </div>
                            <table class="bordered">
                                <tr>
                                    <th>Vaknaam</th>
                                    <th>Onvoldoende</th>
                                    <th>Matig</th>
                                    <th>Voldoende</th>
                                    <th>Ruim Voldoende</th>
                                    <th>Goed</th>
                                </tr>
                                @foreach ($rapport1 as $losseresultaten)
                                    <tr>
                                        <td>{{$losseresultaten->naam}}</td>
                                        <td>
                                            <input name="resultaten[{{$losseresultaten->vakid}}]" type="checkbox"
                                                   id="{{$losseresultaten->vakid}}0"
                                                   value="o" {{ $losseresultaten->cijfer=='o' ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            <label for="{{$losseresultaten->vakid}}0"></label>
                                        </td>
                                        <td>
                                            <input name="resultaten[{{$losseresultaten->vakid}}]" type="checkbox"
                                                   id="{{$losseresultaten->vakid}}1"
                                                   value="m" {{ $losseresultaten->cijfer=='m' ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            <label for="{{$losseresultaten->vakid}}1"></label>
                                        </td>
                                        <td>
                                            <input name="resultaten[{{$losseresultaten->vakid}}]" type="checkbox"
                                                   id="{{$losseresultaten->vakid}}2"
                                                   value="v" {{ $losseresultaten->cijfer=='v' ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            <label for="{{$losseresultaten->vakid}}2"></label>
                                        </td>
                                        <td>
                                            <input name="resultaten[{{$losseresultaten->vakid}}]" type="checkbox"
                                                   id="{{$losseresultaten->vakid}}3"
                                                   value="rv" {{ $losseresultaten->cijfer=='rv' ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            <label for="{{$losseresultaten->vakid}}3"></label>
                                        </td>
                                        <td>
                                            <input name="resultaten[{{$losseresultaten->vakid}}]" type="checkbox"
                                                   id="{{$losseresultaten->vakid}}4"
                                                   value="g" {{ $losseresultaten->cijfer=='g' ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            <label for="{{$losseresultaten->vakid}}4"></label>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <br>
                            <br>
                            <div class="input-field col s12 m12 l12">
                                <textarea name="notitie1" id="textarea1"
                                          class="materialize-textarea">{{$notitie1->notitie}}</textarea>
                                <label for="textarea1">notitie</label>
                            </div>
                            <br> @endif @if($rid1==null)
                                <a href="{{route('wijzig')}}">
                                    <button type="button" class="waves-effect waves-light btn pink">Ga Terug</button>
                                </a>
                            @else
                                <input type="hidden" name="leerlingid" value="{{$id}}">
                                <input type="hidden" name="rapportid1" value="{{$rid1->rapportid}}">
                                <div style="margin-top: 30px" class="right align">
                                    <button class="btn waves-effect waves-light pink" type="submit" name="submit">
                                        Verzend
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                        </div>
                        @endif
                    </div>

                    <!-- rapport 2 tab -->
                    <div id="test2" class="col s12">
                        @if($rid2 == null)
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="card-panel red">
                  <span class="white-text">Rapport 2 is nog niet aangemaakt voor deze leerling en kan daarom niet gewijzigd worden.
                  </span>
                                    </div>
                                </div>
                            </div>
                        @else @if(empty($zelfknap2[0]))
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="card-panel red">
                  <span class="white-text">Knap is voor deze leerling nog niet ingevuld.
                  </span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col s12 ">
                                    <div class="card-panel pink center-align">
                  <span class="white-text">
                    <h3>Zelfknap</h3>
                  </span>
                                    </div>
                                </div>
                            </div>
                            <table class="bordered">
                                <tr>
                                    <th></th>
                                    <th>
                                        <img src={{asset( 'img/plantje_klein.png')}}>
                                    </th>
                                    <th>
                                        <img src={{asset( 'img/plantje_middel.png')}}>
                                    </th>
                                    <th>
                                        <img src={{asset( 'img/plantje_groot.png')}}>
                                    </th>
                                </tr>

                                @foreach($zelfknap2 as $zknap2)
                                    <tr>
                                        <td>{{$zknap2->naam}}</td>

                                        <td>
                                            <input name="zelfknap2[{{$zknap2->knapid}}]" type="checkbox"
                                                   id="z20{{$zknap2->knapid}}" value="plantje_klein.png"
                                                    {{ $zknap2->leerkracht=='plantje_klein.png' ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                            <label for="z20{{$zknap2->knapid}}"></label>
                                        </td>
                                        <td>
                                            <input name="zelfknap2[{{$zknap2->knapid}}]" type="checkbox"
                                                   id="z21{{$zknap2->knapid}}" value="plantje_middel.png"
                                                    {{ $zknap2->leerkracht=='plantje_middel.png' ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                            <label for="z21{{$zknap2->knapid}}"></label>
                                        </td>
                                        <td>
                                            <input name="zelfknap2[{{$zknap2->knapid}}]" type="checkbox"
                                                   id="z22{{$zknap2->knapid}}" value="plantje_groot.png"
                                                    {{ $zknap2->leerkracht=='plantje_groot.png' ? 'checked='.'"'.'checked'.'"' : '' }} />
                                            <label for="z22{{$zknap2->knapid}}"></label>
                                        </td>
                                @endforeach
                            </table>

                            <div class="divider"></div>
                            <!-- Tweede tabel mensknap-->
                            <div class="row">
                                <div class="col s12 ">
                                    <div class="card-panel pink center-align">
                  <span class="white-text">
                    <h3>Mensknap</h3>
                  </span>
                                    </div>
                                </div>
                            </div>
                            <table class="bordered">
                                <tr>
                                    <th></th>
                                    <th>
                                        <img src={{asset( 'img/plantje_klein.png')}}>
                                    </th>
                                    <th>
                                        <img src={{asset( 'img/plantje_middel.png')}}>
                                    </th>
                                    <th>
                                        <img src={{asset( 'img/plantje_groot.png')}}>
                                    </th>
                                </tr>

                                @foreach($mensknap2 as $m2)
                                    <tr>
                                        <td>{{$m2->naam}}</td>

                                        <td>
                                            <input name="mensknap2[{{$m2->knapid}}]" type="checkbox"
                                                   id="m2a{{$m2->knapid}}" value="plantje_klein.png"
                                                    {{ $m2->leerkracht=='plantje_klein.png' ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                            <label for="m2a{{$m2->knapid}}"></label>
                                        </td>
                                        <td>
                                            <input name="mensknap2[{{$m2->knapid}}]" type="checkbox"
                                                   id="m2b{{$m2->knapid}}" value="plantje_middel.png"
                                                    {{ $m2->leerkracht=='plantje_middel.png' ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                            <label for="m2b{{$m2->knapid}}"></label>
                                        </td>
                                        <td>
                                            <input name="mensknap2[{{$m2->knapid}}]" type="checkbox"
                                                   id="m2c{{$m2->knapid}}" value="plantje_groot.png"
                                                    {{ $m2->leerkracht=='plantje_groot.png' ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                            <label for="m2c{{$m2->knapid}}"></label>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            <!-- Derde tabel werkknap-->
                            <div class="row">
                                <div class="col s12 ">
                                    <div class="card-panel pink center-align">
                  <span class="white-text">
                    <h3>Werkknap</h3>
                  </span>
                                    </div>
                                </div>
                                <table class="bordered">
                                    <tr>
                                        <th></th>
                                        <th class="center-align">
                                            <img src={{asset( 'img/plantje_klein.png')}}>
                                        </th>
                                        <th class="center-align">
                                            <img src={{asset( 'img/plantje_middel.png')}}>
                                        </th>
                                        <th class="center-align">
                                            <img src={{asset( 'img/plantje_groot.png')}}>
                                        </th>
                                    </tr>

                                    @foreach($werkknap2 as $w2)
                                        <tr>
                                            <td>{{$w2->naam}}</td>
                                            <td>
                                                <input name="werkknap2[{{$w2->knapid}}]" type="checkbox"
                                                       id="w2a{{$w2->knapid}}" value="plantje_klein.png"
                                                        {{ $w2->leerkracht=='plantje_klein.png' ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                                <label for="w2a{{$w2->knapid}}"></label>
                                            </td>
                                            <td>
                                                <input name="werkknap2[{{$w2->knapid}}]" type="checkbox"
                                                       id="w2b{{$w2->knapid}}" value="plantje_middel.png"
                                                        {{ $w2->leerkracht=='plantje_middel.png' ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                                <label for="w2b{{$w2->knapid}}"></label>
                                            </td>
                                            <td>
                                                <input name="werkknap2[{{$w2->knapid}}]" type="checkbox"
                                                       id="w2c{{$w2->knapid}}" value="plantje_groot.png"
                                                        {{ $w2->leerkracht=='plantje_groot.png' ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                                <label for="w2c{{$w2->knapid}}"></label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col s12 ">
                                <div class="card-panel pink center-align">
                  <span class="white-text">
                    <h3>Methode gebonden resultaten</h3>
                  </span>
                                </div>
                            </div>
                        </div>
                        <table class="bordered">
                            <tr>
                                <th>Vaknaam</th>
                                <th>Onvoldoende</th>
                                <th>Matig</th>
                                <th>Voldoende</th>
                                <th>Ruim Voldoende</th>
                                <th>Goed</th>
                            </tr>
                            @foreach ($rapport2 as $losseresultaten)
                                <tr>
                                    <td>{{$losseresultaten->naam}}</td>
                                    <td>
                                        <input name="resultaten2[{{$losseresultaten->vakid}}]" type="checkbox"
                                               id="mgr2{{$losseresultaten->vakid}}0" value="o" {{
                    $losseresultaten->cijfer=='o' ? 'checked='.'"'.'checked'.'"' : '' }}>
                                        <label for="mgr2{{$losseresultaten->vakid}}0"></label>
                                    </td>
                                    <td>
                                        <input name="resultaten2[{{$losseresultaten->vakid}}]" type="checkbox"
                                               id="mgr2{{$losseresultaten->vakid}}1" value="m" {{
                    $losseresultaten->cijfer=='m' ? 'checked='.'"'.'checked'.'"' : '' }}>
                                        <label for="mgr2{{$losseresultaten->vakid}}1"></label>
                                    </td>
                                    <td>
                                        <input name="resultaten2[{{$losseresultaten->vakid}}]" type="checkbox"
                                               id="mgr2{{$losseresultaten->vakid}}2" value="v" {{
                    $losseresultaten->cijfer=='v' ? 'checked='.'"'.'checked'.'"' : '' }}>
                                        <label for="mgr2{{$losseresultaten->vakid}}2"></label>
                                    </td>
                                    <td>
                                        <input name="resultaten2[{{$losseresultaten->vakid}}]" type="checkbox"
                                               id="mgr2{{$losseresultaten->vakid}}3" value="rv" {{
                    $losseresultaten->cijfer=='rv' ? 'checked='.'"'.'checked'.'"' : '' }}>
                                        <label for="mgr2{{$losseresultaten->vakid}}3"></label>
                                    </td>
                                    <td>
                                        <input name="resultaten2[{{$losseresultaten->vakid}}]" type="checkbox"
                                               id="mgr2{{$losseresultaten->vakid}}4" value="g" {{
                    $losseresultaten->cijfer=='g' ? 'checked='.'"'.'checked'.'"' : '' }}>
                                        <label for="mgr2{{$losseresultaten->vakid}}4"></label>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <br>
                        <br>
                        <div class="input-field col s12 m12 l12">
                            <textarea name="notitie2" id="textarea2"
                                      class="materialize-textarea">{{$notitie2->notitie}}</textarea>
                            <label for="textarea2">notitie</label>
                        </div>
                        <br> @endif @if($rid2==null)
                            <a href="{{route('wijzig')}}">
                                <button type="button" class="waves-effect waves-light btn pink">Ga Terug</button>
                            </a>
                        @else
                            <input type="hidden" name="leerlingid" value="{{$id}}">
                            <input type="hidden" name="rapportid2" value="{{$rid2->rapportid}}">
                            <div style="margin-top: 30px" class="right align">
                                <button class="btn waves-effect waves-light pink" type="submit" name="submit">Verzend
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        @endif
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>

    <div class="hide-on-med-and-up">
        <div class="row">
            <div class="col s12 m5">
                <div class="card-panel red">
        <span class="white-text">Het is op dit moment nog niet mogelijk om cijfers te wijzigen op een mobiel apparaat.
        </span>
                </div>
            </div>
        </div>
    </div>
@endsection