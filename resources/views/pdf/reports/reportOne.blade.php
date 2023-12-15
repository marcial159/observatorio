<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte 01</title>
</head>
<style>
    *
    {
        margin: 0px;
        padding: 0px;
        text-decoration: none;
    }
    body
    {
    font-family: Arial, Helvetica, sans-serif;
     padding: 30px;
     font-size: 9px;
    }
    .head
    {
        width:100%;
    }

    .table
    {
        width:100%;
        border-collapse:collapse;
    }
    .table thead
    {
        background: #2876dc;
        color: white;
    }
    .table th, .table td {
        /* border: solid 1px black */
        border-style: solid;
        border-color: #2876dc;
    }
    .row{
        display: block;
    }
    .text-center{
        text-align: center
    }
</style>
<body>
    <table class="head">
        <tr>
            @if($entity)
                <td style="background-color: #ededed;border: 1px solid #000000; text-align: center;" colspan="9">DESARROLLADO POR {{strtoupper($entity->name) }}</td>   
            @endif
        </tr>
        <tr>
            <td style="background-color: #ededed;border: 1px solid #000000; text-align: center;" colspan="9">{{date("d", strtotime($start))}} DE {{strtoupper($months[(int) date("m", strtotime($start))])}} DEL {{date("Y", strtotime($start))}} al {{date("d", strtotime($end))}} DE {{strtoupper($months[(int) date("m", strtotime($end))])}} DEL {{date("Y", strtotime($end)) }}</td>
        </tr>
        <tr>
            <td></td>
        </tr>
    </table>
    <table class="table">
        <thead>
            <tr>
                <td class="text-center" style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa">N°</td>
                <td class="text-center" style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa">CÓDIGO</td>
                <td class="text-center" style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa">DNI</td>
                <td class="text-center" style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa">APELLIDOS Y NOMBRES</td>
                <td class="text-center" style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa">CURSO</td>
                <td class="text-center" style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa">NOTA</td>
                <td class="text-center" style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa">NOTA TEXTO</td>
                <td class="text-center" style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa">PERIODO</td>
                <td class="text-center" style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa">HORAS</td>
            </tr>
        </thead>
        <tbody>
            {{$correlative = 0}}
            @forelse ($list as $element)
            {{$correlative++}}
            <tr>
                <td class="text-center" style="background-color: #ededed;border: 1px solid #000000;">{{$correlative }}</td>
                <td class="text-center" style="background-color: #ededed;border: 1px solid #000000;">{{$element->code }}</td>
                <td class="text-center" style="background-color: #ededed;border: 1px solid #000000;">{{$element->document }}</td>
                <td class="text-center" style="background-color: #ededed;border: 1px solid #000000;">{{$element->lastname}}, {{$element->firstname }}</td>
                <td class="text-center" style="background-color: #ededed;border: 1px solid #000000;">{{$element->title }}</td>
                <td class="text-center" style="background-color: #ededed;border: 1px solid #000000;">{{$element->note }}</td>
                <td class="text-center" style="background-color: #ededed;border: 1px solid #000000;">{{$element->textnote }}</td>
                <td class="text-center" style="background-color: #ededed;border: 1px solid #000000;">del {{date("d", strtotime($element->start))}} de {{$months[(int) date("m", strtotime($element->start))]}} del {{date("Y", strtotime($element->start))}} al {{date("d", strtotime($element->end))}} de {{$months[(int) date("m", strtotime($element->end))]}} del {{date("Y", strtotime($element->end)) }}</td>
                <td class="text-center" style="background-color: #ededed;border: 1px solid #000000;">{{$element->duration}} horas</td>
            </tr>  
            @empty
            <tr>
                <td colspan="9" style="background-color: #ededed;border: 1px solid #000000; text-align: center;">Sin registros</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>