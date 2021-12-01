<?php

/*
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
*/

require_once "dist/php/databaseconect.php";




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
        //Puede tener otros símbolos. 
        $password_equal = $password1 ==  $password2;


        $consulta->bindParam(':dni', $dni);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':apellidos', $apellidos);
        $consulta->bindParam(':email', $email);
        $consulta->bindParam(':password1', $password1);
        $consulta->bindParam(':password2', $password2);

        if ($nombre_check && $apellidos_check && $email_check && $dni_check && $password_check && $password_equal) {
            if ($consulta->execute()) {
                echo'<script type="text/javascript">
                        window.location.href="login.php";
                        alert("Usuario creado con exito");
                    </script>';
            } else {
                echo "Error al añadir.";
            }
        } else {

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
        <form id="datos" action="" method="POST" name="formulario">

            <div class="columna">
                <div class="datos derecha">
                    <label>Nombre</label><input type="text" name="nombre" required="true">
                    <?php
                        if (!$nombre_check) {
                            echo '<div class="errores">Error en el nombre</div>';
                        }
                    ?>
                </div>
                <div class="datos izquierda">
                    <label>Apellidos</label><input type="text" name="apellidos" required="true">
                    <?php
                        if (!$apellidos_check) {
                            echo '<div class="errores">Error en los apellidos</div>';
                        }
                    ?>
                </div>
            </div>

            <div class="columna">
                <div class="datos derecha">
                    <label>Email</label><input type="text" name="email" required="true">
                    <?php
                        if (!$email_check) {
                            echo '<div class="errores">Error en el email</div>';
                        }
                    ?>
                </div>
                <div class="datos izquierda">
                    <label>NIF</label><input type="text" name="dni" required="true">
                    <?php
                        if (!$dni_check) {
                            echo '<div class="errores">Error en el dni</div>';
                        }
                    ?>
                </div>
            </div>

            <div class="columna">
                <div class="datos derecha">
                    <label>Contraseña</label><input type="password" name="password1" required="true">
                    <?php
                        if (!$password_check) {

                            echo '<div class="errores"><p>8-16 caracteres. Min una min y mayus.</p> <p>Puede contener simbolos.</p></div>';
                        }
                    ?>
                </div>
                <div class="datos izquierda">
                    <label>Repita su contraseña</label><input type="password" name="password2" required="true">
                    <?php
                        if (!$password_equal) {
                            echo '<div class="errores">La contraseña no coincide.</div>';
                        }
                    ?>
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

<?php
}
}
?>