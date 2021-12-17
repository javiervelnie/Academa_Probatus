<?php include 'dist/php/databaseconect.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tareas</title>
    <link href="dist/css/corregirtareas.css" rel="stylesheet">
</head>

<body>
    <?php include 'dist/php/menu_p.php'; ?>

    <div id="contenedortabla">
        <table>
            <tr id="titulos">
                <td class="id-hidden">Id</td>
                <td>Asignatura</td>
                <td>Descripcion</td>
                <td>Estado</td>
                <td>Alumno</td>
                <td>Archivo</td>
                <td>Fecha de creacion</td>
                <td>Fecha de correccion</td>
            </tr>

            <?php
            $consulta = $conn->prepare("SELECT * FROM academia.tareas");
            $consulta->execute();

            if ($consulta) {
                while ($file = $consulta->fetch()) {
                    //Para poner el nombre y apellidos en su correspondiente columna
                    $sql = $conn->prepare("SELECT * FROM academia.alumno where id = :id;");
                    $sql->execute(array(':id' => $file['idalumno']));
                    $algo = $sql->fetch();
                    $nombreApellidos = $algo['nombre'] . ' ' . $algo['apellidos'];

                    //Para poner el nombre del archivo y el enlace en su correspondiente columna
                    if ($file['idarchivo'] != null) {
                        $consulta2 = $conn->prepare("SELECT * FROM academia.archivos WHERE id=:id");
                        $consulta2->execute(array(':id' => $file['idarchivo']));
                        $otra = $consulta2->fetch();
                        $nombreConsulta = "uploads/" .$otra['nombre'];
                        $nombreOriginal = substr($otra['nombre'], 1);
                    } else {
                        $nombreConsulta = "#";
                        $nombreOriginal = "";
                    }
            ?>

                    <tr class="fila">
                        <td class="id-hidden"><?php echo $file['id']  ?></td>
                        <td class="asignatura"><button <?php echo $file['asignatura'] ?> class="btn-abrir-popup" name="btn-abrir-popup"><?php echo $file['asignatura']  ?></button></td>
                        <td class="descripcion"><?php echo $file['descripcion']  ?></td>
                        <td class="estado pendiente"><?php echo $file['estado']  ?></td>
                        <td class="alumno"><?php echo $nombreApellidos  ?></td>
                        <td class="archivo"><a target="blank" href="<?php echo $nombreConsulta ?>"><?php echo $nombreOriginal  ?></a></td>
                        <td class="fechacreacion"><?php echo $file['fechacreacion']  ?></td>
                        <td class="fechacorreccion"><?php echo $file['fechacorreccion']  ?></td>
                    </tr>

            <?php
                }
            }
            ?>
        </table>
    </div>

    <?php

    if (isset($_POST['btn-abrir-popup'])) {
    }
    ?>

    <div class="overlay" id="overlay">
        <div class="popup" id="popup">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
            <h3 class="cabeceratarea">Actualizar tarea de </h3>
            <h4>Detalles</h4>
            <form id="principal" action="" method="POST" name="formulario">

                <div class="contenedor-inputs lado-izquierdo">
                    <table class="tabla">
                        <tr class="id-hidden">
                            <td class="id-hidden">Id</td>
                            <td class="id-hidden"><input name="id" class="id-value" type="text"></td>
                        </tr>
                        <tr>
                            <td class="title">Asignatura</td>
                            <td class="value"><input class="asignatura-value inputs" readonly type="text"></td>
                        </tr>
                        <tr>
                            <td class="title">Estado</td>
                            <td class="value filaEstado"><input class="estado-value inputs" type="text" readonly></td>
                        </tr>
                        <tr>
                            <td class="title">Tarea</td>
                            <td class="value"><input class="tarea-value inputs" type="text" readonly></td>
                        </tr>
                        <tr>
                            <td class="title">Fecha de correccion</td>
                            <td class="value"><input class="fcorreccion-value" type="date" name="fechacorreccion"></td>
                        </tr>
                    </table>
                </div>

                <div class="contenedor-inputs lado-derecho">
                    <table class="tabla">
                        <tr>
                            <td class="title">Descripcion</td>
                            <td class="value"><input class="descripcion-value inputs" readonly type="text"></td>
                        </tr>
                        <tr>
                            <td class="title">Alumno</td>
                            <td class="value filaEstado"><input class="alumno-value inputs" type="text" readonly></td>
                        </tr>
                        <tr>
                            <td class="title">Fecha de creacion</td>
                            <td class="value"><input class="fcreacion-value inputs" type="text" readonly></td>
                        </tr>
                    </table>
                </div>


                <div class="divBotones">
                    <button name="btn_cancelar" type="submit" id="btn_cancelar">CANCELAR</button>
                    <button name="bnt_actualizar" type="submit" id="btn_actualizar">CORREGIR</button>
                </div>

            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['bnt_actualizar'])) {

        $msg_fecha_no_valida = "";

        $consulta = $conn->prepare("UPDATE academia.tareas SET fechacorreccion=:fechacorreccion, estado=:estado WHERE id=:id");

        /* RECOGER VARIABLES DEL FORMULARIO */
        $id = $_POST['id'];
        $fechacorreccion = $_POST['fechacorreccion'];
        $estado = "Corregido";

        $hoy = date("Y-m-d");

        if ($fechacorreccion != null && ($fechacorreccion <= $hoy)) {
            $consulta->bindParam(':fechacorreccion', $fechacorreccion);
            $consulta->bindParam(':estado', $estado);
            $consulta->bindParam(':id', $id);

            if ($consulta->execute()) {
                echo '<script type="text/javascript">
                            window.location.href="corregirtareas.php";
                            alert("Tarea corregida.");
                        </script>';
            } else {

                echo '
                <script type="text/javascript">
                            alert("Error al corregir tarea.");
                            window.location.href="corregirtareas.php";
                        </script>';
            }
        } else {
            echo '
                <script type="text/javascript">
                    alert("Error. Indica una fecha correcta.");
                    window.location.href="corregirtareas.php";
                </script>';
        }
    }

    ?>

    <script src="dist/js/corregirtareas.js"></script>
    <script src="dist/js/estadotareas.js"></script>
</body>

</html>