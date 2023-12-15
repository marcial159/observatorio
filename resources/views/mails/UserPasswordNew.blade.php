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
            <strong class="text-center db">Nuevo Usuario</strong>
            <hr>
            <p class="tj">Hola {{ $user->firstname }}! Te saludamos del Observatorio de Investigación de la UNAMBA, se creó un nuevo usuario con esta dirección de correo electrónico, a continuación te enviamos la contraseña generada aleatoriamente para su primer inicio de sisión:</p>
            <strong class="fs-2">{{ $token  }}</strong>
            <br>
            <p class="tj" style="margin-top: 20px">Esta contraseña puede ser cambiada haciendo click en el icono de usuario con su nombre y seleccionando la opción "Configuraciones", si requiere mayor información contacte al administrador del sistema.</p>
        </div>
    </div>
</body>
</html>