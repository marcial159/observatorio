<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte 03</title>
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
     font-size: 10px;
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
    .table tfoot
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
    .bg-grey{
        background: #c3c2c2;
    }
</style>
<body>
    <table class="head">
        <tr>
            @if($entity)
            <td style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa; text-align: center;" colspan="2">
                <h1>{{$entity->name }}</h1>
            </td>
            @endif
        </tr>
        <tr>
            <td style="background-color: #ededed;border: 1px solid #000000; text-align: center;" colspan="2">{{date("d", strtotime($start))}} DE {{strtoupper($months[(int) date("m", strtotime($start))])}} DEL {{date("Y", strtotime($start))}} al {{date("d", strtotime($end))}} DE {{strtoupper($months[(int) date("m", strtotime($end))])}} DEL {{date("Y", strtotime($end)) }}</td>
        </tr>
        <tr>
            <td></td>
        </tr>
    </table>
    <table class="table">
        <thead>
            <tr>
                <td style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa; text-align: center;">COORDINADOR / EVENTO</td>
                <td style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa; text-align: center;">CERTIFICADOS TRAMITADOS</td>
            </tr>
        </thead>
        <tbody>
            {{$correlative = 0}}
            {{$total = 0}}
            @foreach ($coordinators as $coordinator)
                {{$counter = 0}}
                @foreach ($list[$correlative] as $value)
                    {{$counter = $counter + $value->number}}
                @endforeach
                @if($counter > 0)
                    <tr>
                        <td style="background-color: #d3d3d3;border: 1px solid #000000; text-align: center;">{{$coordinator->firstname}} {{$coordinator->lastname }}</td>
                        <td style="background-color: #d3d3d3;border: 1px solid #000000; text-align: center;">{{$counter }}</td>
                        {{$total = $total + $counter}}
                    </tr>
                    @foreach ($list[$correlative] as $element)
                        <tr>
                            <td style="background-color: #ededed;border: 1px solid #000000; text-align: center;">{{$element->title }}</td>
                            <td style="background-color: #ededed;border: 1px solid #000000; text-align: center;">{{$element->number }}</td>
                        </tr>
                    @endforeach
                    {{$correlative++}}
                @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="background-color: #b5b5b5;border: 1px solid #000000; text-align: center; color:#000000;">TOTAL</td>
                <td style="background-color: #b5b5b5;border: 1px solid #000000; text-align: center; color:#000000;">{{$total }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
