<html>
    <head>
        <title>
            Rapport 1
        </title>
        <link rel="stylesheet" type="text/css" href="{{asset('css/pdf.css')}}">
    </head>

    <body>

    {{--Pagina 1--}}
        <div class="row">
            <img src="{{asset('img/Rapportfoliologo.png')}}" width="200px">
        </div>

        {{--Rapport 1 cijferlijst--}}
        <div class="row">
            @if(!empty($cijfer))
                <h2><span>Rapport van {{$leerling->voornaam}} {{$leerling->tussenvoegsel}} {{$leerling->achternaam}}</span></h2>
                <table width="400">
                    <tr>
                        <th>Vaknaam:</th>
                        <th>Resultaat:</th>
                    </tr>

                    @foreach($cijfer1 as $c1)
                        <tr>
                            <td>{{$c1->naam}}</td>
                            <td>{{$c1->cijfer}}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>

        {{--Rapport 1 notitie--}}
        <div class="row">
            @if(!empty($notitie1->notitie))
                <h1><span>Notitie rapport 1</span></h1>
                <br>
                <b>Leerkracht:</b><br>
                {{ $notitie1->notitie }}
                <br><br>
                <b>Leerling:</b><br>
                {{$notitie1->notitie_leerling}}
            @endif
        </div>

    {{--Pagina 2--}}
        <div class="page-break"></div>

        {{--Rapport 1 knap--}}
        <div class="row">
            @if($check1 != null && $check1->kind != null)
                <table class="bordered" width="500">
                    <tr>
                        <th>Zelfknap:</th>
                        <th>Leerling:</th>
                        <th>Leerkracht:</th>
                    </tr>
                    @foreach($zelfknap1 as $z1)

                        <tr>
                            <td>{{$z1->naam}}</td>
                            <td><img src="{{public_path('img/'. $z1->kind)}}"></td>
                            @if($z1->leerkracht != null)
                                <td><img src="{{public_path('img/'. $z1->leerkracht)}}"></td>
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
                    @foreach($mensknap1 as $m1)
                        <tr>
                            <td>{{$m1->naam}}</td>
                            <td><img src="{{public_path('img/'. $m1->kind)}}"></td>
                            <td><img src="{{public_path('img/'. $m1->leerkracht)}}"></td>
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
                    @foreach($werkknap1 as $w1)
                        <tr>
                            <td>{{$w1->naam}}</td>
                            <td><img src="{{public_path('img/'. $w1->kind)}}"></td>
                            <td><img src="{{public_path('img/'. $w1->leerkracht)}}"></td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </body>
</html>