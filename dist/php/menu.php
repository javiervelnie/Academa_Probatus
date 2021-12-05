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
            <a href="corregirtareas.php">
                <div class="divIconos"><span class="material-icons">edit</span></div>
                CORREGIR TAREAS
            </a>
        </div>

        <form id="divLogout"  action="" method="POST" name="formulario">
            <a href="addtarea.php">
                <div class="logo"><img src="img/nombreAcademia.png" alt="Imagen con el nombre de la academia"></div>
            </a>
            
            <button name="btn_salir" class="btn_salir">
                <span class="material-icons">logout</span>
            </button>

        </form>
    </nav>
    ';

    include "dist/php/destruirsesion.php";

    if (isset($_POST['btn_salir'])) {
        destroySession();
        echo '<script type="text/javascript">window.location.href="login.php";</script>';
    }
?>