<?php

include 'dist/php/databaseconect.php';

date_default_timezone_set('Europe/Madrid');
$fechacreacion = date("Y-m-d");

$msg_error = "";

if (isset($_POST['btn_añadir'])) {

    $fechacorreccion = null;

    /* VARIABLES DEL FORMULARIO */
    $asignatura = $_POST['asignatura'];
    $archivo = $_POST['archivo'];
    $descripcion = $_POST['descripcion'];
    $idAlumno = $_SESSION['id'];

    if ($archivo == "") {
        $archivo = null;
    }

    $consulta = $conn->prepare("INSERT INTO tareas(asignatura,descripcion,idalumno,archivo,fechacreacion,fechacorreccion) VALUES (:asignatura,:descripcion,:idalumno,:archivo,:fechacreacion,:fechacorreccion)");
    $consulta->bindParam(':asignatura', $asignatura);
    $consulta->bindParam(':descripcion', $descripcion);
    $consulta->bindParam(':idalumno', $idAlumno);
    $consulta->bindParam(':archivo', $archivo);
    $consulta->bindParam(':fechacreacion', $fechacreacion);
    $consulta->bindParam(':fechacorreccion', $fechacorreccion);

    if ($consulta->execute() && $asignatura != "escoge") {

        echo '<script>alert("Tarea añadida.");</script>';
    } else {
        $msg_error = "Error al añadir la tarea";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir tareas</title>
    <link href="dist/css/addtarea.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
    <?php include 'dist/php/menu.php'; ?>
    <main>
        <div id="cabecera">
            <h3>Nueva tarea</h3>
        </div>
        <form id="datos" action="" method="POST" name="formulario">
            <div class="campos">
                <div>
                    <div><label>Asignatura</label></div>
                    <div>
                        <select id="asignatura" name="asignatura" required>
                            <option selected="true" value="escoge">--Seleccione usa asignatura--</option>
                            <option value="Biologia">Biologia</option>
                            <option value="Fisica y Quimica">Fisica y Quimica</option>
                            <option value="Frances">Frances</option>
                            <option value="Lengua">Lengua</option>
                            <option value="Historia">Historia</option>
                            <option value="Informatica">Informatica</option>
                            <option value="Ingles">Ingles</option>
                            <option value="Matematicas">Matematicas</option>
                            <option value="Tecnologia">Tecnologia</option>
                        </select>
                    </div>
                </div>

                <div>
                    <div>
                        <div><label>Tarea</label></div>
                        <div><input type="file" name="archivo"></div>
                    </div>
                </div>
            </div>

            <div class="campos">
                <div><label>Decripcion</label></div>
                <div><textarea required name="descripcion"></textarea></div>
            </div>

            <div id="btn_div">
                <button name="btn_cancelar" type="submit" id="btn_cancelar">CANCELAR</button>
                <button name="btn_añadir" type="submit" id="btn_añadir">AÑADIR</button>
            </div>

            <div id="msg_error"><?php echo "$msg_error" ?></div>

        </form>
    </main>

    <script src="dist/js/addtarea.js"></script>
</body>

</html>