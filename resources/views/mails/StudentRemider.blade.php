<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Recordatorio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@200&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: 'Kantumruy Pro', sans-serif;
        }
        .pa-2{
            padding: 5px;
        }
        .background{
            background: #efefef;
            padding: 10px;
            height: 100%;
        }
        .paper{
            background: #ffffff;
        }
        .border-radius{
            border-radius: 15px;
        }
        .fs-2{
            font-size: 20px;
            padding-bottom: 20px;
        }
        .text-center{
            text-align: center;
        }
        .db{
            display: block;
        }
        .margin-all{
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: 20px;
            margin-right: 20px;
        }
        .tj{
            text-align: justify
        }
        .row{
            display: block;
        }
        .bg-dark{
            background: #0000AC;
        }
        .bg-secondary{
            background: #808080;
        }
        .p-2{
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="background">
        <div class="paper margin-all border-radius">
            <div class="row p-2 bg-dark" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <img src="https://certificadoitec.com/assets/img/logo.png" width="120px">
            </div>
            <div class="margin-all">
                {!! $body !!}
                <br>
                {{-- <h5 style="margin-bottom: 20px"><a style="color: #6e6e6e; text-decoration: none" href="https://itec123.com/">itec123.com</a> - <a style="color: #6e6e6e; text-decoration: none" href="https://certificadoitec.com/">certificadoitec.com</a></h5> --}}
            </div>
        </div>
    </div>
</body>
</html>
