<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reporte de evaluación - </title>

    <style>
        /* Configuración del tamaño de página A4 y márgenes */
        /* @page { */
        /* size: A4; */
        /* margin: 20mm 15mm; */
        /* Márgenes superior e inferior de 20mm, márgenes izquierdo y derecho de 15mm */
        /* } */
        /* Estilos adicionales para el contenido */
        /* @font-face {
            font-family: 'poorich';
            src: url('./fonts/POORICH.TTF') format("truetype");
        } */

        html {
            font-size: 9pt;
        }

        @page {
            margin: 90px 50px;
        }

        .header {
            position: fixed;
            left: 0px;
            top: -90px;
            right: 0px;
            height: 90px;
            /* background-color: orange; */
            text-align: center;
        }

        .content {
            /* margin-top: 200pt; */
            /* Deja espacio para la cabecera (ajusta según sea necesario) */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        h1 {
            font-size: 12pt;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px 8px;
            text-align: left;
        }

        th {
            background-color: #e2e2e2;
            /* width: 150pt; */
            /* font-weight: bold; */
        }


        .logo-header {
            position: absolute;
            top: 10;
            left: 0;
        }
    </style>
</head>

<body>
    <div class="header">
        {{-- <img class="logo-header" src="{{ public_path('img/logo.png') }}" width="60" alt="" /> --}}
        <h2 style="font-size: 12pt; margin: 0; margin-top: 20px">Universidad Nacional Micaela Bastidas de Apurímac</h2>
        <span>
            PROYECTOS INCUBADORA DE EMPRESAS
        </span>
    </div>


    <h3>FINANCIAMIENTO DEL PROYECTO</h3>

    <table>
        <thead>
            <tr>
                <th colspan="1">PROYECTO :</th>
                <td colspan="5">{{ $project->title }}</td>
                <th colspan="1">PRESUPUESTO TOTAL</th>
                <td colspan="1">{{ $project->budget }}</td>
                <th colspan="1">BALANCE DISPONIBLE</th>
                <td colspan="1">{{ $project->available_balance }}</td>
            </tr>
            <tr>
                <th style="text-align: center" colspan="10">SEGUIMIENTO FINANCIERO POR RUBROS</th>
            </tr>
        </thead>


        @foreach ($items as $item)
            <thead>
                <tr>
                    <th colspan="10">{{ strtoupper($item->name) }}</th>
                </tr>

                <tr>
                    <th colspan="1">TOTAL</th>
                    <td colspan="1">{{ $item->amount }}</td>
                    <th colspan="1">SALDO</th>
                    <td colspan="1">{{ $item->available_amount }}</td>
                    <th colspan="1">EJECUTADO</th>
                    <td colspan="1">{{ $item->expenses }}</td>
                    <th colspan="1">% EJECUCION</th>
                    <td colspan="1">%{{ round(($item->expenses / $item->amount) * 100, 2) }}</td>
                    <th colspan="1">ESTADO</th>
                    <td colspan="1">{{ $item->status }}</td>
                </tr>

                <tr>
                    <th colspan="3">CONCEPTO</th>
                    <th colspan="1">N° DE SIAF</th>
                    <th colspan="1">N° DE PEDIDO</th>
                    <th colspan="1">N° DE ORDEN</th>
                    <th colspan="1">N° DE PECOSA</th>
                    <th colspan="1">DETALLE</th>
                    <th colspan="1">SITUACIÓN</th>
                    <th colspan="1">MONTO</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($item->concepts as $concept)
                    <tr>
                        <td colspan="3">{{ $concept->description }}</td>
                        <td colspan="1">{{ $concept->siaf_number }}</td>
                        <td colspan="1">{{ $concept->tracking_number }}</td>
                        <td colspan="1">{{ $concept->order_number }}</td>
                        <td colspan="1">{{ $concept->pecosa_number }}</td>
                        <td colspan="1">{{ $concept->details }}</td>
                        <td colspan="1">{{ $concept->situation }}</td>
                        <td colspan="1">{{ $concept->executed_amount }}</td>

                    </tr>
                @endforeach

            </tbody>
        @endforeach


    </table>


    </div>


</body>



</html>
