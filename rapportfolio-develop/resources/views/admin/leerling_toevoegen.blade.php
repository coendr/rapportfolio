@extends('layouts.app')
@section('content')
    <div class="row center-align">
        <div class="col s12">
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
                            <div class="white-text">
                                <h3>Leerlingen toevoegen</h3>
                            </div>
                        </div><br><br>
                        <form action="{{ route('importleerling') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="file" name="import_file"/><br><br>
                            <button class="btn  pink btn-primary">Importeren</button>
                        </form>
                    </div>
                </div>
            </div>

@endsection
