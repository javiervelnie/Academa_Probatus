<?php

require_once "dist/php/databaseconect.php";

$msg_error_login = "";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password1 = $_POST['password1'];

    if ($email != "" || $password1 != "") {

        $consulta = $conn->prepare("SELECT * FROM academia.alumno WHERE email=:email");
        $consulta->bindParam(':email', $email);
        $consulta->execute();

        $existe = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($existe) {
            $sql = $conn->prepare("SELECT * FROM academia.alumno WHERE email=:email AND password1=:password1");
            $sql->bindParam('email', $email);
            $sql->bindParam('password1', $password1);
            $sql->execute();

            $existe = $sql->fetch(PDO::FETCH_ASSOC);

            if ($existe) {
                $sth = $conn->prepare("SELECT id FROM academia.alumno WHERE email=:email");
                $sth->execute(array(':email' => $email));
                $file = $sth->fetch();
                $idConsulta = $file['id'];
                $_SESSION['id'] = $idConsulta;
                header('Location:addtarea.php');
            } else {
                $msg_error_login = "<div style='text-align:center;'><h4 style='color:red; align:center; font-family: Arial, Helvetica, sans-serif;'>Email o contraseña incorrectos</h4></div>";
            }
        } else {
            $msg_error_login = "<div style='text-align:center;'><h4 style='color:red; align:center; font-family: Arial, Helvetica, sans-serif;'>Email o contraseña incorrectos</h4></div>";
        }
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
    <form id="principal" action="" method="POST" name="formulario">
        <div id="titulo"><img id="img_nombre"src="img/nombreAcademia.png"><img id="img_libro" src="img/logoAcademia.png"></div>
        <div id="datos">
            <p>Email</p><input type="text" name="email" required="true">
            <p>Contraseña</p><input type="password" name="password1" required="true">
        </div>
        <div id="registerandforgotkey">
            <a href="registro.php">Registrate aqui</a>
        </div>
        <?php echo $msg_error_login ?>
        <div id="btn_login">
            <button type="submit" id="btn_entrar" name="login">ENTRAR</button>
        </div>
    </form>
</body>

</html>