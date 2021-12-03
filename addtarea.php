<?php

echo '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir tareas</title>
    <link href="dist/css/añadirtarea.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
';

include 'dist/php/menu.php';

echo '
    <main>
        <div id="cabecera">
            <h3>Nueva tarea</h3>
        </div>
        <form>
            <div class="campos">
                <div>
                    <div><label aria-required="true">Asignatura</label></div>
                    <div>
                        <select id="asignaturas" name="asignaturas">
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
                        <div><input type="file"></div>
                    </div>
                </div>
            </div>

            <div class="campos">
                <div><label aria-required="true">Decripcion</label></div>
                <div><textarea name="descripcion"></textarea></div>
            </div>
            
        </form>
    </main>
</body>

</html>
';
