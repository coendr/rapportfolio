@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="card-panel white">
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
            <span class="white-text center-align"><h3>Opmerking Invullen </h3><br><h5>Rapport 1</h5>
            </span>
                        </div>
                    </div>
                </div>

                <form action="{{route('notitieinvullenleerling1', $leerling->leerlingid)}}" method="post">
                    {{csrf_field()}}

                    <table class="bordered">
                        <tr>
                            <th>Opmerking</th>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="input-field col s12 m12 l12">
                                            <textarea id="textarea2" name="notitie"
                                                      class="materialize-textarea"
                                                      data-length="120"></textarea>
                                        <label for="textarea2">Dit heb ik nog te vertellen</label>
                                    </div>
                                </div>

                            </td>

                        </tr>
                    </table>
                    <input name="submit" type="submit" class="btn waves-effect waves-light pink" value="versturen">
                    <label for="submit"></label>

                </form>

            </div>
        </div>
    </div>



@endsection
