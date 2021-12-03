<?php

include 'dist/php/databaseconect.php';

$fechacorreccion = null;

/* Obtengo fecha actual para añadirla a la tabla */
$stringDate = new DateTime();
$fechacreacion = $stringDate->format(DATE_ATOM);
$fechacreacion = substr($fechacreacion,0,strpos($fechacreacion, "T"));

/* NECESITO OBTENER EL ID DE LA PERSONA QUE ESTA CONECTADA EN LA SESION */
$idalumno=1;

if (isset($_POST['btn_añadir'])) {

    $asignatura= $_POST['asignatura'];
    $archivo= $_POST['archivo'];
    $descripcion= $_POST['descripcion'];
    
    $consulta = $conn->prepare("INSERT INTO tareas(asignatura,descripcion,idalumno,archivo,fechacreacion,fechacorreccion) VALUES (:asignatura,:descripcion,:idalumno,:archivo,:fechacreacion,:fechacorreccion)");
    $consulta->bindParam(':asignatura', $asignatura);
    $consulta->bindParam(':descripcion', $descripcion);
    $consulta->bindParam(':idalumno', $idalumno);
    $consulta->bindParam(':archivo', $archivo);
    $consulta->bindParam(':fechacreacion', $fechacreacion);
    $consulta->bindParam(':fechacorreccion', $fechacorreccion);
    $consulta->execute();

    if ($consulta->execute()) {

        echo 'Funciono';

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
        <form>
            <div class="campos">
                <div>
                    <div><label>Asignatura</label></div>
                    <div>
                        <select id="asignatura" name="asignatura" required>
                            <option selected="true" disabled="disabled">--Seleccione usa asignatura--</option>
                            <option value="1">Biologia</option>
                            <option value="2">Fisica y Quimica</option>
                            <option value="3">Frances</option>
                            <option value="4">Lengua</option>
                            <option value="5">Historia</option>
                            <option value="6">Informatica</option>
                            <option value="7">Ingles</option>
                            <option value="8">Matematicas</option>
                            <option value="9">Tecnologia</option>
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
                <button name="" type="submit" id="btn_añadir">AÑADIR</button>
            </div>

        </form>
    </main>

    <script src="dist/js/addtarea.js"></script>
</body>

</html>