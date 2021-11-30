<?php

include 'dist/php/databaseconect.php';

echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link href="dist/css/login.css" rel="stylesheet">
    </head>
    <body>
        <div id="principal">
            <div id="titulo"><img src="img/nombreAcademia.png"><img src="img/logoAcademia.png"></div>
            <div id="datos">
                <p>Usuario</p><input type="text" name="usuario" required="true">
                <p>Contraseña</p><input type="password" name="password" required="true">
            </div>
            <div id="registerandforgotkey">
                <a href="registro.php">Registrate aqui</a>
            </div>
            <div id="btn_login">
                <button type="submit" id="btn_entrar">ENTRAR</button>
            </div>
        </div>
    </body>
    </html> 
';

?>