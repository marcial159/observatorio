<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte 02</title>
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
    .table th, .table td {
        /* border: solid 1px black */
        border-style: solid;
        border-color: #2876dc;
    }
    .row{
        display: block;
    }
    .bg-gray{
        background: rgb(191, 191, 191);
    }
    .text-center{
        text-align: center
    }
    .text-end{
        text-align: end;
    }
</style>
<body>
    <table class="head">
        <tr>
            <td style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa; text-align: center;" colspan="2">
                REGISTRO DE CERTIFICADO
            </td>
        </tr>
        @if($entity)
        <tr>
            <td style="background-color: #ededed;border: 1px solid #000000; text-align: center;" class="text-center" colspan="2">DESARROLLADO POR {{strtoupper($entity->name) }}</td>
        </tr>
        @endif
        <tr>
            <td style="background-color: #ededed;border: 1px solid #000000; text-align: center;" class="text-center" colspan="2">{{date("d", strtotime($start))}} DE {{strtoupper($months[(int) date("m", strtotime($start))])}} DEL {{date("Y", strtotime($start))}} AL {{date("d", strtotime($end))}} DE {{strtoupper($months[(int) date("m", strtotime($end))])}} DEL {{date("Y", strtotime($end)) }}</td>
        </tr>
        <tr>
            <td></td>
        </tr>
    </table>
    <table class="table">
        <thead>
            <tr>
                <td  style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa; text-align: center;">CURSOS</td>
                <td  style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa; text-align: center;">CANTIDAD</td>
            </tr>
        </thead>
        <tbody>
            {{$total = 0}}
            @forelse ($list as $element)
            {{$total = $total + $element->number}}
            <tr>
                <td style="background-color: #ededed; border: 1px solid #000000; text-align: center;">{{$element->title }}</td>
                <td style="background-color: #ededed; border: 1px solid #000000; text-align: center;">{{$element->number }}</td>
            </tr>  
            @empty
            <tr>
                <td style="background-color: #ededed;border: 1px solid #000000; text-align: center;" colspan="2">Sin registros</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="bg-gray">
                <td style="background-color: #cbcbcb;border: 1px solid #000000; text-align: center;">TOTAL GENERAL</td>
                <td style="background-color: #cbcbcb;border: 1px solid #000000; text-align: center;">{{$total }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>