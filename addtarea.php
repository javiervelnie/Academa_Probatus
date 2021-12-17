<?php

include 'dist/php/databaseconect.php';

date_default_timezone_set('Europe/Madrid');
$fechacreacion = date("Y-m-d");

$msg_error = "";
$msg_tipo_archivo = "";

if (isset($_POST['btn_añadir'])) {

    $estado = "Pendiente";
    $fechacorreccion = null;
    $nulo = null;
    /* VARIABLES DEL FORMULARIO */
    $asignatura = $_POST['asignatura'];
    htmlspecialchars($descripcion = $_POST['descripcion']);
    $idAlumno = $_SESSION['id'];

    $nombre_final = "";
    /****************************************** */
    if ($_FILES['archivo']['name'] != null) {
        $nombre_base = $_FILES["archivo"]["name"];
        $nombre_final = $idAlumno. str_replace(" ", "-", $nombre_base);
        $directorio = "uploads/";
        $subir_archivo = $directorio . basename($nombre_final);

        $tmpname = $_FILES["archivo"]["tmp_name"];
        $rutaCompleta = $directorio . basename($tmpname);
        $tipo = $_FILES["archivo"]["type"];
        $size = $_FILES["archivo"]["size"] / 1024; //Almacena el valor en Kb

        if ($tipo == "application/pdf") {
            if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $subir_archivo)) {

                $idArchivo;

                /* CONSULTA AÑADIR ARCHIVO */
                $consulta2 = $conn->prepare("INSERT INTO archivos(nombre,tmpname,tipo,size,idalumno) VALUES (:nombre,:tmpname,:tipo,:size,:idalumno)");
                $consulta2->bindParam(':nombre', $nombre_final);
                $consulta2->bindParam(':tmpname', $tmpname);
                $consulta2->bindParam(':tipo', $tipo);
                $consulta2->bindParam(':size', $size);
                $consulta2->bindParam(':idalumno', $idAlumno);

                if ($consulta2->execute()) {
                    $sql = $conn->prepare("SELECT * FROM academia.archivos WHERE tmpname=:tmpname");
                    $sql->execute(array(':tmpname' => $tmpname));
                    $file = $sql->fetch();
                    $idArchivo = $file['id'];

                    $consulta = $conn->prepare("INSERT INTO tareas(asignatura,descripcion,estado,idalumno,idarchivo,fechacreacion,fechacorreccion) VALUES (:asignatura,:descripcion,:estado,:idalumno,:idarchivo,:fechacreacion,:fechacorreccion)");
                    $consulta->bindParam(':asignatura', $asignatura);
                    $consulta->bindParam(':descripcion', $descripcion);
                    $consulta->bindParam(':estado', $estado);
                    $consulta->bindParam(':idalumno', $idAlumno);
                    $consulta->bindParam(':idarchivo', $idArchivo);
                    $consulta->bindParam(':fechacreacion', $fechacreacion);
                    $consulta->bindParam(':fechacorreccion', $fechacorreccion);

                    if ($asignatura != "escoge" && $consulta->execute()) {
                        echo '<script>alert("Tarea añadida.");</script>';
                    } else {
                        $msg_error = "Error al añadir la tarea. ";
                    }
                } else {
                    $msg_error = "Error al añadir la tarea. ";
                }
            }
        } else {
            $msg_tipo_archivo = "Error. Solo archivos .pdf";
        }
    } else {

        $consulta = $conn->prepare("INSERT INTO tareas(asignatura,descripcion,estado,idalumno,idarchivo,fechacreacion,fechacorreccion) VALUES (:asignatura,:descripcion,:estado,:idalumno,:idarchivo,:fechacreacion,:fechacorreccion)");
        $consulta->bindParam(':asignatura', $asignatura);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':estado', $estado);
        $consulta->bindParam(':idalumno', $idAlumno);
        $consulta->bindParam(':idarchivo', $nulo);
        $consulta->bindParam(':fechacreacion', $fechacreacion);
        $consulta->bindParam(':fechacorreccion', $fechacorreccion);

        if ($asignatura != "escoge" && $consulta->execute()) {
            echo '<script>alert("Tarea añadida.");</script>';
        } else {
            $msg_error = "Error al añadir la tarea. ";
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
    <title>Añadir tareas</title>
    <link href="dist/css/addtarea.css" rel="stylesheet">

</head>

<body>
    <?php include 'dist/php/menu_a.php'; ?>
    <main>
        <div id="cabecera">
            <h1>Nueva tarea</h1>
        </div>
        <form id="datos" action="" method="POST" name="formulario" enctype="multipart/form-data">
            <div id="campos">
                <div class="campos">
                    <div id="contenedor-asignatura">
                        <div><label>Asignatura</label></div>
                        <div>
                            <select class="select-css" id="asignatura" name="asignatura" required>
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

                    <div id="contenedor-tarea">
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
            </div>

            <div id="btn_div">
                <button name="btn_cancelar" type="submit" id="btn_cancelar">CANCELAR</button>
                <button name="btn_añadir" type="submit" id="btn_añadir">AÑADIR</button>
            </div>

            <div id="msg_error"><?php echo "$msg_error $msg_tipo_archivo" ?></div>

        </form>
    </main>

    <script src="dist/js/addtarea.js"></script>
</body>

</html>