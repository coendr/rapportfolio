@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col s12">
            <div class="card-panel white">

                @if($errors->any())
                    <div class="red card-panel">
                        @foreach($errors->all() as $error)

                            <span class="closebtn">&times;</span>
                            {{$error}}

                        @endforeach
                    </div>
                @endif
                    @isset($succes)
                        <div class="green card-panel">
                            <span class="closebtn">&times;</span>
                            {{$succes}}
                        </div>
                    @endisset

                <form action="{{route('uploaden', $id)}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <h4 class="header pink-text">Beschrijving:</h4>
                    <input id="uploadnaam" name="uploadnaam" type="text" class="validate" required>
                    <br><br>
                    <div class="file-field input-field">
                        <div class="btn pink">
                            <span><i class="material-icons left">insert_drive_file</i>Bestand</span>
                            <input type="file" id="file" name="file" required>
                        </div>
                        <div class="file-path-wrapper">

                            <input name="oke" class="file-path validate" type="text">
                        </div>
                    </div>
                    <div class="right-align">
                        <div class="btn waves-effect waves-light pink right-align">
                            <i class="material-icons left">cloud_upload</i><input type="submit" value="toevoegen">
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>

@endsection