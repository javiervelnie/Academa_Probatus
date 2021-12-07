<?php include 'dist/php/databaseconect.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis tareas</title>
    <link href="dist/css/mostrartareas.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
</head>

<body>
    <?php include 'dist/php/menu.php'; ?>

    <div id="contenedortabla">
        <table>
            <tr id="titulos">
                <td class="id-hidden">Id</td>
                <td>Asignatura</td>
                <td>Descripcion</td>
                <td>Estado</td>
                <td>Archivo</td>
                <td>Fecha de creacion</td>
                <td>Fecha de correccion</td>
            </tr>

            <?php
            $listaDeIdTareasAlumno = [];
            $idAlumno = $_SESSION['id'];
            $consulta = $conn->prepare("SELECT * FROM academia.tareas where idalumno = :idalumno;");
            $consulta->execute(array(':idalumno' => $idAlumno));

            if ($consulta) {
                $sql = $conn->prepare("SELECT nombre, apellidos FROM academia.alumno where id = :id;");
                $sql->execute(array(':id' => $idAlumno));
                $algo = $sql->fetch();
                $nombreApellidos = $algo['nombre'] . ' ' . $algo['apellidos'];
                while ($file = $consulta->fetch()) {
                    array_push($listaDeIdTareasAlumno, $file['id']);
                    $id = $file['id'];
            ?>

                    <tr class="fila">
                        <td class="id-hidden"><?php echo $file['id']  ?></td>
                        <td class="asignatura"><button <?php echo "id=$id" ?> class="btn-abrir-popup" name="btn-abrir-popup"><?php echo $file['asignatura']  ?></button></td>
                        <td class="descripcion"><?php echo $file['descripcion']  ?></td>
                        <td class="estado pendiente"><?php echo $file['estado']  ?></td>
                        <td class="archivo"><?php echo $file['archivo']  ?></td>
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
                    <table id="tabla">
                        <tr class="id-hidden"> <!-- class="id-hidden" -->
                            <td class="id-hidden">Id</td>
                            <td class="id-hidden"><input name="id" class="id-value" type="text"></td>
                        </tr>
                        <tr>
                            <td class="title">Asignatura</td>
                            <td class="value"><input class="asignatura-value inputs" readonly type="text"></td>
                        </tr>
                        <tr>
                            <td class="title">Estado</td>
                            <td class="value estado"><input class="estado-value inputs" type="text" readonly></td>
                        </tr>
                        <tr>
                            <td class="title">Fecha de creacion</td>
                            <td class="value"><input class="fcreacion-value inputs" type="text" readonly></td>
                        </tr>
                        <tr>
                            <td class="title">Tarea</td>
                            <td class="value"><input class="tarea-value" type="file" name="archivo" id="archivo"></td>
                        </tr>
                    </table>
                </div>

                <div class="contenedor-inputs lado-derecho">
                    <div>
                        <h5 class="descripcion">Descripcion</h5>
                        <textarea class="descripcion-value" name="descripcion"></textarea>
                    </div>
                </div>


                <div class="divBotones">
                    <button name="btn_cancelar" type="submit" id="btn_cancelar">CANCELAR</button>
                    <button name="bnt_actualizar" type="submit" id="btn_actualizar">ACTUALIZAR</button>
                </div>

            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['bnt_actualizar'])) {
        
        $consulta = $conn->prepare("UPDATE academia.tareas SET archivo=:archivo, descripcion=:descripcion, estado=:estado WHERE id=:id");

        /* RECOGER VARIABLES DEL FORMULARIO */
        $id = $_POST['id'];
        $archivo = $_POST['archivo'];
        $descripcion = $_POST['descripcion'];
        $estado = "Pendiente";
        
        $consulta->bindParam(':archivo', $archivo);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':estado', $estado);
        $consulta->bindParam(':id', $id);

        if ($consulta->execute()) {
            echo '<script type="text/javascript">
                        window.location.href="mostrartareas.php";
                        alert("Tarea actualizada.");
                    </script>';
        } else {
            
            echo '
            <script type="text/javascript">
                        window.location.href="mostartareas.php";
                        alert("Error al actualizar tarea.");
                    </script>';
        }
    }

    ?>

    <script src="dist/js/mostrartareas.js"></script>
    <script src="dist/js/estadotareas.js"></script>
</body>

</html>