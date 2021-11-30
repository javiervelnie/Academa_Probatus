<?php

include "dist/php/databaseconect.php";

if (isset($_POST['crear'])) {

    //VARIABLES ENVIADAS POR EL FORMULARIO
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $usuario = $_POST['usuario'];
    $dni = $_POST['dni'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    //INSERTAR EN LA TABLA
    $sql = "insert into `academia`.`alumno` (`dni`, `nombre`, `apellidos`, `email`, `password1`, `password2`) 
    values('$nombre','$apellidos','$usuario','$dni','$password1','$password2')";

    $sql = $connect->prepare($sql);

    $sql->bindParam(':dni', $dni, PDO::PARAM_STR, 25);
    $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR, 25);
    $sql->bindParam(':apellidos', $apellidos, PDO::PARAM_STR, 25);
    $sql->bindParam(':usuario', $usuario, PDO::PARAM_STR, 25);
    $sql->bindParam(':password1', $password1, PDO::PARAM_STR, 25);
    $sql->bindParam(':password2', $password2, PDO::PARAM_STR, 25);

    $sql->execute();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="dist/css/registro.css" rel="stylesheet">
</head>

<body>
    <div id="cabecera">
        <img src="img/nombreAcademia.png">
        <img src="img/logoAcademia.png">
    </div>
    <div id="principal">
        <div id="titulo">
            <h2>Registro</h2>
        </div>
        <form id="datos" action="" method="POST">

            <div class="columna">
                <div class="datos derecha">
                    <label>Nombre</label><input type="text" name="nombre" required="true">
                </div>
                <div class="datos izquierda">
                    <label>Apellidos</label><input type="text" name="apellidos" required="true">
                </div>
            </div>

            <div class="columna">
                <div class="datos derecha">
                    <label>Usuario</label><input type="text" name="usuario" required="true">
                </div>
                <div class="datos izquierda">
                    <label>NIF</label><input type="text" name="dni" required="true">
                </div>
            </div>

            <div class="columna">
                <div class="datos derecha">
                    <label>Contraseña</label><input type="password" name="password1" required="true">
                </div>
                <div class="datos izquierda">
                    <label>Repita su contraseña</label><input type="password" name="password2" required="true">
                </div>
            </div>

        </form>
        <div id="btn_div">
            <button name="cancelar" type="submit" id="btn_cancelar">CANCELAR</button>
            <button name="crear" type="submit" id="btn_crear">CREAR</button>
        </div>

        <div class="errorMsg"><?php echo $errorMsgReg; ?></div>
    </div>


    <script src="dist/js/registro.js"></script>
</body>

</html>