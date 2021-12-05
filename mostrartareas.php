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

                    <tr>
                        <td><button type="submit" <?php echo "id=$id" ?> class="btn-abrir-popup" name="btn-abrir-popup"><?php echo $file['asignatura']  ?></button></td>
                        <td><?php echo $file['descripcion']  ?></td>
                        <td class="filaEstado"><?php echo $file['estado']  ?></td>
                        <td><?php echo $file['archivo']  ?></td>
                        <td><?php echo $file['fechacreacion']  ?></td>
                        <td><?php echo $file['fechacorreccion']  ?></td>
                    </tr>

            <?php
                }
                $_SESSION['listaDeIdTareasAlumno'] = $listaDeIdTareasAlumno;
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
            <h3>Actualizar tarea de </h3>
            <h4>Detalles</h4>
            <form id="principal" action="" method="POST" name="formulario">

                <div class="contenedor-inputs lado-izquierdo">
                    <table id="tabla">
                        <tr>
                            <td class="title">Asignatura</td>
                            <td class="value">Lengua</td>
                        </tr>
                        <tr>
                            <td class="title">Estado</td>
                            <td class="value">Corregida</td>
                        </tr>
                        <tr>
                            <td class="title">Fecha de correccion</td>
                            <td class="value">2021-05-00</td>
                        </tr>
                        <tr>
                            <td class="title">Tarea</td>
                            <td class="value"><input type="file" name="archivo" id="archivo"></td>
                        </tr>
                    </table>
                </div>

                <div class="contenedor-inputs lado-derecho">
                    <div>
                        <h5 class="descripcion">Descripcion</h5>
                        <textarea></textarea>
                    </div>
                </div>


                <div class="divBotones">
                    <button>Actualizar</button>
                </div>

            </form>
        </div>
    </div>

    <script src="dist/js/mostrartareas.js"></script>
    <script src="dist/js/estadotareas.js"></script>
</body>

</html>