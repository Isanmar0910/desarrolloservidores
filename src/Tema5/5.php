<?php
session_start();

const USUARIO = "ElPapu";
const CONTRASEÑA = 67;

if (isset($_GET["cerrar"])) {
    session_destroy();
    header("Location: 5.php");
    exit;
}

$user = $_POST["usuario"] ?? "";
$pass = $_POST["contraseña"] ?? "";
$error = "";

if (!empty($user) && !empty($pass)) {
    if ($user == USUARIO && $pass == CONTRASEÑA) {
        $_SESSION["usuario"] = $user;
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php if (isset($_SESSION["usuario"])) { ?>

        <h1>Bienvenido, <?php echo $_SESSION["usuario"]; ?></h1>
        <a href="5.php?cerrar=1">Cerrar sesión</a>

    <?php } else { ?>

        <form action="5.php" method="post">

            usuario <input type="text" name="usuario"><br>
            contraseña <input type="password" name="contraseña">
            <button>Enviar</button>

        </form>

        <p><?php echo $error; ?></p>

    <?php } ?>

</body>

</html>