<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificados</title>
    <style>
        *{
            padding: 0px;
            margin: 0px;
            line-height: inherit;
            /* font-weight: 400; */
        }
        @font-face {
            font-family: 'OpenSans';
            src: url(fonts/open-sans/OpenSans-Light.ttf) format("truetype");
            /* font-weight: 400; */
            font-style: normal;
        }
        @page { size: 1188px 840px; }
        .certify{
            height: 100%;
            width: 100%;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            background-position: center;
            position: relative;
            display: block;
            overflow: hidden;
        }

        .element{
            border: 1.5px solid black;
            margin: 0px;
            position: absolute;
            display: inline-block;
            font-family: 'OpenSans';
            font-family: sans-serif;
            /* line-height : normal; */
        }
        .text{
            visibility: {{$elements->text->visibility}};
            top: {{$elements->text->y}};
            left: {{$elements->text->x}};
            width: {{$elements->text->width}}%;
        }

        .title{
            visibility: {{$elements->title->visibility}};
            top: {{$elements->title->y}};
            left: {{$elements->title->x}};
            width: {{$elements->title->width}}%;
            font-size: {{$elements->title->fontSize}}px;
            color: {{$elements->title->color}};
            font-weight: {{$elements->title->fontWeight}};
            font-style: {{$elements->title->fontStyle}};
            text-align: {{$elements->title->textAlign}};
        }
        .name{
            visibility: {{$elements->name->visibility}};
            top: {{$elements->name->y}};
            left: {{$elements->name->x}};
            width: {{$elements->name->width}}%;
            font-size: {{$elements->name->fontSize}}px;
            color: {{$elements->name->color}};
            font-weight: {{$elements->name->fontWeight}};
            font-style: {{$elements->name->fontStyle}};
            text-align: {{$elements->name->textAlign}};
        }
        .date{
            visibility: {{$elements->date->visibility}};
            top: {{$elements->date->y}};
            left: {{$elements->date->x}};
            width: {{$elements->date->width}}%;
            font-size: {{$elements->date->fontSize}}px;
            color: {{$elements->date->color}};
            font-weight: {{$elements->date->fontWeight}};
            font-style: {{$elements->date->fontStyle}};
            text-align: {{$elements->date->textAlign}};
        }
        .duration{
            visibility: {{$elements->duration->visibility}};
            top: {{$elements->duration->y}};
            left: {{$elements->duration->x}};
            width: {{$elements->duration->width}}%;
            font-size: {{$elements->duration->fontSize}}px;
            color: {{$elements->duration->color}};
            font-weight: {{$elements->duration->fontWeight}};
            font-style: {{$elements->duration->fontStyle}};
            text-align: {{$elements->duration->textAlign}};
        }
        .syllabus{
            visibility: {{$elements->syllabus->visibility}};
            top: {{$elements->syllabus->y}};
            left: {{$elements->syllabus->x}};
            width: {{$elements->syllabus->width}}%;
            font-size: {{$elements->syllabus->fontSize}}px;
            color: {{$elements->syllabus->color}};
            font-weight: {{$elements->syllabus->fontWeight}};
            font-style: {{$elements->syllabus->fontStyle}};
            text-align: {{$elements->syllabus->textAlign}};
        }
        .syllabus ul{
            margin-left: 17px;
            text-align: initial;
        }

        .syllabus p{
            margin-left: 0px;
            text-align: initial;
        }


        .code{
            visibility: {{$elements->code->visibility}};
            top: {{$elements->code->y}};
            left: {{$elements->code->x}};
            width: {{$elements->code->width}}%;
            font-size: {{$elements->code->fontSize}}px;
            color: {{$elements->code->color}};
            font-weight: {{$elements->code->fontWeight}};
            font-style: {{$elements->code->fontStyle}};
            text-align: {{$elements->code->textAlign}};
        }
        .note{
            visibility: {{$elements->note->visibility}};
            top: {{$elements->note->y}};
            left: {{$elements->note->x}};
            width: {{$elements->note->width}}%;
            font-size: {{$elements->note->fontSize}}px;
            color: {{$elements->note->color}};
            font-weight: {{$elements->note->fontWeight}};
            font-style: {{$elements->note->fontStyle}};
            text-align: {{$elements->note->textAlign}};
        }
        .qr{
            visibility: {{$elements->qr->visibility}};
            top: {{$elements->qr->y}};
            left: {{$elements->qr->x}};
            width: {{$elements->qr->width}}%;
            position: absolute;
            display: inline-block;
        }
        .emited{
            visibility: {{$elements->emited->visibility}};
            top: {{$elements->emited->y}};
            left: {{$elements->emited->x}};
            width: {{$elements->emited->width}}%;
            font-size: {{$elements->emited->fontSize}};
            color: {{$elements->emited->color}};
            font-weight: {{$elements->emited->fontWeight}};
            font-style: {{$elements->emited->fontStyle}};
            text-align: {{$elements->emited->textAlign}};
        }
        @page { margin: 0px; padding: 0px; }
    </style>
</head>
<body>
    @foreach($participations as $participation)
    <div class="certify" style="background-image: url({{public_path().'/backgrounds/'.$participation->background}});">
        <?php
            $element = [
                '[NOMBRES]',
                '[Nombres]',
                '[APELLIDOS]',
                '[Apellidos]',
                '[TITULO]',
                '[Titulo]',
                '[nota]',
                '[notatexto]',
                '[inicio]',
                '[fin]',
                '[horas]',
                '[codigo]',
                '[emision]',
                '[temario]'
            ];

            $content = [
                strtoupper($participation->firstname),
                $participation->firstname,
                strtoupper($participation->lastname),
                strtoupper($participation->title),
                strtoupper($event->title),
                $event->title,
                $participation->note,
                $participation->textnote,
                date("d", strtotime($event->start)).' - '.$text[(int) date("m", strtotime($event->start))].' - '.date("Y", strtotime($event->start)),
                date("d", strtotime($event->end)).' - '.$text[(int) date("m", strtotime($event->end))].' - '.date("Y", strtotime($event->end)),
                $event->duration,
                $participation->code,
                date('d', strtotime($emited)).' de '.strtolower($text[(int) date('m', strtotime($emited))]).' del '.date('Y', strtotime($emited)),
                $event->syllabus
            ];
            $event->text = str_replace($element, $content, $event->text);
        ?>
        <div class="element text">{!! $event->text !!}</div>
        <div class="element title">{{$event->title }}</div>
        <label class="element name">{{mb_strtoupper($participation->lastname, 'UTF-8')}}, {{mb_strtoupper($participation->firstname, 'UTF-8') }}</label>
        <label class="element date">{{date("d", strtotime($event->start))}} - {{$text[(int) date("m", strtotime($event->start))]}} - {{date("Y", strtotime($event->start))}} AL {{date("d", strtotime($event->end))}} - {{$text[(int) date("m", strtotime($event->end))]}} - {{date("Y", strtotime($event->end))}} </label>
        <label class="element duration">{{$event->duration }}</label>
        <label class="element syllabus">{!! $event->syllabus !!}</label>
        <label class="element code">{{$participation->code }}</label>
        @if($participation->note)
        <label class="element note">{{$participation->note}} ({{$participation->textnote}})</label>
        @endif
        <img class="element qr" src="data:image/svg+xml;base64,{{ base64_encode($participation->qr) }}"/>
        <label class="element emited">{{date('d', strtotime($emited))}} de {{strtolower($text[(int) date('m', strtotime($emited))])}} del {{date('Y', strtotime($emited)) }}</label>
    </div>
    @endforeach
</body></html>
