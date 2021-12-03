<?php 

require_once "dist/php/databaseconect.php";

$msg_error_login = "";

if (isset($_POST['btn_entrar'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    echo'<script>console.log("LLego aqui");</script>';
    if ($email != "" && $password != "") {

        $consulta = $conn->prepare("SELECT * FROM academia.alumno WHERE email='$email'");
        $consulta->bindParam('email', $email);

        if ($consulta->execute()) {
            echo'<script>console.log("LLego aqui");</script>';
            $consulta = $conn->prepare("SELECT * FROM academia.alumno WHERE email='$email' AND password = '$password'");
            $consulta->bindParam('email', $email);
            $consulta->bindParam('password', $password);

            if ($consulta->execute()) {
                header('Location:añadirtarea.php');
            } else {
                $msg_error_login = "<div style='text-align:center;'><h4 style='color:red; align:center;'>Email o contraseña incorrecta</h4><div>";
            }
        } else {
            $msg_error_login = "<div style='text-align:center;'><h4 style='color:red; align:center;'>Email o contraseña incorrecta</h4><div>";
        }
    }  else {
        $msg_error_login = "<div style='text-align:center;'><h4 style='color:red; align:center;'>Email o contraseña incorrecta</h4><div>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="dist/css/login.css" rel="stylesheet">
</head>

<body>
    <div id="principal">
        <div id="titulo"><img src="img/nombreAcademia.png"><img src="img/logoAcademia.png"></div>
        <div id="datos">
            <p>Email</p><input type="text" name="email" required="true">
            <p>Contraseña</p><input type="password" name="password" required="true">
        </div>
        <div id="registerandforgotkey">
            <a href="registro.php">Registrate aqui</a>
        </div>
        <?php echo $msg_error_login ?>
        <div id="btn_login">
            <button type="submit" id="btn_entrar" name="btn_entrar">ENTRAR</button>
        </div>
    </div>
</body>

</html>