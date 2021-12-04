<?php
    echo '
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="dist/css/menu.css" rel="stylesheet">
    <nav>

        <div class="opcionMenu">
            <a href="addtarea.php">
                <div class="divIconos"><span class="material-icons">add</span></div>
                AÑADIR TAREA
            </a>
            <a href="mostrartareas.php">
                <div class="divIconos"><span class="material-icons">menu_book</span></div>
                MIS TAREAS
            </a>
            <a href="">
                <div class="divIconos"><span class="material-icons">edit</span></div>
                CORREGIR TAREAS
            </a>
        </div>

        <div id="divLogout">
            <a href="addtarea.php">
                <div class="logo"><img src="img/nombreAcademia.png" alt="Imagen con el nombre de la academia"></div>
            </a>
            <a href="login.php">
                <div class="btn_logout"><span class="material-icons">logout</span></div>
            </a>

        </div>
    </nav>
    '
?>