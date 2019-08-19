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
                            <span class="white-text center-align"><h3>Groep toevoegen</h3>
            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <form method="post" action="{{route('addgroep')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="input-field col s6">
                                <input name="groepnaam" id="groepnaam" type="text" class="validate" required>
                                <label for="groepnaam">Groepnaam</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <select name="groepjaar" class="option-color" id="groepjaar">
                                    <option value="" disabled selected>Kies een Leerjaar</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="van school">van school</option>
                                </select>
                            <label for="groepjaar">Groepjaar</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 right-align">
                                <input class="btn pink" id="submit" type="submit" value="Toevoegen">
                                <label for="submit"></label>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


@endsection
