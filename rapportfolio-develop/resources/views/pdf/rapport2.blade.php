<html>
    <head>
        <title>
            Rapport 2
        </title>
        <link rel="stylesheet" type="text/css" href="{{asset('css/pdf.css')}}">
    </head>

    <body>

        {{--Pagina 1--}}
        <div class="row">
            <img src="{{asset('img/Rapportfoliologo.png')}}" width="200px">
        </div>

        {{--Rapport 2 cijferlijst--}}
        <div class="row">
            @if(!empty($check3))
                <h2><span>Rapport van {{$leerling->voornaam}} {{$leerling->tussenvoegsel}} {{$leerling->achternaam}}</span></h2>
                <table width="400">
                    <tr>
                        <th>Vaknaam:</th>
                        <th>Resultaat:</th>
                    </tr>

                    @foreach($cijfer2 as $c2)
                        <tr>
                            <td>{{$c2->naam}}</td>
                            <td>{{$c2->cijfer}}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>

        {{--Rapport 2 notitie--}}
        <div class="row">
            @if(!empty($notitie2->notitie))
                <h1><span>Notitie 2</span></h1>
                <br>
                <b>Leerkracht:</b><br>
                {{ $notitie2->notitie }}
                <br><br>
                <b>Leerling:</b><br>
                {{$notitie2->notitie_leerling}}
            @endif
        </div>

        {{--Pagina 2--}}
        <div class="page-break"></div>

        {{--Rapport 1 knap--}}
        <div class="row">
            @if($check2 != null && $check2->kind != null)
                <h1><span>Knap 2</span></h1>
                <br>
                <table class="bordered" width="500">
                    <tr>
                        <th>Zelfknap:</th>
                        <th>Leerling:</th>
                        <th>Leerkracht:</th>
                    </tr>
                    @foreach($zelfknap2 as $z2)
                        <tr>
                            <td>{{$z2->naam}}</td>
                            <td><img src="{{public_path('img/'. $z2->kind)}}"></td>
                            @if($z2->leerkracht != null)
                                <td><img src="{{public_path('img/'. $z2->leerkracht)}}"></td>
                            @endif
                        </tr>
                    @endforeach
                </table>

                {{--Pagina 3--}}
                <div class="page-break"></div>
                <table class="bordered" width="500">
                    <tr>
                        <th>Mensknap:</th>
                        <th>Leerling:</th>
                        <th>Leerkracht:</th>
                    </tr>
                    @foreach($mensknap2 as $m2)
                        <tr>
                            <td>{{$m2->naam}}</td>
                            <td><img src="{{public_path('img/'. $m2->kind)}}"></td>
                            <td><img src="{{public_path('img/'. $m2->leerkracht)}}"></td>
                        </tr>
                    @endforeach
                </table>

                {{--Pagina 4--}}
                <div class="page-break"></div>
                <table class="bordered" width="500">
                    <tr>
                        <th>Werkknap:</th>
                        <th>Leerling:</th>
                        <th>Leerkracht:</th>
                    </tr>
                    @foreach($werkknap2 as $w2)
                        <tr>
                            <td>{{$w2->naam}}</td>
                            <td><img src="{{public_path('img/'. $w2->kind)}}"></td>
                            <td><img src="{{public_path('img/'. $w2->leerkracht)}}"></td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </body>
</html>