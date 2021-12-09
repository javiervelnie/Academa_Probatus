<?php

require_once "dist/php/databaseconect.php";

$msg_error_nombre = "";
$msg_error_apellidos = "";
$msg_error_email = "";
$msg_error_dni = "";
$msg_error_password_check = "";
$msg_error_password_equal = "";

if (isset($_POST['btn_crear'])) {

    $consulta = $conn->prepare("INSERT INTO alumno(dni,nombre,apellidos,email,password1,password2) VALUES (:dni,:nombre,:apellidos,:email,:password1,:password2)");


    /* RECOGER VARIABLES DEL FORMULARIO */
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $dni = $_POST['dni'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    /* EXPRESIONES REGULARES */
    $nombre_check = preg_match("/^[A-Z]{1}[a-z]+|[A-Z]{1}[a-z]+\s[A-Z]{1}[a-z]+$/", $nombre);
    $apellidos_check = preg_match("/^[A-Z]{1}[a-z]+|[A-Z]{1}[a-z]+\s[A-Z]{1}[a-z]+$/", $apellidos);
    $email_check = preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[_a-z0-9-]+(.[_a-z0-9-]+)*(.[a-z]{2,4})$/", $email);
    $dni_check = preg_match("/^\d{8}[a-zA-Z]$/", $dni);
    $password_check = preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/', $password1);
    //entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula. 
    //Puede tener otros símbolos. Da error con la Ñ.
    $password_equal = $password1 ==  $password2;


    $consulta->bindParam(':dni', $dni);
    $consulta->bindParam(':nombre', $nombre);
    $consulta->bindParam(':apellidos', $apellidos);
    $consulta->bindParam(':email', $email);
    $consulta->bindParam(':password1', $password1);
    $consulta->bindParam(':password2', $password2);

    if ($nombre_check && $apellidos_check && $email_check && $dni_check && $password_check && $password_equal) {
        if ($consulta->execute()) {
            echo '<script type="text/javascript">
                        window.location.href="index.php";
                        alert("Usuario creado con exito");
                    </script>';
        } else {
            
            echo '
            <script type="text/javascript">
                        window.location.href="registro.php";
                    </script>
            Error al añadir.';
        }
    } else {
        if (!$nombre_check) {
            $msg_error_nombre = "Nombre no valido.\n";
        }
        if (!$apellidos_check) {
            $msg_error_apellidos = "Apellidos no validos.\n";
        }
        if (!$email_check) {
            $msg_error_email = "Email no valido.\n";
        }
        if (!$dni_check) {
            $msg_error_dni = "NIF no valido.\n";
        }
        if (!$password_check) {
            $msg_error_password_check = "Mayus, Min y Num\n";
        }
        if (!$password_equal) {
            $msg_error_password_equal = "Las contraseñas no son iguales.\n";
        }
    }
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
        <img id="img_titulo" src="img/nombreAcademia.png">
        <img id="img_logo" src="img/logoAcademia.png">
    </div>
    <div id="principal">
        <div id="titulo">
            <h2>Registro</h2>
        </div>
        <form id="datos" action="" method="POST" name="formulario">

            <div class="columna">
                <div class="datos derecha">
                    <label>Nombre</label><input type="text" name="nombre" required="true">
                    <div class="errores"><p><?php echo "$msg_error_nombre" ?></p></div>
                </div>
                <div class="datos izquierda">
                    <label>Apellidos</label><input type="text" name="apellidos" required="true">
                    <div class="errores"><p><?php echo "$msg_error_apellidos" ?></p></div>
                </div>
            </div>

            <div class="columna">
                <div class="datos derecha">
                    <label>Email</label><input type="text" name="email" required="true">
                    <div class="errores"><p><?php echo "$msg_error_email" ?></p></div>
                </div>
                <div class="datos izquierda">
                    <label>NIF</label><input type="text" name="dni" required="true">
                    <div class="errores"><p><?php echo "$msg_error_dni" ?></p></div>
                </div>
            </div>

            <div class="columna">
                <div class="datos derecha">
                    <label>Contraseña</label><input type="password" name="password1" placeholder="Entre 8-16 caracteres" required="true">
                    <div class="errores"><p><?php echo "$msg_error_password_check" ?></p></div>
                </div>
                <div class="datos izquierda">
                    <label>Repita su contraseña</label><input type="password" name="password2" required="true">
                    <div class="errores"><p><?php echo "$msg_error_password_equal" ?></p></div>
                </div>
            </div>

            <div id="btn_div">
                <button name="cancelar" type="submit" id="btn_cancelar">CANCELAR</button>
                <button name="btn_crear" type="submit" id="btn_crear">CREAR</button>
            </div>
        </form>

    </div>


    <script src="dist/js/registro.js"></script>
</body>

</html>