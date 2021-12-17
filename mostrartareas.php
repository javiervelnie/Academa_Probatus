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
    <?php include 'dist/php/menu_a.php';
    $idAlumno = $_SESSION['id']; ?>

    <div id="filtros">
        <div class="contenedor-filtro">
            <select class="select-css" id="asignatura" name="asignatura">
                <option selected="true" value="escoge">--Filtrar por asignatura--</option>
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

        <div class="contenedor-filtro">
            <select class="select-css" id="estado" name="estado">
                <option selected="true" value="escoge">--Filtrar por estado--</option>
                <option value="Biologia">Pendiente</option>
                <option value="Fisica y Quimica">Corregida</option>
            </select>
        </div>
    </div>

    <div id="contenedortabla">
        <table>
            <tr id="titulos">
                <td class="id-hidden">Id</td>
                <td>Asignatura</td>
                <td>Descripcion</td>
                <td>Estado</td>
                <td class="archivo">Archivo</td>
                <td class="fechacreacion">Fecha de creacion</td>
                <td class="fechacorreccion">Fecha de correccion</td>
            </tr>

            <?php
            $listaDeIdTareasAlumno = [];
            $consulta = $conn->prepare("SELECT * FROM academia.tareas where idalumno = :idalumno;");
            $consulta->execute(array(':idalumno' => $idAlumno));

            if ($consulta) {
                $sql = $conn->prepare("SELECT nombre, apellidos FROM academia.alumno where id = :id;");
                $sql->execute(array(':id' => $idAlumno));
                $algo = $sql->fetch();
                $nombreApellidos = $algo['nombre'] . ' ' . $algo['apellidos'];
                while ($file = $consulta->fetch()) {
                    array_push($listaDeIdTareasAlumno, $file['id']);
                    $id = $file['id']; //El id de cada tarea
                    $idarchivo = $file['idarchivo']; //El id de cada archivo dentro de tabla "tareas"
                   
                    if ($idarchivo != "") {
                        $consulta2 = $conn->prepare("SELECT * FROM academia.archivos WHERE id=:id");
                        $consulta2->execute(array(':id' => $idarchivo));
                        $otra = $consulta2->fetch();
                        $nombreConsulta = $otra['nombre'];
                        $nombreOriginal = substr($otra['nombre'], 1);

            ?>

                        <tr class="fila">
                            <td class="id-hidden"><?php echo $file['id']  ?></td>
                            <td class="asignatura"><button <?php echo "id=$id" ?> class="btn-abrir-popup" name="btn-abrir-popup"><?php echo $file['asignatura']  ?></button></td>
                            <td class="descripcion"><?php echo $file['descripcion']  ?></td>
                            <td class="estado pendiente"><?php echo $file['estado']  ?></td>
                            <td class="archivo"><a target="blank" href="<?php echo "uploads/" . $nombreConsulta ?>"><?php echo $nombreOriginal  ?></a></td>
                            <td class="fechacreacion"><?php echo $file['fechacreacion']  ?></td>
                            <td class="fechacorreccion"><?php echo $file['fechacorreccion']  ?></td>
                        </tr>

                    <?php
                    } else { ?>

                        <tr class="fila">
                            <td class="id-hidden"><?php echo $file['id']  ?></td>
                            <td class="asignatura"><button <?php echo "id=$id" ?> class="btn-abrir-popup" name="btn-abrir-popup"><?php echo $file['asignatura']  ?></button></td>
                            <td class="descripcion"><?php echo $file['descripcion']  ?></td>
                            <td class="estado pendiente"><?php echo $file['estado']  ?></td>
                            <td class="archivo"><a target="blank" href="#"></a></td>
                            <td class="fechacreacion"><?php echo $file['fechacreacion']  ?></td>
                            <td class="fechacorreccion"><?php echo $file['fechacorreccion']  ?></td>
                        </tr>

            <?php }
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
            <form id="principal" action="" method="POST" name="formulario" enctype="multipart/form-data">

                <div class="contenedor-inputs lado-izquierdo">
                    <table id="tabla">
                        <tr class="id-hidden">
                            <!-- class="id-hidden" -->
                            <td class="id-hidden">Id</td>
                            <td class="id-hidden"><input name="id" class="id-value" type="text"></td>
                        </tr>
                        <tr>
                            <td class="title">Asignatura</td>
                            <td class="value"><input class="asignatura-value inputs" readonly type="text" name="asignatura"></td>
                        </tr>
                        <tr>
                            <td class="title">Estado</td>
                            <td class="value estado"><input class="estado-value inputs" type="text" readonly></td>
                        </tr>
                        <tr>
                            <td class="title">Fecha de creacion</td>
                            <td class="value"><input class="fcreacion-value inputs" type="text" readonly name="fechacreacion"></td>
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

        $nulo = null;
        /* RECOGER VARIABLES DEL FORMULARIO */
        $id = $_POST['id'];
        $asignatura = $_POST['asignatura'];
        $fechacreacion = $_POST['fechacreacion'];
        htmlspecialchars($descripcion = $_POST['descripcion']);
        $estado = "Pendiente";
        $fechacorreccion = null;

        /* COMPROBAR SI HAY O NO ARCHIVO EN ESTA TAREA */
        if ($_FILES['archivo']['name'] != null) { //Si contiene un archivo
            $nombre_base = $_FILES["archivo"]["name"];
            $nombre_final = $idAlumno . str_replace(" ", "-", $nombre_base);
            $directorio = "uploads/";
            $subir_archivo = $directorio . basename($nombre_final);

            $tmpname = $_FILES["archivo"]["tmp_name"];
            $rutaCompleta = $directorio . basename($tmpname);
            $tipo = $_FILES["archivo"]["type"];
            $size = $_FILES["archivo"]["size"] / 1024;

            $eliminarFilaTarea = $conn->prepare("DELETE FROM academia.tareas where id = :id;");
            $eliminarFilaTarea->bindParam(':id', $id);

            //Obtengo el id del archivo de esa tarea
            $consulta = $conn->prepare("SELECT idarchivo FROM academia.tareas where id = :id;");
            $consulta->execute(array(':id' => $id));
            $algo = $consulta->fetch();
            $idDelArchivo = $algo['idarchivo'];

            if ($eliminarFilaTarea->execute()) {
                //Elimino de los archivos en bdd el que tiene ese id
                $consulta2 = $conn->prepare("DELETE FROM academia.archivos where id = :id;");
                $consulta2->bindParam(':id', $idDelArchivo);

                if (file_exists($subir_archivo)) {
                    unlink($subir_archivo);
                    if ($tipo == "application/pdf" && $consulta2->execute()) {

                        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $subir_archivo)) {

                            $idArchivo;

                            /* CONSULTA AÑADIR ARCHIVO */
                            $consulta3 = $conn->prepare("INSERT INTO archivos(nombre,tmpname,tipo,size,idalumno) VALUES (:nombre,:tmpname,:tipo,:size,:idalumno)");
                            $consulta3->bindParam(':nombre', $nombre_final);
                            $consulta3->bindParam(':tmpname', $tmpname);
                            $consulta3->bindParam(':tipo', $tipo);
                            $consulta3->bindParam(':size', $size);
                            $consulta3->bindParam(':idalumno', $idAlumno);

                            if ($consulta3->execute()) {
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

                                if ($consulta->execute()) {
                                    echo '<script type="text/javascript">
                            window.location.href="mostrartareas.php";
                            alert("Tarea actualizada.");
                        </script>';
                                } else {
                                    echo '
                                        <script type="text/javascript">
                                            window.location.href="mostrartareas.php";
                                            alert("Error al actualizar tarea.");
                                        </script>';
                                }
                            } else {
                                echo '
                                    <script type="text/javascript">
                                        window.location.href="mostrartareas.php";
                                        alert("Error al añadir archivo.");
                                    </script>';
                            }
                        } else {
                            echo '
                    <script type="text/javascript">
                                window.location.href="mostrartareas.php";
                                alert("Error al subir el archivo.");
                            </script>';
                        }
                    } else {
                        echo '
                <script type="text/javascript">
                            window.location.href="mostrartareas.php";
                            alert("Error. Solo .pdf");
                        </script>';
                    }
                } else {
                    if ($tipo == "application/pdf" && $consulta2->execute()) {

                        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $subir_archivo)) {

                            $idArchivo;

                            /* CONSULTA AÑADIR ARCHIVO */
                            $consulta3 = $conn->prepare("INSERT INTO archivos(nombre,tmpname,tipo,size,idalumno) VALUES (:nombre,:tmpname,:tipo,:size,:idalumno)");
                            $consulta3->bindParam(':nombre', $nombre_final);
                            $consulta3->bindParam(':tmpname', $tmpname);
                            $consulta3->bindParam(':tipo', $tipo);
                            $consulta3->bindParam(':size', $size);
                            $consulta3->bindParam(':idalumno', $idAlumno);

                            if ($consulta3->execute()) {
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

                                if ($consulta->execute()) {
                                    echo '<script type="text/javascript">
                            window.location.href="mostrartareas.php";
                            alert("Tarea actualizada.");
                        </script>';
                                } else {
                                    echo '
                                        <script type="text/javascript">
                                            window.location.href="mostrartareas.php";
                                            alert("Error al actualizar tarea.");
                                        </script>';
                                }
                            } else {
                                echo '
                                    <script type="text/javascript">
                                        window.location.href="mostrartareas.php";
                                        alert("Error al añadir archivo.");
                                    </script>';
                            }
                        } else {
                            echo '
                    <script type="text/javascript">
                                window.location.href="mostrartareas.php";
                                alert("Error al subir el archivo.");
                            </script>';
                        }
                    } else {
                        echo '
                <script type="text/javascript">
                            window.location.href="mostrartareas.php";
                            alert("Error. Solo .pdf");
                        </script>';
                    }
                }
            }
        } else {
            //Obtengo el id del archivo de esa tarea
            $consulta = $conn->prepare("SELECT idarchivo FROM academia.tareas where id = :id;");
            $consulta->execute(array(':id' => $id));
            $algo = $consulta->fetch();
            $idDelArchivo = $algo['idarchivo'];

            if ($idDelArchivo != null) {
                $consulta12 = $conn->prepare("SELECT nombre FROM academia.archivos where id = :id;");
                $consulta12->execute(array(':id' => $idDelArchivo));
                $algo12 = $consulta12->fetch();
                $nombre_archivo = $algo12['nombre'];

                $directorio = "uploads/";
                $subir_archivo = $directorio . basename($nombre_archivo);

                $nulo = null;

                $eliminarFilaTarea = $conn->prepare("DELETE FROM academia.tareas where id = :id;");
                $eliminarFilaTarea->bindParam(':id', $id);

                if ($eliminarFilaTarea->execute()) {
                    //Elimino de los archivos en bdd el que tiene ese id
                    $consulta2 = $conn->prepare("DELETE FROM academia.archivos where id = :id;");
                    $consulta2->bindParam(':id', $idDelArchivo);

                    if (file_exists($subir_archivo) && $consulta2->execute()) {
                        unlink($subir_archivo);
                        $eliminarFilaArchivo = $conn->prepare("DELETE FROM academia.archivos where id = :id;");
                        $eliminarFilaTarea->bindParam(':id', $idDelArchivo);

                        $consulta = $conn->prepare("INSERT INTO tareas(asignatura,descripcion,estado,idalumno,idarchivo,fechacreacion,fechacorreccion) VALUES (:asignatura,:descripcion,:estado,:idalumno,:idarchivo,:fechacreacion,:fechacorreccion)");
                        $consulta->bindParam(':asignatura', $asignatura);
                        $consulta->bindParam(':descripcion', $descripcion);
                        $consulta->bindParam(':estado', $estado);
                        $consulta->bindParam(':idalumno', $idAlumno);
                        $consulta->bindParam(':idarchivo', $nulo);
                        $consulta->bindParam(':fechacreacion', $fechacreacion);
                        $consulta->bindParam(':fechacorreccion', $fechacorreccion);

                        if ($consulta->execute()) {
                            echo '<script type="text/javascript">
                        window.location.href="mostrartareas.php";
                        alert("Tarea actualizada.");
                    </script>';
                        } else {
                            echo '
                            <script type="text/javascript">
                                window.location.href="mostrartareas.php";
                                alert("Error al actualizar tarea.");
                            </script>';
                        }
                    } else {
                        echo '
                        <script type="text/javascript">
                            window.location.href="mostrartareas.php";
                            alert("Error. Solo .pdf");
                        </script>';
                    }
                }
            } else {
                $eliminarFilaTarea = $conn->prepare("DELETE FROM academia.tareas where id = :id;");
                $eliminarFilaTarea->bindParam(':id', $id);

                if ($eliminarFilaTarea->execute()) {

                    $consulta = $conn->prepare("INSERT INTO tareas(asignatura,descripcion,estado,idalumno,idarchivo,fechacreacion,fechacorreccion) VALUES (:asignatura,:descripcion,:estado,:idalumno,:idarchivo,:fechacreacion,:fechacorreccion)");
                    $consulta->bindParam(':asignatura', $asignatura);
                    $consulta->bindParam(':descripcion', $descripcion);
                    $consulta->bindParam(':estado', $estado);
                    $consulta->bindParam(':idalumno', $idAlumno);
                    $consulta->bindParam(':idarchivo', $nulo);
                    $consulta->bindParam(':fechacreacion', $fechacreacion);
                    $consulta->bindParam(':fechacorreccion', $fechacorreccion);

                    if ($consulta->execute()) {
                        echo '<script type="text/javascript">
                                window.location.href="mostrartareas.php";
                                alert("Tarea actualizada.");
                            </script>';
                    } else {
                        echo '
                            <script type="text/javascript">
                                window.location.href="mostrartareas.php";
                                alert("Error al actualizar tarea.");
                            </script>';
                    }
                }
            }
        }
    }

    ?>

    <script src="dist/js/mostrartareas.js"></script>
    <script src="dist/js/estadotareas.js"></script>
</body>

</html>