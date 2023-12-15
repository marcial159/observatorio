<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte 05</title>
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
        font-size: 7px;
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
        text-align: center
    }
</style>
<body>
    <table class="table">
        <thead>
            <tr>
                <td colspan="3" style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa; text-align: center;">RANKING DE {{$rows}} ESTUDIANTES POR TRAMITE DE CERTIFICADOS</td>
            </tr>
            <tr>
                <td style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa; text-align: center;">N°</td>
                <td style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa; text-align: center;">ESTUDIANTE</td>
                <td style="background-color: #2876dc;border: 1px solid #000000; color: #fafafa; text-align: center;">CANTIDAD DE CERTIFICADOS TRAMITADOS</td>
            </tr>
        </thead>
        <tbody>
            {{$correlative = 0}}
            @forelse ($list as $element)
            {{$correlative++}}
                <tr>
                    <td style="background-color: #ededed;border: 1px solid #000000; text-align: center;">{{$correlative }}</td>
                    <td style="background-color: #ededed;border: 1px solid #000000;">{{$element->firstname}} {{$element->lastname }}</td>
                    <td style="background-color: #ededed;border: 1px solid #000000; text-align: center;">{{$element->number }}</td>
                </tr>
            @empty
            <tr>
                <td colspan="3" style="background-color: #ededed;border: 1px solid #000000; text-align: center;">Sin registros</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>