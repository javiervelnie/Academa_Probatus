<?php include 'dist/php/databaseconect.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis tareas</title>
    <link href="dist/css/mostrartareas.css" rel="stylesheet">
</head>

<body>
    <?php include 'dist/php/menu.php'; ?>

    <div id="contenedortabla">
        <table>
            <tr id="titulos">
                <td>Asignatura</td>
                <td>Descripcion</td>
                <td>Estado</td>
                <td>Alumno</td>
                <td>Archivo</td>
                <td>Fecha de creacion</td>
                <td>Fecha de correccion</td>
            </tr>

            <?php
            $idAlumno = $_SESSION['id'];
            $consulta = $conn->prepare("SELECT * FROM academia.tareas where idalumno = :idalumno;");
            $consulta->execute(array(':idalumno' => $idAlumno));

            if ($consulta) {
                while ($file = $consulta->fetch()) {
            ?>

                <tr>
                    <td><?php echo $file['asignatura']  ?></td>
                    <td><?php echo $file['descripcion']  ?></td>
                    <td><?php echo $file['estado']  ?></td>
                    <td><?php echo $file['idalumno']  ?></td>
                    <td><?php echo $file['archivo']  ?></td>
                    <td><?php echo $file['fechacreacion']  ?></td>
                    <td><?php echo $file['fechacorreccion']  ?></td>
                </tr>

            <?php
                }
            }
            ?>
        </table>
    </div>
</body>

</html>