@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div style="padding-bottom: 100px" class="card-panel white">
                @isset($wachtwoorderror)
                    <div class="red card-panel white-text">
                        <span class="closebtn">&times;</span>
                        {{$wachtwoorderror}}
                    </div>
                @endisset
                @isset($succes)
                    <div class="green card-panel white-text">
                        <span class="closebtn">&times;</span>
                        {{$succes}}
                    </div>
                @endisset
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card-panel pink">
            <span class="white-text center-align"><h3>Notitie Invullen </h3><br><h5>Rapport 1</h5>
            </span>
                        </div>
                    </div>
                </div>

                <form action="{{route('notinsert1', $leerling->leerlingid)}}" method="post">
                    {{csrf_field()}}

                    <table class="bordered">
                        <tr>
                            <th>Leerling</th>
                            <th>Notitie</th>
                        </tr>
                        <tr>
                            <td>
                                {{$leerling->voornaam}} {{$leerling->tussenvoegsel}} {{$leerling->achternaam}}
                            </td>
                            <td>
                                <div class="row">
                                    <div class="input-field col s12 m12 l12">
                                            <textarea id="textarea2" name="notitie"
                                                      class="materialize-textarea"
                                                      data-length="120" required></textarea>
                                        <label for="textarea2">notitie</label>
                                    </div>
                                </div>

                            </td>

                        </tr>
                    </table>
                    <div style="margin-top: 30px" class="right align">
                            <button class="btn waves-effect waves-light pink" type="submit" name="submit">Verzend
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                </form>

            </div>
        </div>
    </div>



@endsection
