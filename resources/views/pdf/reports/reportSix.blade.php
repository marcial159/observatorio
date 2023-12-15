<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte 06</title>
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
        font-size: 10px;
        border-style: solid;
        border-color: #2876dc;
    }
    .row{
        display: block;
    }
    .text-center{
        text-align: center;
    }
    .text-end{
        text-align: end;
    }
</style>
<body>
    <table class="table">
        <tbody>
            @if($event)
            <tr>
                <td style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa; text-align: center;" colspan="5">
                    {{mb_strtoupper($event->title)}}
                </td>
            </tr>
            @endif
            @if($coordinator)
            <tr>
                <td style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa; text-align: center;" colspan="5">
                    {{mb_strtoupper($coordinator->firstname)}} {{mb_strtoupper($coordinator->lastname)}}
                </td>
            </tr>
            @endif
            <tr>
                <td style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa; text-align: center;" colspan="5">
                    {{date("d", strtotime($start))}} DE {{strtoupper($months[(int) date("m", strtotime($start))])}} DEL {{date("Y", strtotime($start))}} al {{date("d", strtotime($end))}} DE {{strtoupper($months[(int) date("m", strtotime($end))])}} DEL {{date("Y", strtotime($end))}}
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table">
        <thead>
            <tr>
                <td style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa; text-align: center;">N°</td>
                <td style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa; text-align: center;">NOMBRE(S) Y APELLIDOS</td>
                <td style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa; text-align: center;">EVENTO</td>
                <td style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa; text-align: center;">TIPO</td>
                <td style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa; text-align: center;">MONTO</td>
            </tr>
        </thead>
        <tbody>
            {{$correlative = 0}}
            {{$counter = 0}}
            @forelse ($list as $element)
            {{$correlative++}}
            <tr>
                <td style="background-color: #ededed;border: 1px solid #000000; text-align: center;">{{$correlative }}</td>
                <td style="background-color: #ededed;border: 1px solid #000000;">{{$element->firstname}} {{$element->lastname }}</td>
                <td style="background-color: #ededed;border: 1px solid #000000; text-align: center;">{{$element->title }}</td>
                <td style="background-color: #ededed;border: 1px solid #000000; text-align: center;">{{$element->quality }}</td>
                <td style="background-color: #ededed;border: 1px solid #000000; text-align: center;">S/. {{$element->pem}}.00</td>
            </tr>
            {{$counter = $counter + $element->pem}}
            @empty
            <tr>
                <td colspan="5" style="background-color: #ededed;border: 1px solid #000000; text-align: center;">Sin registros</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="background-color: #b5b5b5;border: 1px solid #000000; text-align: center;">Total: </td>
                <td  style="background-color: #b5b5b5;border: 1px solid #000000; text-align: center;">S/. {{$counter}}.00</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>