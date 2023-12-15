<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Constancia</title>
    <style>
        *{
            font-family: Arial, Helvetica, sans-serif;
            margin: 0px;
            padding: 0px;
        }
        body{
            padding-top: 50px;
            padding-left: 80px;
            padding-right: 80px;
            position: relative;
        }
        .row{
            display: block;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .text-center{
            text-align: center;
        }
        .text-start{
            text-align: start;
        }
        .text-end{
            text-align: right;
        }
        .text-justify{
            text-align:justify;
        }
        .fu{
            font-weight: unset;
        }
        .indent{
            text-indent: 40px;
        }
        .color-blue{
            color: blue;
        }
        .fb{
            font-weight: bold;
        }
        .d-inline-block{
            display: inline-block;
        }
        .w-50{
            width: 49.5%;
            margin: 0px;
        }
        h6{
            padding: 0px;
            margin: 0px;
        }
        .paper{
            z-index: 5;
        }
        .aqua{
            z-index: 1;
            top: 370px;
            left: 180px;
            position: absolute;
            width: 430px;
            opacity: .3;
        }
        .footer{
            position: absolute;
            bottom: 50px;
            left: 0px;
            right: 0px;
        }
        .text-italic{
            font-style: italic;
        }
    </style>
</head>
<body>
    <img class="aqua" src="{{public_path().'/assets/img/page.png'}}">
    <div class="paper">
        <div class="row">
            <div class="text-start w-50 d-inline-block">
                <img src="{{public_path().'/assets/img/page.png'}}" width="150">
            </div>
            <div class="text-end w-50 d-inline-block">
                <h6 class="text-end text-italic">Pasaje Felipe Santiago Salaverry</h6>
                <h6 class="text-end text-italic">Mz. D Lote 02 Asociación Víctor Acosta Ríos</h6>
                <h6 class="text-end text-italic">Cel: 976993697</h6>
            </div>
        </div>
        <div class="row">
            <hr class="color-blue">
        </div>
        <div class="row">
            <u><h1 class="text-center fb">CONSTANCIA</h1></u>
        </div>
        <div class="row">
            <h4 class="text-justify">
                EL GERENTE DE LA CONSULTORIA ITEC CON RUC Nº 20564483142 Y ESCRITURA PÚBLICA N° 292 INSCRITA CON PARTIDA N° 11037342 DEL REGISTRO DE PERSONAS JURÍDICAS DE LOS REGISTROS PÚBLICOS.
            </h4>
        </div>
        <div class="row">
            <strong class="">HACE CONSTAR:</strong>
        </div>
        <div class="row">
            <h3 class="text-end fu">
                
            </h3>
            <h3 class="text-justify fu indent">
                Que, <strong class="">{{$user->firstname}} {{$user->lastname }}</strong>, identificado(a) con DNI Nº {{$user->document}}, 
                @if($event->end >= $today) 
                está estudiando
                @else
                ha participado en 
                @endif
                @if($event->modality == 1) el curso @endif
                @if($event->modality == 2) el taller @endif
                @if($event->modality == 3) el diplomado @endif
                @if($event->modality == 4) la especialización @endif
                de <strong>{{$event->title }}</strong>, en la modalidad virtual, 
                @if($event->end >= $today) 
                el cual se está ddesarrollando desde el {{date("d", strtotime($event->start))}} de {{$text[(int) date("m", strtotime($event->start))]}} del {{date("Y", strtotime($event->start))}} al {{date("d", strtotime($event->end))}} de {{$text[(int) date("m", strtotime($event->end))]}} del {{date("Y", strtotime($event->end))}}
                @else
                desarrollado desde el {{date("d", strtotime($event->start))}} de {{$text[(int) date("m", strtotime($event->start))]}} del {{date("Y", strtotime($event->start))}} al {{date("d", strtotime($event->end))}} de {{$text[(int) date("m", strtotime($event->end))]}} del {{date("Y", strtotime($event->end))}}; considerándose 
                <strong>{{($participation->note > 10) ? 'APROBADO' : 'DESAPROBADO' }}</strong>; tal como consta en el registro de calificaciones de nuestra 
                Institución Tecnológica de Capacitación Profesional,
                perteneciente a la Consultoría ITEC.
                @endif
            </h3>
        </div>
        <div class="row">
            @if($transaction && $transaction->type > 1)
            <h3 class="text-center fu">
                El certificado correspondiente se encuentra en proceso de trámite.
            </h3>
            @endif
        </div>
        <div class="row">
            <h3 class="text-justify indent fu">
                Se expide la presente constancia a solicitud del interesado, para los fines que estime por conveniente.
            </h3>
        </div>
        <div class="row">
            <h3 class="text-end fu">
                Abancay, {{date("d", strtotime($today))}} de {{$text[(int) date("m", strtotime($today))]}} del {{date("Y", strtotime($today))}}.
            </h3>
        </div>
        <div class="row">
            <h3 class="fu">
                Atentamente,
            </h3>
        </div>
        <div class="footer" style="padding-left: 80px;padding-right: 80px;">
            <div class="row">
                <hr>
            </div>
            <h6 class="text-center text-italic">Pasaje Felipe Santiago Salaverry</h6>
            <h6 class="text-center text-italic">Mz. D Lote 02 Asociación Víctor Acosta Ríos</h6>
            <h6 class="text-center text-italic">Abancay – Apurímac - Perú</h6>
        </div>
    </div>
</body>
</html>