<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Reseteo de contraseña</title>
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
        .bg{
            background: #f4f4f4
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
        .ma{
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: 20px;
            margin-right: 20px;
        }
        .br{
            border: solid 1px blue;
            border-radius: 25px;
        }
        .tj{
            text-align: justify
        }
    </style>

</head>
<body>
    <div class="pa ma bg br">
        <div class="ma">
            <strong class="text-center db">RESETEO DE CONTRASEÑA</strong>
            <hr>
            <p class="tj">Hola! Te saludamos del Observatorio de Investigación de la UNAMBA, recibimos tu petición de reseteo de contraseña, a continuación te enviamos el código a usar:</p>
            <strong class="fs-2">{{ $token  }}</strong>
            <br>
            <small class="tj db" style="margin-top: 20px">Código válido solo para esta petición, si ud. no solicitó este reseteo de contraseña no realice ninguna acción, nos encargaremos de verificar la validez de la misma, saludamos!.</small>
        </div>
    </div>
</body>
</html>