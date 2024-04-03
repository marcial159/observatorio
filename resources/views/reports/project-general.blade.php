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
            PROYECTOS INVESTIGACION DOCENTE
        </span>
    </div>

    {{-- Código
Título
Etapa ID
Categoría ID
ID del concurso
Presupuesto
Resolución
Fecha de Emisión de la Resolución
Fecha de Inicio del Cronograma
Fecha de Fin del Cronograma
Objetivo General
Objetivos Específicos
ID del Asesor
Observación de Laboratorio
Producción de Laboratorio
ID de la Compañía
Fecha de Creación
Fecha de Actualización
Estado
Representante
Balance Disponible --}}


    <div class="content">
        <h3 style="margin-top: 0px">DATOS GENERALES</h3>
        <table>
            <tbody>
                <tr>
                    <th colspan="1">CÓDIGO</th>
                    <td colspan="1">{{ $project->code }}</td>
                    <th colspan="1">TITULO</th>
                    <td colspan="3">{{ $project->title }}</td>
                </tr>
                <tr>
                    <th colspan="1">ETAPA</th>
                    <td colspan="1">{{ $project->projectStage->name }}</td>
                    <th colspan="1">CATEGORÍA</th>
                    <td colspan="1">{{ $project->category->name }}</td>
                    <th colspan="1">CONCURSO</th>
                    <td colspan="1">{{ $project->contest }}</td>
                </tr>
                <tr>
                    <th colspan="1">PRESUPUESTO</th>
                    <td colspan="1">{{ $project->budget }}</td>
                    <th colspan="1">RESOLUCIÓN</th>
                    <td colspan="1">{{ $project->resolution }}</td>
                    <th colspan="1">FECHA DE EMISIÓN</th>
                    <td colspan="1">{{ $project->resolution_issuance }}</td>
                </tr>
                <tr>
                    <th colspan="1">FECHA DE INICIO</th>
                    <td colspan="1">{{ $project->start_schedule }}</td>
                    <th colspan="1">FECHA DE FIN</th>
                    <td colspan="1">{{ $project->end_schedule }}</td>
                    <th colspan="1">ESTADO</th>
                    <td colspan="1">{{ $project->status }}</td>
                </tr>
                <tr>
                    <th colspan="1">OBJETIVO GENERAL</th>
                    <td colspan="5">{{ $project->general_objective }}</td>
                </tr>
                <tr>
                    <th colspan="6" style="text-align: center">OBJETIVOS ESPECÍFICOS</th>
                </tr>
                <tr>
                    <td colspan="6">{!! '<strong>-</strong>' . str_replace("\n", '<strong>-</strong>', nl2br(e($project->specific_objectives))) !!}</td>

                </tr>
            </tbody>
        </table>

        <h3>EQUIPO</h3>

        <table>
            <thead>
                <tr>
                    <th style="text-align: center;">ROL</th>
                    <th colspan="2" style="text-align: center;">NOMBRES Y APELLIDOS</th>
                    <th style="text-align: center;">DNI</th>
                    <th style="text-align: center;">EMAIL</th>
                    <th style="text-align: center;">TELÉFONO</th>
                </tr>

            </thead>

            <tbody>

                <tr>
                    <td colspan="1">Asesor</td>
                    <td colspan="2">{{ $project->advisor->person->fullName }}</td>
                    <td colspan="1">{{ $project->advisor->person->document }}</td>
                    <td colspan="1">{{ $project->advisor->email }}</td>
                    <td colspan="1">{{ $project->advisor->person->phone }}</td>
                </tr>

                @foreach ($project->members as $member)
                    <tr>
                        <td colspan="1">{{ $member->type }}</td>
                        <td colspan="2">{{ $member->student->person->fullName }}</td>
                        <td colspan="1">{{ $member->student->person->document }}</td>
                        <td colspan="1">{{ $member->student->person->email }}</td>
                        <td colspan="1">{{ $member->student->person->phone }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <h3>LABORATORIOS</h3>

        <table>
            <thead>
                <tr>
                    <th colspan="4" style="text-align: center;">NOMBRE</th>
                    <th style="text-align: center;">AMBIENTE</th>
                    <th style="text-align: center;">DESCRIPCIÓN</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($project->laboratories as $laboratory)
                    <tr>
                        <td colspan="4">{{ $laboratory->name }}</td>
                        <td colspan="1">{{ $laboratory->ambient }}</td>
                        <td colspan="1">{{ $laboratory->description }}</td>
                    </tr>
                @endforeach

                <tr>
                    <th style="text-align: center" colspan="6">OBSERVACIÓN</th>
                </tr>
                <tr>
                    <td colspan="6">{{ $project->laboratory_observation }}</td>
                </tr>

                <tr>
                    <th style="text-align: center" colspan="6">PRODUCCIÓN</th>
                </tr>

                <tr>
                    <td colspan="6">{{ $project->laboratory_production }}</td>
                </tr>

            </tbody>
        </table>

        @if ($project->company)
            <h3>EMPRESA</h3>

            <table>
                <tbody>
                    <tr>
                        <th colspan="1">NOMBRE</th>
                        <td colspan="1">{{ $project->company->name }}</td>
                        <th colspan="1">GERENTE</th>
                        <td colspan="1">{{ $project->company->manager->person->full_name }}</td>
                    </tr>
                    <tr>
                        <th colspan="1">EMAIL</th>
                        <td colspan="1">{{ $project->company->email }}</td>
                        <th colspan="1">DIRECCIÓN</th>
                        <td colspan="1">{{ $project->company->address }}</td>
                    </tr>

                </tbody>
            </table>
        @endif

        {{-- <div style="page-break-before: always;"></div> --}}


        <h3>FINANCIAMIENTO DEL PROYECTO</h3>

        <table>
            <thead>
                <tr>
                    <th colspan="1">PROYECTO :</th>
                    <td colspan="7">{{ $project->title }}</td>
                </tr>
                <tr>
                    <th colspan="1">PRESUPUESTO TOTAL</th>
                    <td colspan="1">S/{{ $project->budget }}</td>
                    <th colspan="1">BALANCE DISPONIBLE</th>
                    <td colspan="1">S/{{ $project->available_balance }}</td>
                    <th colspan="1">SALDO GENERAL</th>
                    <td colspan="1">S/{{ $project->expenses_balance }}</td>
                    <th colspan="1">% EJECUCIÓN GENERAL</th>
                    <td colspan="1">{{ $project->spent_porcentage }}%</td>
                </tr>
            </thead>
        </table>

        <table style="margin-top: 20px">

            @foreach ($items as $item)
                <thead>
                    <tr>
                        <th style="text-align: center" colspan="15">
                            {{ strtoupper($item->name) }}
                        </th>
                    </tr>
                    <tr>
                        <th style="min-width: 250px" colspan="3">TOTAL: S/{{ $item->amount }}</th>
                        <th colspan="3">SALDO: S/{{ $item->available_amount }}</td>
                        <th colspan="3">EJECUTADO: S/{{ $item->expenses }}</td>
                        <th colspan="3">EJECUCION: {{ round(($item->expenses / $item->amount) * 100, 2) }}%</td>
                        <th colspan="3">ESTADO: {{ $item->status }}</td>
                    </tr>

                    <tr>
                        <th colspan="5">CONCEPTO</th>
                        <th colspan="1">N° SIAF</th>
                        <th colspan="1">N° PEDIDO</th>
                        <th colspan="1">N° ORDEN</th>
                        <th colspan="1">N° PECOSA</th>
                        <th colspan="4">DETALLE</th>
                        <th colspan="1">SITUACIÓN</th>
                        <th colspan="1">MONTO</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($item->concepts as $concept)
                        <tr>
                            <td colspan="5">{{ $concept->description }}</td>
                            <td colspan="1">{{ $concept->siaf_number }}</td>
                            <td style="min-width: 70px" colspan="1">{{ $concept->tracking_number }}</td>
                            <td style="min-width: 70px" colspan="1">{{ $concept->order_number }}</td>
                            <td style="min-width: 70px" colspan="1">{{ $concept->pecosa_number }}</td>
                            <td colspan="4">{{ $concept->details }}</td>
                            <td colspan="1">{{ $concept->situation }}</td>
                            <td colspan="1">S/{{ $concept->executed_amount }}</td>

                        </tr>
                    @endforeach

                </tbody>

                <tbody>

                    <tr>
                        <td style="height: 20px; border: none" colspan="15"></td>
                    </tr>

                </tbody>
            @endforeach


        </table>



    </div>


</body>



</html>
